<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryStockModel extends Model
{
    protected $table = 'history_stock';
    protected $allowedFields = ['id_obat', 'sisa_stock', 'tanggal'];

    public function getSatuan()
    {
        return $this->orderBy('satuan', 'ASC')->findAll();
    }
}