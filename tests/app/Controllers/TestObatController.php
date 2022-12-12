<?php

namespace App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Models\ObatModel;

class TestObatController extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    protected $migrate = true;

    public function testIndex()
    {
      $result = $this->withURI('http://localhost/sipo-app/obat')
        ->controller(\App\Controllers\ObatController::class)
        ->execute('index');
        
        $result->assertOK();
        $result->assertSee('Data Obat', 'h1');
        $result->assertSeeElement('table');
    }

    public function testTambah()
    {
      $result = $this->withURI('http://localhost/sipo-app/obat/tambah')
        ->controller(\App\Controllers\ObatController::class)
        ->execute('tambah');
        
        $result->assertOK();
        $result->assertSee('Tambah Data Obat', 'h1');
        $result->assertSeeElement('form');
        $result->assertSeeInField('kd_obat', 'OB0001');
    }
}