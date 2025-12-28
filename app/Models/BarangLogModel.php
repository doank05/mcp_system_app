<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangLogModel extends Model
{
    protected $table = 'barang_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['barang_id','pekerjaan_id'];
}
