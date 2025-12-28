<?php

namespace App\Controllers;

use App\Models\EngineMaintenanceModel;
use App\Models\BarangModel;

class EngineMaintenanceController extends BaseController
{
    protected $maintenance;
    protected $barang;

    public function __construct()
    {
        $this->maintenance = new EngineMaintenanceModel();
        $this->barang = new BarangModel();
    }

    public function index()
    {
        return view('maintenance_engine/index', [
            'title' => 'Maintenance Engine',
            'data' => $this->maintenance
                ->select('engine_maintenance.*, barang.nama_barang')
                ->join('barang', 'barang.id = engine_maintenance.idbarang')
                ->orderBy('tanggal', 'DESC')
                ->findAll()
        ]);
    }

    public function create()
    {
        return view('maintenance_engine/create', [
            'engine' => $this->barang->where('kategori', 'engine')->findAll()
        ]);
    }

    public function store()
    {
        $jenis = $this->request->getPost('jenis_maintenance');
        if ($jenis === 'lainnya') {
            $jenis = $this->request->getPost('jenis_lain');
        }

        $interval = ($jenis === 'oli') ? 2000 : $this->request->getPost('interval_hm');

        $this->maintenance->insert([
            'idbarang' => $this->request->getPost('idbarang'),
            'jenis_maintenance' => $jenis,
            'hm_saat_maintenance' => $this->request->getPost('hm_saat_maintenance'),
            'interval_hm' => $interval,
            'tanggal' => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/maintenance-engine')->with('success', 'Maintenance disimpan');
    }

    public function edit($id)
    {
        return view('maintenance_engine/edit', [
            'row' => $this->maintenance->find($id),
            'engine' => $this->barang->where('kategori', 'engine')->findAll()
        ]);
    }

    public function update($id)
    {
        $jenis = $this->request->getPost('jenis_maintenance');
        if ($jenis === 'lainnya') {
            $jenis = $this->request->getPost('jenis_lain');
        }

        $this->maintenance->update($id, [
            'idbarang' => $this->request->getPost('idbarang'),
            'jenis_maintenance' => $jenis,
            'hm_saat_maintenance' => $this->request->getPost('hm_saat_maintenance'),
            'interval_hm' => $this->request->getPost('interval_hm'),
            'tanggal' => $this->request->getPost('tanggal'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/maintenance-engine')->with('success', 'Maintenance diupdate');
    }

    public function delete($id)
    {
        $this->maintenance->delete($id);
        return redirect()->to('/maintenance-engine')->with('success', 'Maintenance dihapus');
    }
}
