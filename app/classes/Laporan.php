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
            JOIN tb_pengguna ON tb_diagnosis.username = tb_pengguna.username
            JOIN tb_kerusakan ON tb_diagnosis.kerusakan = tb_kerusakan.id_kerusakan";
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
        $tahun = $_GET['tahun'] ?? date('Y');
        $bulan = $_GET['bulan'] ?? date('m');
        $query = "SELECT
            tb_diagnosis.*,
            tb_pengguna.nama_lengkap,
            tb_kerusakan.kerusakan as nama_kerusakan
        FROM
            tb_diagnosis
            JOIN tb_pengguna ON tb_diagnosis.username = tb_pengguna.username
            JOIN tb_kerusakan ON tb_diagnosis.kerusakan = tb_kerusakan.id_kerusakan";
        if($tahun != null && $bulan != null) {
            $query .= " WHERE YEAR(tb_diagnosis.created_at) = $tahun";
            $query .= " AND MONTH(tb_diagnosis.created_at) = $bulan";
        }
        $hasil = $this->_db->other_query($query, 2);

        $pdf = new \FPDF();
        $pdf->AddPage();

        $pdf->Image('assets/images/logo-kop.jpg', 14, 10, 24);
        //Arial bold 15
        $pdf->SetFont('Arial','B',15);
        //pindah ke posisi ke tengah untuk membuat judul
        $pdf->Cell(80);
        //judul
        $pdf->Cell(50,10,'BENGKEL MOBIL GARASI INN',0,1,'C');
        //pindah baris
        $pdf->Ln(20);

        $pdf->SetFont('Arial','',10);
        $pdf->cell(210,-28  ,'Bumi Teluk jambe blok F 21, Sukaluyu, Telukjambe Timur, Karawang, West Java 41361',0,1,'C');
        $pdf->cell(210,38  ,'Telp. 0812-6160-9867',0,0,'C');
        //buat garis horisontal
        $pdf->Line(10,35,200,35);
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->setY(50);
        $month = strtoupper(bulan($bulan));
        $pdf->Cell(200, 10, "LAPORAN HASIL DIAGNOSA TAHUN {$tahun} BULAN {$month}", 0, 1, 'C');

        $pdf->setXY(12, 75);
        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(188, 6, '     Berikut rekapitulasi hasil diagnosa kerusakan pada mesin mobil matic menggunakan metode certainty factor dan Case Based Reasoning (CBR). Hasil rekapitulasi ini dapat digunakan sebagai bahan evaluasi dalam penanganan kerusakan pada mobil matic. Hasil rekapitulasi sebagai berikut: ', 0);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(35, 3, " ", 0, 1, "L");


        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Lengkap', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nama Kerusakan', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Hasil Diagnosa', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tanggal Diagnosa', 1, 1, 'C');
        foreach ($hasil as $key => $row) {
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 10, $key + 1, 1, 0, 'C');
            $pdf->Cell(40, 10, $row['nama_lengkap'], 1, 0, 'L');
            $pdf->Cell(50, 10, $row['nama_kerusakan'], 1, 0, 'L');
            $pdf->Cell(50, 10, 'CF = ' . $row['nilai_cf'] . ', ' . 'CBR = ' . $row['nilai_cbr'], 1, 0, 'L');
            $pdf->Cell(40, 10, tgl_indo(date('Y-m-d', strtotime($row['created_at']))), 1, 1, 'C');
        }
        $pdf->Ln();

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(156);
        $pdf->MultiCell(30,4,'Kepala Bengkel',0,'C');

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(180);
        $pdf->MultiCell(19.5,25,'',0,'R');

        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(148);
        $pdf->MultiCell(50,4, "nama disini",0,'C');

        $pdf->Ln();                
        $pdf->Output();
    }
}