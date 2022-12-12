<?php

namespace App\Models;

use CodeIgniter\Model;
// use App\Models\PersediaanDetailModel;

class PersediaanModel extends Model
{
  protected $table = 'persediaan';
  protected $allowedFields = ['id_obat', 'total_qty', 'stok_awal', 'stok_akhir'];
  protected $useTimestamps = true;

  public function getPersediaan()
  {
    return $this->findAll();
  }

  public function getPersediaanByIdObat($idObat)
  {
    return $this->where('id_obat', $idObat)->first();
  }

  public function getPersediaanJoinToObat($lokasi = 'Semua')
  {
    if ($lokasi == 'Semua') { 
      $query = $this->db->table('persediaan')
        ->select('persediaan.id, obat.kd_obat, obat.nama, obat.jenis, persediaan.total_qty')
        ->join('obat', 'persediaan.id_obat = obat.id')
        ->get();
      return $query;
    } else {
      $query = $this->db->table('persediaan')
        ->select('persediaan_detail.id, obat.kd_obat, obat.nama, obat.jenis, persediaan_detail.qty, persediaan_detail.no_batch, persediaan_detail.expired, persediaan_detail.lokasi_obat, persediaan_detail.status')
        ->join('obat', 'persediaan.id_obat = obat.id')
        ->join('persediaan_detail', 'persediaan.id = persediaan_detail.id_persediaan')
        ->like('persediaan_detail.lokasi_obat', $lokasi)
        ->get();
      return $query;
    }
  }

  public function getLPLPO()
  {
    $query = $this->db->table('persediaan')
      ->select('persediaan.id, obat.id as id_obat, obat.nama, obat.satuan, IFNULL(persediaan.stok_akhir,0) as stok_akhir, IFNULL(persediaan.total_qty,0) as total_qty')
      ->join('obat', 'persediaan.id_obat = obat.id', 'right')
      ->get();

    return $query;
  }

  public function getLimitedStock()
  {
    $query = $this->db->table('persediaan')
     ->join('obat', 'obat.id = persediaan.id_obat')
     ->where('total_qty <=', 50)
     ->get();

    return $query;
  }
}