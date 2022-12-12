<?php

namespace App\Models;


use CodeIgniter\Model;

class PengeluaranDetailModel extends Model
{
  protected $table = 'pengeluaran_detail';
  protected $useTimestamps = true;
  protected $allowedFields = ['id_pengeluaran', 'id_obat', 'id_persediaan_detail', 'qty'];

  public function getSumByBulan($bulan, $idObat)
  {
    $bulanFix = date('m', mktime(0, 0, 0, $bulan, 10));

    $query = $this->db->table('pengeluaran_detail')
      ->select('sum(qty) as total')
      ->where('id_obat', $idObat)
      ->where('month(created_at)', $bulanFix)
      ->get();

    return $query;
  }

  public function getByIdPengeluaran($idPengeluaran)
  {
    $query = $this->db->table('pengeluaran_detail')
        ->select('pengeluaran_detail.qty as qty_keluar, pengeluaran_detail.*, obat.*, persediaan_detail.*, pengeluaran.*')
        ->join('pengeluaran', 'pengeluaran.id =  pengeluaran_detail.id_pengeluaran')
        ->join('obat', 'pengeluaran_detail.id_obat = obat.id')
        ->join('persediaan_detail', 'pengeluaran_detail.id_persediaan_detail = persediaan_detail.id')
        ->where('id_pengeluaran', $idPengeluaran)
        ->get();

    return $query;
  }
}