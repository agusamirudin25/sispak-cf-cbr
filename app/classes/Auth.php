<?php

namespace App\Classes;

header('Access-Control-Allow-Origin:*');

class Auth
{
    private $auth;

    public function __construct()
    {
        $this->auth = new Database();
    }

    public function index()
    {
        if (isset($_SESSION['id_pengguna'])) {
            redirect('Dashboard');
        }
        $title = 'Sistem Pakar Diagnosis Kerusakan Kendaraan';

        return view('login', compact('title'));
    }

    public function cek_login()
    {
        $input = post($_POST);
        $email = $input['email'];
        $password = $input['password'];
        $user = $this->auth->get("SELECT * from tb_pengguna WHERE email = '$email'");
        if ($user) {
            if ($user->status != '1') {
                $data['msg'] = 'Email atau password tidak ditemukan !';
                $data['title'] = 'Login Failed ';
                $data['login_status'] = 0;
            } else {
                if (password_verify($password, $user->password)) :
                    $emailPengguna = $user->email;
                    $nama = $user->nama_lengkap;
                    $type = $user->tipe;
                    
                    $data['title'] = 'Login Success';
                    $data['msg'] = 'Data ditemukan';
                    $data['login_status'] = 1;
                    $data['page'] = 'Dashboard/index';
                    session_set('emailPengguna', $emailPengguna);
                    session_set('nama', $nama);
                    session_set('type', $type);
                else :
                    $data['msg'] = 'Email atau password tidak ditemukan !';
                    $data['title'] = 'Login Failed ';
                    $data['login_status'] = 0;
                endif;
            }
        } else {
            $data['msg'] = 'Email atau password tidak ditemukan !';
            $data['title'] = 'Login Failed ';
            $data['login_status'] = 0;
        }

        echo json_encode($data);
    }
    public function logout()
    {
        session_del('emailPengguna');
        session_del('nama');
        session_del('type');
        session_destroy();
        redirect('Auth');
    }
}
