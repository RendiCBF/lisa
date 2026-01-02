<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    // TAMBAHKAN INI: Agar browser tidak menyimpan cache halaman ini
    $this->response->setHeader('Cache-Control', 'no-store, max-age=0, no-cache');
    $this->response->setHeader('Pragma', 'no-cache');

    return view('pages/dashboard');
}
}