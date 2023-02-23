<?php

namespace App\Controllers;

use App\Models\ModelAdopsi;
use App\Models\ModelHewan;
use App\Models\ModelLoginMember;
use App\Models\ModelTransaksi;
use App\Models\ModelVerifMember;
use Xendit\Xendit;
class Kelolatransaksi extends BaseController
{
    public function __construct()
    {
        Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');
    }


    public function buatTransaksi()
    {

        //cek transaksi dlu
        $cekIdTransaksi= new ModelTransaksi();
        if ($cekIdTransaksi->whereNotIn('status_transaksi',['Dibatalkan oleh Pembeli'])->where('id_adopsi',session()->get('id_adopsiTransaksi'))->countAllResults()!=0) {
            echo '<script>
                    alert("Anda sudah membuat pembayaran, silahkan selesaikan terlebih dahulu");
                    window.location.href="'.base_url('dashboard').'";
                </script>';//nanti diganti ke halaman detail transaksi
        }
        //Query Adopsi
        $cekIdAdopsi= new ModelAdopsi();
        $queryAdopsi= $cekIdAdopsi->where('id_adopsi', session()->get('id_adopsiTransaksi'))->first();
        //Query Member yang bayar
        $cekIdMember = new ModelLoginMember();
        $queryMember= $cekIdMember->where('id_member', session()->get('id_pembayarTransaksi'))->first();
        //Cek info member pemilik hewan
        $cekIdVerif= new ModelVerifMember();
        $queryVerif= $cekIdVerif->where('id_member', session()->get('id_pemilikHewan'))->first();
        //Cek info hewan
        $cekIdhewan= new ModelHewan();
        $queryHewan= $cekIdhewan->where('id_hewan', $queryAdopsi['id_hewan'])->first();
        //infobank
        $data= array_merge($queryAdopsi,$queryMember,$queryHewan,$queryVerif);
        $datas=[
            'data'=>$data
        ];
        return view('dashboard/member/kelolatransaksi/buattransaksi',$datas);
    }


    public function buatVA()
    {
        if ($this->request->isAJAX()) {
            $idAdopsi= session()->get('id_adopsiTransaksi');
            $idMemberBayar= session()->get('id_pembayarTransaksi');
            $kode_bank= $this->request->getPost('kode_bank');

            //ambil data biaya kesepakatan
            $cekIdAdopsi= new ModelAdopsi();
            $queryAdopsi= $cekIdAdopsi->where('id_adopsi', $idAdopsi)->first();
            $biaya= $queryAdopsi['harga_diterima'];


            //ambil data verifikasi pembayar
            $cekIdVerif= new ModelVerifMember();
            $queryVerif= $cekIdVerif->where('id_member', $idMemberBayar)->first();

            //atur tanggal
            $start_date = parse_timestamp(now('Asia/Jakarta'));
            $expires = strtotime('+2 days', strtotime($start_date));
            $date_diff=($expires-strtotime($start_date)) / 86400;

            //queryXendit
            $dataXendit=[
                "external_id"=> $idAdopsi.$idMemberBayar,
                "bank_code"=> $kode_bank,
                "name"=> "Bayar ".$queryVerif['nama_lengkap'],
                "is_single_use"=> true,
                "is_closed" => true,
                "expected_amount"=> 50000,
                "expiration_date"=> date(DATE_ISO8601, $expires)
            ];

          
            $kirimXendit= \Xendit\VirtualAccounts::create($dataXendit);
        
            //queryTransaksi
            
            $data=[
                'id_transaksi'=>$kirimXendit['id'],
                'id_adopsi'=>$idAdopsi,
                'created_at'=>$start_date,
                'status_transaksi'=>'Menunggu',
            ];
            //dd($data);
            $db= db_connect();
            $queryTransaksi= $db->table('transaksi')->insert($data);
            echo json_encode($kirimXendit);
        }else {
            echo 'salah cok';
        }
       
    }


