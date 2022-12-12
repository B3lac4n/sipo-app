<?php

namespace App\Models;

use CodeIgniter\Model;

class PerubahanModel extends Model
{
    protected $table = 'perubahan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kd_perubahan', 'tgl_perubahan', 'id_persediaan_detail', 'lokasi', 'qty', 'petugas', 'keterangan'];

    public function getAll()
    {
        $query = $this->db->table('perubahan')
         ->select('perubahan.kd_perubahan, perubahan.tgl_perubahan, perubahan.lokasi, perubahan.qty, obat.nama, persediaan_detail.no_batch, persediaan_detail.expired')
         ->join('persediaan_detail', 'perubahan.id_persediaan_detail = persediaan_detail.id')
         ->join('obat', 'persediaan_detail.id_obat = obat.id')
         ->orderBy('perubahan.created_at', 'DESC')
         ->get();

        return $query;
    }

    public function getByTanggalPerubahan($tanggal)
    {
        $query = $this->db->table('perubahan')
         ->select('perubahan.kd_perubahan, perubahan.tgl_perubahan, perubahan.lokasi, perubahan.qty, obat.kd_obat, obat.nama, obat.satuan, persediaan_detail.no_batch, persediaan_detail.expired')
         ->join('persediaan_detail', 'perubahan.id_persediaan_detail = persediaan_detail.id')
         ->join('obat', 'persediaan_detail.id_obat = obat.id')
         ->where('perubahan.tgl_perubahan', $tanggal)
         ->get();

         return $query;
    }

    public function getCount()
    {
        $query = $this->db->table('perubahan')
         ->countAll();
       
        return $query;
    }
}