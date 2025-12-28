<?php

namespace App\Controllers;

use App\Models\AlertModel;

class AlertController extends BaseController
{
    protected $alert;

    public function __construct()
    {
        $this->alert = new AlertModel();
    }

    public function index()
    {
        $data = $this->alert
        ->select('alert.*, u1.nama AS dibuat_oleh, u2.nama AS diubah_oleh')
        ->join('users u1', 'u1.id = alert.created_by', 'left')
        ->join('users u2', 'u2.id = alert.updated_by', 'left')
        ->orderBy('alert.created_at', 'DESC')
        ->findAll();
        return view('alert/index', [
            'alerts' => $data,
            'active' => 'alert'
        ]); 
    }

    public function create()
    {
        return view('alert/create', ['active' => 'alert']);

    }

    public function store()
    {
        $this->alert->insert([
            'judul'      => $this->request->getPost('judul'),
            'pesan'      => $this->request->getPost('pesan'),
            'tipe'       => $this->request->getPost('tipe'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
            'created_by' => session('user_id')
        ]);

        return redirect()->to('/alert')
            ->with('success', 'Alert berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('alert/edit', [
            'row' => $this->alert->find($id)
        ]);
    }

    public function update($id)
    {
        $this->alert->update($id, [
            'judul'      => $this->request->getPost('judul'),
            'pesan'      => $this->request->getPost('pesan'),
            'tipe'       => $this->request->getPost('tipe'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
            'updated_by' => session('user_id')
        ]);

        return redirect()->to('/alert')
            ->with('success', 'Alert berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->alert->delete($id);

        return redirect()->to('/alert')
            ->with('success', 'Alert berhasil dihapus');
    }
}
