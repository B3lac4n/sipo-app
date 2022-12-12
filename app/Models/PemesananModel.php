<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kd_pemesanan', 'no_dokumen', 'tgl_dokumen', 'umum', 'bpjs', 'jamkesda', 'petugas', 'keterangan'];

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByBulan($bulan = 1)
    {
      return $this->where('bulan', $bulan)->first();
    }

    public function getById($id)
    {
      return $this->where('id', $id)->first();
    }

    public function getCount()
    {
      $query = $this->db->table('pemesanan')
       ->countAll();
       
      return $query;
    }
}