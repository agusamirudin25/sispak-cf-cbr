<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Pengguna
{
    protected $_db;
    protected $username;
    protected $nama_lengkap;
    protected $password;
    protected $tipe;
    protected $status;

    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['emailPengguna'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['role'] = $this->_db->other_query('SELECT id_role, `role` FROM tb_role', 2);
        $data['pengguna'] = $this->_db->other_query("SELECT nama_lengkap, username, tipe, `role` FROM tb_pengguna JOIN tb_role ON tb_pengguna.tipe = tb_role.id_role", 2);
        view('layouts/_head');
        view('pengguna/index', $data);
        view('layouts/_foot');
    }

    public function tambahPengguna()
    {
        $data['role'] = $this->_db->other_query('SELECT id_role, `role` FROM tb_role', 2);
        view('layouts/_head');
        view('pengguna/tambah_pengguna', $data);
        view('layouts/_foot');
    }
    public function prosesTambahPengguna()
    {
        $input = post();
        $nama_lengkap = $input['nama_lengkap'];
        $username = $input['email'];
        $tipe = $input['tipe'];
        $password = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_username = $this->_db->get("SELECT username FROM tb_pengguna WHERE username = '$username'");

        if ($validasi_username == NULL) {
            $insert = $this->_db->insert("INSERT INTO tb_pengguna(username, nama_lengkap, `password`, tipe, `status`) values ('$username', '$nama_lengkap', '$password', '$tipe', 1)");
            if ($insert) {
                $res['status'] = 1;
                $res['msg'] = "Data Pengguna berhasil ditambahkan";
                $res['page'] = "Pengguna/index";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data Pengguna gagal ditambahkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal ditambahkan. Username sudah digunakan";
        }

        echo json_encode($res);
    }
    public function ubahPengguna($username)
    {
        $data['role'] = $this->_db->other_query('SELECT id_role, `role` FROM tb_role', 2);
        $data['pengguna'] = $this->_db->other_query("SELECT tb_pengguna.*, tb_role.role FROM tb_pengguna JOIN tb_role ON tb_pengguna.tipe = tb_role.id_role WHERE username = '$username'");
        view('layouts/_head');
        view('pengguna/ubah_pengguna', $data);
        view('layouts/_foot');
    }
    public function prosesUbahPengguna()
    {
        $input = post();
        $nama_lengkap = $input['nama_lengkap'];
        $username = $input['email'];
        $tipe = $input['tipe'];
        $password = $input['password'];
        $password_hash = password_hash($input['password'], PASSWORD_DEFAULT);
        $validasi_username = $this->_db->get("SELECT username FROM tb_pengguna WHERE username = '$username' AND username != '$username'");
        if($validasi_username == NULL){
            if ($password == NULL || $password == '') {
                $update = $this->_db->edit("UPDATE tb_pengguna SET nama_lengkap = '$nama_lengkap', tipe = '$tipe' WHERE username = '$username'");
            } else {
                $update = $this->_db->edit("UPDATE tb_pengguna SET nama_lengkap = '$nama_lengkap', tipe = '$tipe', `password` = '$password_hash' WHERE username = '$username'");
            }
            if ($update) {
                $res['status'] = 1;
                $res['msg'] = "Data berhasil dimutakhirkan";
                $res['page'] = "Pengguna/index";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data gagal dimutakhirkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengguna gagal diubah. Username sudah digunakan";
        }
        echo json_encode($res);
    }
    public function hapusPengguna()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_pengguna', 'username', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "Pengguna";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);

    }
}