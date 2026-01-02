<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
<<<<<<< HEAD
        helper(['form', 'url']);
    }

    public function login()
    {
        return view('auth/login');
=======
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
>>>>>>> 269a8752cd7e6661a6b08be710f532b8cd982e2f
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

<<<<<<< HEAD
            // PERUBAHAN DI SINI: Menggunakan password_verify alih-alih md5()
            if (password_verify($password, $user['password'])) {
=======
            if (md5($password) === $user['password']) {
>>>>>>> 269a8752cd7e6661a6b08be710f532b8cd982e2f
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role_id'   => $user['role_id'],
                    'logged_in' => true
                ]);
<<<<<<< HEAD
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

=======

                // SIMPAN LOG AKTIVITAS KE DATABASE
>>>>>>> 269a8752cd7e6661a6b08be710f532b8cd982e2f
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

<<<<<<< HEAD
    public function logout()
    {
        $session = session();
        $session->remove(['user_id', 'username', 'nama', 'role_id', 'logged_in']);
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar.');
    }
}
=======
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
>>>>>>> 269a8752cd7e6661a6b08be710f532b8cd982e2f
