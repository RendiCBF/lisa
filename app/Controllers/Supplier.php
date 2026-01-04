<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use CodeIgniter\Controller;

class Supplier extends Controller
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $this->supplierModel->like('nama', $keyword);
        }

        $data = [
            // Menggunakan variabel 'suppliers' (jamak) agar cocok dengan loop di index.php
            'suppliers' => $this->supplierModel->paginate(10, 'supplier'), 
            'pager'     => $this->supplierModel->pager,
            'keyword'   => $keyword
        ];

        return view('suppliers/index', $data);
    }

    public function create()
    {
        // Pastikan nama folder view adalah 'suppliers' (pakai 's') sesuai index()
        return view('suppliers/create'); 
    }

    public function store()
    {
        $rules = [
            'nama'       => 'required|min_length[3]|is_unique[supplier.nama]', 
            'kontak'     => 'required',
            'no_telepon' => 'required|numeric|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->supplierModel->save([
            'nama'       => $this->request->getPost('nama'),
            'kontak'     => $this->request->getPost('kontak'),
            'no_telepon' => $this->request->getPost('no_telepon'),
        ]);

        // PERBAIKAN: Arahkan ke '/supplier' bukan '/suppliers' agar tidak 404 setelah simpan
        return redirect()->to('/supplier')->with('success', 'Data Supplier berhasil ditambahkan.');
    }

    public function edit($id)
{
    $data = [
        'supplier' => $this->supplierModel->find($id)
    ];

    if (!$data['supplier']) {
        return redirect()->to('/supplier')->with('error', 'Data tidak ditemukan.');
    }

    return view('suppliers/edit', $data);
}

public function update($id)
{
    $rules = [
        'nama'       => "required|min_length[3]|is_unique[supplier.nama,id,$id]", 
        'kontak'     => 'required',
        'no_telepon' => 'required|numeric|min_length[10]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $this->supplierModel->update($id, [
        'nama'       => $this->request->getPost('nama'),
        'kontak'     => $this->request->getPost('kontak'),
        'no_telepon' => $this->request->getPost('no_telepon'),
    ]);

    return redirect()->to('/supplier')->with('success', 'Data Supplier berhasil diperbarui.');
}

public function delete($id)
{
    $this->supplierModel->delete($id);
    return redirect()->to('/supplier')->with('success', 'Data Supplier berhasil dihapus.');
}
}