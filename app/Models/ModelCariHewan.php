<?php

namespace App\Models;

use CodeIgniter\Model;

class Carihewan extends Model
{
    protected $table      = 'hewan';
    protected $primaryKey = 'id_hewan';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nama_hewan', 'jenis_hewan',];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
