<?php

namespace App\Controllers;

use App\Models\DataEngineModel;
use App\Models\BarangModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataEngineController extends BaseController
{
    protected $dataEngine;
    protected $barang;

    public function __construct()
    {
        $this->dataEngine = new DataEngineModel();
        $this->barang     = new BarangModel();
    }

    /* =======================
     * INDEX
     * ======================= */
    public function index()
    {
        $data['title'] = 'Data Engine';

        $data['data_engine'] = $this->dataEngine
            ->select('data_engine.*, barang.nama_barang')
            ->join('barang', 'barang.id = data_engine.idbarang')
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        $data['engine'] = $this->barang
            ->where('kategori', 'engine')
            ->orderBy('nama_barang', 'ASC')
            ->findAll();

        return view('data_engine/index', $data);
    }

    /* =======================
     * CREATE
     * ======================= */
    public function create()
    {
        return view('data_engine/create', [
            'title'  => 'Tambah Data Engine',
            'engine' => $this->barang->where('kategori', 'engine')->findAll()
        ]);
    }

    /* =======================
     * STORE
     * ======================= */
    public function store()
    {
        $hm_awal  = $this->request->getPost('hm_awal');
        $hm_akhir = $this->request->getPost('hm_akhir');

        if ($hm_akhir < $hm_awal) {
            return redirect()->back()->with('error', 'HM akhir tidak boleh lebih kecil dari HM awal');
        }

        $this->dataEngine->insert([
            'idbarang'    => $this->request->getPost('idbarang'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'hm_awal'     => $hm_awal,
            'hm_akhir'    => $hm_akhir,
            'jam_operasi' => $hm_akhir - $hm_awal,
            'kwh'         => $this->request->getPost('kwh'),
            'keterangan'  => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/data-engine')->with('success', 'Data engine berhasil ditambahkan');
    }

    /* =======================
     * EDIT
     * ======================= */
    public function edit($id)
    {
        return view('data_engine/edit', [
            'title'  => 'Edit Data Engine',
            'row'    => $this->dataEngine->find($id),
            'engine' => $this->barang->where('kategori', 'engine')->findAll()
        ]);
    }

    /* =======================
     * UPDATE
     * ======================= */
    public function update($id)
    {
        $hm_awal  = $this->request->getPost('hm_awal');
        $hm_akhir = $this->request->getPost('hm_akhir');

        if ($hm_akhir < $hm_awal) {
            return redirect()->back()->with('error', 'HM akhir tidak boleh lebih kecil dari HM awal');
        }

        $this->dataEngine->update($id, [
            'idbarang'    => $this->request->getPost('idbarang'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'hm_awal'     => $hm_awal,
            'hm_akhir'    => $hm_akhir,
            'jam_operasi' => $hm_akhir - $hm_awal,
            'kwh'         => $this->request->getPost('kwh'),
            'keterangan'  => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/data-engine')->with('success', 'Data engine berhasil diperbarui');
    }

    /* =======================
     * DELETE
     * ======================= */
    public function delete($id)
    {
        $this->dataEngine->delete($id);
        return redirect()->to('/data-engine')->with('success', 'Data engine berhasil dihapus');
    }

    /* =======================
     * PREVIEW EXCEL
     * ======================= */
    public function previewExcel()
{
    $idbarang = $this->request->getPost('idbarang');
    $file     = $this->request->getFile('file_excel');

    if (!$idbarang || !$file || !$file->isValid()) {
        return redirect()->back()->with('error', 'Engine atau file tidak valid');
    }

    // Simpan file sementara
    $newName = $file->getRandomName();
    $file->move(WRITEPATH . 'uploads', $newName);

    // Baca file dari temp
    $spreadsheet = IOFactory::load(WRITEPATH . 'uploads/' . $newName);
    $rows = $spreadsheet->getActiveSheet()
                        ->toArray(null, true, true, true);

    // Simpan info ke session
    session()->set([
        'import_engine_id' => $idbarang,
        'import_file'      => $newName
    ]);

    return view('data_engine/previewExcel', [
        'rows' => $rows
    ]);
    }


    /* =======================
     * IMPORT EXCEL (FINAL)
     * ======================= */
    public function importExcel()
{
    $idbarang = session()->get('import_engine_id');
    $fileName = session()->get('import_file');

    if (!$idbarang || !$fileName) {
        return redirect()->to('/data-engine')
            ->with('error', 'Session import tidak ditemukan');
    }

    $filePath = WRITEPATH . 'uploads/' . $fileName;

    if (!file_exists($filePath)) {
        return redirect()->to('/data-engine')
            ->with('error', 'File import tidak ditemukan');
    }

    $berhasil = 0;
    $gagal = 0;

    $spreadsheet = IOFactory::load($filePath);
    $rows = $spreadsheet->getActiveSheet()
                        ->toArray(null, true, true, true);

    foreach ($rows as $i => $row) {
        if ($i === 1) continue;

        $tanggal  = $row['A'] ?? null;
        $hm_awal  = $row['B'] ?? null;
        $hm_akhir = $row['C'] ?? null;
        $kwh      = $row['D'] ?? 0;
        $ket      = $row['E'] ?? null;

        if (!$tanggal || !is_numeric($hm_awal) || !is_numeric($hm_akhir)) {
            $gagal++;
            continue;
        }

        if ($hm_akhir < $hm_awal) {
            $gagal++;
            continue;
        }

        $tanggal = date('Y-m-d', strtotime($tanggal));

        // Cegah duplikat
        $exists = $this->dataEngine
            ->where('idbarang', $idbarang)
            ->where('tanggal', $tanggal)
            ->first();

        if ($exists) {
            $gagal++;
            continue;
        }

        $this->dataEngine->insert([
            'idbarang'    => $idbarang,
            'tanggal'     => $tanggal,
            'hm_awal'     => $hm_awal,
            'hm_akhir'    => $hm_akhir,
            'jam_operasi' => $hm_akhir - $hm_awal,
            'kwh'         => is_numeric($kwh) ? $kwh : 0,
            'keterangan'  => $ket
        ]);

        $berhasil++;
    }

    // Bersihkan session & file temp
    @unlink($filePath);
    session()->remove(['import_engine_id', 'import_file']);

    return redirect()->to('/data-engine')->with(
        'success',
        "Import selesai. Berhasil: $berhasil, Gagal: $gagal"
    );
}

    
}
