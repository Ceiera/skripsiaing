<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLoginAdmin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'email';
    protected $allowedFields = ['nama_admin','password','email','is_active','id_level'];
}
