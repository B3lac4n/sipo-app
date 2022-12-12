<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pemesanan', 'id_obat', 'qty'];

    public function getPermintaan()
    {
        return $this->findAll();
    }
}