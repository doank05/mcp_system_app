<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'pekerjaan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tipe_pekerjaan',
        'user_id',
    ];
}
