<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdopsi extends Model
{
    public $table      = 'adopsi';
    public $primaryKey = 'id_adopsi';
    public $allowedFields = ['created_at','updated_at','is_active','alasan','status_adopsi','harga_diterima','dibatalkan_oleh'];
    

}
