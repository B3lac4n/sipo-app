<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemesanan extends Migration
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
            'kd_pemesanan'  => [
                'type'              => 'VARCHAR',
                'constraint'        => '10',
            ],
            'no_dokumen'  => [
                'type'              => 'VARCHAR',
                'constraint'        => '20',
            ],
            'tgl_dokumen'  => [
                'type'              => 'DATE',
            ],
            'umum'  => [
                'type'              => 'INT',
                'constraint'        => 4,
            ],
            'bpjs'  => [
                'type'              => 'INT',
                'constraint'        => 4,
            ],
            'jamkesda'  => [
                'type'              => 'INT',
                'constraint'        => 4,
            ],
            'petugas'  => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
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
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
