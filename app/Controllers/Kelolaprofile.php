<?php

namespace App\Controllers;

class Kelolaprofile extends BaseController
{
    public function index()
    {
        return view('/dashboard/member/profile/index');
    }
}
