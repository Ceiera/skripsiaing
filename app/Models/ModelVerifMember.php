<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelVerifMember extends Model
{
    protected $table      = 'verifikasi';
    protected $primaryKey = 'id_verifikasi';
    protected $allowedFields = ['id_verifikasi','id_admin','id_member','nama_lengkap','alamat_ktp','tanggal_lahir','profesi','jum_penghuni_rumah','bersedia_vaksinasi','bersedia_steril','status_tempat_tinggal','persetujuan_penghuni_rumah','pernah_adopsi','alasan_adopsi_lagi','foto_rumah','foto_rumah2','foto_dirirumah','foto_kadang','created_at','updated_at','status_verifikasi','email','no_hp','bank_code','nama_akunbank','foto','last_login','is_active','id_level'];

    //entity untuk joinan
    public function indexjoinMember()
    {
        $temp= new ModelVerifMember();
        $data=$temp->join('member','verifikasi.id_member=member.id_member')->where('status_verifikasi','Dalam Proses')->findAll();
        return $data;
    }
    public function detailMember($id_verif)
    {
        $temp= new ModelVerifMember();
        $data=$temp
            ->join('member','verifikasi.id_member=member.id_member')
            ->where('status_verifikasi','Dalam Proses')
            ->where('id_verifikasi',$id_verif)->findAll();
        return $data;
    }
}
