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
        $data['total_kerusakan'] = $this->_db->other_query('SELECT COUNT(*) as total FROM tb_kerusakan')->total;
        $data['total_konsultasi'] = $this->_db->other_query('SELECT COUNT(*) as total FROM tb_konsultasi')->total;
        $data['total_gejala'] = $this->_db->other_query('SELECT COUNT(*) as total FROM tb_gejala')->total;
        view('layouts/_head');
        view('dashboard', $data);
        view('layouts/_foot');
    }

    public function bantuan()
    {
        view('layouts/_head');
        view('bantuan');
        view('layouts/_foot');
    }

    public function tentang()
    {
        view('layouts/_head');
        view('tentang');
        view('layouts/_foot');
    }

    public function getNotif()
    {
        $role = session_get('type');
        $username = session_get('emailPengguna');
        if($role == 2){
            $data = $this->_db->other_query('SELECT count(id_konsultasi) as total FROM tb_konsultasi', 1);
        }else{
            $data = $this->_db->other_query("SELECT count(id_konsultasi) as total FROM tb_konsultasi WHERE username = '{$username}'", 1);
        }
        echo json_encode($data);
    }

}
