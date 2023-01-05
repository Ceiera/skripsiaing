<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        session()->set($nyala=[
            'sidebar'=>'dashboard'
        ]);
        return view('dashboard/index');
    }
}
