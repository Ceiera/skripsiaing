<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLoginMember extends Model
{
    protected $table      = 'member';
    protected $primaryKey = 'email';
    protected $allowedFields = ['id_member', 'username','password','email','is_active', 'id_level'];
}
