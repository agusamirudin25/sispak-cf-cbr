<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Gejala
{
    protected $_db;
    protected $kode_gejala;
    protected $gejala;
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
        $data['gejala'] = $this->_db->other_query("SELECT * FROM tb_gejala", 2);
        view('layouts/_head');
        view('gejala/index', $data);
        view('layouts/_foot');
    }

    public function tambahGejala()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Mekanik';
        $kode_terakhir = $this->_db->get_last_param('tb_gejala', 'id_gejala');
        if ($kode_terakhir) {
            $nilai_kode = substr($kode_terakhir['id_gejala'], 1);
            $kode = (int) $nilai_kode;
            $kode = $kode + 1;
            $kode_otomatis = "G" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "G01";
        }
        $data['kode_otomatis'] = $kode_otomatis;
        view('layouts/_head');
        view('gejala/tambah_data', $data);
        view('layouts/_foot');
    }
    public function prosesTambahGejala()
    {
        $input = post();
        $kode_gejala = $input['kode_gejala'];
        $nama_gejala = $input['gejala'];

        // cek apakah nama gejala sudah ada
        $cek_nama_gejala = $this->_db->other_query("SELECT * FROM tb_gejala WHERE gejala = '{$nama_gejala}'", 1);
        if ($cek_nama_gejala) {
            $res['status'] = 0;
            $res['msg'] = "Data Gejala gagal ditambahkan. Nama Gejala sudah ada.";
            echo json_encode($res);
            die;
        }

        $statusVerifikasi = session_get('type') == 1 ? 0 : 1;
        $message = session_get('type') == 1 ? "Data Gejala berhasil ditambahkan. Mohon menunggu verifikasi dari pakar." : "Data Gejala berhasil ditambahkan.";
        $redirect = session_get('type') == 1 ? 'Gejala' : 'Gejala/verifikasiGejala';
        // query insert
        $insert = $this->_db->insert("INSERT INTO tb_gejala(id_gejala, gejala, `status`) values ('$kode_gejala', '$nama_gejala', $statusVerifikasi)");
        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = $message;
            $res['page'] = $redirect;
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Gejala gagal ditambahkan";
        }
        echo json_encode($res);
    }
    public function ubahGejala($kode)
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Mekanik';
        $data['gejala'] = $this->_db->get("SELECT * FROM tb_gejala WHERE id_gejala = '$kode'");
        view('layouts/_head');
        view('gejala/ubah_data', $data);
        view('layouts/_foot');
    }
    public function prosesUbahGejala()
    {
        $input = post();
        $kode_gejala = $input['kode_gejala'];
        $nama_gejala = $input['gejala'];

        // cek apakah nama gejala sudah ada
        $cek_nama_gejala = $this->_db->other_query("SELECT * FROM tb_gejala WHERE gejala = '{$nama_gejala}' AND id_gejala != '{$kode_gejala}'", 1);
        if ($cek_nama_gejala) {
            $res['status'] = 0;
            $res['msg'] = "Data Gejala gagal ditambahkan. Nama Gejala sudah ada.";
            echo json_encode($res);
            die;
        }
        // query update
        $update = $this->_db->edit("UPDATE tb_gejala SET gejala = '$nama_gejala' WHERE id_gejala = '$kode_gejala'");
        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data Gejala berhasil diubah";
            $res['page'] = "Gejala";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Gejala gagal diubah";
        }
        echo json_encode($res);
    }

    public function verifikasiGejala()
    {
        $data['gejala'] = $this->_db->other_query("SELECT * FROM tb_gejala", 2);
        view('layouts/_head');
        view('gejala/verif', $data);
        view('layouts/_foot');
    }

    public function prosesVerifGejala()
    {
        $input = post();
        $kode_gejala = $input['id'];
        $status = $input['status'];

        // query update
        $update = $this->_db->edit("UPDATE tb_gejala SET `status` = '$status' WHERE id_gejala = '$kode_gejala'");
        if ($update) {
            $res['status'] = 1;
            $res['msg'] = $status == 1 ? "Data Gejala berhasil diverifikasi" : "Data Gejala berhasil ditolak";
            $res['page'] = "Gejala/verifikasiGejala";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Gejala gagal diverifikasi";
        }
        echo json_encode($res);
    }

    public function hapusGejala()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_gejala', 'id_gejala', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "Gejala";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
        
    }
}