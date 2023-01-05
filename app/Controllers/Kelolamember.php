<?php

namespace App\Controllers;

use App\Models\ModelKelolamember;

class Kelolamember extends BaseController
{
    public function index()
    {
        session()->set($nyala=[
            'sidebar'=>'kelolamember'
        ]);
        $member= new ModelKelolamember();
        $data=$member->getAll_datamember();
        $datas=[
            'data' =>$data
        ];
        return view('dashboard/admin/kelolamember', $datas);
    }
    public function hapus()
    {
        $id_hapus=$this->request->getPost('id_hapus');
        $member= new ModelKelolamember();
        if (!$member->hapusMember($id_hapus)) {
            return redirect()->to('/dashboard/kelolamember');
        }
       
        
    }
}
