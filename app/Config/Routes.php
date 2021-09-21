<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Index
$routes->get('/', 'Admin::userIndex', ['filter' => 'role:admin,sales,purchasing,warehousing']);

$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);

// Transaksi
$routes->get('/penjualan', 'Penjualan::index', ['filter' => 'role:admin']);
$routes->get('/penjualan/index', 'Penjualan::index', ['filter' => 'role:admin']);
$routes->get('/penjualan/create', 'Penjualan::create', ['filter' => 'role:admin']);
$routes->get('/penjualan/caritanggal', 'Penjualan::caritanggal', ['filter' => 'role:admin']);
$routes->get('/penjualan/invoice', 'Penjualan::invoice', ['filter' => 'role:admin']);

$routes->get('/sales/', 'Sales::index', ['filter' => 'role:admin,sales']);
$routes->get('/sales/index', 'Sales::index', ['filter' => 'role:admin,sales']);
$routes->get('/sales/create', 'Sales::create', ['filter' => 'role:admin,sales']);
$routes->get('/sales/caritanggal', 'Sales::caritanggal', ['filter' => 'role:admin,sales']);
$routes->get('/sales/invoice', 'Sales::invoice', ['filter' => 'role:admin,sales']);

$routes->get('/pembelian', 'Pembelian::index', ['filter' => 'role:admin']);
$routes->get('/pembelian/index', 'Pembelian::index', ['filter' => 'role:admin']);
$routes->get('/pembelian/create', 'Pembelian::create', ['filter' => 'role:admin']);
$routes->get('/pembelian/caritanggal', 'Pembelian::caritanggal', ['filter' => 'role:admin']);
$routes->get('/pembelian/invoice', 'Pembelian::invoice', ['filter' => 'role:admin']);

$routes->get('/purchasing/', 'Purchasing::index', ['filter' => 'role:admin,purchasing']);
$routes->get('/purchasing/index', 'Purchasing::index', ['filter' => 'role:admin,purchasing']);
$routes->get('/purchasing/create', 'Purchasing::create', ['filter' => 'role:admin,purchasing']);
$routes->get('/purchasing/caritanggal', 'Purchasing::caritanggal', ['filter' => 'role:admin,purchasing']);

$routes->get('/transaksipengeluaran', 'TransaksiPengeluaran::index', ['filter' => 'role:admin']);
$routes->get('/transaksipengeluaran/index', 'TransaksiPengeluaran::index', ['filter' => 'role:admin']);
$routes->get('/transaksipengeluaran/create', 'TransaksiPengeluaran::create', ['filter' => 'role:admin']);
$routes->get('/transaksipengeluaran/caritanggal', 'TransaksiPengeluaran::caritanggal', ['filter' => 'role:admin']);

$routes->get('/transaksipemasukan', 'TransaksiPemasukan::index', ['filter' => 'role:admin']);
$routes->get('/transaksipemasukan/index', 'TransaksiPemasukan::index', ['filter' => 'role:admin']);
$routes->get('/transaksipemasukan/create', 'TransaksiPemasukan::create', ['filter' => 'role:admin']);
$routes->get('/transaksipemasukan/caritanggal', 'TransaksiPemasukan::caritanggal', ['filter' => 'role:admin']);

$routes->get('/pemasukan', 'Pemasukan::index', ['filter' => 'role:admin']);
$routes->get('/pemasukan/index', 'Pemasukan::index', ['filter' => 'role:admin']);
$routes->get('/pemasukan/caritanggal', 'Pemasukan::caritanggal', ['filter' => 'role:admin']);

$routes->get('/pengeluaran', 'Pengeluaran::index', ['filter' => 'role:admin']);
$routes->get('/pengeluaran/index', 'Pengeluaran::index', ['filter' => 'role:admin']);
$routes->get('/pengeluaran/caritanggal', 'Pengeluaran::caritanggal', ['filter' => 'role:admin']);

$routes->get('/hutang', 'Hutang::index', ['filter' => 'role:admin']);
$routes->get('/hutang/index', 'Hutang::index', ['filter' => 'role:admin']);

$routes->get('/piutang', 'Piutang::index', ['filter' => 'role:admin']);
$routes->get('/piutang/index', 'Piutang::index', ['filter' => 'role:admin']);


// Data Master 

$routes->get('/barang', 'Barang::index', ['filter' => 'role:admin,warehousing']);
$routes->get('/barang/index', 'Barang::index', ['filter' => 'role:admin,warehousing']);
$routes->get('/barang/create', 'Barang::create', ['filter' => 'role:admin,warehousing']);

$routes->get('/supplier', 'Supplier::index', ['filter' => 'role:admin']);
$routes->get('/supplier/index', 'Supplier::index', ['filter' => 'role:admin']);
$routes->get('/supplier/create', 'Supplier::create', ['filter' => 'role:admin']);

$routes->get('/jadwal', 'Jadwal::index', ['filter' => 'role:admin,purchasing']);
$routes->get('/jadwal/index', 'Jadwal::index', ['filter' => 'role:admin,purchasing']);
$routes->get('/jadwal/create', 'Jadwal::create', ['filter' => 'role:admin,purchasing']);
$routes->get('/jadwal/jadwalselesai', 'Jadwal::jadwalselesai', ['filter' => 'role:admin,purchasing']);

// Laporan
$routes->get('/laporan', 'Laporan::index', ['filter' => 'role:admin']);
$routes->get('/laporan/index', 'Laporan::index', ['filter' => 'role:admin']);
$routes->get('/laporan/caritanggal', 'Laporan::caritanggal', ['filter' => 'role:admin']);
$routes->get('/laporan/cetak', 'Laporan::cetak', ['filter' => 'role:admin']);
/**
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
