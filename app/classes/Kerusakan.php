<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Kerusakan
{
    protected $_db;
    protected $kode_kerusakan;
    protected $kerusakan;
    protected $solusi;
    protected $alat;
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
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Mekanik';
        $data['kerusakan'] = $this->_db->other_query("SELECT * FROM tb_kerusakan", 2);
        view('layouts/_head');
        view('kerusakan/index', $data);
        view('layouts/_foot');
    }

    public function tambahKerusakan()
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Mekanik';
        $kode_terakhir = $this->_db->get_last_param('tb_kerusakan', 'id_kerusakan');
        if ($kode_terakhir) {
            $nilai_kode = substr($kode_terakhir['id_kerusakan'], 1);
            $kode = (int) $nilai_kode;
            $kode = $kode + 1;
            $kode_otomatis = "K" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "K01";
        }
        $data['kode_otomatis'] = $kode_otomatis;
        view('layouts/_head');
        view('kerusakan/tambah_data', $data);
        view('layouts/_foot');
    }
    public function prosesTambahKerusakan()
    {
        $input = post();
        $kode_kerusakan = $input['kode_kerusakan'];
        $nama_kerusakan = $input['kerusakan'];
        $solusi = $input['solusi'];
        $alat = $input['alat'];

        // upload file gambar
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $gambar_baru = date('dmYHis') . $gambar;
        $path = "./assets/gambar/" . $gambar_baru;
        if (move_uploaded_file($tmp, $path)) {
            $insert = $this->_db->insert("INSERT INTO tb_kerusakan(id_kerusakan, kerusakan, solusi, alat, gambar) values ('$kode_kerusakan', '$nama_kerusakan', '$solusi', '$alat', '$gambar_baru')");
            if ($insert) {
                $res['status'] = 1;
                $res['msg'] = "Data Kerusakan berhasil ditambahkan";
                $res['page'] = "Kerusakan";
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data Kerusakan gagal ditambahkan";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = "Data Kerusakan gagal ditambahkan. Gambar gagal diupload";
        }
        echo json_encode($res);
    }
    public function ubahKerusakan($kode)
    {
        $data['role'] = (session_get('type') == 1) ? 'Admin' : 'Mekanik';
        $data['kerusakan'] = $this->_db->get("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '$kode'");
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

        // upload file gambar
        if($_FILES['gambar']['name'] != ""){
            $gambar      = $_FILES['gambar']['name'];
            $tmp         = $_FILES['gambar']['tmp_name'];
            $gambar_baru = date('dmYHis') . $gambar;
            $path        = "./assets/gambar/" . $gambar_baru;
            if (move_uploaded_file($tmp, $path)) {
                $update = $this->_db->edit("UPDATE tb_kerusakan SET kerusakan = '$nama_kerusakan', solusi = '$solusi', alat = '$alat', gambar = '$gambar_baru' WHERE id_kerusakan = '$kode_kerusakan'");
                if ($update) {
                    $res['status'] = 1;
                    $res['msg'] = "Data Kerusakan berhasil diubah";
                    $res['page'] = "Kerusakan";
                } else {
                    $res['status'] = 0;
                    $res['msg'] = "Data Kerusakan gagal diubah";
                }
            } else {
                $res['status'] = 0;
                $res['msg'] = "Data Kerusakan gagal diubah. Gambar gagal diupload";
            }
        }
        echo json_encode($res);
    }
    public function hapusKerusakan()
    {
        $input = post();
        $id = $input['id'];
        $delete = $this->_db->delete('tb_kerusakan', 'id_kerusakan', "'" . $id . "'");
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
