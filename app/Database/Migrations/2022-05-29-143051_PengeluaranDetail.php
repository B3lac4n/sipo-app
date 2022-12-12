<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengeluaranDetail extends Migration
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
            'id_pengeluaran'    => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'id_obat'    => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'id_persediaan_detail'    => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'qty'    => [
                'type'              => 'INT',
                'constraint'        => 10
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengeluaran_detail');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran_detail');
    }
}
