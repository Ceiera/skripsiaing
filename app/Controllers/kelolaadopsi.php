<?php

namespace App\Controllers;

use App\Models\ModelAdopsi;
use App\Models\ModelKelolamember;
use App\Models\ModelVerifMember;

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
        //Ambil Model adopsi
        $adopsi= new ModelAdopsi();
        $cekId= $adopsi->find($i);
        $id_member_adopsi=$cekId['id_member_calon'];

        //cari info member
        $member=new ModelKelolamember();
        $dataMember= $member->find($id_member_adopsi);
        //cari info detail member
        $verfikasi=new ModelVerifMember();
        $dataVerifikasi= $verfikasi->where('id_member',$id_member_adopsi)->where('status_verifikasi','Diterima')->first();
        $data=array_merge($dataMember,$dataVerifikasi);

        //kasih data ke page
        $datas=[
            'data' =>$data
        ];
        return view('dashboard/member/kelolaadopsi/detailcalon', $datas);
    }
}
