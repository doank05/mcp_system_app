<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduksiPowerDistributionModel extends Model
{
    protected $table      = 'produksi_power_distribution';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'produksi_id',
        'unit',
        'daya_listrik',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false; // karena kita pakai default DB

    // Ambil distribusi power per produksi
    public function getByProduksi($produksiId)
    {
        return $this->where('produksi_id', $produksiId)->findAll();
    }
}
