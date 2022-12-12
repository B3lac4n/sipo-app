<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PersediaanDetail extends Migration
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
            'id_persediaan' => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'id_obat'   => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'no_batch'  => [
                'type'              => 'VARCHAR',
                'constraint'        => '20'
            ],
            'expired'   => [
                'type'              => 'DATE'
            ],
            'kategori_obat' => [
                'type'              => 'VARCHAR',
                'constraint'        => '20'
            ],
            'lokasi_obat' => [
                'type'              => 'VARCHAR',
                'constraint'        => '20'
            ],
            'qty'       => [
                'type'              => 'INT',
                'constraint'        => 10
            ],
            'status' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30'
            ],
            'created_at'    => [
                'type'              => 'DATETIME'
            ],
            'updated_at'    => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('persediaan_detail');
    }

    public function down()
    {
        $this->forge->dropTable('persediaan_detail');
    }
}
