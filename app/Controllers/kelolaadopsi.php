<?php

namespace App\Controllers;

use App\Models\ModelAdopsi;
use App\Models\ModelHewan;
use App\Models\ModelKelolamember;
use App\Models\ModelVerifMember;
use App\Models\ModelWA;

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
        $temp=$db->query("select * from adopsi join hewan on adopsi.id_hewan=hewan.id_hewan join verifikasi on adopsi.id_member_calon=verifikasi.id_member where status_adopsi in ('Menunggu Diterima','Menunggu Pembayaran') and adopsi.id_member_pemilik='".$pencari."'")->getResultArray();
        
        //cek id calon di tabel verifikasi

        $diproses=$temp;
        $temp=$db->query("select * from adopsi join hewan on adopsi.id_hewan=hewan.id_hewan join verifikasi on adopsi.id_member_calon=verifikasi.id_member where status_adopsi in ('Gagal','Berhasil') and adopsi.id_member_pemilik='".$pencari."'")->getResultArray();
        $final=$temp;
        $datas=[
            'diproses' =>$diproses,
            'final'=>$final
        ];
        return view('dashboard/member/kelolaadopsi/orang', $datas);
    }
    
    public function detailorang($i)
    {
        //Ambil Model adopsi
        $adopsi= new ModelAdopsi();
        $cekId= $adopsi->where('id_adopsi',$i)->first();
        $id_member_adopsi=$cekId['id_member_calon'];
        $id_hewan=$cekId['id_hewan'];

        //cari info member
        $member=new ModelKelolamember();
        $dataMember= $member->find($id_member_adopsi);
        //cari info detail member
        $verfikasi=new ModelVerifMember();
        $dataVerifikasi= $verfikasi->where('id_member',$id_member_adopsi)->where('status_verifikasi','Diterima')->first();
        //cari info hewan
        $hewan=new ModelHewan();
        $dataHewan= $hewan->where('id_hewan', $id_hewan)->first();
        $data=array_merge($cekId,$dataMember,$dataVerifikasi,$dataHewan);

        //kasih data ke page
        $datas=[
            'data' =>$data
        ]; 
        return view('dashboard/member/kelolaadopsi/detailcalon', $datas);
    }
    public function terimaCalon()
    {
        
        $id_adopsi= $this->request->getPost('id_adopsi');
        $id_hewan= $this->request->getPost('id_hewan');

        // query ambil harga hewan
        $cekIdHewan= new ModelHewan();
        $queryHewan= $cekIdHewan->where('id_hewan', $id_hewan)->first();
        $hargaHewan= (int)$queryHewan['biaya_ganti'];

        // query adopsi untuk insert harga persetujuan, 
        $cekIdAdopsi= new ModelAdopsi();
        $queryAdopsi= $cekIdAdopsi->where('status_adopsi','Menunggu Pembayaran')->where('id_adopsi', $id_adopsi)->first();
        // $insertAdopsi=[
            
        // ];
        if (empty($queryAdopsi)) {
            $updateAdopsi=[
                'status_adopsi'=> 'Menunggu Pembayaran',
                'harga_diterima'=> $hargaHewan,
            ];
            
            $queryAdopsi= $cekIdAdopsi->update($id_adopsi,$updateAdopsi);
            return redirect()->to('dashboard/kelolaadopsi/orang')->with('alert','Berhasil, Mohon menunggu sampai calon memproses langkah berikutnya');
        }

        return redirect()->to('dashboard/kelolaadopsi/orang')->with('alert','Anda sudah menerima calon ini, mohon tunggu calon proses pembayaran (Jika ada)');

    }
    public function tolakCalon()
    {
       $id_adopsi= $this->request->getPost('id_adopsi');
       $idPembatal= session()->get('id_member');

       //Query Batal di tabel adopsi
       $cekIdAdopsi= new ModelAdopsi();
       $updateAdopsi= [
            'status_adopsi'=> 'Gagal',
            'dibatalkan_oleh' => $idPembatal,
       ];

       $queryAdopsi= $cekIdAdopsi->update($id_adopsi, $updateAdopsi);
       return redirect()->to('dashboard/kelolaadopsi/orang');
    }
    //Pengajuan
    public function pengajuan()
    {
        $db=db_connect();
        $pencari=session()->get('id_member');
        $temp=$db->query("select * from adopsi join hewan on adopsi.id_hewan=hewan.id_hewan join verifikasi on adopsi.id_member_calon=verifikasi.id_member where status_adopsi in ('Menunggu Diterima','Menunggu Pembayaran') and adopsi.id_member_calon='".$pencari."'")->getResultArray();
        $diproses=$temp;
        $temp=$db->query("select * from adopsi join hewan on adopsi.id_hewan=hewan.id_hewan join verifikasi on adopsi.id_member_pemilik=verifikasi.id_member where status_adopsi in ('Gagal','Berhasil') and adopsi.id_member_calon='".$pencari."'")->getResultArray();
        $final=$temp;
        $datas=[
            'diproses' =>$diproses,
            'final'=>$final
        ];
        return view('dashboard/member/kelolaadopsi/pengajuan', $datas);
    }
    
    public function detailpengajuan($i)
    {
        //Ambil Model adopsi
        $adopsi= new ModelAdopsi();
        $cekId= $adopsi->where('id_adopsi',$i)->first();
        $id_member_adopsi=$cekId['id_member_pemilik'];
        $id_hewan=$cekId['id_hewan'];

        //cari info member
        $member=new ModelKelolamember();
        $dataMember= $member->find($id_member_adopsi);
        //cari info detail member
        $verfikasi=new ModelVerifMember();
        $dataVerifikasi= $verfikasi->where('id_member',$id_member_adopsi)->where('status_verifikasi','Diterima')->first();
        //cari info hewan
        $hewan=new ModelHewan();
        $dataHewan= $hewan->where('id_hewan', $id_hewan)->first();
        $data=array_merge($cekId,$dataMember,$dataVerifikasi,$dataHewan);

        //kasih data ke page
        $datas=[
            'data' =>$data
        ]; 
        return view('dashboard/member/kelolaadopsi/detailpengajuan', $datas);
    }
    
    public function terimapengajuan()
    {
        $id_adopsi= $this->request->getPost('id_adopsi');
        $id_hewan= $this->request->getPost('id_hewan');

        // query adopsi untuk insert harga persetujuan, 
        $cekIdAdopsi= new ModelAdopsi();
        $queryAdopsi= $cekIdAdopsi->where('id_adopsi', $id_adopsi)->first();
        //Query member untuk notifikasi
        $cekIdMember= new ModelKelolamember();
        $idMemberPemilik=$queryAdopsi['id_member_pemilik'];
        $queryMember= $cekIdMember->where('id_member', $idMemberPemilik)->first();
        $nomerPemilik=$queryMember['no_hp'];

        if ($queryAdopsi['status_adopsi']=='Menunggu Diterima') {
            if (!empty(session('notify'))) {
                return redirect()->to('dashboard/kelolaadopsi/pengajuan')->with('alert','Sabar ya, Pemilik hewan sudah diberitahu');
            }else {
                $kirimWa= new ModelWA();
                $temp= $kirimWa->kirimWA($nomerPemilik, 'Halo perlu diingatkan ada yang ingin adopsi hewan kamu, yuk cek di //link');
                $sess= ['notify'=>'yes'];
                session()->set($sess);
                return redirect()->to('dashboard/kelolaadopsi/pengajuan')->with('alert','Pemilik sudah diberitahu');
            }
            
        }else {
            $flashData=[
                'id_adopsiTransaksi'=>$queryAdopsi['id_adopsi'],
                'id_pembayarTransaksi'=>session()->get('id_member'),
                'id_hewanTransaksi'=>$queryAdopsi['id_hewan'],
                'id_pemilikHewan'=>$queryAdopsi['id_member_pemilik'],
            ];
           session()->set($flashData);
           return redirect()->to('dashboard/kelolatransaksi/buattransaksi');
        }
        // $insertAdopsi=[
    }
}
