<?php

namespace App\Controllers;

use App\Models;
use DateTime;
use App\Controllers\Support;

class Home extends BaseController
{
    protected $pemesananModel;
    protected $penerimaanModel;
    protected $pengeluaranModel;
    protected $perubahanModel;
    protected $persediaanDetailModel;
    protected $persediaanModel;
    protected $support;

    public function __construct()
    {
        $this->pemesananModel = new Models\PemesananModel();
        $this->penerimaanModel = new Models\PenerimaanModel();
        $this->pengeluaranModel = new Models\PengeluaranModel();
        $this->perubahanModel = new Models\PerubahanModel();
        $this->persediaanDetailModel = new Models\PersediaanDetailModel();
        $this->persediaanModel = new Models\PersediaanModel();
        $this->support = new Support();
    }

    public function index()
    {
        $jumlahPemesanan = $this->pemesananModel->getCount();
        $jumlahPenerimaan = $this->penerimaanModel->getCount();
        $jumlahPengeluaran = $this->pengeluaranModel->getCount();
        $jumlahPerubahan = $this->perubahanModel->getCount();

        $limitedStock = $this->persediaanModel->getLimitedStock()->getResult();
        $persediaanExpired = $this->persediaanDetailModel->getExpired()->getResult();

        foreach ($persediaanExpired as $key => $value) {
            $expired = new DateTime($value->expired);
            $tanggalSekarang = new DateTime();

            $selisih = $tanggalSekarang->diff($expired);
            $persediaanExpired[$key]->selisih = $selisih->days;

            $expiredFormated = $this->support->tanggalExpired($value->expired);
            $persediaanExpired[$key]->expired = $expiredFormated;
        }

        
        $data = [
            'title' => 'Home',
            'menu' => 'beranda',
            'submenu' => false,
            'count' => [
                'pemesanan' => $jumlahPemesanan,
                'penerimaan' => $jumlahPenerimaan,
                'pengeluaran' => $jumlahPengeluaran,
                'perubahan' => $jumlahPerubahan,
            ],
            'persediaanExpired' => $persediaanExpired,
            'limitedStock' => $limitedStock
        ];
        
        return view('home', $data);
    }
}
