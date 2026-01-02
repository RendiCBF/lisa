<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // 2. Cek Role (Arguments dikirim dari Routes)
        $userRole = session()->get('role');
        if ($arguments && !in_array($userRole, $arguments)) {
            // Jika role tidak ada di list yang diizinkan, lempar ke 403
            return redirect()->to('/error403');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}