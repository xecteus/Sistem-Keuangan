<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasukanModel extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';

    public function getPemasukan()
    {
        $builder = $this->db->table('pemasukan');
        return $builder->get();
    }

    public function savePemasukan($data)
    {
        $query = $this->db->table('pemasukan')->insert($data);
        return $query;
    }

    public function updatePemasukan($data, $id)
    {
        $query = $this->db->table('pemasukan')->update($data, array('id_pemasukan' => $id));
        return $query;
    }

    public function deletePemasukan($id)
    {
        $query = $this->db->table('pemasukan')->delete(array('id_pemasukan' => $id));
        return $query;
    }
}
