<?php

namespace App\Models;

use CodeIgniter\Model;

class KetenagaanModel extends Model
{
  protected $table = 'ketenagaan';
  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'nip', 'status', 'pendidikan'];

  public function getKetenagaan()
  {
    return $this->findAll();
  }

  public function getById($id)
  {
    return $this->where('id', $id)->first();
  }

  public function getDokter()
  {
    return $this->where('status', 'Dokter')->findAll();
  }

  public function getKepala()
  {
    return $this->where('status', 'Kepala Puskesmas')->first();
  }

  public function getFarmasi()
  {
    return $this->where('status', 'Farmasi')->first();
  }
}