<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'item';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['supplier_id', 'nama', 'stok', 'harga'];

    public function getItemWithSupplier()
    {
        return $this->select('item.*, supplier.nama as nama_supplier')
                    ->join('supplier', 'supplier.id = item.supplier_id');
    }
}