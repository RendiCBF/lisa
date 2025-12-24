<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        // Memastikan helper form dan url selalu siap
        helper(['form', 'url']);
    }

   public function login()
    {
    // Hapus atau beri komentar (//) pada baris redirect jika ingin login selalu tampil
    // if (session()->get('logged_in')) {
    //     return redirect()->to(base_url('dashboard'));
    // }
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

            if (md5($password) === $user['password']) {
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role_id'   => $user['role_id'],
                    'logged_in' => true
                ]);

                // SIMPAN LOG AKTIVITAS KE DATABASE
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
    
    // Jangan gunakan $session->destroy() karena akan menghapus flashdata pesan.
    // Gunakan remove() untuk menghapus data login saja.
    $session->remove(['user_id', 'username', 'nama', 'role_id', 'logged_in']);
    
    // Sekarang pesan 'success' akan tersimpan di flashdata dan bisa terbaca di login.php
    return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
} // Pastikan tanda kurung ini adalah yang terakhir di file Anda