<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perubahan extends Migration
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
            'kd_perubahan'  => [
                'type'              => 'VARCHAR',
                'constraint'        => '10',
            ],
            'tgl_perubahan' => [
                'type'              => 'DATE'
            ],
            'id_persediaan_detail' => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'lokasi'    => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],
            'qty'   => [
                'type'              => 'INT',
                'constraint'        => 10
            ],
            'petugas'   => [
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
        $this->forge->createTable('perubahan');
    }

    public function down()
    { 
        $this->forge->dropTable('perubahan');
    }
}
