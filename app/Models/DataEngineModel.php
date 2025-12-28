<?php

namespace App\Models;

use CodeIgniter\Model;

class DataEngineModel extends Model
{
    protected $table = 'data_engine';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'idbarang',
        'tanggal',
        'hm_awal',
        'hm_akhir',
        'jam_operasi',
        'kwh',
        'keterangan'
    ];

    protected $useTimestamps = true;
}
