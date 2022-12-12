<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kd_obat' => 'OB0001',
                'nama'    => 'Paracetamol',
                'jenis'    => 'Habis Pakai',
                'suhu_penyimpanan'  => 20,
                'satuan'    => 'Tablet',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kd_obat' => 'OB0002',
                'nama'    => 'Amoxilin',
                'jenis'    => 'Habis Pakai',
                'suhu_penyimpanan'  => 20,
                'satuan'    => 'Tablet',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kd_obat' => 'OB0003',
                'nama'    => 'Albendazol suspensi 5ml',
                'jenis'    => 'Habis Pakai',
                'suhu_penyimpanan'  => 20,
                'satuan'    => 'Botol',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kd_obat' => 'OB0004',
                'nama'    => 'Ambroxol sirup',
                'jenis'    => 'Habis Pakai',
                'suhu_penyimpanan'  => 20,
                'satuan'    => 'Botol',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'kd_obat' => 'OB0005',
                'nama'    => 'Ambroxol tablet',
                'jenis'    => 'Habis Pakai',
                'suhu_penyimpanan'  => 20,
                'satuan'    => 'Tablet',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            // [
            //     'kd_obat' => 'OB0006',
            //     'nama'    => 'Albendazol 400 mg',
            //     'jenis'    => 'Narkotika',
            //     'suhu_penyimpanan'  => 20,
            //     'satuan'    => 'Tablet'
            // ],
            // [
            //     'kd_obat' => 'OB0007',
            //     'nama'    => 'Bisoprolol tablet 5 mg',
            //     'jenis'    => 'Narkotika',
            //     'suhu_penyimpanan'  => 20,
            //     'satuan'    => 'Tablet'
            // ],
            // [
            //     'kd_obat' => 'OB0008',
            //     'nama'    => 'Chloramfecort H. Cream',
            //     'jenis'    => 'Narkotika',
            //     'suhu_penyimpanan'  => 20,
            //     'satuan'    => 'Tube'
            // ],
            // [
            //     'kd_obat' => 'OB0009',
            //     'nama'    => 'Diazepam tablet 2 mg',
            //     'jenis'    => 'Narkotika',
            //     'suhu_penyimpanan'  => 20,
            //     'satuan'    => 'Tablet'
            // ],
            // [
            //     'kd_obat' => 'OB00010',
            //     'nama'    => 'Fenitoin Natrium kapsul 100 mg',
            //     'jenis'    => 'Narkotika',
            //     'suhu_penyimpanan'  => 20,
            //     'satuan'    => 'Kapsul'
            // ]
        ];

        $this->db->table('obat')->insertBatch($data);
    }
}
