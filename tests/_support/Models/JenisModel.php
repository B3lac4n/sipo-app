<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table = 'jenis_obat';
    protected $useTimestamps = true;
    protected $allowedFields = ['jenis'];
    
    public function getJenis()
    {
        return $this->orderBy('jenis', 'ASC')->findAll();
    }
}