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
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('username', $username)->first();

        if ($user) {
            if ((int)$user['is_active'] !== 1) {
                return redirect()->back()->withInput()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // PERUBAHAN DI SINI: Menggunakan password_verify alih-alih md5()
            if (password_verify($password, $user['password'])) {
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
                    'role_nama' => $role_nama, // Simpan teks 'admin', 'manager', atau 'staff'
                    'logged_in' => true
                ]);

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
        $session = session();
        $session->remove(['user_id', 'username', 'nama', 'role_id', 'logged_in']);
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
}