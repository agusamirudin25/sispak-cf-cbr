<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Konsultasi
{
    protected $_db;
    protected $id;
    protected $username;
    protected $pertanyaan;

    public function __construct()
    {
        $this->_db = new Database();
        if (!isset($_SESSION['emailPengguna'])) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $type = session_get('type');
        $usernamePengguna = session_get('emailPengguna');
        if ($type == 3) {
            $data['konsultasi'] = $this->_db->other_query("SELECT tb_konsultasi.*, tb_pengguna.nama_lengkap FROM tb_konsultasi JOIN tb_pengguna ON tb_konsultasi.username = tb_pengguna.username WHERE tb_konsultasi.username = '$usernamePengguna' ORDER BY created_at DESC", 2);
        } else {
            $data['konsultasi'] = $this->_db->other_query("SELECT tb_konsultasi.*, tb_pengguna.nama_lengkap FROM tb_konsultasi JOIN tb_pengguna ON tb_konsultasi.username = tb_pengguna.username ORDER BY created_at DESC", 2);
        }
        view('layouts/_head');
        view('konsultasi/index', $data);
        view('layouts/_foot');
    }

    public function tambahKonsultasi()
    {
        view('layouts/_head');
        view('konsultasi/tambah_data');
        view('layouts/_foot');
    }

    public function prosesTambahKonsultasi()
    {
        $input = post();
        $pesan = $input['pesan'];
        $username = session_get('emailPengguna');
        $sql = "INSERT INTO tb_konsultasi (pertanyaan, username) VALUES ('$pesan', '$username')";
        // query insert
        $insert = $this->_db->insert($sql);
        // get last data
        $lastData = $this->_db->other_query("SELECT * FROM tb_konsultasi WHERE username = '$username' ORDER BY id_konsultasi DESC LIMIT 1", 2);
        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Sukses kirim";
            $res['data'] = $lastData;
        } else {
            $res['status'] = 0;
            $res['msg'] = "Gagal kirim";
        }
        echo json_encode($input);
    }

    public function detailKonsultasi($id)
    {
        // select data
        $data['konsultasi'] = $this->_db->other_query("SELECT tb_konsultasi.*, tb_pengguna.nama_lengkap FROM tb_konsultasi JOIN tb_pengguna ON tb_konsultasi.username = tb_pengguna.username WHERE id_konsultasi = '$id'");
        // select jawaban
        $data['jawaban'] = $this->_db->other_query("SELECT * FROM tb_jawaban_konsultasi WHERE id_konsultasi = '$id' ORDER BY created_at", 2);
        $data['id_konsultasi'] = $id;
        view('layouts/_head');
        view('konsultasi/detail_data', $data);
        view('layouts/_foot');
    }

    public function prosesJawaban()
    {
        $input = post();
        $pesan = $input['pesan'];
        $id_konsultasi = $input['id_konsultasi'];
        $pakar = session_get('type') == 2 ? 1 : 0;
        $sql = "INSERT INTO tb_jawaban_konsultasi (id_konsultasi, jawaban, pakar) VALUES ('$id_konsultasi', '$pesan', '$pakar')";
        // query insert
        $insert = $this->_db->insert($sql);
        $lastData = [
            'pesan' => $pesan,
        ];
        // get last data
        if ($insert) {
            $res['status'] = 1;
            $res['msg'] = "Sukses kirim";
            $res['data'] = $lastData;
        } else {
            $res['status'] = 0;
            $res['msg'] = "Gagal kirim";
        }
        echo json_encode($input);
    
    }  

    public function hapusKonsultasi()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_konsultasi', 'id_konsultasi', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data konsultasi berhasil dihapus";
            $res['page'] = "Konsultasi";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data konsultasi gagal dihapus";
        }
        echo json_encode($res);
    }
}