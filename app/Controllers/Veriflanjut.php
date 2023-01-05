<?php

namespace App\Controllers;

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
        $nama_lengkap= $this->request->getPost('namalengkap');
        $alamat_ktp= $this->request->getPost('alamat_ktp');
        $tanggal_lahir=parse_timestamp(strtotime($this->request->getPost('tanggal_lahir')), 'Y-m-d');
        $profesi= $this->request->getPost('profesi');
        $jumlahpenghuni= $this->request->getPost('jumlah_penghuni');
        $bersedia_vaksinasi= $this->request->getPost('bersedia_vaksinasi');
        $bersedia_sterilisasi= $this->request->getPost('bersedia_sterilisasi');
        $status_bangunan= $this->request->getPost('status_bangunan');
        $persetujuan= $this->request->getPost('persetujuan_rumah');
        $pernah_adopsi= $this->request->getPost('pernah_adopsi');
        $alasan_adopsi= $this->request->getPost('alasan_adopsi');
        $bersedia_vaksinasi= $this->request->getPost('bersedia_vaksinasi');
        $foto_rumah= $this->request->getFile('fotorumah');
        $foto_rumah2= $this->request->getFile('fotorumah2');
        $foto_diri= $this->request->getFile('fotodiri');
        $fotokandang= $this->request->getFile('foto_kadang');
        if (isset($foto_rumah,$foto_rumah2,$foto_diri,$fotokandang)) {
                $nmfoto_rumah=$foto_rumah->getRandomName();
                $nmfoto_rumah2=$foto_rumah2->getRandomName();
                $nmfoto_diri=$foto_diri->getRandomName();
                $nmfoto_kandang=$fotokandang->getRandomName();

                $foto_rumah->move('verifikasi', $nmfoto_rumah);
                $foto_rumah2->move('verifikasi', $nmfoto_rumah2);
                $foto_diri->move('verifikasi', $nmfoto_diri);
                $fotokandang->move('verifikasi', $nmfoto_kandang);
                $db=db_connect();
                $db->table('verifikasi')->insert(
                    [
                        'id_verifikasi'=>$id_verifikasi,
                        'id_member'=>$id_member,
                        'nama_lengkap'=>$nama_lengkap,
                        'alamat_ktp'=>$alamat_ktp,
                        'tanggal_lahir'=>$tanggal_lahir,
                        'profesi'=>$profesi,
                        'jum_penghuni_rumah'=>$jumlahpenghuni,
                        'bersedia_vaksinasi_rutin'=>$bersedia_vaksinasi,
                        'bersedia_steril'=>$bersedia_sterilisasi,
                        'status_tempat_tinggal'=>$status_bangunan,
                        'persetujuan_penghuni_rumah'=>$persetujuan,
                        'pernah_adopsi'=>$pernah_adopsi,
                        'alasan_adopsi_lagi'=>$alasan_adopsi,
                        'foto_rumah'=>$nmfoto_rumah,
                        'foto_rumah2'=>$nmfoto_rumah2,
                        'foto_dirirumah'=>$nmfoto_diri,
                        'foto_kandang'=>$nmfoto_kandang
                    ]
                );
                return redirect()->to('dashboard/kelolahewan');
        }else {
            $nmfoto_rumah=$foto_rumah->getRandomName();
            $nmfoto_rumah2=$foto_rumah2->getRandomName();
            $nmfoto_diri=$foto_diri->getRandomName();

            $foto_rumah->move('verifikasi', $nmfoto_rumah);
            $foto_rumah2->move('verifikasi', $nmfoto_rumah2);
            $foto_diri->move('verifikasi', $nmfoto_diri);
            $db=db_connect();
            $db->table('verifikasi')->insert(
                [
                    'id_verifikasi'=>$id_verifikasi,
                    'id_member'=>$id_member,
                    'nama_lengkap'=>$nama_lengkap,
                    'alamat_ktp'=>$alamat_ktp,
                    'tanggal_lahir'=>$tanggal_lahir,
                    'profesi'=>$profesi,
                    'jum_penghuni_rumah'=>$jumlahpenghuni,
                    'bersedia_vaksinasi_rutin'=>$bersedia_vaksinasi,
                    'bersedia_steril'=>$bersedia_sterilisasi,
                    'status_tempat_tinggal'=>$status_bangunan,
                    'persetujuan_penghuni_rumah'=>$persetujuan,
                    'pernah_adopsi'=>$pernah_adopsi,
                    'alasan_adopsi_lagi'=>$alasan_adopsi,
                    'foto_rumah'=>$nmfoto_rumah,
                    'foto_rumah2'=>$nmfoto_rumah2,
                    'foto_dirirumah'=>$nmfoto_diri,
    
                ]
            );
            return redirect()->to('dashboard/kelolahewan');
            # code...
        }
    }
}
