<?php

namespace APP\Database\Seeds;

use CodeIgniter\I18n\Time;

class SeederOrang extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'virgiawan',
                'alamat' => 'kuwasen',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'adimas',
                'alamat' => 'balong',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'kopong',
                'alamat' => 'srobyong',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        // query builder
        $this->db->table('orang')->insertBatch($data);
    }
}
