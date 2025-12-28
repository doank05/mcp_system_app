<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'pekerjaan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_pekerjaan',
        'deskripsi',
        'tanggalMulai',
        'tanggalSelesai',
        'bagian',
        'nikKaryawan',
        'status'
    ];

    protected $useTimestamps = false;
}
