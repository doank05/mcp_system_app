<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    protected $table = 'budget';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tahun',
        'ton_tbs',
        'pome',
        'umpan_bioreaktor',
        'produksi_biogas',
        'produksi_daya_listrik',
        'ton_kernel',
        'kwh_per_biogas',
        'biogas_per_pome',
        'created_by',
        'updated_by'
    ];
}
