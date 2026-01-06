<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderItemModel extends Model {
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    protected $allowedFields = ['orders_id', 'item_id', 'kuantitas', 'harga_unit', 'subtotal'];
}