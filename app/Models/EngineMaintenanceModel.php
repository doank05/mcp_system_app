<?php

namespace App\Models;

use CodeIgniter\Model;

class EngineMaintenanceModel extends Model
{
    protected $table = 'engine_maintenance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'idbarang',
        'jenis_maintenance',
        'hm_saat_maintenance',
        'interval_hm',
        'tanggal',
        'keterangan'
    ];

    protected $useTimestamps = true;
}
