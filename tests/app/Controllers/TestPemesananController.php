<?php

namespace App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class TestPemesananController extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    protected $migrate = true;

    public function testIndex()
    {
      $result = $this->withURI('http://localhost/sipo-app/transaksi/pemesanan')
        ->controller(\App\Controllers\PemesananController::class)
        ->execute('create');
        
        $result->assertOK();
        $result->assertSee('Transaksi Pemesanan Obat', 'h1');
        $result->assertSeeElement('#form-pemesanan');
        $result->assertSeeInField('kd_pemesanan', 'TP22120001');
        $result->assertSeeInField('petugas', 'Gusnanto');
    }
}