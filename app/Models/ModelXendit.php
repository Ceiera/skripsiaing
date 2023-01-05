<?php

namespace App\Models;
use Xendit\Xendit;
require 'vendor/autoload.php';
use CodeIgniter\Model;

class ModelXendit extends Model
{
    public $table      = 'transaksi';
    public $primaryKey = 'id_transaksi';
    public $allowedFields = ['id_member','username','email','no_hp','created_at','updated_at','is_active','id_level'];
    
    //Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');

    // function getBalance($account_type)
    // {
    //     $params = array(
    //         'for-user-id' => '<sub account user id>' //The sub-account user-id that you want to make this transaction for (Optional).
    //     );
    //     $getBalance = \Xendit\Balance::getBalance(string $account_type, array $params);
    // }
    // function createShopee()
    // {
    //     $params = [
    //         'reference_id' => 'test-reference-id',
    //         'currency' => 'IDR',
    //         'amount' => 1000,
    //         'checkout_method' => 'ONE_TIME_PAYMENT',
    //         'channel_code' => 'ID_SHOPEEPAY',
    //         'channel_properties' => [
    //             'success_redirect_url' => 'https://dashboard.xendit.co/register/1',
    //         ],
    //         'metadata' => [
    //             'branch_code' => 'tree_branch'
    //         ]
    //     ];
        
    //     $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
    //     var_dump($createEWalletCharge);
    // }

}
