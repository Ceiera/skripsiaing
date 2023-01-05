<?php

namespace App\Controllers;

class Kelolaadopsi extends BaseController
{
    public function index()
    {
        $db=db_connect();
        $pencari=session()->get('id_member');
        $temp=$db->query("select * from adopsi, hewan where adopsi.id_hewan=hewan.id_hewan and adopsi.id_member_calon='".$pencari."'")->getResultArray();
        $data=$temp;
        $datas=[
            'data' =>$data 
        ];
        return view('dashboard/member/kelolaadopsi/index', $datas);
    }
    public function detail()
    {
        // $db=db_connect();
        // $pencari=session()->get('id_member');
        // $temp=$db->query("select * from adopsi, hewan where adopsi.id_hewan=hewan.id_hewan and adopsi.id_member_calon='".$pencari."'")->getResultArray();
        // $data=$temp;
        // $datas=[
        //     'data' =>$data 
        // ];
        return view('dashboard/member/kelolaadopsi/detail');
    }
    public function orang()
    {
        $db=db_connect();
        $pencari=session()->get('id_member');
        $temp=$db->query("select * from adopsi, hewan where status_adopsi in ('Menunggu Diterima','Menunggu Pembayaran') and adopsi.id_hewan=hewan.id_hewan and adopsi.id_member_pemilik='".$pencari."'")->getResultArray();
        $data=$temp;
        $datas=[
            'data' =>$data 
        ];
        return view('dashboard/member/kelolaadopsi/orang', $datas);
    }
    
    public function detailorang($i)
    {
        $db=db_connect();
        $id_adopsi=$db->query("select * from adopsi where id_adopsi='".$i."'");
        foreach ($id_adopsi->getResultArray() as $key) {
            $id_calon=$key['id_member_calon'];
            $id_hewan=$key['id_hewan'];
            $tanggal_ajuan=$key['created_at'];
            $edit_tanggal=$key['updated_at'];
        }
        $data_calon=$db->query("select member.id_member, email, no_hp, nama_lengkap, profesi, bersedia_vaksinasi_rutin, bersedia steril, pernah_adopsi from member join verifikasi on member.id_member=verifikasi.id_member where id_member='".$id_calon."'");
        dd($data_calon);
        // $temp=$db->query("select * from adopsi, hewan where status_adopsi in ('Menunggu Diterima','Menunggu Pembayaran') and adopsi.id_hewan=hewan.id_hewan and adopsi.id_member_pemilik='".$pencari."'")->getResultArray();
        // $data=$temp;
        // $datas=[
        //     'data' =>$data 
        // ];
        // return view('dashboard/member/kelolaadopsi/orang', $datas);
    }
}
