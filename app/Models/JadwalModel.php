<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'kode_jadwal';

    public function getBarang()
    {
        $builder = $this->db->table('barang');
        return $builder->get();
    }

    public function getSupplier()
    {
        $builder = $this->db->table('supplier');
        return $builder->get();
    }

    public function getJadwal()
    {
        $builder = $this->db->table('jadwal');
        return $builder->get();
    }

    public function saveJadwal($data)
    {
        $query = $this->db->table('jadwal')->insert($data);
        return $query;
    }
}
