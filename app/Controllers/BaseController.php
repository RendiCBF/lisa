<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;

    // 1. TAMBAHKAN HELPER DI SINI AGAR TERSEDIA DI SEMUA CONTROLLER
    protected $helpers = ['form', 'url', 'session']; 

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // 2. AKTIFKAN SESSION SERVICE DI SINI
        $this->session = \Config\Services::session();
    }
}