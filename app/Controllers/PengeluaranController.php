<?php

namespace App\Controllers;

use App\Controllers\Support;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Models\ObatModel;
use App\Models\PengeluaranModel;
use App\Models\PengeluaranDetailModel;
use App\Models\KetenagaanModel;
use App\Models\PersediaanModel;
use App\Models\PersediaanDetailModel;

class PengeluaranController extends BaseController
{
  protected $support;

  protected $obatModel;
  protected $pengeluaranModel;
  protected $pengeluaranDetailModel;
  protected $ketenagaanModel;
  protected $persediaanModel;
  protected $persediaanDetailModel;

  public function __construct()
  {
    $this->support = new Support();

    $this->obatModel = new ObatModel();
    $this->pengeluaranModel = new PengeluaranModel();
    $this->pengeluaranDetailModel = new PengeluaranDetailModel();
    $this->ketenagaanModel = new KetenagaanModel();
    $this->persediaanModel = new PersediaanModel();
    $this->persediaanDetailModel = new PersediaanDetailModel();
  }

  public function index()
  {
    $pengeluaran = $this->pengeluaranModel->getAll();

    $data = [
      'title' => 'Pengeluaran Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_pengeluaran',
      'pengeluaran' => $pengeluaran
    ];

    return view('data_transaksi/pengeluaran', $data);
  }

  public function detail($idPengeluaran)
  {
    $pengeluaranDetail = $this->pengeluaranDetailModel->getByIdPengeluaran($idPengeluaran)->getResultArray();
    $pengeluaran = $this->pengeluaranModel->getById($idPengeluaran);

    $data = [
      'title' => 'Pengeluaran Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_pengeluaran',
      'pengeluaranDetail' => $pengeluaranDetail,
      'kd_pengeluaran' => $pengeluaran['kd_pengeluaran']
    ];

    return view('data_transaksi/pengeluaran_detail', $data);
  }

  public function create()
  {
    $newKode = $this->support->generateKode('pengeluaran', 'pengeluaran', 'kd_pengeluaran');
    $semuaObat = $this->obatModel->getObat();
    $dokter = $this->ketenagaanModel->getDokter();

    $data = [
      'title'  => 'Pengeluaran Obat',
      'menu' => 'tr_pengeluaran',
      'submenu' => false,
      'kodePengeluaran' => $newKode,
      'semuaObat' => $semuaObat,
      'dokter' => $dokter
    ];
    
    return view('transaksi/pengeluaran_obat', $data);
  }

  public function save()
  {
    $json = $this->request->getJSON();
    $itemObat = $json->items;

    $this->pengeluaranModel->insert([
      'kd_pengeluaran' => $json->kd_pengeluaran,
      'tgl_pengeluaran' => $json->tgl_pengeluaran,
      'jenis' => $json->jenis,
      'nama_dokter' => $json->dokter,
      'nama_pengguna' => $json->pasien,
      'jk_pengguna' => $json->jk,
      'umur_pengguna' => $json->umur,
      'petugas' => $json->petugas,
      'keterangan' => $json->keterangan
    ]);

    foreach ($itemObat as $item) {
      // cari persediaan berdasarkan idObat
      $persediaan = $this->persediaanModel->getPersediaanByIdObat($item->idObat);
      $stock_update = $persediaan['total_qty'] - $item->qty;
      // update total qty persediaan
      $this->persediaanModel->update($persediaan['id'], ['total_qty' => $stock_update]);

      $this->historyStockModel->insert([
          'id_obat' => $item->idObat, 
          'sisa_stock' => $stock_update,
          'tanggal' => date('Y-m-d')
      ]);
      
      $persediaanDetail = $this->persediaanDetailModel->getPersediaanByFefo($item->idObat, 'Apotek')->getResult();
      
      $qty = $item->qty;
      
      foreach ($persediaanDetail as $pd) {
        $stok = $pd->qty;
        $sisa = $stok - $qty;
        
        if ($sisa < 0) {
          // insert pengeluaran detail
          $this->insertPengeluaranDetail($pd->id, $item, $stok);
      
          $this->persediaanDetailModel->set('qty', 0)->set('status', 'Habis')->where('id', $pd->id)->update();
          $qty = $sisa * -1;
        } else {
          // insert pengeluaran detail
          $this->insertPengeluaranDetail($pd->id, $item, $qty);
          
          if ($sisa == 0) {
            $this->persediaanDetailModel->set('qty', $sisa)->set('status', 'Habis')->where('id', $pd->id)->update();
          } else {
            $this->persediaanDetailModel->set('qty', $sisa)->where('id', $pd->id)->update();
          }
          break;
        }
      }
    }

    // ambil data pengeluaran (Obat yg dipakai) terakhir untuk dikirim ke json atau frontend
    $pengeluaran = $this->pengeluaranDetailModel->getByIdPengeluaran($this->pengeluaranModel->getInsertID())->getResult();

    $obat = [];

    foreach ($pengeluaran as $value) {
      $data = [
        'nama_obat' => $value->nama,
        'nomor_batch' => $value->no_batch,
        'lokasi' => $value->lokasi_obat,
        'qty'=> $value->qty_keluar
      ];

      array_push($obat, $data);
    }


    $data = [
      'success' => true,
      'message' => 'Data pengeluaran berhasil ditambahkan',
      'id' => $this->pengeluaranModel->getInsertID(),
      'obat' => $obat
    ];

    return $this->response->setStatusCode(201)->setJSON($data);
  }

  private function insertPengeluaranDetail($idPersediaanDetail, $item, $qty)
  {
    $this->pengeluaranDetailModel->insert([
      'id_pengeluaran' => $this->pengeluaranModel->getInsertID(),
      'id_obat' => $item->idObat,
      'id_persediaan_detail' => $idPersediaanDetail,
      'qty' => $qty
    ]);
  }

  public function laporan($id = false)
  {
    if ($id) {
      $idPengeluaran = $id;
    } else {
      $idPengeluaran = $this->request->getVar('kode');
    }

    $pengeluaran = $this->pengeluaranDetailModel->getByIdPengeluaran($idPengeluaran)->getResult();
    $kepalaPuskesmas = $this->ketenagaanModel->getKepala();
    $petugasFarmasi = $this->ketenagaanModel->getFarmasi();

    foreach ($pengeluaran as $data) {
      $data->expired = $this->support->tanggalExpired($data->expired);
    }
    
    $tanggalPengeluaran = $this->support->tanggalIndoFull($pengeluaran[0]->tgl_pengeluaran);
    $tanggalLaporan =  $this->support->tanggalIndoFull(date("Y-m-d"));
    
    $data = [
      'pengeluaran' => $pengeluaran,
      'kepalaPuskesmas' => $kepalaPuskesmas,
      'petugasFarmasi' => $petugasFarmasi,
      'tanggalPengeluaran' => $tanggalPengeluaran,
      'tanggalLaporan' => $tanggalLaporan
    ];
    
    $filename = date('y-m-d-H-i-s'). '-pengeluaran-' . $pengeluaran[0]->kd_pengeluaran;

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('chroot', base_url());
    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);
    // load HTML content
    // $dompdf->loadHtml(view('laporan/lplpo', $data));
    $dompdf->loadHtml(view('laporan/pengeluaran', $data));
    // (optional) setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    // render html as PDF
    $dompdf->render();
    // output the generated pdf
    $dompdf->stream($filename, array("Attachment" => false));
  }
}