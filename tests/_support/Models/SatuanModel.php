<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table = 'satuan_obat';
    protected $useTimestamps = true;
    protected $allowedFields = ['satuan'];

    public function getSatuan()
    {
        return $this->orderBy('satuan', 'ASC')->findAll();
    }
}