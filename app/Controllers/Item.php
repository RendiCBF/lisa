<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller { // Nama Class harus sama dengan Nama File

    public function index() {
        // Mengambil data dari tabel 'item' sesuai ERD di PDF
        $data['items'] = $this->db->get('item')->result_array();
        $this->load->view('item/index', $data);
    }
}
    public function add() {
        $data = [
            'nama_item'  => $this->input->post('nama_item'),
            'kategori'   => $this->input->post('kategori'),
            'stok'       => $this->input->post('stok'),
            'harga_beli' => $this->input->post('harga_beli'),
            'harga_jual' => $this->input->post('harga_jual')
        ];
        $this->db->insert('item', $data);
        redirect('item');
    }
}