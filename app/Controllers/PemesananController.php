<?php

namespace App\Controllers;

// ini_set('max_execution_time', 1200);

use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

use App\Controllers\Support;

use App\Models\PemesananModel;
use App\Models\KetenagaanModel;
use App\Models\PersediaanModel;
use App\Models\PenerimaanDetailModel;
use App\Models\PengeluaranDetailModel;
use App\Models\LPLPOModel;

class PemesananController extends BaseController
{
  protected $pemesananModel;
  protected $ketenagaanModel;
  protected $persediaanModel;
  protected $penerimaanDetailModel;
  protected $pengeluaranDetailModel;
  protected $lplpoModel;
  
  protected $support;

  public function __construct()
  {
    $this->pemesananModel = new PemesananModel();
    $this->ketenagaanModel = new KetenagaanModel();
    $this->persediaanModel = new PersediaanModel();
    $this->penerimaanDetailModel = new PenerimaanDetailModel();
    $this->pengeluaranDetailModel = new PengeluaranDetailModel();
    $this->lplpoModel = new LPLPOModel();

    $this->support = new Support();
  }

  public function index()
  {
    $pemesanan = $this->pemesananModel->getAll();

    $data = [
      'title' => 'Data Pemesanan Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_pemesanan',
      'pemesanan' => $pemesanan
    ];
    return view('data_transaksi/pemesanan', $data);
  }

  public function create()
  {
    $newKode = $this->support->generateKode('pemesanan', 'pemesanan', 'kd_pemesanan');

    // $dataLPLPO = $this->getLPLPO(date('m'));

    $data = [
      'title' => 'Pemesanan Obat',
      'menu' => 'tr_pemesanan',
      'submenu' => false,
      'kodePemesanan' => $newKode
    ];

    return view('transaksi/pemesanan_obat', $data);
  }

