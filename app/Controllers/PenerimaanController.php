<?php

namespace App\Controllers;

use App\Controllers\Support;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;
use CodeIgniter\I18n\Time;

use App\Models\ObatModel;
use App\Models\KetenagaanModel;
use App\Models\PenerimaanModel;
use App\Models\PenerimaanDetailModel;
use App\Models\PersediaanModel;
use App\Models\PersediaanDetailModel;
use App\Models\HistoryStockModel;

class PenerimaanController extends BaseController
{
  protected $support;

  protected $obatModel;
  protected $ketenagaanModel;
  protected $penerimaanModel;
  protected $penerimaanDetailModel;
  protected $PersediaanModel;
  protected $PersediaanDetailModel;
  protected $historyStockModel;

  public function __construct()
  {
      $this->support = new Support();

      $this->obatModel = new ObatModel();
      $this->ketenagaanModel = new ketenagaanModel();
      $this->penerimaanModel = new PenerimaanModel();
      $this->penerimaanDetailModel = new PenerimaanDetailModel();
      $this->persediaanModel = new PersediaanModel();
      $this->persediaanDetailModel = new PersediaanDetailModel();
      $this->historyStockModel = new HistoryStockModel();
  }
  
  public function index()
  {
    $penerimaan = $this->penerimaanModel->getAll();

    $data = [
      'title'  => 'Penerimaan Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_penerimaan',
      'penerimaan' => $penerimaan
    ];
    
    return view('data_transaksi/penerimaan', $data);
  }

  public function detail($idPenerimaan)
  {
    $penerimaanDetail = $this->penerimaanDetailModel->getByIdPenerimaan($idPenerimaan)->getResultArray();
    $penerimaan = $this->penerimaanModel->getById($idPenerimaan);

    $data = [
      'title'  => 'Penerimaan Obat',
      'menu' => 'data_transaksi',
      'submenu' => 'dt_penerimaan',
      'penerimaanDetail' => $penerimaanDetail,
      'sbbk' => $penerimaan['no_sbbk']
    ];
    
    return view('data_transaksi/penerimaan_detail', $data);
  }

  public function create()
  {
    $newKode = $this->support->generateKode('penerimaan', 'penerimaan', 'kd_penerimaan');
    $semuaObat = $this->obatModel->getObat();

    $data = [
      'title'  => 'Penerimaan Obat',
      'menu' => 'tr_penerimaan',
      'submenu' => false,
      'kodePenerimaan' => $newKode,
      'semuaObat' => $semuaObat
    ];
    
    return view('transaksi/penerimaan_obat', $data);
  }

  public function save()
  {
    $json = $this->request->getJSON();

    $itemObat = $json->items;

    $this->penerimaanModel->insert([
      'kd_penerimaan' => $json->kd_penerimaan,
      'no_sbbk' => $json->sbbk,
      'tgl_penerimaan' => $json->tgl_penerimaan,
      'petugas' => $json->petugas,
      'keterangan' => $json->keterangan
    ]);

    foreach ($itemObat as $item) {
      $persediaan = $this->persediaanModel->getPersediaanByIdObat($item->idObat);
      $stock_update = $persediaan['total_qty'] + $item->qty;

      if ($persediaan) {
        $this->persediaanModel->update($persediaan['id'], ['total_qty' => $stock_update]);
        
        $this->historyStockModel->insert([
          'id_obat' => $item->idObat, 
          'sisa_stock' => $stock_update,
          'tanggal' => date('Y-m-d')
        ]);

        $this->insertPersediaanDetail($persediaan['id'], $item);
        $this->insertPenerimaanDetail($persediaan['id'], $item);
      } else {
        // how to use try catch
        $this->persediaanModel->insert([
          'id_obat' => $item->idObat,
          'total_qty' => $item->qty
        ]);

        $this->historyStockModel->insert([
          'id_obat' => $item->idObat, 
          'sisa_stock' => $item->qty,
          'tanggal' => date('Y-m-d')
        ]);

        $this->insertPersediaanDetail($this->persediaanModel->getInsertID(), $item);
        $this->insertPenerimaanDetail($this->persediaanModel->getInsertID(), $item);
      }
    }
    
    $data = [
      'success' => true,
      'message' => 'Data penerimaan berhasil ditambahkan',
      'id' => $this->penerimaanModel->getInsertID()
    ];

    return $this->response->setStatusCode(201)->setJSON($data);
  }

  private function insertPersediaanDetail($idPersediaan, $item)
  {
    $this->persediaanDetailModel->insert([
      'id_persediaan' => $idPersediaan,
      'id_obat' => $item->idObat,
      'no_batch' => $item->batch,
      'expired' => $item->tgl_expire,
      'kategori_obat' => $item->kategori,
      'lokasi_obat' => $item->lokasi,
      'qty' => $item->qty,
      'status' => 'Tersedia'
    ]);
  }

  private function insertPenerimaanDetail($idPersediaan, $item)
  {
    $this->penerimaanDetailModel->insert([
      'id_penerimaan' => $this->penerimaanModel->getInsertID(),
      'id_obat' => $item->idObat,
      'id_persediaan' => $idPersediaan,
      'no_batch' => $item->batch,
      'expired' => $item->tgl_expire,
      'lokasi_obat' => $item->lokasi,
      'qty' => $item->qty
    ]);
  }

  public function laporan($id = false)
  {
    if ($id) {
      $idPenerimaan = $id;
    } else {
      $idPenerimaan = $this->request->getVar('kode');
    }
    
    $penerimaan = $this->penerimaanModel->getByIdJoinPenerimaanDetail($idPenerimaan)->getResult();

    if (empty($penerimaan)) {
      return redirect()->back()->with('empty', 'Data penerimaan tidak ditemukan.');
    }

    $kepalaPuskesmas = $this->ketenagaanModel->getKepala();
    $petugasFarmasi = $this->ketenagaanModel->getFarmasi();

    foreach ($penerimaan as $data) {
      $data->expired = $this->support->tanggalExpired($data->expired);
    }
    
    $tanggalPenerimaan = $this->support->tanggalIndoFull($penerimaan[0]->tgl_penerimaan);
    $tanggalLaporan =  $this->support->tanggalIndoFull(date("Y-m-d"));
    
    $data = [
      'penerimaan' => $penerimaan,
      'kepalaPuskesmas' => $kepalaPuskesmas,
      'petugasFarmasi' => $petugasFarmasi,
      'tanggalPenerimaan' => $tanggalPenerimaan,
      'tanggalLaporan' => $tanggalLaporan
    ];
    
    $filename = date('y-m-d-H-i-s'). '-penerimaan-' . $penerimaan[0]->kd_penerimaan;

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('chroot', base_url());
    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);
    // load HTML content
    // $dompdf->loadHtml(view('laporan/lplpo', $data));
    $dompdf->loadHtml(view('laporan/penerimaan', $data));
    // (optional) setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    // render html as PDF
    $dompdf->render();
    // output the generated pdf
    $dompdf->stream($filename, array("Attachment" => false));
  }
}
