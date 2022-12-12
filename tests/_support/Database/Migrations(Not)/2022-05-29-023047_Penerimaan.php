<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penerimaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'kd_penerimaan' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => true
            ],
            'no_sbbk'   => [
                'type'              => 'VARCHAR',
                'constraint'        => '20',
            ],
            'tgl_penerimaan'    => [
                'type'              => 'DATE'
            ],
            'petugas'    => [
                'type'              => 'VARCHAR',
                'constraint'        => '30'
            ],
            'keterangan'    => [
                'type'              => 'TEXT',
                'null'              => true
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penerimaan');
    }

    public function down()
    {
        $this->forge->dropTable('penerimaan');
    }
}
