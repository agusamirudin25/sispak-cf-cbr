<?php

namespace App\Classes;
header('Access-Control-Allow-Origin:*');


class Dashboard
{
    protected $_db;
    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['emailPengguna'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Pakar';
        view('layouts/_head');
        view('dashboard', $data);
        view('layouts/_foot');
    }

}
