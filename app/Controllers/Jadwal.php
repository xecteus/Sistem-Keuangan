<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use mysqli;

class Jadwal extends BaseController
{

    public function index()
    {
        $db = \Config\Database::connect();
        //Query menampilkan data jadwal
        $query = $db->query(
            "SELECT jadwal.kode_jadwal AS kode_jadwal, barang.id_barang AS id_barang, supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS nama_barang, jadwal.tanggal AS tanggal from jadwal 
            JOIN supplier 
                ON jadwal.id_supplier = supplier.id_supplier 
            JOIN barang 
                ON jadwal.id_barang = barang.id_barang
                WHERE jadwal.status='DALAM PROSES'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Jadwal Supplier',
            'breadcrumb' => 'Jadwal Supplier',
            'jadwal' => $query
        ];
        return view('/jadwal/index', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //Query generate kode unik
        $query = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(kode_jadwal) as maxKode FROM jadwal"
        );
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(kode_jadwal,14)) as maxKode FROM jadwal"
        );
        $data = mysqli_fetch_array($query);
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "BK";
        $tahun = substr($date, 0, 3);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . $tgl . $bulan . $tahun . sprintf("%06s", $noOrder);
        //--------------------------------------------------------------------------//

        //Select Option Supplier
        $query_option_supp = $db->query(
            "SELECT * FROM supplier"
        )->getResultArray();

        //Select Option Barang
        $query_option_brg = $db->query(
            "SELECT * FROM barang where status='HABIS'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Form Penjadwalan Supplier',
            'breadcrumb' => 'Jadwal Supplier',
            'breadcrumb2' => 'Tambah Jadwal',
            'kodeJadwal' => $kdtrans,
            'brg' => $query_option_brg,
            'sup' => $query_option_supp,
            'validation' => $validation,
        ];
        return view('jadwal/create', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'namaBrg' => 'required',
            'namaSupp' => 'required',
            'tanggal' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/jadwal/create')->withInput();
        }

        $db = \Config\Database::connect();
        $kode_jadwal = $this->request->getPost('kodeJadwal');
        $id_barang = $this->request->getPost('id_barang');
        $id_supplier = $this->request->getPost('id_supplier');
        $tanggal = $this->request->getPost('tanggal');

        $db->query(
            "INSERT INTO jadwal VALUES ('$kode_jadwal', '$id_barang', '$id_supplier', '$tanggal' , 'DALAM PROSES')"
        );
        $db->query(
            "UPDATE barang SET `status`='DIPESAN' WHERE id_barang='$id_barang' "
        );
        return redirect()->to('/jadwal/index');
    }

    public function update()
    {

        $db = \Config\Database::connect();
        $kode_jadwal = $this->request->getPost('kodejadwal');
        $tanggal = $this->request->getPost('tanggal');

        $db->query(
            "UPDATE jadwal SET `tanggal`='$tanggal' WHERE kode_jadwal='$kode_jadwal'"
        );
        return redirect()->to('/jadwal/index');
    }

    public function delete()
    {
        $db = \Config\Database::connect();
        $kode_jadwal = $this->request->getPost('kodejadwal');
        $id_barang = $this->request->getPost('idbarang');

        $db->query(
            "UPDATE barang SET `status`='HABIS' WHERE id_barang='$id_barang'"
        );
        $db->query(
            "DELETE FROM jadwal WHERE kode_jadwal='$kode_jadwal'"
        );
        return redirect()->to('/jadwal/index');
    }

    public function delivered()
    {
        $db = \Config\Database::connect();
        $kode_jadwal = $this->request->getPost('kodejadwal');
        $id_barang = $this->request->getPost('idbarang');

        $db->query(
            "UPDATE jadwal SET `status`='SELESAI' WHERE kode_jadwal='$kode_jadwal'"
        );

        $db->query(
            "UPDATE barang SET `status`='TERSEDIA' WHERE id_barang='$id_barang'"
        );

        return redirect()->to('/pembelian/create');
    }

    public function jadwalselesai()
    {
        $db = \Config\Database::connect();
        //Query menampilkan data jadwal
        $query = $db->query(
            "SELECT jadwal.kode_jadwal AS kode_jadwal, barang.id_barang AS id_barang, supplier.nama AS namaSupp, supplier.nohp AS noHP, barang.nama AS nama_barang, jadwal.tanggal AS tanggal from jadwal 
            JOIN supplier 
                ON jadwal.id_supplier = supplier.id_supplier 
            JOIN barang 
                ON jadwal.id_barang = barang.id_barang
                WHERE jadwal.status='SELESAI'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Jadwal Supplier',
            'breadcrumb' => 'Jadwal Supplier',
            'breadcrumb2' => 'Jadwal Selesai',
            'jadwal' => $query
        ];
        return view('/jadwal/jadwalselesai', $data);
    }
    //--------------------------------------------------------------------
}
