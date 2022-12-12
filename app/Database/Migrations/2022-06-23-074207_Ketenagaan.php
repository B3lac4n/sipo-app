<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ketenagaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '30'
            ],
            'nip'  => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'status' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30'
            ],
            'pendidikan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20'
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ketenagaan');
    }

    public function down()
    {
        $this->forge->dropTable('ketenagaan');
    }
}
