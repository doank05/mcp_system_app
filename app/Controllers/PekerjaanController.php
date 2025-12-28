<?php
namespace App\Controllers;

use App\Models\PekerjaanModel;
use App\Models\BarangModel;
use App\Models\BarangLogModel;
use App\Models\UserModel;

class PekerjaanController extends BaseController
{
    protected $pekerjaanModel;

    protected $barangModel;
    protected $barangLogModel;

    public function __construct()
    {
        $this->pekerjaanModel = new PekerjaanModel();
        $this->barangModel    = new BarangModel();
        $this->barangLogModel = new BarangLogModel();
    }


    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $data['pekerjaan'] = $this->pekerjaanModel->findAll();
        return view('pekerjaan/index', $data);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $barangModel = new BarangModel();
        $userModel   = new UserModel();

        return view('pekerjaan/createPekerjaan', [
            'barang' => $barangModel->findAll(),
            'users'  => $userModel->findAll()
        ]);
    }

    // =========================
    // SAVE
    // =========================
    public function save()
    {
        if (!$this->validate([
            'nama_pekerjaan' => 'required',
            'tanggalMulai'   => 'required',
            'tanggalSelesai' => 'required',
            'bagian'         => 'required',
            'nikKaryawan'    => 'required',
            'barang_id'      => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid');
        }

        // 1. Simpan pekerjaan
        $pekerjaanId = $this->pekerjaanModel->insert([
            'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'tanggalMulai'   => $this->request->getPost('tanggalMulai'),
            'tanggalSelesai' => $this->request->getPost('tanggalSelesai'),
            'bagian'         => $this->request->getPost('bagian'),
            'nikKaryawan'    => $this->request->getPost('nikKaryawan'),
            'status'         => $this->request->getPost('status'),
        ]);

        // 2. Simpan barang_log
        $barangLogModel = new BarangLogModel();
        $barangLogModel->insert([
            'barang_id'    => $this->request->getPost('barang_id'),
            'pekerjaan_id' => $pekerjaanId
        ]);

        return redirect()->to('/pekerjaan')
            ->with('success', 'Pekerjaan berhasil disimpan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $pekerjaan = $this->pekerjaanModel->find($id);

        if (!$pekerjaan) {
            return redirect()->to('/pekerjaan');
        }

        // Ambil semua barang
        $barang = $this->barangModel->findAll();

        // Ambil barang yg sudah terhubung (jika ada)
        $barangLog = $this->barangLogModel
            ->where('pekerjaan_id', $id)
            ->first();

        return view('pekerjaan/editPekerjaan', [
            'pekerjaan'      => $pekerjaan,
            'barang'         => $barang,
            'selectedBarang' => $barangLog['barang_id'] ?? null
        ]);
    }


    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        // 1. Update pekerjaan
        $this->pekerjaanModel->update($id, [
            'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'tanggalMulai'   => $this->request->getPost('tanggalMulai'),
            'tanggalSelesai' => $this->request->getPost('tanggalSelesai'),
            'bagian'         => $this->request->getPost('bagian'),
            'nikKaryawan'    => $this->request->getPost('nikKaryawan'),
            'status'         => $this->request->getPost('status'),
        ]);

        // 2. Update barang_log
        $barangId = $this->request->getPost('barang_id');

        if ($barangId) {
            $existing = $this->barangLogModel
                ->where('pekerjaan_id', $id)
                ->first();

            if ($existing) {
                // update
                $this->barangLogModel->update($existing['id'], [
                    'barang_id' => $barangId
                ]);
            } else {
                // insert baru
                $this->barangLogModel->insert([
                    'barang_id'    => $barangId,
                    'pekerjaan_id' => $id
                ]);
            }
        }

        return redirect()->to('/pekerjaan')
            ->with('success', 'Data pekerjaan berhasil diperbarui');
    }


    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $this->pekerjaanModel->delete($id);
        return redirect()->to('/pekerjaan')
            ->with('success', 'Pekerjaan berhasil dihapus');
    }
}
