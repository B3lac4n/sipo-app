<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Persediaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'id_obat'   => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'total_qty' => [
                'type'              => 'INT',
                'constraint'        => 10
            ],
            'stok_awal' => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'stok_akhir' => [
                'type'              => 'INT',
                'constraint'        => 10
            ],
            'created_at' => [
                'type'              => 'DATETIME',
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('persediaan');
    }

    public function down()
    {
        $this->forge->dropTable('persediaan');
    }
}
