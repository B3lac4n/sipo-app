<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KetenagaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'    => 'H. MOHAMMAD TASLIM. SKM',
                'nip'    => '19800421 200801 1 007 / III c',
                'status'  => "Kepala Puskesmas",
                'pendidikan'    => 'S1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama'    => 'GUSNANTO, Amd., Kep',
                'nip'    => '19701706 199101 1 001 / III d',
                'status'  => "Admin",
                'pendidikan'    => 'S1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama'    => 'dr. REGI NORMAN',
                'nip'    => '19761004 200903 1 003 / III d',
                'status'  => "Dokter",
                'pendidikan'    => 'S1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama'    => 'ROSNA WATI TAMPUBOLON, S.Farm',
                'nip'    => 'TKS',
                'status'  => "Farmasi",
                'pendidikan'    => 'S1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('ketenagaan')->insertBatch($data);
    }
}
