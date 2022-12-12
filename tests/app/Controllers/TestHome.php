<?php

namespace App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Models\PemesananModel;
use Tests\Support\Models\PenerimaanModel;
use Tests\Support\Models\PengeluaranModel;
use Tests\Support\Models\PerubahanModel;
use Tests\Support\Models\PersediaanDetailModel;
use Tests\Support\Models\PersediaanModel;
use DateTime;
use App\Controllers\Support;

class TestHome extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    protected $migrate = true;

    public function testIndex()
    {
      $result = $this->withURI('http://localhost/sipo-app/')
        ->controller(\App\Controllers\Home::class)
        ->execute('index');
        
        $result->assertOK();
        $result->assertSee('Beranda', 'h1');
        $result->assertSeeElement('.small-box bg-info');
        $result->assertSeeElement('.small-box bg-success');
        $result->assertSeeElement('.small-box bg-warning');
        $result->assertSeeElement('.small-box bg-info');
    }
}