<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduksiModel extends Model
{
    protected $table = 'produksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tanggal',
        'tahun',
        'ton_tbs_olah',
        'ton_kernel_olah',
        'pome',
        'umpan_bioreaktor',
        'flare',
        'gas_out_scrubber',
        'produksi_daya_listrik',
        'created_by',
        'updated_by'
    ];

    public function getProduksiBiogasHarian($tahun = null)
    {
        $builder = $this->select('tanggal, produksi_biogas')
                        ->orderBy('tanggal', 'ASC');

        if ($tahun !== null) {
            $builder->where('tahun', $tahun);
        }

        return $builder->findAll();
    }
}
