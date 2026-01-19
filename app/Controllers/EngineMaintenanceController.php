<?php

namespace App\Controllers;

use App\Models\EngineMaintenanceModel;
use App\Models\BarangModel;
use App\Models\PekerjaanModel;
use App\Models\KaryawanModel;
use App\Models\UserModel;

class EngineMaintenanceController extends BaseController
{
    protected $maintenance;
    protected $barang;
    protected $pekerjaan;
    protected $karyawan;

    public function __construct()
    {
        $this->maintenance = new EngineMaintenanceModel();
        $this->barang      = new BarangModel();
        $this->pekerjaan   = new PekerjaanModel();
        $this->karyawan    = new UserModel();
    }

    // =========================
    // INDEX (TIDAK DIUBAH)
    // =========================
    public function index()
    {
        return view('maintenance_engine/index', [
            'title' => 'Maintenance Engine',
            'data' => $this->maintenance
                ->select('engine_maintenance.*, barang.nama_barang, users.nama, users.nik')
                ->join('barang', 'barang.id = engine_maintenance.idbarang')
                ->join('pekerjaan', 'pekerjaan.id = engine_maintenance.pekerjaan_id')
                ->join('users', 'users.id = pekerjaan.user_id')
                ->orderBy('tanggal', 'DESC')
                ->findAll()
        ]);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('maintenance_engine/create', [
            'engine'   => $this->barang->where('kategori', 'engine')->findAll(),
            'karyawan' => $this->karyawan->findAll()
        ]);
    }

    // =========================
    // STORE (HEADER + DETAIL)
    // =========================

public function store()
{
    $userId = $this->request->getPost('user_id');

    if (! $userId) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Karyawan wajib dipilih');
    }

    // =========================
    // SIMPAN PEKERJAAN (HEADER)
    // =========================
    $this->pekerjaan->insert([
        'tipe_pekerjaan' => 'engine',
        'user_id'        => (int) $userId,
    ]);

    $pekerjaanId = $this->pekerjaan->getInsertID();

    if (! $pekerjaanId) {
        return redirect()->back()
            ->with('error', 'Gagal menyimpan pekerjaan');
    }

    // =========================
    // SIMPAN ENGINE MAINTENANCE
    // =========================
    $this->maintenance->insert([
        'pekerjaan_id'        => $pekerjaanId,
        'idbarang'            => (int) $this->request->getPost('idbarang'),
        'jenis_maintenance'   => $this->request->getPost('jenis_maintenance'),
        'hm_saat_maintenance' => $this->request->getPost('hm_saat_maintenance'),
        'interval_hm'         => $this->request->getPost('interval_hm'),
        'tanggal'             => $this->request->getPost('tanggal'),
        'keterangan'          => $this->request->getPost('keterangan'),
    ]);

    return redirect()->to('/maintenance-engine')
        ->with('success', 'Maintenance engine berhasil disimpan');
}

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        return view('maintenance_engine/edit', [
            'row'    => $this->maintenance->find($id),
            'engine' => $this->barang->where('jenis', 'engine')->findAll()
        ]);
    }

    // =========================
    // UPDATE (DETAIL ONLY)
    // =========================
    public function update($id)
    {
        $jenis = $this->request->getPost('jenis_maintenance');
        if ($jenis === 'lainnya') {
            $jenis = $this->request->getPost('jenis_lain');
        }

        $this->maintenance->update($id, [
            'idbarang'            => $this->request->getPost('idbarang'),
            'jenis_maintenance'   => $jenis,
            'hm_saat_maintenance' => $this->request->getPost('hm_saat_maintenance'),
            'interval_hm'         => $this->request->getPost('interval_hm'),
            'tanggal'             => $this->request->getPost('tanggal'),
            'keterangan'          => $this->request->getPost('keterangan'),
            'updated_at'          => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/maintenance-engine')
            ->with('success', 'Maintenance engine diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
{
    // Ambil data maintenance
    $row = $this->maintenance->find($id);

    if (! $row) {
        return redirect()->to('/maintenance-engine')
            ->with('error', 'Data tidak ditemukan');
    }

    $pekerjaanId = $row['pekerjaan_id'];

    // 1️⃣ Hapus detail engine maintenance
    $this->maintenance->delete($id);

    // 2️⃣ Hapus header pekerjaan
    if ($pekerjaanId) {
        $this->pekerjaan->delete($pekerjaanId);
    }

    return redirect()->to('/maintenance-engine')
        ->with('success', 'Maintenance engine & pekerjaan berhasil dihapus');
}

}
