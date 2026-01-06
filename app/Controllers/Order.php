<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ItemModel;

class Order extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $itemModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->itemModel = new ItemModel();
    }

    // Fungsi ini yang tadi hilang/tidak terbaca
    public function create()
    {
    $customerModel = new \App\Models\CustomerModel();
    
    $data = [
        'items'     => $this->itemModel->findAll(),
        // Mengambil semua data dari tabel customer Anda
        'customers' => $customerModel->findAll() 
    ];
    
    return view('orders/create', $data);
}

    public function store()
    {
        $items_post = $this->request->getPost('items');
        $total_bayar = 0;

        foreach ($items_post as $item) {
            $total_bayar += $item['subtotal'];
        }

        $this->orderModel->insert([
            'users_id'      => 1, 
            'customer_id'   => $this->request->getPost('customer_id'),
            'tanggal_order' => date('Y-m-d H:i:s'),
            'jumlah_total'  => $total_bayar,
            'status'        => 'PAID'
        ]);

        $order_id = $this->orderModel->insertID();

        foreach ($items_post as $item) {
            $this->orderItemModel->insert([
                'orders_id'  => $order_id,
                'item_id'    => $item['item_id'],
                'kuantitas'  => $item['qty'],
                'harga_unit' => $item['harga'],
                'subtotal'   => $item['subtotal']
            ]);

            // Update Stok
            $barang = $this->itemModel->find($item['item_id']);
            $this->itemModel->update($item['item_id'], [
                'stok' => $barang['stok'] - $item['qty']
            ]);
        }

        return redirect()->to(base_url('order/preview/' . $order_id));
    }

    public function preview($id)
    {
        $data['order'] = $this->orderModel->find($id);
        $data['details'] = $this->orderItemModel
            ->select('order_item.*, item.nama as nama_barang')
            ->join('item', 'item.id = order_item.item_id')
            ->where('orders_id', $id)
            ->findAll();

        return view('orders/preview', $data);
    }
}