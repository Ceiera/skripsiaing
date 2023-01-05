<?php

namespace App\Controllers;

class Pengunjung extends BaseController
{
    public function index()
    {
        return view ('pengunjung/index');
    }
    public function test()
    {
        $db = db_connect();
        $query= $db->query('SELECT * From Weather');
        foreach ($query->getResultArray() as $row);
        return view ('pengunjung/test', $row);
    }
}
