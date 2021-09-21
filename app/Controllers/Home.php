<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$pemasukanHarian = $db->query(
			"SELECT sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE DAY(pemasukan.tanggal) = DAY(CURRENT_DATE()) AND MONTH(pemasukan.tanggal) = MONTH(CURRENT_DATE()) AND YEAR(pemasukan.tanggal) = YEAR(CURRENT_DATE())"
		)->getResultArray();

		$pemasukanBulanan = $db->query(
			"SELECT sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE MONTH(pemasukan.tanggal) = MONTH(CURRENT_DATE()) AND YEAR(pemasukan.tanggal) = YEAR(CURRENT_DATE())"
		)->getResultArray();

		$pengeluaranHarian = $db->query(
			"SELECT sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE DAY(pengeluaran.tanggal) = DAY(CURRENT_DATE()) AND MONTH(pengeluaran.tanggal) = MONTH(CURRENT_DATE()) AND YEAR(pengeluaran.tanggal) = YEAR(CURRENT_DATE())"
		)->getResultArray();

		$pengeluaranBulanan = $db->query(
			"SELECT sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE MONTH(pengeluaran.tanggal) = MONTH(CURRENT_DATE()) AND YEAR(pengeluaran.tanggal) = YEAR(CURRENT_DATE())"
		)->getResultArray();

		$data = [
			'titlehead' => 'Dashboard',
			'breadcrumb' => 'Dashboard',
			'pemasukanHarian' => $pemasukanHarian,
			'pemasukanBulanan' => $pemasukanBulanan,
			'pengeluaranHarian' => $pengeluaranHarian,
			'pengeluaranBulanan' => $pengeluaranBulanan
		];
		return view('auth/login', $data);
	}

	public function register()
	{
		return view('auth/register');
	}


	public function form_tambah_pemasukan()
	{
		$data = [
			'titlehead' => 'Tambah Pemasukan',
			'breadcrumb' => 'Form Tambah Pemasukan'
		];
		return view('/form/pemasukan', $data);
	}

	public function form_tambah_pengeluaran()
	{
		$data = [
			'titlehead' => 'Tambah Pengeluaran',
			'breadcrumb' => 'Form Tambah Pengeluaran'
		];
		return view('/form/pengeluaran', $data);
	}

	public function transaksi_jadwal()
	{
		$data = [
			'titlehead' => 'Jadwal Supplier',
			'breadcrumb' => 'Penjadwalan Kedatangan Supplier'
		];
		return view('/transaksi/jadwal', $data);
	}

	public function form_tambah_jadwal()
	{
		$data = [
			'titlehead' => 'Tambah Jadwal',
			'breadcrumb' => 'Form Tambah Jadwal Kedatangan Supplier'
		];
		return view('/form/penjadwalan', $data);
	}


	public function form_tambah_hutang()
	{
		$data = [
			'titlehead' => 'Tambah Hutang',
			'breadcrumb' => 'Form Tambah Hutang'
		];
		return view('/form/hutang', $data);
	}

	public function form_tambah_user()
	{
		$data = [
			'titlehead' => 'Tambah User',
			'breadcrumb' => 'Form Tambah User'
		];
		return view('/form/user', $data);
	}

	public function form_tambah_supplier()
	{
		$data = [
			'titlehead' => 'Tambah Supplier',
			'breadcrumb' => 'Form Tambah Supplier'
		];
		return view('/form/supplier', $data);
	}


	public function form_tambah_barang()
	{
		$data = [
			'titlehead' => 'Tambah Barang',
			'breadcrumb' => 'Form Tambah Barang'
		];
		return view('/form/barang', $data);
	}
	//--------------------------------------------------------------------

}
