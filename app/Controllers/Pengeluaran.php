<?php

namespace App\Controllers;

use App\Models\PengeluaranModel;

class Pengeluaran extends BaseController
{
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
    }

    public function index()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        //Query menampilkan data jadwal
        $query = $db->query(
            "SELECT pembelian.kode_trans AS kode_trans, pembelian.keterangan AS keterangan, pembelian.kategori AS kategori, pengeluaran.tanggal AS tanggal, pembelian.jumlah AS jumlah, pembelian.metode AS metode 
            FROM pengeluaran JOIN pembelian 
            ON pengeluaran.kode_trans = pembelian.kode_trans"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Pengeluaran',
            'breadcrumb' => 'Pengeluaran',
            'pengeluaran' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pengeluaran/index', $data);
    }

    public function caritanggal()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT pembelian.kode_trans AS kode_trans, pembelian.keterangan AS keterangan, pembelian.kategori AS kategori, pengeluaran.tanggal AS tanggal, pembelian.jumlah AS jumlah, pembelian.metode AS metode 
            FROM pengeluaran JOIN pembelian 
            ON pengeluaran.kode_trans = pembelian.kode_trans 
            WHERE pengeluaran.tanggal BETWEEN '$tanggalawal' and '$tanggalakhir'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Pengeluaran',
            'breadcrumb' => 'Pengeluaran',
            'pengeluaran' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pengeluaran/index', $data);
    }
    //--------------------------------------------------------------------
}
