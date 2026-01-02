<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // 1. Tentukan nama tabel yang ada di database Anda
    protected $table      = 'users'; 

    // 2. Tentukan Primary Key dari tabel tersebut
    protected $primaryKey = 'id';

    // 3. Tentukan kolom mana saja yang BOLEH diisi atau dimanipulasi
    // Sesuaikan dengan nama kolom di database Anda
   protected $allowedFields = ['role_id', 'username', 'password', 'nama', 'is_active'];

    // 4. (Opsional) Mengaktifkan otomatisasi waktu (created_at, updated_at)
    protected $useTimestamps = true;
}