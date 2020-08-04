<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo "ini controller coba index";
    }

    public function about($nama = '', $umur = '')
    {
        echo "nama saya adalah $nama, saya berumur $umur tahun";
    }

    //--------------------------------------------------------------------

}
