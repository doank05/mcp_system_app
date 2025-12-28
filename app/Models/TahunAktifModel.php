<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAktifModel extends Model
{
    protected $table = 'tahun_aktif';
    protected $allowedFields = ['tahun', 'is_active'];
}
