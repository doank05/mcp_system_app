<?php

namespace App\Models;

use CodeIgniter\Model;

class EngineMaintenanceModel extends Model
{
    protected $table = 'engine_maintenance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pekerjaan_id',
        'idbarang',
        'jenis_maintenance',
        'hm_saat_maintenance',
        'interval_hm',
        'tanggal',
        'keterangan',
        'created_at',
        'updated_at',
    ];


    protected $useTimestamps = true;
}
