<?php

namespace App\Controllers;

use App\Models\ProduksiModel;
use App\Models\TahunAktifModel;
use App\Models\ProduksiPowerDistributionModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProduksiController extends BaseController
{
    protected $produksi;
    protected $tahunAktif;
    protected $powerDist;

    public function __construct()
    {
        $this->produksi   = new ProduksiModel();
        $this->tahunAktif = new TahunAktifModel();
        $this->powerDist  = new ProduksiPowerDistributionModel();
    }

    private function getTahunAktif()
    {
        $row = $this->tahunAktif->where('is_active', 1)->first();

        if (!$row) {
            $tahun = date('Y');

            $this->tahunAktif->insert([
                'tahun'     => $tahun,
                'is_active' => 1
            ]);

            return $tahun;
        }

        return $row['tahun'];
    }

public function index()
    {
        $tahun = $this->getTahunAktif();

        $data = $this->produksi
            ->where('tahun', $tahun)
            ->orderBy('tanggal', 'DESC')
            ->paginate(25); 

        // ===== TAMBAHAN WARNING LOGIC =====
        $rows = $this->produksi
            ->select('tanggal')
            ->where('tahun', $tahun)
            ->findAll();

        $existingDates = array_column($rows, 'tanggal');

        $startDate = $tahun . '-01-01';
        $endDate   = date('Y-m-d', strtotime('-1 day')); // today - 1

        $missingDates = [];

        $current = strtotime($startDate);
        $end     = strtotime($endDate);

        while ($current <= $end) {
            $date = date('Y-m-d', $current);

            if (!in_array($date, $existingDates)) {
                $missingDates[] = $date;
            }

            $current = strtotime('+1 day', $current);
        }
        // ==================================

        return view('produksi/index', [
            'data'  => $data,
            'pager' => $this->produksi->pager,
            'tahun' => $tahun,
            'missingDates' => $missingDates
        ]);
    }


    public function create()
    {
        return view('produksi/create', [
            'tahun' => $this->getTahunAktif()
        ]);
    }

    public function store()
    {
        $db = db_connect();
        $db->transBegin();

        try {
            $tahun = $this->getTahunAktif();

            $this->produksi->insert([
                'tanggal' => $this->request->getPost('tanggal'),
                'tahun'   => $tahun,

                'ton_tbs_olah' => $this->request->getPost('ton_tbs_olah'),
                'pome' => $this->request->getPost('pome'),
                'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
                'flare' => $this->request->getPost('flare'),
                'gas_out_scrubber' => $this->request->getPost('gas_out_scrubber'),
                'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
                'ton_kernel_olah' => $this->request->getPost('ton_kernel_olah'),

                'created_by' => session('user_id')
            ]);

            $produksiId = $this->produksi->getInsertID();

            $units = ['KCP','PKS_GATENG','MCP','ESTATE','GRANUL'];

            foreach ($units as $unit) {
                $this->powerDist->insert([
                    'produksi_id' => $produksiId,
                    'unit' => $unit,
                    'daya_listrik' => $this->request->getPost(strtolower($unit))
                ]);
            }

            $db->transCommit();
            return redirect()->to('/produksi')->with('success','Data produksi disimpan');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $row = $this->produksi->find($id);

        // ambil distribusi power
        $power = $this->powerDist
            ->where('produksi_id', $id)
            ->findAll();

        // ubah jadi array: unit => nilai
        $powerMap = [];
        foreach ($power as $p) {
            $powerMap[strtolower($p['unit'])] = $p['daya_listrik'];
        }

        return view('produksi/edit', [
            'row' => $row,
            'power' => $powerMap
        ]);
    }


    public function update($id)
    {
        $db = db_connect();
        $db->transBegin();

        try {
            $this->produksi->update($id, [
                'ton_tbs_olah' => $this->request->getPost('ton_tbs_olah'),
                'pome' => $this->request->getPost('pome'),
                'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
                'flare' => $this->request->getPost('flare'),
                'gas_out_scrubber' => $this->request->getPost('gas_out_scrubber'),
                'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
                'ton_kernel_olah' => $this->request->getPost('ton_kernel_olah'),
                'updated_by' => session('user_id')
            ]);

            $this->powerDist->where('produksi_id', $id)->delete();

            $units = ['KCP','PKS_GATENG','MCP','ESTATE','GRANUL'];

            foreach ($units as $unit) {
                $this->powerDist->insert([
                    'produksi_id' => $id,
                    'unit' => $unit,
                    'daya_listrik' => $this->request->getPost(strtolower($unit))
                ]);
            }

            $db->transCommit();
            return redirect()->to('/produksi')->with('success','Data produksi diperbarui');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->produksi->delete($id);

        return redirect()->to('/produksi')
            ->with('success', 'Data produksi berhasil dihapus');
    }

    public function importExcel()
    {
        $file = $this->request->getFile('file_excel');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $ext = $file->getClientExtension();
        $reader = $ext === 'csv'
            ? IOFactory::createReader('Csv')
            : IOFactory::createReader('Xlsx');

        $spreadsheet = $reader->load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        $preview = [];
        $tahun = $this->getTahunAktif();

        foreach ($sheet as $i => $row) {
            if ($i === 0) continue;
            if (empty($row[0])) continue;

            $preview[] = [
                'tanggal' => $row[0],
                'ton_tbs_olah' => $row[1] ?? 0,
                'pome' => $row[2] ?? 0,
                'umpan_bioreaktor' => $row[3] ?? 0,
                'flare' => $row[4] ?? 0,
                'gas_out_scrubber' => $row[5] ?? 0,
                'produksi_daya_listrik' => $row[6] ?? 0,
                'ton_kernel_olah' => $row[7] ?? 0,
                'kcp' => $row[8] ?? 0,
                'pks_gateng' => $row[9] ?? 0,
                'mcp' => $row[10] ?? 0,
                'estate' => $row[11] ?? 0,
                'granul' => $row[12] ?? 0,
                'tahun' => $tahun
            ];
        }

        session()->set('produksi_preview', $preview);

        return view('produksi/import_preview', [
            'preview' => $preview,
            'tahun' => $tahun
        ]);
    }

    public function importSave()
    {
        $data = session()->get('produksi_preview');

        if (!$data) {
            return redirect()->to('/produksi')->with('error', 'Tidak ada data import');
        }

        foreach ($data as $row) {
            $exists = $this->produksi
                ->where('tanggal', $row['tanggal'])
                ->first();

            if ($exists) continue;

            $db = db_connect();
            $db->transBegin();

            try {
                $this->produksi->insert([
                    'tanggal' => $row['tanggal'],
                    'tahun' => $row['tahun'],
                    'ton_tbs_olah' => $row['ton_tbs_olah'],
                    'pome' => $row['pome'],
                    'umpan_bioreaktor' => $row['umpan_bioreaktor'],
                    'flare' => $row['flare'],
                    'gas_out_scrubber' => $row['gas_out_scrubber'],
                    'produksi_daya_listrik' => $row['produksi_daya_listrik'],
                    'ton_kernel_olah' => $row['ton_kernel_olah'],
                    'created_by' => session('user_id')
                ]);

                $id = $this->produksi->getInsertID();

                $map = [
                    'KCP' => $row['kcp'],
                    'PKS_GATENG' => $row['pks_gateng'],
                    'MCP' => $row['mcp'],
                    'ESTATE' => $row['estate'],
                    'GRANUL' => $row['granul'],
                ];

                foreach ($map as $unit => $val) {
                    $this->powerDist->insert([
                        'produksi_id' => $id,
                        'unit' => $unit,
                        'daya_listrik' => $val
                    ]);
                }

                $db->transCommit();

            } catch (\Throwable $e) {
                $db->transRollback();
            }
        }

        session()->remove('produksi_preview');

        return redirect()->to('/produksi')
            ->with('success', 'Import data produksi berhasil');
    }

    public function detail($id)
    {
        $row = $this->produksi->find($id);

        $power = $this->powerDist
            ->where('produksi_id', $id)
            ->findAll();

        return view('produksi/detail', [
            'row' => $row,
            'power' => $power
        ]);
    }


}
