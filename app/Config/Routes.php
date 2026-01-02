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
