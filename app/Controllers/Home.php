<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\DataEngineModel;
use App\Models\EngineMaintenanceModel;
use App\Models\ProduksiModel;
use App\Models\TahunAktifModel;
use App\Models\BudgetModel;

class Home extends BaseController
{
    protected $barang;
    protected $dataEngine;
    protected $maintenance;
    protected $produksi;
    protected $tahunAktif;
    protected $budget;

    public function __construct()
    {
        $this->barang      = new BarangModel();
        $this->dataEngine  = new DataEngineModel();
        $this->maintenance = new EngineMaintenanceModel();
        $this->produksi    = new ProduksiModel();
        $this->tahunAktif  = new TahunAktifModel();
        $this->budget      = new BudgetModel();
    }

    public function index()
    {
        /**
         * =========================
         * TAHUN AKTIF
         * =========================
         */
        $tahunRow = $this->tahunAktif
            ->where('is_active', 1)
            ->first();

        $tahun = $tahunRow ? $tahunRow['tahun'] : date('Y');

        /**
         * =========================
         * BUDGET TAHUNAN
         * =========================
         */
        $budget = $this->budget
            ->where('tahun', $tahun)
            ->first();

        // fallback jika budget belum ada
        $budget = $budget ?? [
            'ton_tbs' => 0,
            'pome' => 0,
            'umpan_bioreaktor' => 0,
            'produksi_biogas' => 0,
            'produksi_daya_listrik' => 0,
            'ton_kernel' => 0,
            'kwh_per_biogas' => 0,
            'biogas_per_pome' => 0
        ];

        /**
         * =========================
         * SUMMARY PRODUKSI
         * =========================
         */
        $summary = $this->produksi
            ->select('
                SUM(ton_tbs_olah) AS ton_tbs,
                SUM(pome) AS pome,
                SUM(umpan_bioreaktor) AS umpan,
                SUM(produksi_biogas) AS biogas,
                SUM(produksi_daya_listrik) AS listrik,
                SUM(ton_kernel_olah) AS kernel,
                AVG(kwh_per_biogas) AS kwh_biogas,
                AVG(biogas_per_pome) AS biogas_pome
            ')
            ->where('tahun', $tahun)
            ->first();

        // pastikan tidak null
        $summary = array_map(fn($v) => $v ?? 0, $summary);

        /**
         * =========================
         * DATA ENGINE DASHBOARD
         * =========================
         */
        $engineList = $this->barang
            ->where('kategori', 'engine')
            ->orderBy('nama_barang', 'ASC')
            ->findAll();

        $engines = [];

        foreach ($engineList as $e) {

            /**
             * HM TERAKHIR ENGINE (DATA_ENGINE)
             */
            $lastEngine = $this->dataEngine
                ->where('idbarang', $e['id'])
                ->orderBy('tanggal', 'DESC')
                ->first();

            $hmTerakhir = $lastEngine ? (int) $lastEngine['hm_akhir'] : null;

            $jamOperasi = $lastEngine
                ? ((int)$lastEngine['hm_akhir'] - (int)$lastEngine['hm_awal'])
                : null;

            $kwh = $lastEngine['kwh'] ?? null;

            /**
             * MAINTENANCE (INTERVAL AMBIL DARI DB)
             */
            $oli = $this->hitungMaintenance(
                $e['id'],
                'oli',
                $hmTerakhir
            );

            $overhaul = $this->hitungMaintenance(
                $e['id'],
                'overhaul',
                $hmTerakhir
            );

            $engines[] = [
                'nama'           => $e['nama_barang'],
                'jam_operasi'    => $jamOperasi,
                'kwh'            => $kwh,
                'oli_calc'       => $oli,
                'overhaul_calc'  => $overhaul
            ];
        }

        /**
         * =========================
         * RETURN VIEW
         * =========================
         */
        return view('index', [
            'tahun'   => $tahun,
            'budget'  => $budget,
            'summary' => $summary,
            'engines' => $engines
        ]);
    }

    /**
     * =========================
     * HITUNG MAINTENANCE ENGINE
     * =========================
     * interval_hm diambil dari DB
     */
    private function hitungMaintenance(
        int $idbarang,
        string $jenis,
        ?int $hmTerakhir
    ) {
        if ($hmTerakhir === null) {
            return null;
        }

        $row = $this->maintenance
            ->where('idbarang', $idbarang)
            ->like('jenis_maintenance', $jenis)
            ->orderBy('tanggal', 'DESC')
            ->first();

        if (!$row || empty($row['interval_hm'])) {
            return null;
        }

        $interval = (int) $row['interval_hm'];

        $hmNext  = (int)$row['hm_saat_maintenance'] + $interval;
        $sisaJam = max($hmNext - $hmTerakhir, 0);

        // status warna
        if ($sisaJam <= 0) {
            $status = 'danger';
        } elseif ($sisaJam <= 500) {
            $status = 'warning';
        } else {
            $status = 'success';
        }

        return [
            'sisa_jam' => round($sisaJam),
            'status'   => $status,
            'estimasi_tanggal' => date(
                'd M Y',
                strtotime('+' . ceil($sisaJam / 24) . ' days')
            )
        ];
    }
}
