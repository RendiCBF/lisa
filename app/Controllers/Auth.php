<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        helper(['form', 'url']);
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Username dan Password wajib diisi.');
        }

        $username = $this->request->getPost('username');
        $password = (string)$this->request->getPost('password');

        // Join ke tabel roles untuk mendapatkan nama role (admin/staff/manager)
        $user = $this->userModel->select('users.*, roles.nama_role as role_nama')
                                ->join('roles', 'roles.id = users.role_id')
                                ->where('username', $username)
                                ->first();

        if ($user) {
            if ((int)$user['is_active'] !== 1) {
                return redirect()->back()->withInput()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // Gunakan password_verify jika sudah menggunakan hash standard, 
            // Namun jika database masih MD5, gunakan baris bawah ini:
            if (md5($password) === $user['password']) {

                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role_id'   => $user['role_id'],
                    'logged_in' => true
                ]);

                $role_nama = '';
                if ($user['role_id'] == 1) {
                    $role_nama = 'admin';
                } elseif ($user['role_id'] == 2) {
                    $role_nama = 'manager';
                } else {
                    $role_nama = 'staff';
                }

                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role_id'   => $user['role_id'],
                    'role_nama' => strtolower($user['role_nama']), // SINKRON DENGAN SIDEBAR
                    'logged_in' => true
                ]);

                // LOG AKTIVITAS
                $db = \Config\Database::connect();
                $db->table('log_aktivitas')->insert([
                    'users_id'   => $user['id'],
                    'action'     => 'LOGIN',
                    'detail'     => 'User ' . $user['nama'] . ' berhasil login.',
                ]);

                return redirect()->to(base_url('dashboard'))->with('success', 'Selamat datang, ' . $user['nama']);
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Untuk logout total lebih aman menggunakan destroy
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
}

   public function logout0()
    {
    $session = session();
    
    // Jangan gunakan $session->destroy() karena akan menghapus flashdata pesan.
    // Gunakan remove() untuk menghapus data login saja.
    $session->remove(['user_id', 'username', 'nama', 'role_id', 'logged_in']);
    
    // Sekarang pesan 'success' akan tersimpan di flashdata dan bisa terbaca di login.php
    return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
} // Pastikan tanda kurung ini adalah yang terakhir di file Anda
