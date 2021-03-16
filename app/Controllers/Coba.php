<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        // echo "ini controller coba index";
        // $covid = file_get_contents('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json');
        // $covid_encode = json_decode($covid)->features[0]->attributes;
        // d($covid_encode);
        // $texts = "'text' => 'anjay', 'text' => 'ssakjsk',";
        // $kb = [
        //     'keyboard' => [
        //         (explode(",", $texts))
        //     ],
        //     'resize_keyboard' => true,
        //     'one_time_keyboard' => true
        // ];
        // d($kb);

        // $keyboard = [
        //     'keyboard' => [
        //         [
        //             ['text' => 'anjay'],
        //             ['text' => 'ssakjsk'],
        //         ]
        //     ],
        //     'resize_keyboard' => true,
        //     'one_time_keyboard' => true
        // ];
        // d($keyboard);

        $covid = file_get_contents('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json');
        // $covid_encode = json_decode($covid, true)['features'];
        $covid_encode = json_decode($covid)->features;

        // dd($covid_encode[0]['attributes']);

        foreach ($covid_encode as $key => $val) {
            // $covids[] = $val['attributes'];
            $covids[] = $val->attributes;
        }
        // d($covids);
        // foreach ($covid_encode as $key => $val) {
        //     // $covids[] = $val['attributes'];
        //     $kd_prov[] = $val['attributes']['Kode_Provi'];
        // }
        // if ($kd_prov == 12) {
        //     // dd($key);
        //     dd($key);
        // }
        // $keys = array_keys(array_column($covids, 'Kode_Provi'), 11);
        // foreach ($array as $key => $val) {
        //     if ($val['uid'] === $id) {
        //         return $key;
        //     }
        // }
        // return null;
        // dd($kd_prov);
        // dd($covids);
        $userdb = array(
            array(
                'uid' => '100',
                'name' => 'Sandra Shush',
                'pic_square' => 'urlof100'
            ),
            array(
                'uid' => '5465',
                'name' => 'Stefanie Mcmohn',
                'pic_square' => 'urlof100'
            ),
            array(
                'uid' => '40489',
                'name' => 'Michael',
                'pic_square' => 'urlof40489'
            )
        );
        d($covids);
        $keys = array_keys(array_column($covids, 'Provinsi'), 'Jawa Tengah');
        // foreach ($covid_encode as $key => $val) {
        //     if ($val['FID'] === $id) {
        //         return $key;
        //     }
        // }
        // return null;
        // $key = array_column($covid_encode['attributes'], 'Kode_Provi');
        d($keys);
        $konci = $keys[0];
        // dd($konci);
        d($covids[$konci]);
        die();

        $positif = '';
        foreach ($covid_encode as $c) {
            $positif .= $c->attributes->Kasus_Posi;
        }

        dd($positif);

        $covids = '';
        foreach ($covid_encode as $c) {
            $anjay[] = [['text' => $c->attributes->Provinsi]];
        }
        $keyboard_provinsis = [
            'keyboard' => $anjay,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        d($keyboard_provinsis);

        // $explode = explode(".", $covids);
        // $keyboard_provinsis = ['keyboard' => $explode, 'resize_keyboard' => true, 'one_time_keyboard' => true];
        // d($keyboard_provinsis['keyboard']);

        // echo "</br></br>";
        $keyboard_provinsi = [
            'keyboard' => [
                // $texts
                [
                    ['text' => 'pertamax']
                ],
                [
                    ['text' => 'kedua']
                ],
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        d($keyboard_provinsi);
    }

    public function about($nama = '', $umur = '')
    {
        echo "nama saya adalah $nama, saya berumur $umur tahun";
    }

    public function coba2()
    {
        $covid = file_get_contents('https://services5.arcgis.com/VS6HdKS0VfIhv8Ct/arcgis/rest/services/COVID19_Indonesia_per_Provinsi/FeatureServer/0/query?where=1%3D1&outFields=*&outSR=4326&f=json');
        $covid_encode = json_decode($covid)->features;
        foreach ($covid_encode as $c) {
            // untuk keyboard
            $pilih_provinsi[] = [['text' => $c->attributes->Provinsi]];

            // untuk ngambil key dari tiap provinsi
            $data_provinsi[] = $c->attributes;
        }

        $keys = array_keys(array_column($data_provinsi, 'Provinsi'), 'Jawa Tengah');

        // dd($keys);
        // $key = $keys[0];
        // $data_per_provinsi = $data_provinsi[0][$keys];
        dd($data_provinsi[$keys[0]]);
        $response = '<b>' . $data_per_provinsi->Provinsi . "</b>\n" .
            'Positif : ' . $data_per_provinsi->Kasus_Posi . "\n" .
            'Sembuh : ' . $data_per_provinsi->Kasus_Semb . "\n" .
            'Meninggal : ' . $data_per_provinsi->Kasus_Meni . "\n\n";

        d($response);
    }

    //--------------------------------------------------------------------

}
