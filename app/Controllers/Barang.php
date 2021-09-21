<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $barang = $db->query(
            "SELECT * FROM barang WHERE `status`='HABIS'"
        )->getResultArray();

        $data = [
            'titlehead' => 'Data Barang Habis',
            'breadcrumb' => 'Barang',
            'barang' => $barang
        ];
        return view('/barang/index', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(id_barang,8)) as maxKode FROM barang"
        );
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "BRG";
        $kdtrans = $char . sprintf("%06s", $noOrder);

        $data = [
            'titlehead' => 'Form Tambah Barang',
            'breadcrumb' => 'Barang',
            'breadcrumb2' => 'Tambah Barang',
            'kodeBarang' => $kdtrans,
            'tanggal' => $date,
            'validation' => $validation,
        ];
        return view('barang/create', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'namaBarang' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/barang/create')->withInput();
        }

        $data = [
            'id_barang' => $this->request->getPost('idBarang'),
            'nama' => $this->request->getPost('namaBarang'),
            'status' => 'HABIS',
            'tanggal' => $this->request->getPost('tanggal')
        ];
        $this->barangModel->saveBarang($data);
        return redirect()->to('/barang/index');
    }

    public function update()
    {
        $db = \Config\Database::connect();

        $id_barang = $this->request->getPost('id_barang');
        $nama = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');

        $db->query(
            "UPDATE barang SET `nama`='$nama', `tanggal`='$tanggal' WHERE id_barang='$id_barang'"
        );
        return redirect()->to('/barang');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_barang');
        $this->barangModel->deleteBarang($id);
        return redirect()->to('/barang');
    }
    //--------------------------------------------------------------------
}
