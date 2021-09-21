<?php

namespace App\Models;

use CodeIgniter\Model;

class HutangModel extends Model
{
    protected $table = 'hutang';
    protected $primaryKey = 'kode_hutang';

    public function getHutang()
    {
        $builder = $this->db->table('hutang');
        return $builder->get();
    }
    public function saveHutang($data)
    {
        $query = $this->db->table('hutang')->insert($data);
        return $query;
    }

    public function deleteHutang($id)
    {
        $query = $this->db->table('hutang')->delete(array('kode_hutang' => $id));
        return $query;
    }
}
