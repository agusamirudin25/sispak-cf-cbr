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

    public function login()
    {
        if (isset($_SESSION['id_pengguna'])) {
            redirect('Dashboard');
        }
        $title = 'Integrasi k-means clustering dan SIG Daerah rawan bencana alam';

        return view('login', compact('title'));
    }

    public function cek_login()
    {
        $input = post($_POST);
        $username = $input['nama_pengguna'];
        $password = $input['katasandi'];
        $user = $this->auth->get("SELECT * from m_pengguna WHERE nama_pengguna = '$username'");
        if ($user) {
            if ($user->status != '1') {
                $data['msg'] = 'Nama Pengguna atau katasandi tidak ditemukan !';
                $data['title'] = 'Login Failed ';
                $data['login_status'] = 0;
            } else {
                if (password_verify($password, $user->katasandi)) :
                    $id_pengguna = $user->nama_pengguna;
                    $nama = $user->nama_lengkap;
                    $type = $user->tipe;

                    $data['title'] = 'Login Success';
                    $data['msg'] = 'Data ditemukan';
                    $data['login_status'] = 1;
                    $data['page'] = 'Dashboard/index';
                    session_set('id_pengguna', $id_pengguna);
                    session_set('nama', $nama);
                    session_set('type', $type);
                else :
                    $data['msg'] = 'Nama Pengguna atau katasandi tidak ditemukan !';
                    $data['title'] = 'Login Failed ';
                    $data['login_status'] = 0;
                endif;
            }
        } else {
            $data['msg'] = 'Nama Pengguna atau katasandi tidak ditemukan !';
            $data['title'] = 'Login Failed ';
            $data['login_status'] = 0;
        }

        echo json_encode($data);
    }
    public function logout()
    {
        session_del('id_pengguna');
        session_del('nama');
        session_del('type');
        session_destroy();
        redirect('Auth');
    }
}
