<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['kd_pengeluaran', 'tgl_pengeluaran', 'jenis', 'nama_dokter', 'nama_pengguna', 'jk_pengguna', 'umur_pengguna', 'petugas', 'keterangan'];

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getById($idPengeluaran)
    {
        return $this->where('id', $idPengeluaran)->first();
    }

    public function getCount()
    {
      $query = $this->db->table('pengeluaran')
       ->countAll();
       
      return $query;
    }
}