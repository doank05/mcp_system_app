<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduksiModel extends Model
{
    protected $table = 'produksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tanggal','tahun',
        'ton_tbs_olah','pome','umpan_bioreaktor',
        'produksi_biogas','produksi_daya_listrik',
        'ton_kernel_olah','kwh_per_biogas','biogas_per_pome',
        'created_by','updated_by'
    ];
}
