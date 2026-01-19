<?php

namespace App\Controllers;

use App\Models\NonEngineMaintenanceModel;
use App\Models\PekerjaanModel;
use App\Models\BarangModel;
use App\Models\UserModel;

class NonEngineMaintenanceController extends BaseController
{
    protected $maintenance;
    protected $pekerjaan;
    protected $barang;
    protected $users;

    public function __construct()
    {
        $this->maintenance = new NonEngineMaintenanceModel();
        $this->pekerjaan   = new PekerjaanModel();
        $this->barang      = new BarangModel();
        $this->users       = new UserModel();
    }

    // =========================
    // INDEX
    // =========================
    public function index()
    {
        return view('maintenance_non_engine/index', [
            'title' => 'Maintenance Non Engine',
            'data'  => $this->maintenance
            ->select('nonengine_maintenance.*, barang.nama_barang, users.username')
            ->join('barang', 'barang.id = nonengine_maintenance.idbarang')
            ->join('pekerjaan', 'pekerjaan.id = nonengine_maintenance.pekerjaan_id')
            ->join('users', 'users.id = pekerjaan.user_id')
            ->orderBy('nonengine_maintenance.created_at', 'DESC')
            ->findAll()
        ]);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('maintenance_non_engine/create', [
            'barang'   => $this->barang->where('kategori !=', 'engine')->findAll(),
            'karyawan' => $this->users->findAll()
        ]);
    }

    // =========================
    // STORE
    // =========================
    public function store()
    {
        $userId = $this->request->getPost('user_id');

        if (! $userId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Karyawan wajib dipilih');
        }

        // HEADER PEKERJAAN
        $this->pekerjaan->insert([
            'tipe_pekerjaan' => 'non_engine',
            'user_id'        => (int) $userId,
        ]);

        $pekerjaanId = $this->pekerjaan->getInsertID();

        // DETAIL NON ENGINE
        $this->maintenance->insert([
            'pekerjaan_id'   => $pekerjaanId,
            'idbarang'       => (int) $this->request->getPost('idbarang'),
            'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'bagian'         => $this->request->getPost('bagian'),
            'status' => $this->request->getPost('status') ?? 'belum',

        ]);

        return redirect()->to('/maintenance-non-engine')
            ->with('success', 'Maintenance non-engine berhasil disimpan');
    }
    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $row = $this->maintenance->find($id);

        if (! $row) {
            return redirect()->to('/maintenance-non-engine')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('maintenance_non_engine/edit', [
            'title'    => 'Edit Maintenance Non Engine',
            'row'      => $row,
            'barang'   => $this->barang->where('kategori !=', 'engine')->findAll(),
            'karyawan' => $this->users->findAll()
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $this->maintenance->update($id, [
            'idbarang'       => (int) $this->request->getPost('idbarang'),
            'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'tanggalMulai'   => $this->request->getPost('tanggalMulai'),
            'tanggalSelesai' => $this->request->getPost('tanggalSelesai'),
            'bagian'         => $this->request->getPost('bagian'),
            'status'         => $this->request->getPost('status'),
        ]);

        return redirect()->to('/maintenance-non-engine')
            ->with('success', 'Maintenance non engine berhasil diperbarui');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
        {
            // Ambil data maintenance
            $row = $this->maintenance->find($id);

            if (! $row) {
                return redirect()->to('/maintenance-non-engine')
                    ->with('error', 'Data tidak ditemukan');
            }

            $pekerjaanId = $row['pekerjaan_id'];

            // Hapus detail non engine
            $this->maintenance->delete($id);

            // Hapus header pekerjaan
            if ($pekerjaanId) {
                $this->pekerjaan->delete($pekerjaanId);
            }

            return redirect()->to('/maintenance-non-engine')
                ->with('success', 'Maintenance dan pekerjaan berhasil dihapus');
    }


}
