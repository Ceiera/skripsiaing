<?php

namespace App\Controllers;

use App\Models\Enkripsi;

class Register extends BaseController
{
    public function index()
    {
        return view('login/register');
    }
    public function cekRegis()
    {
        $email= $this->request->getPost('email');
        //$passwordd= new Enkripsi();
        $temp= hash("md5", $this->request->getPost('password'));
        //$passwordd->Enkripsi($this->request->getPost('password'));
        $password= $this->request->getPost('password');
        $username=$this->request->getPost('username');
        $no_hp=$this->request->getPost('no_hp');

        $validation= \Config\Services::validation();
        $valid= $this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[admin.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique'=>'Email Sudah terdaftar'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'passwordCon' => [
                'label' => 'PasswordCon',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches'=> 'Password tidak sama'
                ]
            ],
            'no_hp' => [
                'label' => 'Password',
                'rules' => 'required|alpha_numeric|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'alpha_numeric'=>'hanya boleh angka'
                ]
            ]
        ]);
        if(!$valid){
            $sessError = [
                'errEmail' => $validation->getError('email'),
                'errPassword' => $validation->getError('password'),
                'errUsername' => $validation->getError('username'),
                'errPasswordCon' => $validation->getError('passwordCon'),
                'errNo_hp' => $validation->getError('no_hp'),
                'username'=>$username,
                'email'=>$email,
                'no_hp'=>$no_hp
            ];
            session()->setFlashdata($sessError);
            return redirect()->to('/login/register');
        }else {
            $db=db_connect();
            $idmember= random_string('alnum',12);
            if ($db->table('member')
                    ->where('email',$email)
                    ->countAllResults()!=0) {
                        if ($db->table('member')
                                ->where('no_hp','+62'.$no_hp)
                                ->countAllResults()!=0) {
                                    $sess=['errEmail'=>'Email sudah didaftarkan','errNo_hp'=>'No HP sudah didaftarkan'];
                                    session()->setFlashdata($sess);
                                    return redirect()->to('/login/register');
                        }
                        return redirect()->to('/login/register')->with('errEmail','Email sudah didaftarkan');
            }elseif($db->table('member')
                        ->where('no_hp','+62'.$no_hp)
                        ->countAllResults()!=0) {
                            return redirect()->to('/login/register')->with('errNo_hp','Nomor sudah didaftarkan');
            }
            $tanggal= date('Y-m-d H:i:s', now('Asia/Jakarta'));
            $querydb=$db->table('member')->insert([
                    'id_member'=> $idmember,
                    'username'    => $username,
                    'password'   => $temp,
                    'email' => $email,
                    'no_hp' => '+62'.$no_hp,
                    'created_at' => $tanggal
            ]);
            $berhasil="Silahkan Login";
            session()->setFlashdata('berhasil', $berhasil);
            return redirect()->to('/login');
        }
    }
}
