<?php

namespace App\Controllers;

use App\Models\BarangLogModel;
use App\Models\BarangModel;
use App\Models\UserModel;

class BarangLogController extends BaseController
{
    protected $logModel;
    protected $barangModel;
    protected $userModel;

    public function __construct()
    {
        $this->logModel    = new BarangLogModel();
        $this->barangModel = new BarangModel();
        $this->userModel   = new UserModel();
    }

    // LIST LOG
    public function index($barangId)
    {
        $data = [
            'barang' => $this->barangModel->find($barangId),
            'logs'   => $this->logModel
                            ->where('barang_id', $barangId)
                            ->orderBy('tanggal', 'DESC')
                            ->findAll()
        ];

        return view('barang_log/index', $data);
    }

    // FORM TAMBAH
    public function create($barangId)
    {
        $data = [
            'barang' => $this->barangModel->find($barangId),
            'users'  => $this->userModel->findAll()
        ];

        return view('barang_log/create', $data);
    }

    // SIMPAN
    public function save()
    {
        $this->logModel->save([
            'barang_id'       => $this->request->getPost('barang_id'),
            'tanggal'         => $this->request->getPost('tanggal'),
            'kegiatan'        => $this->request->getPost('kegiatan'),
            'nikKaryawan'     => $this->request->getPost('nikKaryawan'),
            'kondisi_setelah' => $this->request->getPost('kondisi_setelah')
        ]);

        return redirect()
            ->to('/barang-log/'.$this->request->getPost('barang_id'))
            ->with('success', 'Log perawatan berhasil ditambahkan');
    }

    // DELETE
    public function delete($id, $barangId)
    {
        $this->logModel->delete($id);
        return redirect()
            ->to('/barang-log/'.$barangId)
            ->with('success', 'Log berhasil dihapus');
    }
}
