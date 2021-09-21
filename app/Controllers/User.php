<?php

namespace App\Controllers;

class User extends BaseController
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
		return view('user/index', $data);
	}
}
