<?php

namespace App\Models;

use CodeIgniter\Model;

class NonEngineMaintenanceModel extends Model
{
    protected $table = 'nonengine_maintenance'; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pekerjaan_id',
        'idbarang',
        'nama_pekerjaan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'bagian',
        'status',
    ];

    protected $useTimestamps = true;
}
