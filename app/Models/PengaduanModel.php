<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['tipe', 'username', 'deskripsi', 'foto', 'status'];
    protected $useTimestamps = true;
}
