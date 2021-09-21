<?php

namespace App\Controllers;

use App\Models\PemasukanModel;
use mysqli;

class Pemasukan extends BaseController
{

    protected $pemasukanModel;

    public function __construct()
    {
        $this->pemasukanModel = new PemasukanModel();
    }

    public function index()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        //Query menampilkan data jadwal
        $query = $db->query(
            "SELECT penjualan.kode_trans AS kode_trans, penjualan.keterangan AS keterangan, penjualan.kategori AS kategori, pemasukan.tanggal AS tanggal, penjualan.jumlah AS jumlah, penjualan.metode AS metode 
            FROM pemasukan JOIN penjualan 
            ON pemasukan.kode_trans = penjualan.kode_trans"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Pemasukan',
            'breadcrumb' => 'Pemasukan',
            'pemasukan' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pemasukan/index', $data);
    }

    public function caritanggal()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT penjualan.kode_trans AS kode_trans, penjualan.keterangan AS keterangan, penjualan.kategori AS kategori, pemasukan.tanggal AS tanggal, penjualan.jumlah AS jumlah, penjualan.metode AS metode 
            FROM pemasukan JOIN penjualan 
            ON pemasukan.kode_trans = penjualan.kode_trans 
            WHERE pemasukan.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Pemasukan',
            'breadcrumb' => 'Pemasukan',
            'pemasukan' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pemasukan/index', $data);
    }
    //--------------------------------------------------------------------
}
