<?php

namespace App\Controllers;

class Simulasibayar extends BaseController
{
    public function simulasiBayar()
    {
        return view('simulasibayar');
    }
    public function simulasiBayarKirim()
    {
        $externalid= "03n6vdqiF7wjgcMniCHmmX0law";
        $total= 50000;
        $option=[
            'baseURI'=> 'https://api.xendit.co/callback_virtual_accounts/',
        ];
        $headerCoy= [
            'User-Agent' => 'testing/1.0',
            'Accept'     => 'application/json'
        ];
        $body=["amount"=>$total];
        $auth=['xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN', '', 'basic'];
        $client= \config\Services::curlrequest($option);
        $response=
        $client->setAuth($auth[0],$auth[1],$auth[2])
                ->request('POST','/external_id='.$externalid.'/simulate_payment',
            ['body'=>$body]);
        echo $response;
    }
}
