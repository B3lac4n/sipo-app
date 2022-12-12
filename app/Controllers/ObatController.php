<?php

namespace App\Controllers;

use App\Controllers\Support;

use App\Models\ObatModel;
use App\Models\JenisModel;
use App\Models\SatuanModel;

class ObatController extends BaseController
{
    protected $support;

    protected $obatModel;
    protected $jenisModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->support = new Support();

        $this->obatModel = new ObatModel();
        $this->jenisModel = new JenisModel();
        $this->satuanModel = new SatuanModel();
    }

    public function index()
    {
        $semuaObat = $this->obatModel->getObat();

        $data = [
            'title' => 'Data Obat',
            'menu' => 'obat',
            'submenu' => false,
            'semuaObat' => $semuaObat
        ];

        return view('master_obat/obat', $data);
    }

    public function tambah()
    {
        $newKode = $this->support->generateKode('obat', 'obat', 'kd_obat');
        $jenisObat = $this->jenisModel->getJenis();
        $satuanObat = $this->satuanModel->getSatuan();
        
        $data = [
            'title' => 'Tambah Obat',
            'menu' => 'tambah_obat',
            'submenu' => false,
            'kodeObat'  => $newKode,
            'jenisObat' => $jenisObat,
            'satuanObat' => $satuanObat
        ];


        return view('master_obat/tambah', $data);
    }

    public function edit($id)
    {
        $obat = $this->obatModel->getById($id);
        $jenisObat = $this->jenisModel->getJenis();
        $satuanObat = $this->satuanModel->getSatuan();
        
        $data = [
            'title' => 'Tambah Obat',
            'menu' => 'obat',
            'submenu' => false,
            'obat'  => $obat,
            'jenisObat' => $jenisObat,
            'satuanObat' => $satuanObat
        ];


        return view('master_obat/edit', $data);
    }

    public function save()
    {
        $validate = $this->validate([
            'kd_obat' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Kode obat tidak boleh kosong'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Nama obat tidak boleh kosong'
                ]
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Jenis obat tidak boleh kosong'
                ]
            ],
            'suhu' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Suhu obat tidak boleh kosong'
                ]
            ],
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
            
        $data = [
            'kd_obat' => $this->request->getVar('kd_obat'),
            'nama' => $this->request->getVar('nama'),
            'jenis' => $this->request->getVar('jenis'),
            'suhu_penyimpanan' => $this->request->getVar('suhu'),
            'satuan' => $this->request->getVar('satuan'),
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        if ($this->request->getVar('id')) {
            $data['id'] = $this->request->getVar('id');
        }

        $this->obatModel->save($data);

        if ($this->request->getVar('id')) {
            session()->setFlashdata('success', 'Data obat berhasil diperbaharui.');
        } else {
            session()->setFlashdata('success', 'Data obat berhasil ditambahkan.');
        }

        return redirect()->to('/obat');
    }

    public function hapus($id)
    {
        $this->obatModel->delete($id);

        session()->setFlashdata('success', 'Data obat berhasil dihapus.');
        return redirect()->back();
    }
}
