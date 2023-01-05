<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelWA extends Model
{
    protected $table      = 'member';
    protected $primaryKey = 'email';
    protected $allowedFields = ['id_member', 'username','password','email','is_active', 'id_level'];
    function kirimWA($nomortujuan, $pesan)
    {
        $my_apikey = "1E3G6ISNOEEY442WLPQ9";
        $destination = $nomortujuan;
        $message = $pesan;
        $api_url = "http://panel.rapiwha.com/send_message.php";
        $api_url .= "?apikey=". urlencode ($my_apikey);
        $api_url .= "&number=". urlencode ($destination);
        $api_url .= "&text=". urlencode ($message);
        $my_result_object = json_decode(file_get_contents($api_url, false));
        // echo "<br>Result: ". $my_result_object->success;
        // echo "<br>Description: ". $my_result_object->description;
        // echo "<br>Code: ". $my_result_object->result_code;

        return $my_result_object;
    }
}
