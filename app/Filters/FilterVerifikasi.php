<?php

namespace App\Filters;

use App\Models\ModelVerifMember;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterVerifikasi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('level')!='2') {
            return redirect()->to('/dashboard/veriflanjut')->with('belumverif','Mohon Verifikasi Lanjut Terlebih dahulu'); 
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}