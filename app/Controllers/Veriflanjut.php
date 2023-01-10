<?php

namespace App\Controllers;

use App\Models\ModelKelolamember;
use App\Models\ModelVerifMember;

class Veriflanjut extends BaseController
{
    public function index()
    {
        return view('dashboard/member/profile/verifikasilanjut');
    }
    public function kirim()
    {
        $id_verifikasi= random_string('alnum', 16);
        $id_member= session()->get('id_member');
        $nama_lengkap= $this->request->getPost('nama_lengkap');
        $alamat_ktp= $this->request->getPost('alamat_ktp');
        $tanggal_lahir=parse_timestamp(strtotime($this->request->getPost('tanggal_lahir')), 'Y-m-d');
        $profesi= $this->request->getPost('profesi');
        $jumlahpenghuni= $this->request->getPost('jumlah_penghuni');
        $bersedia_vaksinasi= $this->request->getPost('bersedia_vaksinasi');
        $bersedia_steril= $this->request->getPost('bersedia_steril');
        $status_tempat= $this->request->getPost('status_tempat');
        $persetujuan= $this->request->getPost('persetujuan_rumah');
        $pernah_adopsi= $this->request->getPost('pernah_adopsi');
        $alasan_adopsi= $this->request->getPost('alasan_adopsi');
        $foto_rumah= $this->request->getFile('fotorumah');
        $foto_rumah2= $this->request->getFile('fotorumah2');
        $foto_diri= $this->request->getFile('fotodiri');
        $fotokandang= $this->request->getFile('fotokandang');
        $tanggal=parse_timestamp(now('Asia/Jakarta'));

        //Query
        $nmfoto_rumah=$foto_rumah->getRandomName();
        $nmfoto_rumah2=$foto_rumah2->getRandomName();
        $nmfoto_diri=$foto_diri->getRandomName();
        $nmfoto_kandang=$fotokandang->getRandomName();

        $foto_rumah->move('verifikasi', $nmfoto_rumah);
        $foto_rumah2->move('verifikasi', $nmfoto_rumah2);
        $foto_diri->move('verifikasi', $nmfoto_diri);
        $fotokandang->move('verifikasi', $nmfoto_kandang);
        
        $model=new ModelVerifMember();
        $datas=[
                'id_verifikasi'=>$id_verifikasi,
                'id_member'=>$id_member,
                'nama_lengkap'=>$nama_lengkap,
                'alamat_ktp'=>$alamat_ktp,
                'tanggal_lahir'=>$tanggal_lahir,
                'profesi'=>$profesi,
                'jum_penghuni_rumah'=>$jumlahpenghuni,
                'bersedia_vaksinasi_rutin'=>$bersedia_vaksinasi,
                'bersedia_steril'=>$bersedia_steril,
                'status_tempat_tinggal'=>$status_tempat,
                'persetujuan_penghuni_rumah'=>$persetujuan,
                'pernah_adopsi'=>$pernah_adopsi,
                'alasan_adopsi_lagi'=>$alasan_adopsi,
                'foto_rumah'=>$nmfoto_rumah,
                'foto_rumah2'=>$nmfoto_rumah2,
                'foto_dirirumah'=>$nmfoto_diri,
                'foto_kandang'=>$nmfoto_kandang,
                'created_at'=>$tanggal,
            ];
        $anu=false;
        $temp=db_connect();
        $temp->table('verifikasi')->insert($datas);
        return redirect()->to('dashboard/kelolahewan');

    }
    public function list()
    {
        $verif= new ModelVerifMember();
        $data=$verif->indexjoinMember();
        $datas=[
            'data' =>$data
        ];      
        return view('dashboard/admin/veriflanjut', $datas);
    }
    public function detail($id)
    {
        $verif= new ModelVerifMember();
        $data=$verif->detailMember($id);
        $datas=[
            'data' =>$data
        ];     
        return view('dashboard/admin/detailverif', $datas);
    }
    public function terima()
    {
        $id_verifikasi=$this->request->getPost('id_verifikasi');
        $id_member=$this->request->getPost('id_member');

        //cek didatabase
        $verif= new ModelVerifMember();
        if ($data=$verif->where('id_verifikasi',$id_verifikasi)->findAll()) {
            $datave=[
                'status_verifikasi'=>'Diterima',
                'update_at'=>$tanggal=parse_timestamp(now('Asia/Jakarta'))  
            ];
            $verif->update($id_verifikasi,$datave);

            $member= new ModelKelolamember();
            $datale=['id_level'=>'2'];
            $member->update($id_member,$datale);
            return redirect()->to('dashboard/admin/veriflanjut');
        }else {
            return redirect()->to('dashboard/admin/veriflanjut');
        }
    }
    public function tolak()
    {
        $id_verifikasi=$this->request->getPost('id_verifikasi');
        $id_member=$this->request->getPost('id_member');
        $verif= new ModelVerifMember();
        if ($data=$verif->where('id_verifikasi',$id_verifikasi)->findAll()) {
            $datave=[
                'status_verifikasi'=>'Ditolak',
                'update_at'=>$tanggal=parse_timestamp(now('Asia/Jakarta'))  
            ];
            $verif->update($id_verifikasi,$datave);
            return redirect()->to('dashboard/admin/veriflanjut');
        }else {
            return redirect()->to('dashboard/admin/veriflanjut');
        }
    }
}
