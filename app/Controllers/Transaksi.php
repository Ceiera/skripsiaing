<?php

namespace App\Controllers;

use Xendit\Xendit;
use App\Models\ModelXenditA;
class Transaksi extends BaseController
{
    public function testing()
    {
        $timestamp = "2016-04-20 00:37:15";
        $start_date = parse_timestamp(now('Asia/Jakarta'));

        $expires = strtotime('+7 days', strtotime($start_date));
        //$expires = date($expires);

        $date_diff=($expires-strtotime($start_date)) / 86400;

        echo "Start: ".$start_date."<br>";
        echo "Expire: ".date('Y-m-d H:i:s', $expires)."<br>";

        echo round($date_diff, 0)." days left";
    }
    public function balance()
    {
        //xendit ga bisa ditaruh di model
        Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');
        $getBalance = \Xendit\Balance::getBalance('CASH');
        dd($getBalance['balance']);
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
