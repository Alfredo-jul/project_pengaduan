<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'role', 'isi', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
