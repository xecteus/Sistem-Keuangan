<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    public function getSupplier()
    {
        $builder = $this->db->table('supplier');
        return $builder->get();
    }

    public function saveSupplier($data)
    {
        $query = $this->db->table('supplier')->insert($data);
        return $query;
    }

    public function updateSupplier($data, $id)
    {
        $query = $this->db->table('supplier')->update($data, array('id_supplier' => $id));
        return $query;
    }

    public function deleteSupplier($id)
    {
        $query = $this->db->table('supplier')->delete(array('id_supplier' => $id));
        return $query;
    }
}
