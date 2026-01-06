<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['users_id', 'customer_id', 'tanggal_order', 'jumlah_total', 'status'];
}