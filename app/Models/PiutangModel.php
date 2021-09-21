<?php

namespace App\Models;

use CodeIgniter\Model;

class PiutangModel extends Model
{
    protected $table = 'piutang';
    protected $primaryKey = 'kode_piutang';

    public function getPiutang()
    {
        $builder = $this->db->table('piutang');
        return $builder->get();
    }
    public function savePiutang($data)
    {
        $query = $this->db->table('piutang')->insert($data);
        return $query;
    }

    public function deletePiutang($id)
    {
        $query = $this->db->table('piutang')->delete(array('kode_piutang' => $id));
        return $query;
    }
}
