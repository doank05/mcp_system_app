<?php

namespace App\Controllers;

use App\Models\BarangModel;

class BarangController extends BaseController
{
    protected $barang;

    public function __construct()
    {
        $this->barang = new BarangModel();
    }

    // ===============================
    // INDEX + SEARCH
    // ===============================
    public function index()
    {
        $keyword = $this->request->getGet('q');

        if ($keyword) {
            $this->barang
                ->like('nama_barang', $keyword)
                ->orLike('kode_barang', $keyword)
                ->orLike('lokasi', $keyword);
        }

        return view('barang/index', [
            'barang'  => $this->barang->orderBy('id', 'DESC')->findAll(),
            'keyword' => $keyword
        ]);
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('barang/create');
    }

    public function save()
    {
        if (!$this->validate([
            'kode_barang' => 'required|is_unique[barang.kode_barang]',
            'nama_barang' => 'required',
            'bagian'      => 'required'
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Data tidak valid atau kode barang sudah ada');
        }

        $this->barang->insert([
            'kode_barang'   => $this->request->getPost('kode_barang'),
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'kategori'      => $this->request->getPost('kategori'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'bagian'        => $this->request->getPost('bagian'),
            'tanggal_pasang'=> $this->request->getPost('tanggal_pasang'),
            'kondisi'       => $this->request->getPost('kondisi'),
        ]);

        return redirect()->to('/barang')->with('success', 'Barang berhasil ditambahkan');
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        return view('barang/edit', [
            'barang' => $this->barang->find($id)
        ]);
    }

    public function update($id)
    {
        $this->barang->update($id, [
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'kategori'      => $this->request->getPost('kategori'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'bagian'        => $this->request->getPost('bagian'),
            'tanggal_pasang'=> $this->request->getPost('tanggal_pasang'),
            'kondisi'       => $this->request->getPost('kondisi'),
        ]);

        return redirect()->to('/barang')->with('success', 'Data barang diperbarui');
    }

    // ===============================
    // DELETE
    // ===============================
    public function delete($id)
    {
        $this->barang->delete($id);
        return redirect()->to('/barang')->with('success', 'Barang berhasil dihapus');
    }
}
