<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;
use App\Models\UserModel;

class PekerjaanController extends BaseController
{
    protected $pekerjaanModel;

    public function __construct()
    {
        $this->pekerjaanModel = new PekerjaanModel();
    }

    // =========================
    // INDEX
    // =========================
    public function index()
    {
        return view('pekerjaan/index', [
            'title' => 'Data Pekerjaan',
            'pekerjaan' => $this->pekerjaanModel->orderBy('id', 'DESC')->findAll()
        ]);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $userModel = new UserModel();

        return view('pekerjaan/createPekerjaan', [
            'title' => 'Tambah Pekerjaan',
            'users' => $userModel->findAll()
        ]);
    }

    // =========================
    // STORE (HEADER ONLY)
    // =========================
    public function store()
    {
        if (! $this->validate([
            'tipe_pekerjaan' => 'required|in_list[engine,non_engine]',
            'nikKaryawan'    => 'required',
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Data pekerjaan tidak valid');
        }

        $pekerjaanId = $this->pekerjaanModel->insert([
            'tipe_pekerjaan' => $this->request->getPost('tipe_pekerjaan'),
            'nikKaryawan'    => $this->request->getPost('nikKaryawan'),
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        // Redirect ke child sesuai tipe
        if ($this->request->getPost('tipe_pekerjaan') === 'engine') {
            return redirect()->to("/maintenance-engine/create/$pekerjaanId");
        }

        return redirect()->to("/nonengine-maintenance/create/$pekerjaanId");
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
