<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BudgetModel;

class BudgetController extends BaseController
{
    protected $budget;

    public function __construct()
    {
        $this->budget = new BudgetModel();
    }

    public function index()
    {
        $data = $this->budget
            ->orderBy('tahun', 'DESC')
            ->findAll();

        return view('budget/index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('budget/create');
    }

    public function store()
    {
        $this->budget->insert([
            'tahun' => $this->request->getPost('tahun'),
            'ton_tbs' => $this->request->getPost('ton_tbs'),
            'pome' => $this->request->getPost('pome'),
            'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
            'produksi_biogas' => $this->request->getPost('produksi_biogas'),
            'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
            'ton_kernel' => $this->request->getPost('ton_kernel'),
            'kwh_per_biogas' => $this->request->getPost('kwh_per_biogas'),
            'biogas_per_pome' => $this->request->getPost('biogas_per_pome'),
            'created_by' => session('user_id')
        ]);

        return redirect()->to('/budget')->with('success', 'Budget berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('budget/edit', [
            'data' => $this->budget->find($id)
        ]);
    }

    public function update($id)
    {
        $this->budget->update($id, [
            'tahun' => $this->request->getPost('tahun'),
            'ton_tbs' => $this->request->getPost('ton_tbs'),
            'pome' => $this->request->getPost('pome'),
            'umpan_bioreaktor' => $this->request->getPost('umpan_bioreaktor'),
            'produksi_biogas' => $this->request->getPost('produksi_biogas'),
            'produksi_daya_listrik' => $this->request->getPost('produksi_daya_listrik'),
            'ton_kernel' => $this->request->getPost('ton_kernel'),
            'kwh_per_biogas' => $this->request->getPost('kwh_per_biogas'),
            'biogas_per_pome' => $this->request->getPost('biogas_per_pome'),
            'updated_by' => session('user_id')
        ]);

        return redirect()->to('/budget')->with('success', 'Budget berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->budget->delete($id);
        return redirect()->to('/budget')->with('success', 'Budget berhasil dihapus');
    }
}
