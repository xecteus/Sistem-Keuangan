<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'kode_trans';

    public function getPenjualan()
    {
        $builder = $this->db->table('penjualan');
        return $builder->get();
    }

    public function savePenjualan($data)
    {
        $query = $this->db->table('penjualan')->insert($data);
        return $query;
    }

    public function updatePenjualan($data, $id)
    {
        $query = $this->db->table('penjualan')->update($data, array('kode_trans' => $id));
        return $query;
    }

    public function deletePenjualan($id)
    {
        $query = $this->db->table('penjualan')->delete(array('kode_trans' => $id));
        return $query;
    }
}
