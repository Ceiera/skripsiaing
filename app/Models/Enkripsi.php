<?php

namespace App\Models;

use CodeIgniter\Model;

class Enkripsi extends Model
{
    public function Enkripsi($password)
    {
        $configs         = new \Config\Encryption();
        $configs->key    = 'skripsibikinlemescuysumpahcapekpisanotaknya';
        $configs->driver = 'OpenSSL';
        $encrypter = \Config\Services::encrypter($configs);

        $terenkripsi = $encrypter->encrypt($password);
        return $terenkripsi;
    }
    public function Dekripsi($password)
    {
        $configs         = new \Config\Encryption();
        $configs->key    = 'skripsibikinlemescuysumpahcapekpisanotaknya';
        $configs->driver = 'OpenSSL';
        $encrypter = \Config\Services::encrypter($configs);

        $dekripsi = $encrypter->decrypt($password);
        return $dekripsi;
    }
}
