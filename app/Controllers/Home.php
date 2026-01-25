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
        /** =========================
         * TAHUN AKTIF
         * ========================= */
        $tahunRow = $this->tahunAktif->where('is_active', 1)->first();
        $tahun = $tahunRow ? $tahunRow['tahun'] : date('Y');

        /** =========================
         * BUDGET
         * ========================= */
        $budget = $this->budget->where('tahun', $tahun)->first();
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

        /** =========================
         * FILTER PERIODE MCP
         * ========================= */
        $periode = $this->request->getGet('periode') ?? 'januari';

        $periodeMap = [
            'januari'   => ["$tahun-01-01", "$tahun-01-25"],
            'februari'  => ["$tahun-01-26", "$tahun-02-25"],
            'maret'     => ["$tahun-02-26", "$tahun-03-25"],
            'april'     => ["$tahun-03-26", "$tahun-04-25"],
            'mei'       => ["$tahun-04-26", "$tahun-05-25"],
            'juni'      => ["$tahun-05-26", "$tahun-06-25"],
            'juli'      => ["$tahun-06-26", "$tahun-07-25"],
            'agustus'   => ["$tahun-07-26", "$tahun-08-25"],
            'september' => ["$tahun-08-26", "$tahun-09-25"],
            'oktober'   => ["$tahun-09-26", "$tahun-10-25"],
            'november'  => ["$tahun-10-26", "$tahun-11-25"],
            'desember'  => ["$tahun-11-26", "$tahun-12-31"],
        ];

        [$startDate, $endDate] = $periodeMap[$periode];

        /** =========================
         * SUMMARY PRODUKSI
         * ========================= */
        $summary = $this->produksi
            ->select('
                SUM(ton_tbs_olah) AS ton_tbs,
                SUM(pome) AS pome,
                SUM(umpan_bioreaktor) AS umpan,
                SUM(flare + gas_out_scrubber) AS biogas,
                SUM(produksi_daya_listrik) AS listrik,
                SUM(ton_kernel_olah) AS kernel,
                (SUM(produksi_daya_listrik) / NULLIF(SUM(gas_out_scrubber),0)) AS kwh_biogas,
                ((SUM(flare + gas_out_scrubber)) / NULLIF(SUM(umpan_bioreaktor),0)) AS biogas_pome
            ')
            ->where('tahun', $tahun)
            ->first();

        $summary = array_map(fn($v) => $v ?? 0, $summary);

        /** =========================
         * CHART BIOGAS
         * ========================= */
        $biogasRows = $this->produksi
            ->select('tanggal, flare, gas_out_scrubber, (flare + gas_out_scrubber) AS total_biogas')
            ->where('tanggal >=', $startDate)
            ->where('tanggal <=', $endDate)
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $chartLabels = [];
        $chartFlare = [];
        $chartScrubber = [];
        $chartTotal = [];

        foreach ($biogasRows as $r) {
            $chartLabels[]   = date('d-m', strtotime($r['tanggal']));
            $chartFlare[]    = (float)$r['flare'];
            $chartScrubber[] = (float)$r['gas_out_scrubber'];
            $chartTotal[]    = (float)$r['total_biogas'];
        }

        /** =========================
         * CHART LISTRIK + DISTRIBUSI
         * ========================= */
        $listrikRows = $this->produksi
            ->select('id, tanggal, produksi_daya_listrik')
            ->where('tanggal >=', $startDate)
            ->where('tanggal <=', $endDate)
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $labelsListrik = [];
        $totalListrik = [];
        $kcp = [];
        $pks = [];
        $mcp = [];
        $estate = [];
        $granul = [];

        foreach ($listrikRows as $r) {
            $labelsListrik[] = date('d-m', strtotime($r['tanggal']));
            $totalListrik[] = (float)$r['produksi_daya_listrik'];

            $dist = db_connect()->table('produksi_power_distribution')
                ->where('produksi_id', $r['id'])
                ->get()
                ->getResultArray();

            $map = ['kcp'=>0,'pks_gateng'=>0,'mcp'=>0,'estate'=>0,'granul'=>0];
            foreach ($dist as $d) {
                $map[strtolower($d['unit'])] = (float)$d['daya_listrik'];
            }

            $kcp[]    = $map['kcp'];
            $pks[]    = $map['pks_gateng'];
            $mcp[]    = $map['mcp'];
            $estate[] = $map['estate'];
            $granul[] = $map['granul'];
        }

        return view('index', [
            'tahun' => $tahun,
            'budget' => $budget,
            'summary' => $summary,
            'periode' => $periode,

            'chartLabels'   => json_encode($chartLabels),
            'chartFlare'    => json_encode($chartFlare),
            'chartScrubber' => json_encode($chartScrubber),
            'chartTotal'    => json_encode($chartTotal),

            'labelsListrik' => json_encode($labelsListrik),
            'totalListrik'  => json_encode($totalListrik),
            'kcp' => json_encode($kcp),
            'pks' => json_encode($pks),
            'mcp' => json_encode($mcp),
            'estate' => json_encode($estate),
            'granul' => json_encode($granul),
        ]);
    }

    private function hitungMaintenance(int $idbarang, string $jenis, ?int $hmTerakhir)
    {
        if ($hmTerakhir === null) return null;

        $row = $this->maintenance
            ->where('idbarang', $idbarang)
            ->like('jenis_maintenance', $jenis)
            ->orderBy('tanggal', 'DESC')
            ->first();

        if (!$row || empty($row['interval_hm'])) return null;

        $interval = (int)$row['interval_hm'];
        $hmNext  = (int)$row['hm_saat_maintenance'] + $interval;
        $sisaJam = max($hmNext - $hmTerakhir, 0);

        if ($sisaJam <= 0) $status = 'danger';
        elseif ($sisaJam <= 500) $status = 'warning';
        else $status = 'success';

        return [
            'sisa_jam' => round($sisaJam),
            'status' => $status,
            'estimasi_tanggal' => date('d M Y', strtotime('+' . ceil($sisaJam / 24) . ' days'))
        ];
    }
}
