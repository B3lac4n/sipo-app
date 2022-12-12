<?php

namespace App\Controllers;

use App\Controllers\Support;

use App\Models\PersediaanModel;
use App\Models\PersediaanDetailModel;

class PersediaanController extends BaseController
{
  protected $support;
  protected $persediaanModel;
  protected $persediaanDetailModel;

  public function __construct()
  {
    $this->support = new Support();
    $this->persediaanModel = new PersediaanModel();
    $this->persediaanDetailModel = new PersediaanDetailModel();
    helper('inflector');
  }

  public function index($lokasi = 'semua')
  {
    // load helper to uppercase first letter
    $persediaan = $this->persediaanModel->getPersediaanJoinToObat(pascalize($lokasi))->getResult();
    
    $data = [
        'title' => 'Persediaan Obat',
        'menu' => 'persediaan',
        'submenu' => 'semua_persediaan',
        'persediaan' => $persediaan,
        'lokasi'  => $lokasi
    ];

    if ($lokasi == 'gudang') {
      $kodePerubahan = $this->support->generateKode('perubahan', 'perubahan', 'kd_perubahan');
      $data['submenu'] = 'persediaan_gudang';
      $data['kodePerubahan'] = $kodePerubahan;
      $data['user'] = user()->username;
    }
    
    if ($lokasi == 'apotek') {
      $data['submenu'] = 'persediaan_apotek';
    }

    if ($lokasi != 'semua') {
      return view('persediaan/persediaan_lokasi', $data);
    }

    return view('persediaan/persediaan', $data);
  }

  public function detail($idPersediaan)
  {
    $persediaan = $this->persediaanDetailModel->getPersediaanDetailByLocation($idPersediaan)->getResult();

    $data = [
        'title' => 'Detail Persediaan Obat',
        'menu' => 'persediaan',
        'submenu' => 'semua_persediaan',
        'persediaan' => $persediaan
    ];

    return view('persediaan/persediaan_detail', $data);
  }

  public function stok($idObat = 0)
  {
    $stok = $this->persediaanDetailModel->getStok($idObat)->getResult();
    
    return json_encode($stok);
  }
}