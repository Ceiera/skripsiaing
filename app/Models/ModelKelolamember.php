<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelolamember extends Model
{
    public $table      = 'member';
    public $primaryKey = 'id_member';
    public $allowedFields = ['id_member','username','email','no_hp','created_at','updated_at','is_active','id_level'];
    function getAll_datamember()
    {
        $coro= new ModelKelolamember();
        $kadal=$coro->where('is_active', '1')->findAll();
        return $kadal;
    }
    function hapusMember($id_hapus)
    {
        $hapus=[
            'is_active'=>'0'
        ];
        $coro= new ModelKelolamember();
        $coro->update($id_hapus, $hapus);
    }

}
