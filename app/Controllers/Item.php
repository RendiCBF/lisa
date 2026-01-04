<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\SupplierModel;

class Item extends BaseController
{
    protected $itemModel;
    protected $supplierModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $itemData = $this->itemModel->getItemWithSupplier();

        if ($keyword) {
            $itemData->like('item.nama', $keyword);
        }

        $data = [
            'items'   => $itemData->paginate(10, 'item'),
            'pager'   => $this->itemModel->pager,
            'keyword' => $keyword
        ];

        return view('items/index', $data);
    }

    public function create()
    {
        $data = [
            'suppliers' => $this->supplierModel->findAll()
        ];
        return view('items/create', $data);
    }

    public function store()
    {
        $this->itemModel->save([
            'supplier_id' => $this->request->getPost('supplier_id'),
            'nama'        => $this->request->getPost('nama'),
            'stok'        => $this->request->getPost('stok'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to(base_url('item'))->with('success', 'Data Item berhasil disimpan.');
    }

    // --- TAMBAHKAN KODE DI BAWAH INI ---

    public function edit($id)
    {
        $data = [
            'item'      => $this->itemModel->find($id),
            'suppliers' => $this->supplierModel->findAll()
        ];

        if (!$data['item']) {
            return redirect()->to(base_url('item'))->with('error', 'Data tidak ditemukan.');
        }

        return view('items/edit', $data);
    }

    public function update($id)
    {
        $this->itemModel->update($id, [
            'supplier_id' => $this->request->getPost('supplier_id'),
            'nama'        => $this->request->getPost('nama'),
            'stok'        => $this->request->getPost('stok'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to(base_url('item'))->with('success', 'Data Item berhasil diubah.');
    }

    public function delete($id)
    {
        $this->itemModel->delete($id);
        return redirect()->to(base_url('item'))->with('success', 'Data Item berhasil dihapus.');
    }
}