<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Home',
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'judul' => 'About Me',
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'judul' => 'Contact Us',
            'alamat' =>
            [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Soekarno-Hatta no. 1945',
                    'kota' => 'jepara',
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Soekarno-Hatta no. 1708',
                    'kota' => 'jepara',
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
