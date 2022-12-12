<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Obat extends Migration
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
            'kd_obat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '8',
                'unique'     => true
            ],
            'nama'  => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'jenis'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'suhu_penyimpanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'satuan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('obat');
    }

    public function down()
    {
        $this->forge->dropTable('obat');
    }
}
