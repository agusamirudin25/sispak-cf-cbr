<?php

namespace App\Controller;


use App\model\Database;

header('Access-Control-Allow-Origin:*');


class Laporan
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

    public function generate()
    {
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Image(FCPATH . 'assets/images/kop.png', -2, -3, 220);
        $pdf->Cell(40, 10, 'Hello World!');
        $pdf->Output();
    }
}
