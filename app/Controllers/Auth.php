<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function loginProcess()
    {
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('nik', $nik)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'NIK tidak ditemukan.');
        }

        // verify password pakai hash
        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Password salah.');
        }

        // set session
        session()->set([
            'user_id' => $user['id'],
            'nama' => $user['nama'],
            'nik' => $user['nik'],
            'jabatan' => $user['jabatan'],
            'logged_in' => true
        ]);

        return redirect()->to(base_url('pekerjaan'));



    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
