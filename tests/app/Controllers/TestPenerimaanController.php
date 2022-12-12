<?php

namespace App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class TestPenerimaanController extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    protected $migrate = true;

    public function testCreate()
    {
      $result = $this->withURI('http://localhost/sipo-app/transaksi/penerimaan')
        ->controller(\App\Controllers\PenerimaanController::class)
        ->execute('create');
        
        $result->assertOK();
        $result->assertSee('Transaksi Penerimaan Obat', 'h1');
        $result->assertSeeElement('#form-penerimaan');
        $result->assertSeeInField('kd_penerimaan', 'TM22120001');
        $result->assertSeeInField('petugas', 'Gusnanto');
    }
}