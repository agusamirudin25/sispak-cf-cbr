<?php

namespace App\Classes;

header('Access-Control-Allow-Origin:*');


class Laporan
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
        $tahun = $_GET['tahun'] ?? null;
        $bulan = $_GET['bulan'] ?? null;
        $link_cetak = 'laporan/cetak_laporan';
        $query = "SELECT
            tb_diagnosis.*,
            tb_pengguna.nama_lengkap,
            tb_kerusakan.kerusakan as nama_kerusakan
        FROM
            tb_diagnosis
            JOIN tb_pengguna ON tb_diagnosis.email = tb_pengguna.email
            JOIN tb_kerusakan ON tb_diagnosis.kerusakan = tb_kerusakan.kode_kerusakan";
        if($tahun != null && $bulan != null) {
            $query .= " WHERE YEAR(tb_diagnosis.created_at) = $tahun";
            $query .= " AND MONTH(tb_diagnosis.created_at) = $bulan";
            $link_cetak .= "?tahun=$tahun&bulan=$bulan";
        }
        $data['diagnosis'] = $this->_db->other_query($query, 2);
        $data['link_cetak'] = $link_cetak;
        view('layouts/_head');
        view('laporan/index', $data);
        view('layouts/_foot');
    }

    public function cetak_laporan()
    {
        $tahun = $_GET['tahun'] ?? null;
        $bulan = $_GET['bulan'] ?? null;
        $query = "SELECT
            tb_diagnosis.*,
            tb_pengguna.nama_lengkap,
            tb_kerusakan.kerusakan as nama_kerusakan
        FROM
            tb_diagnosis
            JOIN tb_pengguna ON tb_diagnosis.email = tb_pengguna.email
            JOIN tb_kerusakan ON tb_diagnosis.kerusakan = tb_kerusakan.kode_kerusakan";
        if($tahun != null && $bulan != null) {
            $query .= " WHERE YEAR(tb_diagnosis.created_at) = $tahun";
            $query .= " AND MONTH(tb_diagnosis.created_at) = $bulan";
        }
        $data['diagnosis'] = $this->_db->other_query($query, 2);
        $data['tahun'] = $tahun;
        $data['bulan'] = bulan($bulan);
        view('laporan/cetak_laporan', $data);
    }
}
