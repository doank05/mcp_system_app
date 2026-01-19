<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BarangLogModel;
use App\Models\EngineMaintenanceModel;
use App\Models\NonEngineMaintenanceModel;
use App\Models\PekerjaanModel;
use App\Models\UserModel;

class InventoryController extends BaseController
{
    protected $barangModel;
    protected $barangLogModel;
    protected $engineMaintenance;
    protected $nonEngineMaintenance;
    protected $pekerjaanModel;
    protected $userModel;

    public function __construct()
    {
        $this->barangModel          = new BarangModel();
        $this->barangLogModel       = new BarangLogModel();
        $this->engineMaintenance    = new EngineMaintenanceModel();
        $this->nonEngineMaintenance = new NonEngineMaintenanceModel();
        $this->pekerjaanModel       = new PekerjaanModel();
        $this->userModel            = new UserModel();
    }

    // =====================================================
    // INVENTORY ENGINE INDEX
    // =====================================================
    public function engineIndex()
    {
        $barang = $this->barangModel
            ->select('id, nama_barang, kode_barang, kategori')
            ->where('kategori', 'engine')
            ->findAll();

        return view('inventory/engine/index', [
            'barang' => $barang,
            'active' => 'inventory_engine'
        ]);
    }

    // =====================================================
    // INVENTORY NON ENGINE INDEX
    // =====================================================
    public function nonEngineIndex()
    {
        $barang = $this->barangModel
            ->select('id, nama_barang, kode_barang, kategori')
            ->where('kategori !=', 'engine')
            ->findAll();

        return view('inventory/non-engine/index', [
            'barang' => $barang,
            'active' => 'inventory_non_engine'
        ]);
    }

    // =====================================================
    // DETAIL INVENTORY ENGINE
    // =====================================================
    public function detailEngine($barangId)
    {
        // BARANG
        $barang = $this->barangModel->find($barangId);
        if (! $barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Engine tidak ditemukan');
        }

        // MAINTENANCE TERBARU
        $engine = $this->engineMaintenance
            ->where('idbarang', $barangId)
            ->orderBy('tanggal', 'DESC')
            ->first();

        // JIKA BELUM PERNAH MAINTENANCE
        if (! $engine) {
            return view('inventory/engine/detail', [
                'barang'      => $barang,
                'engine'      => null,
                'user'        => null,
                'maintenance' => [],
                'active'      => 'inventory_engine'
            ]);
        }

        // PEKERJAAN + USER
        $pekerjaan = $this->pekerjaanModel->find($engine['pekerjaan_id']);
        $user      = $pekerjaan
            ? $this->userModel->find($pekerjaan['user_id'])
            : null;

        // HISTORI MAINTENANCE
        $maintenance = $this->engineMaintenance
            ->where('idbarang', $barangId)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('inventory/engine/detail', [
            'barang'      => $barang,
            'engine'      => $engine,
            'user'        => $user,
            'maintenance' => $maintenance,
            'active'      => 'inventory_engine'
        ]);
    }

    // =====================================================
    // DETAIL INVENTORY NON ENGINE
    // =====================================================
    public function nonEngineDetail($barangId)
    {
        // BARANG
        $barang = $this->barangModel->find($barangId);
        if (! $barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan');
        }

        // DETAIL NON ENGINE TERBARU
        $detail = $this->nonEngineMaintenance
            ->where('idbarang', $barangId)
            ->orderBy('created_at', 'DESC')
            ->first();

        // JIKA BELUM ADA MAINTENANCE
        if (! $detail) {
            return view('inventory/non-engine/detail', [
                'barang' => $barang,
                'detail' => null,
                'user'   => null,
                'active' => 'inventory_non_engine'
            ]);
        }

        // PEKERJAAN + USER
        $pekerjaan = $this->pekerjaanModel->find($detail['pekerjaan_id']);
        $user      = $pekerjaan
            ? $this->userModel->find($pekerjaan['user_id'])
            : null;

        return view('inventory/non_engine/detail', [
            'barang' => $barang,
            'detail' => $detail,
            'user'   => $user,
            'active' => 'inventory_non_engine'
        ]);
    }

    // =====================================================
    // ===== KODE LAMA (TIDAK DIHAPUS) =====================
    // =====================================================

    // LIST INVENTORY (LEGACY)
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

    // DETAIL + HISTORY BARANG (LEGACY)
    public function detail($id)
    {
        $barang = $this->barangModel->find($id);

        if (! $barang) {
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
                users.username AS nama_karyawan
            ')
            ->join('pekerjaan', 'pekerjaan.id = barang_log.pekerjaan_id')
            ->join('users', 'users.id = pekerjaan.user_id')
            ->where('barang_log.barang_id', $id)
            ->orderBy('pekerjaan.tanggalMulai', 'DESC')
            ->findAll();

        return view('inventory/detail', [
            'barang'  => $barang,
            'history' => $history
        ]);
    }
}
