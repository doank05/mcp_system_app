<?php

namespace App\Controllers;

use App\Models\TahunAktifModel;

class TahunAktifController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TahunAktifModel();
    }

    public function index()
    {
        return view('tahun_aktif/index', [
            'data' => $this->model->orderBy('tahun','DESC')->findAll()
        ]);
    }

    public function setAktif()
    {
        $tahun = $this->request->getPost('tahun');

        if (!$tahun) {
            return redirect()->back()->with('error', 'Tahun tidak valid');
        }

        // Nonaktifkan semua
        $this->model
        ->where('is_active', 1)
        ->set(['is_active' => 0])
        ->update();


        // Aktifkan yang dipilih
        $this->model
            ->where('tahun', $tahun)
            ->set(['is_active' => 1])
            ->update();

        return redirect()->to('/tahun-aktif')
            ->with('success', "Tahun $tahun berhasil diaktifkan");
    }


    public function store()
    {
        $tahun = $this->request->getPost('tahun');

        $this->model->insert([
            'tahun' => $tahun,
            'is_active' => 0
        ]);

        return redirect()->to('/tahun-aktif')
            ->with('success', 'Tahun baru ditambahkan');
    }
}
