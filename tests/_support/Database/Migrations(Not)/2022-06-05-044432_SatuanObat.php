<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatuanObat extends Migration
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
            'satuan'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '30'
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('satuan_obat');
    }

    public function down()
    {
        $this->forge->dropTable('satuan_obat');
    }
}
