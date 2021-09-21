<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['auth'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		session();

		$db = \Config\Database::connect();
		$query = $db->query(
			'SELECT supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS namaBrg, jadwal.tanggal AS tanggal from jadwal 
			JOIN supplier 
				ON jadwal.id_supplier = supplier.id_supplier 
			JOIN barang 
				ON jadwal.id_barang = barang.id_barang
				WHERE jadwal.status="DALAM PROSES" AND jadwal.tanggal=DATE(NOW()) + INTERVAL 0 DAY
				UNION
				SELECT supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS namaBrg, jadwal.tanggal AS tanggal from jadwal 
			JOIN supplier 
				ON jadwal.id_supplier = supplier.id_supplier 
			JOIN barang 
				ON jadwal.id_barang = barang.id_barang
				WHERE jadwal.status="DALAM PROSES" AND jadwal.tanggal=DATE(NOW()) + INTERVAL 1 DAY
				UNION
				SELECT supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS namaBrg, jadwal.tanggal AS tanggal from jadwal 
			JOIN supplier 
				ON jadwal.id_supplier = supplier.id_supplier 
			JOIN barang 
				ON jadwal.id_barang = barang.id_barang
				WHERE jadwal.status="DALAM PROSES" AND jadwal.tanggal=DATE(NOW()) + INTERVAL 2 DAY
				UNION
				SELECT supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS namaBrg, jadwal.tanggal AS tanggal from jadwal 
			JOIN supplier 
				ON jadwal.id_supplier = supplier.id_supplier 
			JOIN barang 
				ON jadwal.id_barang = barang.id_barang
				WHERE jadwal.status="DALAM PROSES" AND jadwal.tanggal=DATE(NOW()) + INTERVAL 3 DAY'
		)->getResultArray();

		//Query menampilkan data jadwal
		$query2 = $db->query(
			"SELECT jadwal.kode_jadwal AS kode_jadwal, barang.id_barang AS id_barang, supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS nama_barang, jadwal.tanggal AS tanggal from jadwal 
			JOIN supplier 
				ON jadwal.id_supplier = supplier.id_supplier 
			JOIN barang 
				ON jadwal.id_barang = barang.id_barang
				WHERE jadwal.status='DALAM PROSES'"
		)->getResultArray();

		$data = [
			'titlehead' => 'Form Penjadwalan Supplier',
			'breadcrumb' => 'Jadwal Supplier',
			'jadwal' => $query2,
			'notifications' => $query,
		];
		return view('/jadwal/index', $data);
	}
}
