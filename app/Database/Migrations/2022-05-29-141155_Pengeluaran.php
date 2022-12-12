<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengeluaran extends Migration
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
            'kd_pengeluaran'    => [
                'type'              => 'VARCHAR',
                'constraint'        => '10',
            ],
            'tgl_pengeluaran'   => [
                'type'              => 'DATE'
            ],
            'jenis' => [
                'type'              => 'VARCHAR',
                'constraint'        => '10'
            ],
            'nama_dokter' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],
            'nama_pengguna' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50'
            ],
            'jk_pengguna' => [
                'type'              => 'VARCHAR',
                'constraint'        => '20'
            ],
            'umur_pengguna' => [
                'type'              => 'INT',
                'constraint'        => 3
            ],
            'petugas' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30'
            ],
            'keterangan' => [
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
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}
