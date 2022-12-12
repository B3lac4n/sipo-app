<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LPLPO extends Migration
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
            'id_pemesanan'  => [
                'type'              => 'INT',
                'constraint'        => 5,
            ],
            'id_obat'       => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'stock_awal'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'penerimaan'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'persediaan'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'pemakaian'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'sisa_stock'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'permintaan'    => [
                'type'              => 'INT',
                'constraint'        => 10,
                'null'              => true
            ],
            'pemberian'    => [
                'type'              => 'INT',
                'constraint'        => 10,
                'null'              => true
            ],
            'keterangan'    => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
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
        $this->forge->createTable('lplpo');
    }

    public function down()
    {
        $this->forge->dropTable('lplpo');
    }
}
