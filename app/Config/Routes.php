<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/obat', 'ObatController::index');
$routes->get('/obat/tambah', 'ObatController::tambah');
$routes->get('/obat/edit/(:num)', 'ObatController::edit/$1');
$routes->get('/obat/hapus/(:num)', 'ObatController::hapus/$1');
$routes->post('/obat/save', 'ObatController::save');

$routes->get('/obat/jenisdansatuan', 'JenisDanSatuan::index');

$routes->get('/penerimaan', 'PenerimaanController::index');
$routes->get('/penerimaan/(:num)', 'PenerimaanController::detail/$1');
$routes->get('/transaksi/penerimaan', 'PenerimaanController::create');
$routes->post('/transaksi/penerimaan', 'PenerimaanController::save');
$routes->get('/transaksi/penerimaan/laporan/(:num)', 'PenerimaanController::laporan/$1');
$routes->post('/transaksi/penerimaan/laporan', 'PenerimaanController::laporan');

$routes->get('/pemesanan', 'PemesananController::index');
$routes->get('/transaksi/pemesanan', 'PemesananController::create');
$routes->post('/transaksi/pemesanan', 'PemesananController::save');
$routes->get('/transaksi/validasi-lplpo', 'PemesananController::validasi_lplpo');
$routes->post('/transaksi/validasi-lplpo', 'PemesananController::selesaikan_pemesanan');
$routes->get('/transaksi/pemesanan/laporan/(:num)', 'PemesananController::laporan/$1');
$routes->post('/transaksi/pemesanan/laporan', 'PemesananController::laporan');

$routes->get('/pengeluaran', 'PengeluaranController::index');
$routes->get('/pengeluaran/(:num)', 'PengeluaranController::detail/$1');
$routes->get('/transaksi/pengeluaran', 'PengeluaranController::create');
$routes->post('/transaksi/pengeluaran', 'PengeluaranController::save');
$routes->get('/transaksi/pengeluaran/laporan/(:num)', 'PengeluaranController::laporan/$1');
$routes->post('/transaksi/pengeluaran/laporan', 'PengeluaranController::laporan');

$routes->get('/perubahan', 'PerubahanLokasiController::index');
$routes->post('/transaksi/perubahan', 'PerubahanLokasiController::save');
$routes->post('/transaksi/perubahan/laporan', 'PerubahanLokasiController::laporan');

$routes->get('/persediaan', 'PersediaanController::index');
$routes->get('/persediaan/(:alpha)', 'PersediaanController::index/$1');
$routes->get('/persediaan/(:num)', 'PersediaanController::detail/$1');
// For Fetch Javascript
$routes->get('/persediaan/stok/(:num)', 'PersediaanController::stok/$1');

$routes->get('/ketenagaan', 'KetenagaanController::index', ['filter' => 'role:admin']);
$routes->get('/ketenagaan/tambah', 'KetenagaanController::tambah', ['filter' => 'role:admin']);
$routes->get('/ketenagaan/edit/(:num)', 'KetenagaanController::edit/$1', ['filter' => 'role:admin']);
$routes->get('/ketenagaan/hapus/(:num)', 'KetenagaanController::hapus/$1', ['filter' => 'role:admin']);
$routes->post('/ketenagaan/save', 'KetenagaanController::save', ['filter' => 'role:admin']);

$routes->get('/pengguna', 'PenggunaController::index', ['filter' => 'role:admin']);
$routes->get('/pengguna/tambah', 'PenggunaController::tambah', ['filter' => 'role:admin']);
$routes->get('/pengguna/profil/(:num)', 'PenggunaController::profil/$1');
$routes->post('/pengguna/password', 'PenggunaController::gantiPassword');

// test
// $routes->get('testing', 'Testing::index'); 


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
