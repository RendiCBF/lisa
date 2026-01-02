<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function login(): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function attemptLogin(): RedirectResponse
    {
        $username = $this->request->getPost('username');
        $password = (string)$this->request->getPost('password');

        // JOIN disesuaikan: tabel 'role', kolom 'nama_peran'
        $user = $this->userModel->select('users.*, role.nama_peran as role_nama')
                                ->join('role', 'role.id = users.role_id')
                                ->where('username', $username)
                                ->first();

        if ($user) {
            if ((int)$user['is_active'] !== 1) {
                return redirect()->back()->withInput()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // MENGGUNAKAN password_verify karena database kamu pakai BCRYPT
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role_id'   => $user['role_id'],
                    'role_nama' => strtolower($user['role_nama']), 
                    'logged_in' => true
                ]);

                // Simpan Log Aktivitas
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

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
}