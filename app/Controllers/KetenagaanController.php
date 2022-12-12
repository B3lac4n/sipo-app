<?php

namespace App\Controllers;

use App\Models\KetenagaanModel;

class KetenagaanController extends BaseController
{
  protected $ketenagaanModel;

  public function __construct()
  {
    $this->ketenagaanModel = new KetenagaanModel();
  }

  public function index()
  {
    $ketenagaan = $this->ketenagaanModel->getKetenagaan();

    $data = [
      'title' => 'Data Ketenagaan',
      'menu' => 'ketenagaan',
      'submenu' => false,
      'ketenagaan' => $ketenagaan
    ];

    return view('master_ketenagaan/ketenagaan.php', $data);
  }

  public function tambah()
  {
    $data = [
      'title' => 'Tambah Data Ketenagaan',
      'menu' => 'ketenagaan',
      'submenu' => false,
    ];

    return view('master_ketenagaan/tambah', $data);
  }

  public function edit($id = 0)
  {
    $ketenagaan = $this->ketenagaanModel->getById($id);

    $data = [
      'title' => 'Edit Data Ketenagaan',
      'menu' => 'ketenagaan',
      'submenu' => false,
      'ketenagaan' => $ketenagaan
    ];

    return view('master_ketenagaan/edit', $data);
  }

  public function save()
  {
    $validate = $this->validate([
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama tidak boleh kosong'
        ]
      ],
      'nip' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nip tidak boleh kosong'
        ]
      ],
      'status' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status tidak boleh kosong'
        ]
      ],
      'pendidikan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Pendidikan tidak boleh kosong'
        ]
      ]
    ]);

    if (!$validate) {
      return redirect()->back()->withInput();
    }

    $data = [
      'nama' => $this->request->getVar('nama'),
      'nip' => $this->request->getVar('nip'),
      'status' => $this->request->getVar('status'),
      'pendidikan' => $this->request->getVar('pendidikan')
    ];

    if ($this->request->getVar('id')) {
      $data['id'] = $this->request->getVar('id');
    }

    $this->ketenagaanModel->save($data);

    if ($this->request->getVar('id')) {
      session()->setFlashdata('success', 'Data ketenagaan berhasil diperbaharui.');
    } else {
      session()->setFlashdata('success', 'Data ketenagaan berhasil ditambahkan.');
    }
      
    return redirect()->to('/ketenagaan');
  }

  public function hapus($id)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->where('id_ketenagaan', $id);
    $query = $builder->get();
    $pengguna = $query->getRow();
    
    if (!empty($pengguna)) {
      return redirect()->back()->with('errors', 'Gagal menghapus data. Data digunakan untuk Autentikasi.');
    }


    $this->ketenagaanModel->delete($id);

    session()->setFlashdata('success', 'Data ketenagaan berhasil dihapus.');
    return redirect()->back();
  }
}