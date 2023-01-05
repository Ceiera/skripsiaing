<?php

namespace App\Controllers;
use App\Models\ModelKelolamember;
use App\Models\ModelHewan;
use CodeIgniter\Files\File;

class Kelolahewan extends BaseController
{
    //method index
    public function index()
    {
        session()->set($nyala=[
            'sidebar'=>'kelolahewan'
        ]);
        $hewan= new ModelHewan();
        $pencari=session()->get('id_member');
        $data=$hewan->listHewan($pencari);
        $datas=[
            'data' =>$data
        ];       
        return view('dashboard/member/kelolahewan/index', $datas);
    }
    //method hapus
    public function hapus()
    {
        $id_hapus=$this->request->getPost('id_hewan');
        $id_coy=session()->get('id_member');
        $member= new ModelHewan();
        $data=[
            'updated_at'=> $tanggal=parse_timestamp(now('Asia/Jakarta')),
            'is_active' => '0'
        ];
        if ($member->where('id_hewan',$id_hapus)) {
           
            $member->update($id_coy, $data);
            return redirect()->to('/dashboard/kelolahewan');
        } 
    }
    //method view tambah
    public function tambah()
    {
        session()->set($nyala=[
            'sidebar'=>'kelolamember'
        ]);
        return view('dashboard/member/kelolahewan/tambahhewan');
        
    }
    //method view edit
    public function edit()
    {
        session()->set($nyala=[
            'sidebar'=>'kelolamember'
        ]);
        $hewan= new ModelHewan();
        $id_hewan=$this->request->getPost('id_hewan');
        $pencarian=$hewan->editHewan($id_hewan);
        foreach ($pencarian as $key) {
            $data=[
                'id_hewan'=>$key['id_hewan'],
                'nama_hewan'=>$key['nama_hewan'],
                'jenis_hewan'=>$key['jenis_hewan'],
                'tanggal'=>parse_timestamp(strtotime($key['tanggal_lahir']), 'Y-m-d'),
                'berat'=>$key['berat'],
                'jenis_kelaminh'=>$key['jenis_kelaminh'],
                'vaksinasi'=>$key['vaksinasi'],
                'steril'=>$key['steril'],
                'kemampuan_khusus'=>$key['kemampuan_khusus'],
                'biaya_ganti'=>$key['biaya_ganti'],
                'foto'=>$key['foto']
            ];
            session()->setFlashdata($data);
        }
        return redirect()->to('/dashboard/kelolahewan/tambah');
    }
    //method post tambah dan edit
    public function upload()
    {
        $id_hewan= $this->request->getPost('id_hewan');
        $id_member = $this->request->getPost('id_member');
        $nama_hewan= $this->request->getPost('nama_hewan');
        $jenis_kelamin= $this->request->getPost('jenis_kelamin');
        $jenis_hewan= $this->request->getPost('jenis_hewan');
        $tanggal = parse_timestamp(strtotime($this->request->getPost('tanggal_lahir')), 'Y-m-d');
        $berat=$this->request->getPost('berat');
        $vaksinasi=$this->request->getPost('vaksinasi');
        $steril=$this->request->getPost('steril');
        $biaya=$this->request->getPost('biaya');
        $kemampuan=$this->request->getPost('kemampuan_khusus');
        $img = $this->request->getFile('fotohewan');

        //validasi
        // $validation= \Config\Services::validation();
        // $valid= $this->validate([
        //     'berat' => [
        //         'label' => 'berat',
        //         'rules' => 'integer',
        //         'errors' => [
        //             'integer' => '{field} harus bernilai benar'
        //         ]
        //     ],
        //     'biaya' => [
        //         'label' => 'biaya',
        //         'rules' => 'integer',
        //         'errors' => [
        //             'integer' => '{field} harus bernilai benar'
        //         ]
        //     ],
        //     'fotohewan' => [
        //         'label' => 'fotohewan',
        //         'rules' => 'uploaded[fotohewan]'
        //             . '|is_image[fotohewan]'
        //             . '|mime_in[fotohewan,image/jpg,image/jpeg,image/png]'
        //             . '|max_size[fotohewan,2048]',
        //     ]
        // ]);
        // if(!$valid){
        //     $sessError = [
        //         'errBerat' => $validation->getError('berat'),
        //         'errBiaya' => $validation->getError('biaya'),
        //         'errFotohewan' => $validation->getError('fotohewan')
        //     ];
        //     session()->setFlashdata($sessError);
        //     if ($id_hewan=='') {
        //         return redirect()->to('dashboard/kelolahewan/tambah');
        //     }
        //     return redirect()->to('dashboard/kelolahewan');
        // }

        //insert baru
        if ($id_hewan=='') {
            $id_hewan=generateRandomString(12);
            $id_member=session()->get('id_member');
            //upload gambar
            $namafoto=$img->getRandomName();
            $img->move('hewan', $namafoto);
            $db=db_connect();
            $db->table('hewan')->insert(
                [
                    'id_hewan'=>$id_hewan,
                    'id_member'=>$id_member,
                    'nama_hewan'=>$nama_hewan,
                    'jenis_hewan'=>$jenis_hewan,
                    'tanggal_lahir'=>$tanggal,
                    'berat'=>$berat,
                    'jenis_kelaminh'=>$jenis_kelamin,
                    'vaksinasi'=>$vaksinasi,
                    'steril'=>$steril,
                    'kemampuan_khusus'=>$kemampuan,
                    'created_at'=>$tanggal=parse_timestamp(now('Asia/Jakarta')),
                    'biaya_ganti'=>$biaya,
                    'foto'=> $namafoto,
                    'is_active'=>'1'
                ]
            );
            return redirect()->to('dashboard/kelolahewan');
        }else {
            //$cari= new ModelHewan();
            $id_member=session()->get('id_member');
            $db=db_connect();
            //upload gambar
            // if ($cari->where('id_hewan', $id_hewan)->find()) {
            //    dd($cari);
            // }
            if ($img->getName()) {
                unlink('hewan/'.$this->request->getPost('namafotolama'));
                $namafoto=$img->getRandomName();
                $img->move('hewan', $namafoto);
                $db->table('hewan')->where('id_hewan',$id_hewan)->update(
                    [
                        'id_hewan'=>$id_hewan,
                        'id_member'=>$id_member,
                        'nama_hewan'=>$nama_hewan,
                        'jenis_hewan'=>$jenis_hewan,
                        'tanggal_lahir'=>$tanggal,
                        'berat'=>$berat,
                        'jenis_kelaminh'=>$jenis_kelamin,
                        'vaksinasi'=>$vaksinasi,
                        'steril'=>$steril,
                        'kemampuan_khusus'=>$kemampuan,
                        'updated_at'=>$tanggal=parse_timestamp(now('Asia/Jakarta')),
                        'biaya_ganti'=>$biaya,
                        'foto'=> $namafoto,
                        'is_active'=>'1'
                    ]
                );
                return redirect()->to('dashboard/kelolahewan');
            }
            $db->table('hewan')->where('id_hewan',$id_hewan)->update(
                [
                    'id_hewan'=>$id_hewan,
                    'id_member'=>$id_member,
                    'nama_hewan'=>$nama_hewan,
                    'jenis_hewan'=>$jenis_hewan,
                    'tanggal_lahir'=>$tanggal,
                    'berat'=>$berat,
                    'jenis_kelaminh'=>$jenis_kelamin,
                    'vaksinasi'=>$vaksinasi,
                    'steril'=>$steril,
                    'kemampuan_khusus'=>$kemampuan,
                    'updated_at'=>$tanggal=parse_timestamp(now('Asia/Jakarta')),
                    'biaya_ganti'=>$biaya,
                    'is_active'=>'1'
                ]
            );
            return redirect()->to('dashboard/kelolahewan');
        }
       
        

        // return view('upload_form', $data);
    }
}
