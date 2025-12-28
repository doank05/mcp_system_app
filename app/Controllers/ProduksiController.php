<?php

namespace App\Controllers;

use App\Models\ProduksiModel;
use App\Models\TahunAktifModel;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ProduksiController extends BaseController
{
    protected $produksi;
    protected $tahunAktif;

    public function __construct()
    {
        $this->produksi   = new ProduksiModel();
        $this->tahunAktif = new TahunAktifModel();
    }

    private function getTahunAktif()
    {
        $row = $this->tahunAktif->where('is_active', 1)->first();

        // Jika belum ada tahun aktif, buat otomatis
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

    return view('produksi/index', [
        'data'  => $data,
        'pager' => $this->produksi->pager,
        'tahun' => $tahun
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
        $tahun = $this->getTahunAktif();
        if (!$tahun) {
            return redirect()->back()->with('error', 'Tahun aktif belum tersedia');
        }

        $this->produksi->insert([
            'tanggal' => $this->request->getPost('tanggal'),
            'tahun'   => $this->getTahunAktif(),

            'ton_tbs_olah' => $this->request->getPost('ton_tbs_olah'),
            'pome' => $this->request->getPost('pome'),
            'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
            'produksi_biogas' => $this->request->getPost('produksi_biogas'),
            'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
            'ton_kernel_olah' => $this->request->getPost('ton_kernel_olah'),
            'kwh_per_biogas' => $this->request->getPost('kwh_per_biogas'),
            'biogas_per_pome' => $this->request->getPost('biogas_per_pome'),

            'created_by' => session('user_id')
        ]);

        return redirect()->to('/produksi')->with('success','Data produksi disimpan');
    }

    public function edit($id)
    {
        return view('produksi/edit', [
            'row' => $this->produksi->find($id)
        ]);
    }

    public function update($id)
    {
        $this->produksi->update($id, [
            'ton_tbs_olah' => $this->request->getPost('ton_tbs_olah'),
            'pome' => $this->request->getPost('pome'),
            'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
            'produksi_biogas' => $this->request->getPost('produksi_biogas'),
            'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
            'ton_kernel_olah' => $this->request->getPost('ton_kernel_olah'),
            'kwh_per_biogas' => $this->request->getPost('kwh_per_biogas'),
            'biogas_per_pome' => $this->request->getPost('biogas_per_pome'),
            'updated_by' => session('user_id')
        ]);

        return redirect()->to('/produksi')->with('success','Data produksi diperbarui');
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
            if ($i === 0) continue; // skip header

            if (empty($row[0])) continue;

            $preview[] = [
                'tanggal' => $row[0],
                'ton_tbs_olah' => $row[1] ?? 0,
                'pome' => $row[2] ?? 0,
                'umpan_bioreaktor' => $row[3] ?? 0,
                'produksi_biogas' => $row[4] ?? 0,
                'produksi_daya_listrik' => $row[5] ?? 0,
                'ton_kernel_olah' => $row[6] ?? 0,
                'kwh_per_biogas' => $row[7] ?? 0,
                'biogas_per_pome' => $row[8] ?? 0,
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
            // Cegah duplikat tanggal
            $exists = $this->produksi
                ->where('tanggal', $row['tanggal'])
                ->first();

            if ($exists) continue;

            $this->produksi->insert([
                'tanggal' => $row['tanggal'],
                'tahun' => $row['tahun'],
                'ton_tbs_olah' => $row['ton_tbs_olah'],
                'pome' => $row['pome'],
                'umpan_bioreaktor' => $row['umpan_bioreaktor'],
                'produksi_biogas' => $row['produksi_biogas'],
                'produksi_daya_listrik' => $row['produksi_daya_listrik'],
                'ton_kernel_olah' => $row['ton_kernel_olah'],
                'kwh_per_biogas' => $row['kwh_per_biogas'],
                'biogas_per_pome' => $row['biogas_per_pome'],
                'created_by' => session('user_id')
            ]);
        }

        session()->remove('produksi_preview');

        return redirect()->to('/produksi')
            ->with('success', 'Import data produksi berhasil');
}



}
