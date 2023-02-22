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
            $cekIdTransaksi= new ModelTransaksi();
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
        session()->set('status_pembayaran','INACTIVE');
        if (session()->get('status_pembayaran')=='INACTIVE') {
            //update sql
            //mulai dari adopsi
            $cekIdAdopsi= new ModelAdopsi();
            $queryAdopsi= $cekIdAdopsi->update('status_adopsi','Proses Jual Beli');
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
    
    
}
