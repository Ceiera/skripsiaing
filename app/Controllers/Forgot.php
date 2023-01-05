<?php

namespace App\Controllers;

use App\Models\ModelKelolamember;
use App\Models\ModelLoginMember;
use App\Models\ModelWA;

use function App\Controllers\generateRandomString as ControllersGenerateRandomString;

class Forgot extends BaseController
{
    public function index()
    {
        return view('/login/forgot');
    }
    public function cekEmail()
    {
        function email($penerima, $password){
            $config = [
                'protocol' => 'smtp',
                'SMTPHost' => 'smtp-relay.sendinblue.com',
                'SMTPPort' => 587,
                'SMTPUser' => 'ikhromay@gmail.com', // change it to yours
                'SMTPPass' => 'O4cWNKBJyLHDGFCz', // change it to yours
                'mailType' => 'text',
                'charset' => 'iso-8859-1',
                'wordWrap' => TRUE
            ];
            // $config = [
            //     'protocol' => 'sendmail',
            //     'mailPath' => '/usr/sbin/sendmail',
            //     'charset'  => 'iso-8859-1',
            //     'wordWrap' => true       
            // ];
            
            $email = \Config\Services::email();
            $email->initialize($config);
            $email->setFrom('adopsicuy@gmail.com','Developer');
            $email->setTo($penerima);
            $email->setSubject('Perubahan Password');
            $email->setMessage('reset password untuk login terbaru:'.$password);
            if ($email->send()) {
                $berhasil='Terkirim';
                return $berhasil;
            }else {
                return $email->printDebugger();
            }          
            
        }


        $email=$this->request->getPost('email');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'email' => [
                'label' => 'email',
                'rules' => 'required|is_not_unique[member.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_not_unique' => 'Email tidak ditemukan'
                ]
            ]
        ]);
        if (!$valid) {
            $sessError = [
                'errEmail' => $validation->getError('email')
            ];
            session()->setFlashdata($sessError);
            return redirect()->to('login/forgot');
        }else {
            $db=db_connect();
            function generateRandomString($length = 6) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $password= generateRandomString();
            if ($db->query("update member set password='".$password. "' where email='".$email."' ")) {
                $kirim= email($email, $password);
                $no_hp = new ModelLoginMember();
                $hp=$no_hp->find($email);
                $WA= new ModelWA();
                $WA->kirimWA($hp['no_hp'], $password);
                session()->setFlashdata('pesan', $kirim);
                return redirect()->to('/login/forgot');
            }
            // else {
            //     session()->setFlashdata('pesangagal', 'email tidak terdaftar');
            // }                     
            
        }
    }
}
