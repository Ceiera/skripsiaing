<?php

namespace App\Controllers;

use App\Models\ModelAdopsi;
use App\Models\ModelHewan;
use App\Models\ModelWA;
use phpDocumentor\Reflection\Types\Null_;

class Pasar extends BaseController
{
    public function index()
    {
        $db=db_connect();
        $select1="(select id_hewan from adopsi where status_adopsi='Menunggu Pembayaran' OR status_adopsi='Berhasil')";
        //$select2="(select adopsi.id_hewan from hewan right join adopsi on hewan.id_hewan=adopsi.id_hewan where adopsi.status_adopsi='Menunggu Diterima' OR adopsi.status_adopsi='Gagal')";
        $manual="select * from hewan where id_hewan not in ".$select1;
        $data=$db->query($manual)->getResultArray();
        $datas=[
            'data' =>$data
        ];
        //dd($data);       
        return view('pasar/index', $datas);
    }
    public function detail($id)
    {
        $data = new ModelHewan();
        $datam=$data->detail($id);
        $datas=[
            'data' =>$datam
        ];

        return view('pasar/detailhewan', $datas);
    }

    public function ajukanadopsi()
    {
        $id_member=session()->get('id_member');
        $id_hewan=$this->request->getPost('id_hewan');
        $db=db_connect();
        $temp=$db->table('hewan')->where('id_hewan', $id_hewan);
        $namapemilik=$this->request->getPost('pemilik');
        if ($id_member==$namapemilik) {
            echo 'gagal';   
        }
        //cek adopsi sudah ada atau belum, agar tidak ada duplikasi
        $cekIdAdopsi= new ModelAdopsi();
        $queryAdopsi= $cekIdAdopsi->where('id_member_calon', $id_member)->where('id_hewan', $id_hewan)->first();
        if (empty($queryAdopsi['id_adopsi'])) {
            $temp=$db->table('adopsi')->insert([
                'id_adopsi' => random_string('alnum', 12),
                'id_hewan' => $id_hewan,
                'id_member_pemilik' => $namapemilik,
                'id_member_calon' =>$id_member
            ]);
            $kirim= new ModelWA();
            $sql="select * from member where id_member='".$namapemilik."'";
            $temp=$db->query($sql)->getResultArray();
            foreach ($temp as $key) {
                $kirim->kirimWA($key['no_hp'], 'HALO ada yang adopsi hewan kamu. Cek sekarang di: localhost:8080/dashboard/kelolaadopsi/'.$id_hewan);
            }
            return redirect()->to('/dashboard');
            echo ' # code...';
        }else {
            echo 'sudah ada';
            return redirect()->to('/pasar')->with('alert', 'Hewan Tersebut sudah anda ajukan, mohon cek di dashboard dan tunggu ajuan diterima oleh pemilik hewan');
        }
        
    }
    public function terimaadopsi()
    {
        # code...
    }
}