  public function save()
  {
    $validate = $this->validate([
      'kd_pemesanan' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kode Pemesanan tidak boleh kosong'
        ]
      ],
      'no_dokumen' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Dokumen tidak boleh kosong'
        ]
      ],
      'tgl_dokumen' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Tanggal Dokumen tidak boleh kosong'
        ]
      ],
      'umum' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'Umum tidak boleh kosong',
          'numeric' => 'Umum harus berisi angka'
        ]
      ],
      'bpjs' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'BPJS tidak boleh kosong',
          'numeric' => 'BPJS harus berisi angka'
        ]
      ],
      'jamkesda' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'JAMKESDA tidak boleh kosong',
          'numeric' => 'JAMKESDA harus berisi angka'
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

    $data = [
      'kd_pemesanan' => $this->request->getVar('kd_pemesanan'),
      'no_dokumen' => $this->request->getVar('no_dokumen'),
      'tgl_dokumen' => $this->request->getVar('tgl_dokumen'),
      'umum' => $this->request->getVar('umum'),
      'bpjs' => $this->request->getVar('bpjs'),
      'jamkesda' => $this->request->getVar('jamkesda'),
      'petugas' => $this->request->getVar('petugas'),
      'keterangan' => $this->request->getVar('keterangan')
    ];

    // $session = \Config\Services::session();
    // $session->set('pemesanan_baru', $data);

    $this->pemesananModel->save($data);
    $idPemesanan = $this->pemesananModel->getInsertID();

    session()->setFlashData('inserted', 'Data pemesanan berhasil disimpan');

    return redirect()->back()->with('id', $idPemesanan);
    return redirect()->to('/transaksi/validasi-lplpo');
  }

  public function validasi_lplpo()
  {
    $session = \Config\Services::session();
    $pemesanan_baru = $session->pemesanan_baru;
    
    $dataLPLPO = $this->getLPLPO(date('m'));

    $data = [
      'title' => 'Pemesanan Obat',
      'menu' => 'tr_pemesanan',
      'submenu' => false,
      'dataLPLPO' => $dataLPLPO
    ];

    return view('transaksi/validasi_lplpo', $data);
  }

  public function selesaikan_pemesanan()
  {
    $session = \Config\Services::session();
    $pemesanan_baru = $session->pemesanan_baru;

    $this->pemesananModel->save($pemesanan_baru);
    $idPemesanan = $this->pemesananModel->getInsertID();

    $session->remove('pemesanan_baru');

    $idObats = $this->request->getVar('id_obat');
    // dd(count($idObats));

    for ($i=0; $i < count($idObats); $i++) { 
      $this->lplpoModel->save([
        'id_pemesanan' => $idPemesanan,
        'id_obat' => $this->request->getVar('id_obat['.$i.']'),
        'stock_awal' => $this->request->getVar('stok_awal['.$i.']'),
        'penerimaan'  => $this->request->getVar('penerimaan['.$i.']'),
        'persediaan'  => $this->request->getVar('persediaan['.$i.']'),
        'pemakaian'  => $this->request->getVar('pemakaian['.$i.']'),
        'sisa_stock'  => $this->request->getVar('sisa_stok['.$i.']'),
        'permintaan'  => $this->request->getVar('permintaan['.$i.']'),
        'pemberian'  => $this->request->getVar('pemberian['.$i.']'),
        'keterangan'  => $this->request->getVar('keterangan['.$i.']')
      ]);
    }

    session()->setFlashData('inserted', 'Data pemesanan berhasil disimpan');

    return redirect()->to('/transaksi/pemesanan')->with('id', $idPemesanan);
  }

  public function laporan($id = false)
  {
    if ($id) {
      $idPemesanan = $id;
    }else {
      $idPemesanan = $this->request->getVar('kode');
    }
    
    $pemesanan = $this->pemesananModel->getById($idPemesanan);
    
    if (empty($pemesanan)) {
      return redirect()->back()->with('empty', 'Data pemesanan tidak ditemukan.');
    }

    $tgl_dokumen = new DateTime($pemesanan['tgl_dokumen']);

    $split_tanggal_dokumen = [
      'bulan' => $tgl_dokumen->format('m'),
      'tahun' => $tgl_dokumen->format('Y'),
      'hari' => $tgl_dokumen->format('d'),
    ];
    
    $kepalaPuskesmas = $this->ketenagaanModel->getKepala();
    $petugasFarmasi = $this->ketenagaanModel->getFarmasi();
    
    $dataLPLPO = $this->getLPLPO($split_tanggal_dokumen['bulan']);

    $pemesanan['tgl_dokumen'] = $this->support->tanggalIndoFull($pemesanan['tgl_dokumen']);
    $pemesanan['bulan'] = $this->support->bulanIndo($split_tanggal_dokumen['bulan']);
    $pemesanan['tahun'] = $split_tanggal_dokumen['tahun'];
    
    $data = [
      'pemesanan' => $pemesanan,
      'kepalaPuskesmas' => $kepalaPuskesmas,
      'petugasFarmasi' => $petugasFarmasi,
      'dataLPLPO' => $dataLPLPO
    ];
    
    $filename = date('y-m-d-H-i-s'). '-lplpo-' . $pemesanan['kd_pemesanan'];

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('chroot', base_url());
    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);
    // load HTML content
    $dompdf->loadHtml(view('laporan/lplpo', $data));
    // (optional) setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    // render html as PDF
    $dompdf->render();
    // output the generated pdf
    $dompdf->stream($filename, array("Attachment" => false));
  }

  private function getLPLPO($bulan)
  {
    $dataPersediaan = $this->persediaanModel->getLPLPO()->getResult();
    
    // dd($dataPersediaan);

    foreach ($dataPersediaan as $key => $data) {
      $dataPersediaan[$key]->stock_awal = $data->stok_akhir;

      $sumPenerimaan = $this->penerimaanDetailModel->getSumByBulan($bulan, $data->id_obat)->getResult();
      $sumPengeluaran = $this->pengeluaranDetailModel->getSumByBulan($bulan, $data->id_obat)->getResult();
      
      if ($sumPenerimaan[0]->total == null) {
        $dataPersediaan[$key]->total_penerimaan = '0';
      } else {
        $dataPersediaan[$key]->total_penerimaan = $sumPenerimaan[0]->total;
      }

      if ($sumPengeluaran[0]->total == null) {
        $dataPersediaan[$key]->total_pengeluaran = '0';
      } else {
        $dataPersediaan[$key]->total_pengeluaran = $sumPengeluaran[0]->total;
      }

      $dataPersediaan[$key]->persediaan = $data->stock_awal + $dataPersediaan[$key]->total_penerimaan;
      $sisa_stock = $dataPersediaan[$key]->persediaan - $dataPersediaan[$key]->total_pengeluaran;
      
      $dataPersediaan[$key]->sisa_stock = $sisa_stock;

      $permintaan = (3 * $dataPersediaan[$key]->total_pengeluaran) - $data->total_qty;
      
      if ($permintaan <= 0) {
        $dataPersediaan[$key]->permintaan = '';
      } else {
        $dataPersediaan[$key]->permintaan = $permintaan;
      }

      if ($data->id) {
        $this->persediaanModel->update($data->id, ['stok_akhir' => $sisa_stock]);
      }

    }
    // dd($dataPersediaan);
    return $dataPersediaan;
  }
}