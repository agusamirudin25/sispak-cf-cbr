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
        $data['pengetahuan'] = $this->_db->other_query("SELECT tb_pengetahuan.kode_gejala, tb_gejala.gejala, tb_pengetahuan.kode_kerusakan, tb_kerusakan.kerusakan, tb_pengetahuan.bobot FROM tb_pengetahuan
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
    public function ubahKerusakan($kode)
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Pakar';
        $data['kerusakan'] = $this->_db->get("SELECT * FROM tb_kerusakan WHERE kode_kerusakan = '$kode'");
        view('layouts/_head');
        view('kerusakan/ubah_data', $data);
        view('layouts/_foot');
    }
    public function prosesUbahKerusakan()
    {
        $input = post();
        $kode_kerusakan = $input['kode_kerusakan'];
        $nama_kerusakan = $input['kerusakan'];
        $solusi = $input['solusi'];
        $alat = $input['alat'];
        // query update
        $update = $this->_db->edit("UPDATE tb_kerusakan SET kerusakan = '$nama_kerusakan', solusi = '$solusi', alat = '$alat' WHERE kode_kerusakan = '$kode_kerusakan'");
        if ($update) {
            $res['status'] = 1;
            $res['msg'] = "Data Kerusakan berhasil diubah";
            $res['page'] = "Kerusakan";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Kerusakan gagal diubah";
        }
        echo json_encode($res);
    }
    public function hapusKerusakan()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_kerusakan', 'kode_kerusakan', "'" . $id . "'");
        if ($delete) {
            $res['status'] = 1;
            $res['msg'] = "Data berhasil dihapus";
            $res['page'] = "Kerusakan";
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data gagal dihapus";
        }
        echo json_encode($res);
    }
}
