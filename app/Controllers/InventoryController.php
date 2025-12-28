<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BarangLogModel;

class InventoryController extends BaseController
{
    protected $barangModel;
    protected $barangLogModel;

    public function __construct()
    {
        $this->barangModel    = new BarangModel();
        $this->barangLogModel = new BarangLogModel();
    }

    // LIST INVENTORY
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $barang = $this->barangModel
                ->like('nama_barang', $keyword)
                ->orLike('kode_barang', $keyword)
                ->findAll();
        } else {
            $barang = $this->barangModel->findAll();
        }

        return view('inventory/index', [
            'barang' => $barang
        ]);
    }

    // DETAIL + HISTORY BARANG
    public function detail($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan');
        }

        $history = $this->barangLogModel
            ->select('
                barang_log.id,
                pekerjaan.nama_pekerjaan,
                pekerjaan.deskripsi,
                pekerjaan.tanggalMulai,
                pekerjaan.tanggalSelesai,
                pekerjaan.status,
                users.nama AS nama_karyawan
            ')
            ->join('pekerjaan', 'pekerjaan.id = barang_log.pekerjaan_id')
            ->join('users', 'users.nik = pekerjaan.nikKaryawan')
            ->where('barang_log.barang_id', $id)
            ->orderBy('pekerjaan.tanggalMulai', 'DESC')
            ->findAll();

        return view('inventory/detail', [
            'barang'  => $barang,
            'history' => $history
        ]);
    }
}
