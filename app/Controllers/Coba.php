<?php

namespace App\Controllers;

use App\Models\ModelKelolamember;
use App\Models\ModelLoginMember;
use App\Models\ModelWA;
use App\Models\ModelXendit;
use Config\Autoload;
use Xendit\Xendit;

use function App\Controllers\generateRandomString as ControllersGenerateRandomString;
use function App\Controllers\parse_timestamp as ControllersParse_timestamp;

class Coba extends BaseController
{
    public function index()
    {
        return view('/login/coba');
    }
    public function cekXendit()
    {
        $url= 'https://api.xendit.co/callback_virtual_accounts';
        Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');
        function parse_timestamp($timestamp, $format = 'Y-m-d H:i:s')
                {
                    return date($format, $timestamp);
                }
            $tanggal= parse_timestamp(now('Asia/Jakarta'));
        $params= [
            "external_id"=>"VA_fixed-".$tanggal,
            "is_single_use"=> true,
            "bank_code"=> "MANDIRI",
            "name"=>"Steve Wozniak",
            "expected_amount"=> 50000
        ];

        $bikin = \Xendit\VirtualAccounts::create($params);  
        var_dump($bikin);
    }
}
