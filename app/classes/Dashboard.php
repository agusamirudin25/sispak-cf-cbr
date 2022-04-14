<?php

namespace App\Classes;
header('Access-Control-Allow-Origin:*');


class Dashboard
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
        $data_bencana = $this->_db->other_query("SELECT * FROM v_dataset", 2);
        $jumlah = [];
        $kecamatan = [];
        foreach ($data_bencana as $dt) {
            array_push($kecamatan, $dt['nama_kecamatan']);
            array_push($jumlah, $dt['total_banjir']);
        }
        $data['kecamatan'] = json_encode($kecamatan);
        $data['total'] = json_encode($jumlah);
        view('layouts/_head');
        view('dashboard', $data);
        view('layouts/_foot');
    }

    function getData()
    {
        $query = $this->_db->other_query("SELECT * FROM v_clustering", 2);
        $data = [];
        foreach ($query as $row) {
            $data[] = $row;
        }

        $res['data_bencana'] = $data;
        echo json_encode($res);
    }
    function getGrafik()
    {
        $input = post();
        $jenis_bencana = $input['jenis'];
        $judul = '';
        $jenis = '';
        switch ($jenis_bencana) {
            case 'banjir':
                $jenis = 'total_banjir';
                $judul = 'BANJIR';
                break;
            case 'gempa':
                $jenis = 'total_gempa';
                $judul = 'GEMPA BUMI';
                break;
            case 'longsor':
                $jenis = 'total_longsor';
                $judul = 'TANAH LONGSOR';
                break;
            default:
                $jenis = 'total_banjir';
                break;
        }
        $data_bencana = $this->_db->other_query("SELECT * FROM v_dataset", 2);
        $jumlah = [];
        $kecamatan = [];
        foreach ($data_bencana as $dt) {
            array_push($kecamatan, $dt['nama_kecamatan']);
            array_push($jumlah, $dt[$jenis]);
        }
        $res['kecamatan'] = json_encode($kecamatan);
        $res['total'] = json_encode($jumlah);
        $res['judul'] = $judul;
        echo json_encode($res);
    }
}
