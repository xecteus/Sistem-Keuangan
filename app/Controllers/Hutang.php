<?php

namespace App\Controllers;

use App\Models\HutangModel;
use App\Models\PengeluaranModel;

class Hutang extends BaseController
{
    protected $hutangModel;
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->hutangModel = new HutangModel();
        $this->pengeluaranModel = new PengeluaranModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $hutang = $db->query(
            "SELECT hutang.kode_hutang AS kode_hutang, pembelian.kode_trans AS kode_trans, pembelian.kategori AS kategori, pembelian.keterangan AS keterangan, pembelian.tanggal AS tanggal1, hutang.tanggal AS tanggal2, 
            pembelian.jumlah AS jumlah, hutang.dibayar AS dibayar, hutang.sisa AS sisa, hutang.status AS status 
            FROM hutang JOIN pembelian 
            ON hutang.kode_trans = pembelian.kode_trans WHERE hutang.status='BELUM LUNAS'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Hutang',
            'breadcrumb' => 'Hutang',
            'hutang' => $hutang
        ];
        return view('/hutang/index', $data);
    }

    public function bayarHutang()
    {
        //Kode ID Pengeluaran
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

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

        $query1 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT dibayar FROM hutang"
        );
        $dibayar = mysqli_fetch_array($query1);

        $id = $this->request->getPost('kode_hutang');
        $kode_trans = $this->request->getPost('kode_trans');
        $tanggal = $this->request->getPost('tanggal');
        $keterangan = $this->request->getPost('keterangan');
        $jumlah = $this->request->getPost('jumlah');
        $bayar = $this->request->getPost('bayar');
        $dibayar = $this->request->getPost('dibayar');

        //Hitung Sisa Hutang
        $bayarTambah = $dibayar + $bayar;
        $sisa = $jumlah - $bayar;
        $sisa2 = $this->request->getPost('sisa2');

        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $db = \Config\Database::connect();
        if ($bayar <= $jumlah) {
            $query = $db->query(
                "UPDATE hutang set dibayar='$bayarTambah', sisa='$sisa' where kode_hutang='$id'"
            );
            session()->setFlashData('pesan', 'Hutang Berhasil Dibayar');
        } elseif ($bayar >= $jumlah) {
            session()->setFlashData('pesan2', 'Pembayaran melebihi tagihan');
        }

        if ($sisa2 == 0) {
            $query = $db->query(
                "UPDATE hutang set `status`='LUNAS' where kode_hutang='$id'"
            );
            $query = $db->query(
                "INSERT INTO pengeluaran (id_pengeluaran, kode_trans, tanggal) VALUES ('$kdtrans2', '$kode_trans', '$date')"
            );
        }
        return redirect()->to('/hutang');
    }

    public function update()
    {
        $id = $this->request->getPost('kode_hutang');
        $tanggal = $this->request->getPost('tanggal');

        $db = \Config\Database::connect();
        $db->query(
            "UPDATE hutang set tanggal='$tanggal' WHERE kode_hutang='$id'"
        );
        return redirect()->to('/hutang');
    }

    public function delete()
    {
        $id = $this->request->getPost('kode_hutang');
        $this->hutangModel->deleteHutang($id);
        return redirect()->to('/hutang');
    }

    //--------------------------------------------------------------------
}
