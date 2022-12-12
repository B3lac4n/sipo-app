<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataGroups = [
            [
                'name' => 'admin',
                'description' => 'Administrator Sistem' 
            ],
            [
                'name' => 'petugas',
                'description' => 'Petugas Farmasi' 
            ]
        ];

        $this->db->table('auth_groups')->insertBatch($dataGroups);

        $data = [
            'email'    => 'gusnanto@gmail.com',
            'username'    => 'gusnanto',
            'id_ketenagaan' => 2,
            'fullname' => 'Gusnanto',
            'password_hash'  => '$2y$10$yEQh0wTTg1kDV/LgTaynDuKbFclyF3OKM2vS.83LZgFk8XLdeqtsK',
            'active'    => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('users')->insert($data);

        $dataGroupsUsers = [
            'group_id' => 1,
            'user_id' => 1
        ];

        $this->db->table('auth_groups_users')->insert($dataGroupsUsers);
    }
}
