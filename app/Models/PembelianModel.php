<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'kode_trans';

    public function getPembelian()
    {
        $builder = $this->db->table('pembelian');
        return $builder->get();
    }

    public function savePembelian($data)
    {
        $query = $this->db->table('pembelian')->insert($data);
        return $query;
    }

    public function updatePembelian($data, $id)
    {
        $query = $this->db->table('pembelian')->update($data, array('kode_trans' => $id));
        return $query;
    }

    public function deletePembelian($id)
    {
        $query = $this->db->table('pembelian')->delete(array('kode_trans' => $id));
        return $query;
    }
}
