<?php

namespace App\Controllers;

use App\Models\PiutangModel;
use App\Models\PemasukanModel;

class Piutang extends BaseController
{
    protected $piutangModel;
    protected $pemasukanModel;

    public function __construct()
    {
        $this->piutangModel = new PiutangModel();
        $this->pemasukanModel = new PemasukanModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $piutang = $db->query(
            "SELECT piutang.kode_piutang AS kode_piutang, penjualan.kode_trans AS kode_trans, penjualan.kategori AS kategori, penjualan.keterangan AS keterangan, penjualan.tanggal AS tanggal1, piutang.tanggal AS tanggal2, 
            penjualan.jumlah AS jumlah, piutang.dibayar AS dibayar, piutang.sisa AS sisa, piutang.status AS status 
            FROM piutang JOIN penjualan 
            ON piutang.kode_trans = penjualan.kode_trans WHERE piutang.status='BELUM LUNAS'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Piutang',
            'breadcrumb' => 'Piutang',
            'piutang' => $piutang
        ];
        return view('/piutang/index', $data);
    }

    public function bayarPiutang()
    {
        //Kode ID Pemasukan
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

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
        // End of kode Id Pemasukan

        $query1 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT dibayar FROM piutang"
        );
        $dibayar = mysqli_fetch_array($query1);

        $id = $this->request->getPost('kode_piutang');
        $kode_trans = $this->request->getPost('kode_trans');
        $tanggal = $this->request->getPost('tanggal');
        $keterangan = $this->request->getPost('keterangan');
        $jumlah = $this->request->getPost('jumlah');
        $bayar = $this->request->getPost('bayar');
        $dibayar = $this->request->getPost('dibayar');

        //Hitung Sisa Piutang
        $bayarTambah = $dibayar + $bayar;
        $sisa = $jumlah - $bayar;
        $sisa2 = $this->request->getPost('sisa2');

        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $db = \Config\Database::connect();
        if ($bayar <= $jumlah) {
            $query = $db->query(
                "UPDATE piutang set dibayar='$bayarTambah', sisa='$sisa' where kode_piutang='$id'"
            );
            session()->setFlashData('pesan', 'Piutang Berhasil Dibayar');
        } elseif ($bayar >= $jumlah) {
            session()->setFlashData('pesan2', 'Pembayaran melebihi tagihan');
        }

        if ($sisa2 == 0) {
            $query = $db->query(
                "UPDATE piutang set `status`='LUNAS' where kode_piutang='$id'"
            );
            $query = $db->query(
                "INSERT INTO pemasukan (id_pemasukan, kode_trans, tanggal) VALUES ('$kdtrans2', '$kode_trans', '$date')"
            );
        }
        return redirect()->to('/piutang');
    }

    public function update()
    {
        $id = $this->request->getPost('kode_piutang');
        $tanggal = $this->request->getPost('tanggal');

        $db = \Config\Database::connect();
        $db->query(
            "UPDATE piutang set tanggal='$tanggal' WHERE kode_piutang='$id'"
        );
        return redirect()->to('/piutang');
    }

    //--------------------------------------------------------------------
}
