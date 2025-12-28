<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\DataEngineModel;
use App\Models\EngineMaintenanceModel;
use App\Models\AlertModel;
use App\Models\ProduksiModel;
use App\Models\TahunAktifModel;



class Home extends BaseController
{
    protected $barang;
    protected $dataEngine;
    protected $maintenance;
    protected $alertModel;
    protected $produksiModel;
    protected $tahunAktifModel; 

    public function __construct()
    {
        $this->barang      = new BarangModel();
        $this->dataEngine  = new DataEngineModel();
        $this->maintenance = new EngineMaintenanceModel();
        $this->alertModel = new AlertModel();
        $this->produksiModel = new ProduksiModel();
        $this->tahunAktifModel = new TahunAktifModel();
    }

    public function index()
    {
        $tahun = $this->tahunAktifModel->where('is_active',1)->first()['tahun'];

        $summary = $this->produksiModel
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
            ->where('tahun',$tahun)
            ->first();
        $summary = array_map(fn($v) => $v ?? 0, $summary);


        // $alertModel = new AlertModel();
        // $alerts = $alertModel->where('is_active', 1)->findAll();
        $engineList = $this->barang
            ->where('kategori', 'engine')
            ->orderBy('nama_barang', 'ASC')
            ->findAll();

        $engines = [];

        foreach ($engineList as $e) {

            // =========================
            // DATA ENGINE TERAKHIR
            // =========================
            $lastEngine = $this->dataEngine
                ->where('idbarang', $e['id'])
                ->orderBy('tanggal', 'DESC')
                ->first();

            $hmTerakhir = $lastEngine['hm_akhir'] ?? 0;

            $jamOperasi = ($lastEngine)
                ? ($lastEngine['hm_akhir'] - $lastEngine['hm_awal'])
                : null;

            $kwh = $lastEngine['kwh'] ?? null;

            // =========================
            // OLI (interval 2000 HM)
            // =========================
            $oli = $this->getMaintenance($e['id'], 'oli', 2000, $hmTerakhir);

            // =========================
            // OVERHAUL (interval 30000 HM)
            // =========================
            $overhaul = $this->getMaintenance($e['id'], 'overhaul', 30000, $hmTerakhir);

            $engines[] = [
                'nama'        => $e['nama_barang'],
                'jam_operasi' => $jamOperasi,
                'kwh'         => $kwh,
                'oli'         => $oli,
                'overhaul'    => $overhaul
            ];
        }
        

        return view('index', compact('engines',  'summary', 'tahun'));
    }

    private function getMaintenance($idbarang, $jenis, $interval, $hmTerakhir)
    {
        $row = $this->maintenance
            ->where('idbarang', $idbarang)
            ->like('jenis_maintenance', $jenis)
            ->orderBy('tanggal', 'DESC')
            ->first();

        if (!$row) {
            return null;
        }

        $target = $row['hm_saat_maintenance'] + $interval;
        $sisa   = $target - $hmTerakhir;

        if ($sisa <= 0) {
            $status = 'danger';
        } elseif ($sisa <= 500) {
            $status = 'warning';
        } else {
            $status = 'success';
        }

        return [
            'sisa_jam' => round($sisa),
            'status'   => $status,
            'tanggal'  => $row['tanggal']
        ];
    }
}
