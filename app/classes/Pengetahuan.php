<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Pengetahuan
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
        $data['pengetahuan'] = $this->_db->other_query("SELECT tb_pengetahuan.id, tb_pengetahuan.kode_gejala, tb_gejala.gejala, tb_pengetahuan.kode_kerusakan, tb_kerusakan.kerusakan, tb_pengetahuan.bobot FROM tb_pengetahuan
        JOIN tb_gejala ON tb_pengetahuan.kode_gejala = tb_gejala.kode_gejala
        JOIN tb_kerusakan ON tb_pengetahuan.kode_kerusakan = tb_kerusakan.kode_kerusakan", 2);
        view('layouts/_head');
        view('pengetahuan/index', $data);
        view('layouts/_foot');
    }

    public function tambahPengetahuan()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Pakar';
        $data['gejala'] = $this->_db->other_query("SELECT * FROM tb_gejala", 2);
        $data['kerusakan'] = $this->_db->other_query("SELECT * FROM tb_kerusakan", 2);
        view('layouts/_head');
        view('pengetahuan/tambah_data', $data);
        view('layouts/_foot');
    }
    public function prosesTambahPengetahuan()
    {
        $input = post();
        $gejala = $input['gejala'];
        $kerusakan = $input['kerusakan'];
        $bobot = $input['bobot'];

        // check duplicate
        $check = $this->_db->other_query("SELECT * FROM tb_pengetahuan WHERE kode_gejala = '$gejala' AND kode_kerusakan = '$kerusakan'", 2);
        if ($check) {
            echo json_encode(array('status' => 0, 'msg' => 'Data sudah ada'));
            die;
        }

        // query insert
        $insert = $this->_db->insert("INSERT INTO tb_pengetahuan(kode_gejala, kode_kerusakan, bobot) values ('$gejala', '$kerusakan', '$bobot')");
        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Data Pengetahuan berhasil ditambahkan";
            $res['page'] = "Pengetahuan";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengetahuan gagal ditambahkan";
        }
        echo json_encode($res);
    }
    public function ubahPengetahuan($kode)
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Pakar';
        $data['pengetahuan'] = $this->_db->get("SELECT * FROM tb_pengetahuan WHERE id = '$kode'");
        $data['gejala'] = $this->_db->other_query("SELECT * FROM tb_gejala", 2);
        $data['kerusakan'] = $this->_db->other_query("SELECT * FROM tb_kerusakan", 2);
        view('layouts/_head');
        view('pengetahuan/ubah_data', $data);
        view('layouts/_foot');
    }
    public function prosesUbahPengetahuan()
    {
        $input = post();
        $gejala = $input['gejala'];
        $kerusakan = $input['kerusakan'];
        $bobot = $input['bobot'];

         // check duplicate
         $check = $this->_db->other_query("SELECT * FROM tb_pengetahuan WHERE kode_gejala = '$gejala' AND kode_kerusakan = '$kerusakan' AND id != '$input[id]'", 2);
         if ($check) {
             echo json_encode(array('status' => 0, 'msg' => 'Data sudah ada'));
             die;
         }
        
        // query update
        $update = $this->_db->edit("UPDATE tb_pengetahuan SET kode_gejala = '$gejala', kode_kerusakan = '$kerusakan', bobot = '$bobot' WHERE id = '$input[id]'");
        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data Pengetahuan berhasil diubah";
            $res['page'] = "Pengetahuan";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Pengetahuan gagal diubah";
        }
        echo json_encode($res);
    }
    public function hapusPengetahuan()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_pengetahuan', 'id', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "pengetahuan";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
