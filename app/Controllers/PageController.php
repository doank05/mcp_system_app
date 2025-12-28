<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;
use App\Models\UserModel;

class PageController extends BaseController
{
    public function inform()
    {
        return view('inform', [
            'title' => 'Informasi',
            'active' => 'inform'
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'About',
            'active' => 'about'
        ]);
    }


    public function alur()
    {
        return view('alur', [
            'title' => 'Alur',
            'active' => 'alur'
        ]);
    }
    public function perawatan()
    {
    $pekerjaanModel = new PekerjaanModel();
    $userModel = new UserModel();

    // Ambil data 7 hari terakhir
    $today = date('Y-m-d');
    $sevenDaysLater = date('Y-m-d', strtotime('+7 days'));

    $dataPekerjaan = $pekerjaanModel
        ->where('tanggalMulai <=', $sevenDaysLater)
        ->where('tanggalMulai >=', $today)
        ->orderBy('tanggalMulai', 'ASC')
        ->findAll();

    // Ambil nama karyawan dari tabel users
    foreach ($dataPekerjaan as &$p) {
        $user = $userModel->where('nik', $p['nikKaryawan'])->first();
        $p['nama_karyawan'] = $user ? $user['nama'] : '-';
    }

    $data['pekerjaan'] = $dataPekerjaan;

    return view('perawatan', $data);
    }

    public function laporan()
    {
        return view('laporan', [
            'title' => 'Laporan',
            'active' => 'laporan'
        ]);
    }
    public function login()
    {
        return view('login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    
    public function produksi()
    {
    

    // return view('perawatan', $data);
    }


}



