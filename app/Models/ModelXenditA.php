<?php

namespace App\Models;
namespace Xendit\Xendit;
require 'vendor/autoload.php';
use CodeIgniter\Model;

class ModelXenditA extends Model
{
    
    function jukut()
    {
        Xendit::setApiKey('xnd_development_wceYjoRwTDZBzwTq8Rhc31XCs3SruHMfEQzkgGNasfqWoKGDDqPGpgIAFDMEN');    
        $getBalance = \Xendit\Balance::getBalance('');
        return $getBalance;
    }
    
}
