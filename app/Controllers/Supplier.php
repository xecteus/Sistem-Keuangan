<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $supplier = $this->supplierModel->findAll();
        $data = [
            'titlehead' => 'Data Supplier',
            'breadcrumb' => 'Supplier',
            'supplier' => $supplier
        ];
        return view('/supplier/index', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $query2 = mysqli_query(
            mysqli_connect("localhost", "root", "", "majujaya2"),
            "SELECT max(SUBSTRING(id_supplier,9)) as maxKode FROM supplier"
        );
        $data2 = mysqli_fetch_array($query2);
        $noOrder = $data2['maxKode'];
        $noOrder++;

        $char = "SUPP";
        $kdtrans = $char . sprintf("%06s", $noOrder);

        $data = [
            'titlehead' => 'Form Tambah Supplier',
            'breadcrumb' => 'Supplier',
            'breadcrumb2' => 'Tambah Supplier',
            'kodeSupplier' => $kdtrans,
            'validation' => $validation,
        ];
        return view('/supplier/create', $data);
    }

    public function save()
    {
        //Validasi Input
        if (!$this->validate([
            'namaSupplier' => 'required',
            'noHp' => 'required|numeric',
            'alamat' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/supplier/create')->withInput();
        }

        $data = [
            'id_supplier' => $this->request->getPost('idSupplier'),
            'nama' => $this->request->getPost('namaSupplier'),
            'nohp' => $this->request->getPost('noHp'),
            'alamat' => $this->request->getPost('alamat')
        ];
        $this->supplierModel->saveSupplier($data);
        return redirect()->to('/supplier/index');
    }

    public function update()
    {
        $id = $this->request->getPost('idSupplier');
        $data = [
            'id_supplier' => $this->request->getPost('idSupplier'),
            'nama' => $this->request->getPost('namaSupplier'),
            'nohp' => $this->request->getPost('noHP'),
            'alamat' => $this->request->getPost('alamat')
        ];
        $this->supplierModel->updateSupplier($data, $id);
        return redirect()->to('/supplier');
    }

    public function delete()
    {
        $id = $this->request->getPost('idSupplier');
        $this->supplierModel->deleteSupplier($id);
        return redirect()->to('/supplier');
    }
    //--------------------------------------------------------------------
}
