<?php

namespace App\Models;

use CodeIgniter\Model;
// use App\Models\PersediaanDetailModel;

class LPLPOModel extends Model
{
  protected $table = 'lplpo';
  protected $allowedFields = ['id_pemesanan', 'id_obat', 'stock_awal', 'penerimaan', 'persediaan', 'pemakaian', 'sisa_stock', 'permintaan', 'pemberian', 'keterangan'];
  protected $useTimestamps = true;

  public function getAll()
  {
    return $this->findAll();
  }

  public function getByIdPemesanan($id_pemesanan)
  {
    $query = $this->db->table('lplpo')
      ->select('lplpo.*, obat.nama, obat.satuan')
      ->join('obat', 'lplpo.id_obat = obat.id')
      ->where('id_pemesanan', $id_pemesanan)
      ->get();

    return $query;
  }
}