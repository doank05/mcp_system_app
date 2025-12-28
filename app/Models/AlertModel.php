<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertModel extends Model
{
    protected $table      = 'alert';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'pesan',
        'tipe',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $useTimestamps = false;
}
