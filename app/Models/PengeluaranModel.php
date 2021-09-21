<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';

    public function getPengeluaran()
    {
        $builder = $this->db->table('pengeluaran');
        return $builder->get();
    }

    public function savePengeluaran($data)
    {
        $query = $this->db->table('pengeluaran')->insert($data);
        return $query;
    }

    public function updatePengeluaran($data, $id)
    {
        $query = $this->db->table('pengeluaran')->update($data, array('id_pengeluaran' => $id));
        return $query;
    }

    public function deletePengeluaran($id)
    {
        $query = $this->db->table('pengeluaran')->delete(array('id_pengeluaran' => $id));
        return $query;
    }
}
