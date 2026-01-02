<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama (jika akses localhost/lisa/public/ langsung ke login)
$routes->get('/', 'Auth::login');

// Rute Autentikasi
$routes->get('login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');

// Rute Dashboard
$routes->get('dashboard', 'Dashboard::index');

$routes->get('/dashboard', 'Admin::index', ['filter' => 'role:Admin,Staff,Manager']);

// Hanya Admin & Manager yang bisa lihat laporan
$routes->get('/laporan', 'Laporan::index', ['filter' => 'role:Admin,Manager']);

// Hanya Admin yang bisa kelola User
$routes->get('/users', 'User::index', ['filter' => 'role:Admin']);

// Route untuk Error 403
$routes->get('/error403', function() {
    return view('errors/html/error_403');
});

$routes->get('user', 'User::index', ['filter' => 'role:admin']);

// 2. Buat route untuk halaman error 403
$routes->get('error403', function() {
    return view('errors/error_403');
});