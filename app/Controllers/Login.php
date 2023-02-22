<?php

namespace App\Controllers;

use App\Models\ModelLoginAdmin;
use App\Models\ModelLoginMember;

class Login extends BaseController
{
    public function index()
    {
        return view('login/index');
    }
    public function cekUser(){
        //ngambil post dari form yang mengarah ke cekUser
        $email= $this->request->getPost('email');
        $password= hash("md5", $this->request->getPost('password'));

        //dari codeigniter buat cek validasi
        $validation= \Config\Services::validation();
        $valid= $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if(!$valid){
            $sessError = [
                'errEmail' => $validation->getError('email'),
                'errPassword' => $validation->getError('password')
            ];
            session()->setFlashdata($sessError);
            return redirect()->to('/login');
        }else {
            $modelLogin= new ModelLoginMember();
            $cekEmailLogin= $modelLogin->find($email);
            if ($cekEmailLogin==null) {
                //cek yang diadmin
                $modelLoginA = new ModelLoginAdmin();
                $cekEmailLogin=$modelLoginA->find($email);
                if ($cekEmailLogin==null) {
                    //kalo bener kosong, isi errEmail ke yang baru
                    $sessError = [
                        'errEmail' => 'Email mungkin salah',
                        'errPassword' => 'Password mungkin salah'
                    ];
                    session()->setFlashdata($sessError);
                    return redirect()->to('/login');
                }else {
                    //cek password, masukin masil dari model ke variable memberpassword
                    $memberPassword = $cekEmailLogin['password'];
                    if ($password==$memberPassword) {
                        //bikin buat bedain fitur member dengan lainnya
                        //simpan data data yang perlu
                        $simpan_session=[
                            'id_admin'=>$cekEmailLogin['id_admin'],
                            'email'=>$cekEmailLogin['email'],
                            'nama' =>$cekEmailLogin['nama_admin'],
                            'level'=>$cekEmailLogin['id_level']
                        ];
                        //set session pakai variable simpan session
                        session()->set($simpan_session);
    
                        return redirect()->to('/dashboard');
                    }else {
                        $sessError = [
                            'errEmail' => 'Email mungkin salah',
                            'errPassword' => 'Password mungkin salah'
                        ];
                        session()->setFlashdata($sessError);
                        return redirect()->to('/login');
                    }
                }
                //kalo bener kosong, isi errEmail ke yang baru
                $sessError = [
                    'errEmail' => 'Email mungkin salah',
                    'errPassword' => 'Password mungkin salah'
                ];
                session()->setFlashdata($sessError);
                return redirect()->to('/login');
            }else {
                //cek password, masukin masil dari model ke variable memberpassword
                $memberPassword = $cekEmailLogin['password'];
                if ($password==$memberPassword) {
                    //bikin buat bedain fitur member dengan lainnya
                    //simpan data data yang perlu
                    $simpan_session=[
                        'id_member'=>$cekEmailLogin['id_member'],
                        'email'=>$cekEmailLogin['email'],
                        'nama' =>$cekEmailLogin['username'],
                        'level'=>$cekEmailLogin['id_level']
                    ];
                    //set session pakai variable simpan session
                    session()->set($simpan_session);

                    return redirect()->to('/dashboard');
                }else {
                    $sessError = [
                        'errEmail' => 'Email mungkin salah',
                        'errPassword' => 'Password mungkin salah'
                    ];
                    session()->setFlashdata($sessError);
                    return redirect()->to('/login');
                }
            }
        }
    }
    public function keluar(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
