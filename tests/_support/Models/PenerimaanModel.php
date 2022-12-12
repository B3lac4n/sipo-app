<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaanModel extends Model
{
    protected $table = 'penerimaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kd_penerimaan', 'no_sbbk', 'tgl_penerimaan', 'petugas', 'keterangan'];

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getById($idPenerimaan)
    {
        return $this->where('id', $idPenerimaan)->first();
    }

    public function getByIdJoinPenerimaanDetail($id)
    {
        $query = $this->db->table('penerimaan')
         ->join('penerimaan_detail', 'penerimaan.id = penerimaan_detail.id_penerimaan')
         ->join('obat', 'penerimaan_detail.id_obat = obat.id')
         ->where('penerimaan.id', $id)
         ->get();

        return $query;
    }

    public function getCount()
    {
      $query = $this->db->table('penerimaan')
       ->countAll();
       
      return $query;
    }
}