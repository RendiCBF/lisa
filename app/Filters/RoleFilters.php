<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

// Nama class HARUS SAMA dengan nama file: RoleFilters
class RoleFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Ambil role dari session (pastikan di Auth.php session role_nama sudah diset)
        $userRole = session()->get('role_nama');

        // Proteksi: Jika route butuh role tertentu dan user tidak memilikinya
        if ($arguments && !in_array($userRole, $arguments)) {
            return redirect()->to(base_url('error403'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Biarkan kosong
    }
}