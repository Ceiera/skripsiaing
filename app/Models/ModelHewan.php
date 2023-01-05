<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHewan extends Model
{
    protected $table      = 'hewan';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['id_hewan','id_member','nama_hewan','jenis_hewan', 'tanggal_lahir','berat', 'jenis_kelaminh', 'vaksinasi', 'steril', 'kemampuan_khusus', 'biaya_ganti', 'foto', 'created_at', 'updated_at', 'is_active'];
    function listHewan($pemilik){
        $cari = new ModelHewan();
        $puk= $cari->where('id_member', $pemilik)->where('is_active', '1')->find();
        return $puk;
    }
    function editHewan($hewan)
    {
        $cari = new ModelHewan();
        $puk= $cari->where('id_hewan', $hewan)->find();
        return $puk;
    }
    function detail($id){
        $cari = new ModelHewan();
        $puk= $cari->where('id_hewan', $id)->find();
        return $puk;
    }
}
