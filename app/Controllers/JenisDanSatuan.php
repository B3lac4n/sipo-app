<?php

namespace App\Controllers;

use App\Models\JenisModel;
use App\Models\SatuanModel;

class JenisDanSatuan extends BaseController
{
  protected $jenisObat;
  protected $satuanObat;

  public function __construct()
  {
    $this->jenisModel = new JenisModel();
    $this->satuanModel = new SatuanModel();
  }

  public function index()
  {
    $jenisObat = $this->jenisModel->findAll();
    $satuanObat = $this->satuanModel->findAll();

    $data = [
        'title' => 'Data Jenis dan Satuan Obat',
        'menu' => 'jenis',
        'submenu' => false,
        'jenisObat' => $jenisObat,
        'satuanObat' => $satuanObat
    ];

    return view('master_obat/jenis_dan_satuan', $data);
  }

  public function save()
  {
    if ($this->request->getVar('type') === 'jenis') {

      $validate = $this->validate([
          'jenis' => [
              'rules' => 'required',
              'errors' => [
              'required' => 'Jenis obat tidak boleh kosong'
              ]
          ]
      ]);

      if (!$validate) {
          return redirect()->back()->withInput();
      }

      if ($this->request->getVar('id')) { 
        $this->jenisModel->save([
          'id' => $this->request->getVar('id'),
          'jenis' => $this->request->getVar('jenis')
        ]);
      } else {
        $this->jenisModel->save([
          'jenis' => $this->request->getVar('jenis')
        ]);
      }

      session()->setFlashdata('jenis-success', 'Data jenis obat disimpan.');

    } else if ($this->request->getVar('type') === 'satuan') {

      $validate = $this->validate([
          'satuan' => [
              'rules' => 'required',
              'errors' => [
              'required' => 'Satuan obat tidak boleh kosong'
              ]
          ]
      ]);

      if (!$validate) {
          return redirect()->back()->withInput();
      }

      if ($this->request->getVar('id')) {
        $this->satuanModel->save([
          'id' => $this->request->getVar('id'),
          'satuan' => $this->request->getVar('satuan')
        ]);
      } else {
        $this->satuanModel->save([
          'satuan' => $this->request->getVar('satuan')
        ]);
      }

      session()->setFlashdata('satuan-success', 'Data satuan obat disimpan.');
    }

    return redirect()->to('/obat/jenisdansatuan');
  }

  public function hapus_jenis($id)
  {
    $this->jenisModel->delete($id);

    session()->setFlashdata('jenis-success', 'Jenis obat berhasil dihapus.');
    return redirect()->back();
  }

  public function hapus_satuan($id)
  {
    $this->satuanModel->delete($id);

    session()->setFlashdata('satuan-success', 'Satuan obat berhasil dihapus.');
    return redirect()->back();
  }
}