    public function cekPembayaran(){
        $id=$this->request->getPost('id');
        $queryXendit= \Xendit\VirtualAccounts::retrieve($id);
        session()->set('status_pembayaran',$queryXendit['status']);
        if (session()->get('status_pembayaran')=='INACTIVE') {
            //update sql
            //ambil id adopsi dari transaksi
            $cekIdTransaksi= new ModelTransaksi();
            $queryTransaksi= $cekIdTransaksi->where('id_transaksi',$id)->first();

            //mulai dari adopsi
            $cekIdAdopsi= new ModelAdopsi();
            $queryAdopsi= $cekIdAdopsi->update($queryTransaksi['id_adopsi'],['status_adopsi'=>'Proses Jual Beli']);
            $queryTransaksi= $cekIdTransaksi->update($id,['status_transaksi'=>'Berhasil Dibayar']);
            // $queryTransaksi= $cekIdTransaksi->update('')
            echo json_encode($queryXendit);
        }else {
            echo json_encode($queryXendit);
        }
        
    }

    
    public function databayar()
    {
        $testing=[];
        $cekIdTransaksi= new ModelTransaksi();
        $testing2=['anu'=>'anu','anu2'=>'anu2'];
        $testing=$testing2;
        session()->set($testing);
        return view('testingpage',$testing);
    }
    public function balance()
    {
        // $input="+6281286444778";
        // $data = trim($input,'+');
        $arraysww= [
        "external_id"=> "va-1475804036622asdasd",
        "bank_code"=> "BNI",
        "name"=> "Michael Chen"];
        $data=$getVABanks = \Xendit\VirtualAccounts::create($arraysww);
        dd($data['id']);
        //return view('testingpage');
    }
    public function buatPembayaran()
    {
        Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');
        $getBalance = \Xendit\Balance::getBalance('CASH');
        $dataXendit=[
            "external_id" => "va-1475804036622",
            "bank_code"=>"BRI",
            "name"=> "Michael Chen",
            "is_closed"=> true,
            "expected_amount"=> 50000,
            "expiration_date"=> "2023-01-19 16:08:08"
        ];
        $buatPemabyaran= \Xendit\VirtualAccounts::create($dataXendit);
        dd($buatPemabyaran);
    }
    public function daftarTransaksi()
    {
        $transaksi= db_connect();
        $berhasil= $transaksi->query("select * from transaksi join adopsi on transaksi.id_adopsi=adopsi.id_adopsi join hewan on adopsi.id_hewan=hewan.id_hewan where transaksi.id_adopsi in (select adopsi.id_adopsi from adopsi where adopsi.id_member_calon='".session()->get('id_member')."') and status_transaksi='Selesai'")->getResultArray(); //Tampil data transaksi yang sudah pernah dibayar
        $gagal= $transaksi->query("select * from transaksi join adopsi on transaksi.id_adopsi=adopsi.id_adopsi join hewan on adopsi.id_hewan=hewan.id_hewan where transaksi.id_adopsi in (select adopsi.id_adopsi from adopsi where adopsi.id_member_calon='".session()->get('id_member')."') and status_transaksi in ('Dibatalkan oleh Pembeli','Dibatalkan oleh Penjual')")->getResultArray();
        $menungguDibayar= $transaksi->query("select * from transaksi join adopsi on transaksi.id_adopsi=adopsi.id_adopsi join hewan on adopsi.id_hewan=hewan.id_hewan where transaksi.id_adopsi in (select adopsi.id_adopsi from adopsi where adopsi.id_member_calon='".session()->get('id_member')."') and status_transaksi in ('Menunggu')")->getResultArray();
        $sedangBerjalan= $transaksi->query("select * from transaksi join adopsi on transaksi.id_adopsi=adopsi.id_adopsi join hewan on adopsi.id_hewan=hewan.id_hewan where transaksi.id_adopsi in (select adopsi.id_adopsi from adopsi where adopsi.id_member_calon='".session()->get('id_member')."') and status_transaksi in ('Berhasil Dibayar','Diterima oleh Penjual','Proses Pengiriman','Sampai')")->getResultArray();
        $data=[
            'berhasil'=>$berhasil,
            'gagal'=>$gagal,
            'menungguDibayar'=>$menungguDibayar,
            'sedangBerjalan'=>$sedangBerjalan
        ];
        return view ('/dashboard/member/kelolatransaksi/daftartransaksi',$data);
    }
    
    
}
