<?php

namespace App\Models; // Wajib ada

use CodeIgniter\Model;

class SupplierModel extends Model // Nama class harus sama dengan nama file
{
   protected $table = 'supplier';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'kontak', 'no_telepon'];
}