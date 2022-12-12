<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HistoryStock extends Migration
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
            'id_obat'       => [
                'type'              => 'INT',
                'constraint'        => 5
            ],
            'sisa_stock'    => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'tanggal'       => [
                'type'              => 'DATE'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('history_stock');
    }

    public function down()
    {
        $this->forge->dropTable('history_stock');
    }
}
