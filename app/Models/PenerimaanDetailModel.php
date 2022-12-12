<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaanDetailModel extends Model
{
    protected $table = 'penerimaan_detail';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_penerimaan', 'id_obat', 'id_persediaan', 'no_batch', 'expired', 'lokasi_obat', 'qty'];

    public function getPenerimaanDetail()
    {
      return $this->findAll();
    }

    public function getByIdPenerimaan($idPenerimaan)
    {
      $query = $this->db->table('penerimaan_detail')
        ->join('obat', 'penerimaan_detail.id_obat = obat.id')
        ->where('id_penerimaan', $idPenerimaan)
        ->get();

      return $query;
    }

    public function getSumByBulan($bulan, $idObat)
    {
      $bulanFix = date('m', mktime(0, 0, 0, $bulan, 10));

      $query = $this->db->table('penerimaan_detail')
        ->select('sum(qty) as total')
        ->where('id_obat', $idObat)
        ->where('month(created_at)', $bulanFix)
        ->get();

      return $query;
    }
}