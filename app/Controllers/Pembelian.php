<?php

namespace App\Controllers;

use App\Models\PembelianModel;
use mysqli;
use TCPDF;

class Pembelian extends BaseController
{

    protected $pembelianModel;

    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $tanggalawal = date("Y-m-d");
        $tanggalakhir = date("Y-m-d");
        $pembelian = $db->query(
            "SELECT * FROM pembelian where tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' AND kategori = 'Pembelian';"
        )->getResultArray();
        $data = [
            'titlehead' => 'Data Transaksi Pembelian',
            'breadcrumb' => 'Transaksi Pembelian',
            'pembelian' => $pembelian,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pembelian/index', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $query = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(kode_trans) as maxKode FROM pembelian"
        );
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(kode_trans,15)) as maxKode FROM pembelian"
        );
        $data = mysqli_fetch_array($query);
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "PB";
        $tahun = substr($date, 0, 3);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . $tgl . $bulan . $tahun . sprintf("%06s", $noOrder);

        $data = [
            'titlehead' => 'Form Tambah Pembelian',
            'breadcrumb' => 'Transaksi Pembelian',
            'breadcrumb2' => 'Tambah Pembelian',
            'kodePembelian' => $kdtrans,
            'tanggal' => $date,
            'validation' => $validation,
        ];
        return view('pembelian/create', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pembelian/create')->withInput();
        }

        //Kode ID HUTANG
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $query = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(kode_hutang) as maxKode FROM hutang"
        );
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(kode_hutang,15)) as maxKode FROM hutang"
        );
        $data = mysqli_fetch_array($query);
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "HTG";
        $tahun = substr($date, 0, 3);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . $tgl . $bulan . $tahun . sprintf("%06s", $noOrder);
        // End of Kode ID Hutang

        //Kode Id Pengeluaran
        $query3 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(id_pengeluaran) as maxKode FROM pengeluaran"
        );
        $query4 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(id_pengeluaran,15)) as maxKode FROM pengeluaran"
        );
        $data3 = mysqli_fetch_array($query3);
        $data4 = mysqli_fetch_array($query4);
        $noOrder2 = $data4['maxKode'];
        $noOrder2++;

        $char2 = "PNG";
        $tahun2 = substr($date, 0, 3);
        $bulan2 = substr($date, 5, 2);
        $tgl2 = substr($date, 8, 2);
        $kdtrans2 = $char2 . $tgl2 . $bulan2 . $tahun2 . sprintf("%06s", $noOrder2);
        // End of kode Id Pengeluaran

        $kode_trans = $this->request->getPost('kode_trans');
        $kategori = $this->request->getPost('kategori');
        $keterangan = $this->request->getPost('keterangan');
        $jumlah = $this->request->getPost('jumlah');
        $metode = $this->request->getPost('metode_pembayaran');
        $tanggal = $this->request->getPost('tanggal');
        $tanggalTempo = $this->request->getPost('tanggal_tempo');

        $db = \Config\Database::connect();
        if ($metode == 'Lunas') {
            $db->query(
                "INSERT INTO pembelian (kode_trans, keterangan, kategori, jumlah, metode, tanggal) VALUES ('$kode_trans', '$keterangan', '$kategori', '$jumlah', '$metode', '$tanggal')"
            );
            $db->query(
                "INSERT INTO pengeluaran (id_pengeluaran, kode_trans, tanggal) VALUES ('$kdtrans2','$kode_trans', '$tanggal')"
            );
        } else if ($metode == 'Hutang') {
            $db->query(
                "INSERT INTO pembelian (kode_trans, keterangan, kategori, jumlah, metode, tanggal) VALUES ('$kode_trans', '$keterangan', '$kategori', '$jumlah', '$metode', '$tanggal')"
            );
            $db->query(
                "INSERT INTO hutang (kode_hutang, kode_trans, tanggal, dibayar, sisa, status) VALUES ('$kdtrans','$kode_trans', '$tanggalTempo', 0, '$jumlah', 'BELUM LUNAS')"
            );
        }
        return redirect()->to('/pembelian/index');
    }

    public function caritanggal()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM pembelian where tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' AND kategori = 'Pembelian';"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Transaksi Pembelian',
            'breadcrumb' => 'Transaksi Pembelian',
            'pembelian' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/pembelian/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('kode_transaksi');
        $data = [
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];
        $this->pembelianModel->updatePembelian($data, $id);
        return redirect()->to('/pembelian');
    }

    public function delete()
    {
        $id = $this->request->getPost('kode_trans');
        $this->pembelianModel->deletePembelian($id);
        return redirect()->to('/pembelian');
    }

    public function invoice()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('kode_trans');
        $metode = $this->request->getPost('metode');

        $query = $db->query(
            "SELECT * FROM pembelian where kode_trans='$id'"
        )->getResultArray();

        $query2 = $db->query(
            "SELECT hutang.tanggal AS tanggal2
            FROM hutang JOIN pembelian 
            ON hutang.kode_trans = pembelian.kode_trans WHERE pembelian.kode_trans ='$id'"
        )->getResultArray();

        $data = [
            'pembelian' => $query,
            'hutang' => $query2,
            'metode' => $metode,
        ];
        return view('/pembelian/invoice', $data);
    }
    //--------------------------------------------------------------------
}
