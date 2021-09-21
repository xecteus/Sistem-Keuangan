<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    public function getBarang()
    {
        $builder = $this->db->table('barang');
        return $builder->get();
    }

    public function saveBarang($data)
    {
        $query = $this->db->table('barang')->insert($data);
        return $query;
    }

    public function updateBarang($data, $id)
    {
        $query = $this->db->table('barang')->update($data, array('id_barang' => $id));
        return $query;
    }

    public function deleteBarang($id)
    {
        $query = $this->db->table('barang')->delete(array('id_barang' => $id));
        return $query;
    }
}
