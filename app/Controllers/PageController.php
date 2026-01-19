<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;
use App\Models\UserModel;
use App\Models\NonEngineMaintenanceModel;


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
    $nonEngineModel = new NonEngineMaintenanceModel();
    $pekerjaanModel = new PekerjaanModel();
    $userModel      = new UserModel();

    // Rentang 7 hari ke depan
    $today = date('Y-m-d');
    $sevenDaysLater = date('Y-m-d', strtotime('+7 days'));

    // Ambil data non-engine maintenance 7 hari ke depan
    $dataPekerjaan = $nonEngineModel
        ->where('tanggal_mulai <=', $sevenDaysLater)
        ->where('tanggal_selesai >=', $today)
        ->orderBy('tanggal_mulai', 'ASC')
        ->findAll();

    // Lengkapi nama karyawan (JOIN manual agar aman & jelas)
    foreach ($dataPekerjaan as &$p) {

        // Ambil pekerjaan (header)
        $pekerjaan = $pekerjaanModel->find($p['pekerjaan_id']);

        if ($pekerjaan) {
            // Ambil user berdasarkan user_id (BENER, BUKAN NIK)
            $user = $userModel->find($pekerjaan['user_id']);
            $p['nama_karyawan'] = $user['nama'] ?? '-';
        } else {
            $p['nama_karyawan'] = '-';
        }
    }

    return view('perawatan', [
        'pekerjaan' => $dataPekerjaan
    ]);
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



