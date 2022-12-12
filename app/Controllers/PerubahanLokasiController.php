<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\Support;

use App\Models\ObatModel;
use App\Models\KetenagaanModel;
use App\Models\PerubahanModel;
use App\Models\PersediaanDetailModel;

class PerubahanLokasiController extends BaseController
{
  protected $support;
  protected $obatModel;
  protected $ketenagaanModel;
  protected $perubahanModel;
  protected $persediaanDetailModel;

  public function __construct()
  {
    $this->support = new Support();
    $this->obatModel = new ObatModel();
    $this->ketenagaanModel = new KetenagaanModel();
    $this->perubahanModel = new PerubahanModel();
    $this->persediaanDetailModel = new PersediaanDetailModel();
  }

  public function index()
  {
    $perubahan = $this->perubahanModel->getAll()->getResultArray();

    $data = [
      'title' => 'Data Perubahan Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_perubahan',
      'perubahan' => $perubahan
    ];
    return view('data_transaksi/perubahan', $data);
  }

  public function save()
  {
    $validate = $this->validate([
      'kd_perubahan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kode Perubahan tidak boleh kosong.'
        ]
      ],
      'tgl_perubahan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Tanggal Perubahan tidak boleh kosong'
        ]
      ],
      'lokasi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Lokasi tidak boleh kosong'
        ]
      ],
      'rak' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Lokasi Rak tidak boleh kosong'
        ]
      ],
      'jumlah' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'Jumlah tidak boleh kosong',
          'numeric' => 'Jumlah harus berisi angka'
        ]
      ],
      'petugas' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Petugas tidak boleh kosong'
        ]
      ]
    ]);

    if (!$validate) {
      return redirect()->back()->withInput();
    }
    
    $lokasiTujuan = $this->request->getVar('lokasi') . ' / ' . $this->request->getVar('rak');

    $this->persediaanDetailModel->set('lokasi_obat', $lokasiTujuan)->where('id', $this->request->getVar('id'))->update();

    $data = [
      'kd_perubahan' => $this->request->getVar('kd_perubahan'),
      'tgl_perubahan' => $this->request->getVar('tgl_perubahan'),
      'id_persediaan_detail' => $this->request->getVar('id'),
      'lokasi' => $lokasiTujuan,
      'qty' => $this->request->getVar('jumlah'),
      'petugas' => $this->request->getVar('petugas'),
      'keterangan' => $this->request->getVar('keterangan')
    ];

    $this->perubahanModel->save($data);

    session()->setFlashdata('moved', 'Obat berhasil dipindahkan ke '.$lokasiTujuan);

    return redirect()->back();
  }

  public function laporan()
  {
    $tanggal = $this->request->getVar('tgl_perubahan');
    $perubahan = $this->perubahanModel->getByTanggalPerubahan($tanggal)->getResult();

    if (empty($perubahan)) {
      return redirect()->back()->with('empty', 'Data perubahan tanggal '. $tanggal . ' tidak ditemukan.');
    }

    foreach ($perubahan as $data) {
      $data->expired = $this->support->tanggalExpired($data->expired);
    }

    $kepalaPuskesmas = $this->ketenagaanModel->getKepala();
    $petugasFarmasi = $this->ketenagaanModel->getFarmasi();
    $tanggalLaporan =  $this->support->tanggalIndoFull(date("Y-m-d"));
    
    $data = [
      'perubahan' => $perubahan,
      'kepalaPuskesmas' => $kepalaPuskesmas,
      'petugasFarmasi' => $petugasFarmasi,
      'tanggal' => $this->support->tanggalIndoFull($tanggal),
      'tanggalLaporan' => $tanggalLaporan
    ];
    
    $filename = date('y-m-d-H-i-s'). '-perubahan-' . $tanggal;

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('chroot', base_url());
    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);
    // load HTML content
    $dompdf->loadHtml(view('laporan/perubahan', $data));
    // (optional) setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    // render html as PDF
    $dompdf->render();
    // output the generated pdf
    $dompdf->stream($filename, array("Attachment" => false));
  }
}