<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Pengguna
{
    protected $_db;
    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['id_pengguna'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Kepala Pelaksana';
        $data['pengguna'] = $this->_db->other_query("SELECT nama_pengguna, nama_lengkap, email, tipe FROM m_pengguna", 2);
        view('layouts/_head');
        view('pengguna/index', $data);
        view('layouts/_foot');
    }

    public function tambahPengguna()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Kepala Pelaksana';
        view('layouts/_head');
        view('pengguna/tambah_pengguna', $data);
        view('layouts/_foot');
    }
    public function prosesTambahPengguna()
    {
        $input = post();
        $nama_pengguna = $input['nama_pengguna'];
        $nama_lengkap = $input['nama_lengkap'];
        $email = $input['email'];
        $tipe = $input['tipe'];
        $katasandi = password_hash($input['katasandi'], PASSWORD_DEFAULT);
        $validasi_nama_pengguna = $this->_db->get("SELECT nama_pengguna FROM m_pengguna WHERE nama_pengguna = '$nama_pengguna'");

        if ($validasi_nama_pengguna == NULL) {
            $insert = $this->_db->insert("INSERT INTO m_pengguna(nama_pengguna, nama_lengkap, katasandi, email, tipe, `status`) values ('$nama_pengguna', '$nama_lengkap', '$katasandi', '$email', '$tipe', 1)");
            if ($insert) {
                $res['status'] = 1;
                $res['msg'] = "Data berhasil ditambahkan";
                $res['page'] = "Pengguna";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data gagal ditambahkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal ditambahkan. Nama pengguna sudah digunakan";
        }

        echo json_encode($res);
    }
    public function ubahPengguna($id)
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Kepala Pelaksana';
        $data['pengguna'] = $this->_db->other_query("SELECT * FROM m_pengguna WHERE nama_pengguna = '$id'");
        view('layouts/_head');
        view('pengguna/ubah_pengguna', $data);
        view('layouts/_foot');
    }
    public function prosesUbahPengguna()
    {
        $input = post();
        $nama_pengguna = $input['nama_pengguna'];
        $nama_lengkap = $input['nama_lengkap'];
        $email = $input['email'];
        $tipe = $input['tipe'];
        $katasandi = $input['katasandi'];
        $katasandi_hash = password_hash($input['katasandi'], PASSWORD_DEFAULT);
        if ($katasandi == NULL || $katasandi == '') {
            $update = $this->_db->edit("UPDATE m_pengguna SET nama_lengkap = '$nama_lengkap', email = '$email', tipe = '$tipe' WHERE nama_pengguna = '$nama_pengguna'");
        } else {
            $update = $this->_db->edit("UPDATE m_pengguna SET nama_lengkap = '$nama_lengkap', email = '$email', tipe = '$tipe', katasandi = '$katasandi_hash' WHERE nama_pengguna = '$nama_pengguna'");
        }
        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dimutakhirkan";
            $res['page'] = "Pengguna";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dimutakhirkan";
        }
        echo json_encode($res);
    }
    public function hapusPengguna()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('m_pengguna', 'nama_pengguna', "'" . $id . "'");
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
