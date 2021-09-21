<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use mysqli;

class TransaksiPemasukan extends BaseController
{

    protected $penjualanModel;

    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $tanggalawal = date("Y-m-d");
        $tanggalakhir = date("Y-m-d");
        $penjualan = $db->query(
            "SELECT * FROM penjualan where tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' AND kategori <>'Penjualan';"
        )->getResultArray();
        $data = [
            'titlehead' => 'Data Transaksi Pemasukan',
            'breadcrumb' => 'Transaksi Pemasukan',
            'penjualan' => $penjualan,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/transaksipemasukan/index', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $query = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(kode_trans) as maxKode FROM penjualan"
        );
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(kode_trans,15)) as maxKode FROM penjualan"
        );
        $data = mysqli_fetch_array($query);
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "PJ";
        $tahun = substr($date, 0, 3);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . $tgl . $bulan . $tahun . sprintf("%06s", $noOrder);

        $data = [
            'titlehead' => 'Form Tambah Pemasukan',
            'breadcrumb' => 'Transaksi Pemasukan',
            'breadcrumb2' => 'Tambah Pemasukan',
            'kodePenjualan' => $kdtrans,
            'tanggal' => $date,
            'validation' => $validation,
        ];
        return view('transaksipemasukan/create', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'kategori' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/transaksipemasukan/create')->withInput();
        }

        // Kode ID Piutang
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $query = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(kode_piutang) as maxKode FROM piutang"
        );
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(kode_piutang,15)) as maxKode FROM piutang"
        );
        $data = mysqli_fetch_array($query);
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "PTG";
        $tahun = substr($date, 0, 3);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . $tgl . $bulan . $tahun . sprintf("%06s", $noOrder);
        // End of Kode ID Piutang

        // Kode Id Pemasukan
        $query3 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(id_pemasukan) as maxKode FROM pemasukan"
        );
        $query4 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(id_pemasukan,15)) as maxKode FROM pemasukan"
        );
        $data3 = mysqli_fetch_array($query3);
        $data4 = mysqli_fetch_array($query4);
        $noOrder2 = $data4['maxKode'];
        $noOrder2++;

        $char2 = "PMS";
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
                "INSERT INTO penjualan (kode_trans, keterangan, kategori, jumlah, metode, tanggal) VALUES ('$kode_trans', '$keterangan', '$kategori', '$jumlah', '$metode', '$tanggal')"
            );
            $db->query(
                "INSERT INTO pemasukan (id_pemasukan, kode_trans, tanggal) VALUES ('$kdtrans2','$kode_trans', '$tanggal')"
            );
        } else if ($metode == 'Hutang') {
            $db->query(
                "INSERT INTO penjualan (kode_trans, keterangan, kategori, jumlah, metode, tanggal) VALUES ('$kode_trans', '$keterangan', '$kategori', '$jumlah', '$metode', '$tanggal')"
            );
            $db->query(
                "INSERT INTO piutang (kode_piutang, kode_trans, tanggal, dibayar, sisa, status) VALUES ('$kdtrans','$kode_trans', '$tanggalTempo', 0, '$jumlah', 'BELUM LUNAS')"
            );
        }
        return redirect()->to('/transaksipemasukan/index');
    }

    public function caritanggal()
    {
        $tanggalawal = $this->request->getVar('tanggalawal');
        $tanggalakhir = $this->request->getVar('tanggalakhir');
        $db = \Config\Database::connect();
        $query = $db->query(
            "SELECT * FROM penjualan where tanggal BETWEEN '$tanggalawal' and '$tanggalakhir' AND kategori <>'Penjualan'';"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Transaksi Pemasukan',
            'breadcrumb' => 'Transaksi Pemasukan',
            'penjualan' => $query,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir
        ];
        return view('/transaksipemasukan/index', $data);
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
        $this->penjualanModel->updatePenjualan($data, $id);
        return redirect()->to('/transaksipemasukan');
    }

    public function delete()
    {
        $id = $this->request->getPost('kode_trans');
        $this->penjualanModel->deletePenjualan($id);
        return redirect()->to('/transaksipemasukan');
    }
    //--------------------------------------------------------------------
}
