<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'login';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = ['nim', 'username', 'password', 'role'];

    // Optional: otomatis timestamp created_at/updated_at jika ada kolom
    protected $useTimestamps = true;
}