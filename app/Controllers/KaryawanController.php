<?php

namespace App\Controllers;

use App\Models\UserModel;

class KaryawanController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('karyawan/index', [
            'karyawan' => $this->userModel->findAll()
        ]);
    }

    public function create()
    {
        return view('karyawan/create');
    }

    public function store()
    {
        $this->userModel->insert([
            'nik'      => $this->request->getPost('nik'),
            'nama'     => $this->request->getPost('nama'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'tmk'      => $this->request->getPost('tmk'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            )
        ]);

        return redirect()->to('/karyawan')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('karyawan/edit', [
            'karyawan' => $this->userModel->find($id)
        ]);
    }

    public function update($id)
    {
        $data = [
            'nik'     => $this->request->getPost('nik'),
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tmk'     => $this->request->getPost('tmk'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/karyawan')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/karyawan')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}
