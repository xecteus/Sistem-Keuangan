<?php

namespace App\Controllers;


class Laporan extends BaseController
{

    public function index()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('asia/jakarta');
        $tanggalawal = date('Y-m-01');
        $tanggalakhir = date("Y-m-t");
        $tanggalsekarang = date('Y-m-d');
        $queryPemasukan = $db->query(
            "SELECT penjualan.kategori as kategori_pemasukan, sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' GROUP BY penjualan.kategori"
        )->getResultArray();

        $queryTotalPemasukan = $db->query(
            "SELECT sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $queryPengeluaran = $db->query(
            "SELECT pembelian.kategori as kategori_pengeluaran, sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' GROUP BY pembelian.kategori"
        )->getResultArray();

        $queryTotalPengeluaran = $db->query(
            "SELECT sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $totalSemua = $db->query(
            "SELECT (SELECT COALESCE(SUM(penjualan.jumlah), 0) from pemasukan JOIN penjualan ON pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            - (SELECT COALESCE(sum(pembelian.jumlah), 0) from pengeluaran JOIN pembelian ON pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            AS TotalSemua"
        )->getResultArray();

        $data = [
            'titlehead' => 'Laporan',
            'breadcrumb' => 'Laporan',
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'tanggalsekarang' => $tanggalsekarang,
            'totalsemua' => $totalSemua,
            'pemasukan' => $queryPemasukan,
            'pengeluaran' => $queryPengeluaran,
            'totalpengeluaran' => $queryTotalPengeluaran,
            'totalpemasukan' => $queryTotalPemasukan,
        ];
        return view('/laporan/index', $data);
    }

    public function caritanggal()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('asia/jakarta');
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $tanggalsekarang = date('Y-m-d');
        $queryPemasukan = $db->query(
            "SELECT penjualan.kategori as kategori_pemasukan, sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' GROUP BY penjualan.kategori"
        )->getResultArray();

        $queryTotalPemasukan = $db->query(
            "SELECT sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $queryPengeluaran = $db->query(
            "SELECT pembelian.kategori as kategori_pengeluaran, sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' GROUP BY pembelian.kategori;"
        )->getResultArray();

        $queryTotalPengeluaran = $db->query(
            "SELECT sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $totalSemua = $db->query(
            "SELECT (SELECT COALESCE(SUM(penjualan.jumlah), 0) from pemasukan JOIN penjualan ON pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            - (SELECT COALESCE(sum(pembelian.jumlah), 0) from pengeluaran JOIN pembelian ON pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            AS TotalSemua"
        )->getResultArray();

        $data = [
            'titlehead' => 'Laporan',
            'breadcrumb' => 'Laporan',
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'tanggalsekarang' => $tanggalsekarang,
            'totalsemua' => $totalSemua,
            'pemasukan' => $queryPemasukan,
            'pengeluaran' => $queryPengeluaran,
            'totalpengeluaran' => $queryTotalPengeluaran,
            'totalpemasukan' => $queryTotalPemasukan,
        ];
        return view('/laporan/index', $data);
    }

    public function cetak()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set('asia/jakarta');
        $tanggalawal = $this->request->getVar('tanggal_awal');
        $tanggalakhir = $this->request->getVar('tanggal_akhir');
        $tanggalsekarang = date('Y-m-d');
        $queryPemasukan = $db->query(
            "SELECT penjualan.kategori as kategori_pemasukan, sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $queryTotalPemasukan = $db->query(
            "SELECT sum(penjualan.jumlah) AS jumlah_pemasukan
            from pemasukan 
            JOIN penjualan on pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $queryPengeluaran = $db->query(
            "SELECT pembelian.kategori as kategori_pengeluaran, sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' GROUP BY pembelian.kategori"
        )->getResultArray();

        $queryTotalPengeluaran = $db->query(
            "SELECT sum(pembelian.jumlah) AS jumlah_pengeluaran
            from pengeluaran 
            JOIN pembelian on pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $totalSemua = $db->query(
            "SELECT (SELECT COALESCE(SUM(penjualan.jumlah), 0) from pemasukan JOIN penjualan ON pemasukan.kode_trans = penjualan.kode_trans WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            - (SELECT COALESCE(sum(pembelian.jumlah), 0) from pengeluaran JOIN pembelian ON pengeluaran.kode_trans = pembelian.kode_trans WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir') 
            AS TotalSemua"
        )->getResultArray();

        $data = [
            'titlehead' => 'Laporan',
            'breadcrumb' => 'Laporan',
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'tanggalsekarang' => $tanggalsekarang,
            'totalsemua' => $totalSemua,
            'pemasukan' => $queryPemasukan,
            'pengeluaran' => $queryPengeluaran,
            'totalpengeluaran' => $queryTotalPengeluaran,
            'totalpemasukan' => $queryTotalPemasukan,
        ];
        return view('/laporan/cetak', $data);
    }
}
