<?php

namespace App\Classes;


header('Access-Control-Allow-Origin:*');


class Diagnosis
{
    protected $_db;
    protected $id;
    protected $username;
    protected $data_gejala;
    protected $kerusakan;
    protected $nilai_cf;
    protected $nilai_cbr;

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
        $data['gejala'] = $this->_db->other_query("SELECT * FROM tb_gejala", 2);
        $data['bobot'] = $this->_db->other_query("SELECT * FROM tb_bobot", 2);
        view('layouts/_head');
        view('diagnosis/index', $data);
        view('layouts/_foot');
    }

    public function prosesDiagnosis()
    {
        $gejala = $_POST['gejala'];
        $bobot = $_POST['bobot'];
      
        // merge array gejala dan bobot
        $data = array_combine($gejala, $bobot);
        // setup where_in
        $where_in = '';
        foreach ($gejala as $key => $value) {
            if ($key == 0) {
                $where_in .= "'". $value ."'";
            } else {
                $where_in .= ",'". $value ."'";
            }
        }
        $sql = "SELECT kode_kerusakan, count(kode_kerusakan) as total_gejala FROM tb_pengetahuan WHERE kode_gejala IN ($where_in) GROUP BY kode_kerusakan";
        $diagnosa = $this->_db->other_query($sql, 2);
        $paling_banyak_gejala = '';
        $nilai_paling_banyak = 0;
        $hasil = [];
        foreach ($diagnosa as $key => $value) {
            if ($value['total_gejala'] > $nilai_paling_banyak) {
                $paling_banyak_gejala = $value['kode_kerusakan'];
                $nilai_paling_banyak = $value['total_gejala'];
            }
            // select count tb_pengetahuan
            $sql = "SELECT count(kode_kerusakan) as total FROM tb_pengetahuan WHERE kode_kerusakan = '".$value['kode_kerusakan']."'";
            $count = $this->_db->other_query($sql, 1);
            $total = $count->total;
            $tempData = $total - $diagnosa[$key]['total_gejala'];
            $hasil[$value['kode_kerusakan']] = $tempData;
        }
        // get min value
        $kode_kerusakan = array_keys($hasil, min($hasil));
        if(count($kode_kerusakan) > 1){
            $kode_kerusakan = $paling_banyak_gejala;
        }else{
            $kode_kerusakan = $kode_kerusakan[0];
        }

        // perhitungan CF
        // get data tb_pengetahuan where kode_kerusakan = $kode_kerusakan
        $sql = "SELECT tb_pengetahuan.*, tb_kerusakan.kerusakan FROM tb_pengetahuan JOIN tb_kerusakan ON tb_pengetahuan.kode_kerusakan = tb_kerusakan.id_kerusakan WHERE tb_pengetahuan.kode_kerusakan = '".$kode_kerusakan."'";
        $data_pengetahuan = $this->_db->other_query($sql, 2);
        // perkalian nilai pakar dengan nilai bobot user
        $keterangan_perkalian_cf = [];
        $hasil_cf = [];
        foreach ($data_pengetahuan as $key => $value) {
            // pretty($value['bobot'] . '*' . ($data[$value['kode_gejala']] ?? 0), 0);
            $keterangan_perkalian_cf[] = $value['bobot'] . ' * ' . ($data[$value['kode_gejala']] ?? 0);
            $temp_hasil_cf = $value['bobot'] * ($data[$value['kode_gejala']] ?? 0);
            $hasil_cf[] = [
                'kode_gejala' => $value['kode_gejala'],
                'nilai' => number_format($temp_hasil_cf, 2, '.', '')
            ];
        }

        // menentukan CF Combine CF (H,E) 1,2 = CF (H,E)1 + CF (H,E)2 * (1 - CF [H,E]1)
        $keterangan_cf_combine = [];
        $hasil_cf_combine = [];
        foreach ($hasil_cf as $key => $value) {
            // if key last data
            if ($key != count($hasil_cf) - 1) {
                // get array next index $value
                $next_index = $key + 1;
                if ($key == 0) {
                    // pretty($value['nilai'] . '+' . ($hasil_cf[$next_index]['nilai'] ?? 0) . '*' . (1 - $value['nilai']), 0);
                    $keterangan_cf_combine[] = $value['nilai'] . ' + ' . ($hasil_cf[$next_index]['nilai'] ?? 0) . ' * ' . (1 - $value['nilai']);
                    $hasil_cf_combine[] = $value['nilai'] + ($hasil_cf[$next_index]['nilai'] ?? 0) * (1 - $value['nilai']);
                } else {
                    // pretty($hasil_cf_combine[$key - 1] . '+' . ($hasil_cf[$next_index]['nilai'] ?? 0) . '*' . (1 - $hasil_cf_combine[$key - 1]), 0);
                    $keterangan_cf_combine[] = $hasil_cf_combine[$key - 1] . ' + ' . ($hasil_cf[$next_index]['nilai'] ?? 0) . ' * ' . (1 - $hasil_cf_combine[$key - 1]);
                    $hasil_cf_combine[] = $hasil_cf_combine[$key - 1] + ($hasil_cf[$next_index]['nilai'] ?? 0) * (1 - $hasil_cf_combine[$key - 1]);
                }
            }
        }

        // get last value of index
        $last_index = count($hasil_cf_combine) - 1;
        $nilai_akhir_cf = $hasil_cf_combine[$last_index];
        $persentase_nilai_akhir_cf = number_format($nilai_akhir_cf * 100, 0, '.', '');
       
        // perhitungan CBR
        // Similarity = S1 * W1 + W2 +… … + Sn * Wn
		// 	            W1 + W2 +… … + Wn

        $similarity = [];
        $total_bobot = 0;
        $keterangan_cbr = [];
        foreach ($data_pengetahuan as $key => $value) {
            $total_bobot += $value['bobot'];
            // cek data gejala apakah ada di tb_kasus_baru
            $sql = "SELECT count(kode_gejala) as `count` FROM tb_kasus_baru WHERE kode_gejala = '".$value['kode_gejala']."'";
            $kasus_baru = $this->_db->other_query($sql);
            if ($kasus_baru->count > 0) {
                // pretty(1 . '*' . $value['bobot'], 0);
                $keterangan_cbr[] = 1 . '*' . $value['bobot'];
                $similarity[] = 1 * $value['bobot'];
            } else {
                // pretty(0 . '*' . $value['bobot'], 0);
                $keterangan_cbr[] = 0 . '*' . $value['bobot'];
                $similarity[] = 0 * $value['bobot'];
            }
        }
        // sum array
        $total_similarity = array_sum($similarity);
        $hasil_cbr = $total_similarity / $total_bobot;
        $persentase_hasil_cbr = number_format($hasil_cbr * 100, 0, '.', '');
        
        $data['input'] = $data;
        $data['gejala'] = $this->_db->other_query("SELECT tb_gejala.id_gejala, tb_gejala.gejala, tb_pengetahuan.bobot FROM tb_gejala JOIN tb_pengetahuan ON tb_gejala.id_gejala = tb_pengetahuan.kode_gejala WHERE tb_gejala.id_gejala IN ($where_in) AND tb_pengetahuan.kode_kerusakan = '$kode_kerusakan'", 2);
        $data['kerusakan'] = $this->_db->other_query("SELECT * FROM tb_kerusakan WHERE id_kerusakan = '$kode_kerusakan'", 1);
        $data['nilai_perkalian_cf'] = $hasil_cf;
        $data['nilai_cf_combine'] = $hasil_cf_combine;
        $data['hasil_cf'] = $nilai_akhir_cf;
        $data['persentase_hasil_cf'] = $persentase_nilai_akhir_cf . '%';

        $data['hasil_cbr'] = $hasil_cbr;
        $data['total_similarity'] = $total_similarity;
        $data['keterangan_perhitungan_cbr'] = $total_similarity . ' / ' . $total_bobot . ' = ' . $hasil_cbr;
        $data['persentase_hasil_cbr'] = $persentase_hasil_cbr . '%';
        $data['keterangan_perkalian_cf'] = $keterangan_perkalian_cf;
        $data['keterangan_cf_combine'] = $keterangan_cf_combine;
        $data['keterangan_cbr'] = $keterangan_cbr;

        // insert data ke tb_diagnosis
        $usernamePengguna = session_get('emailPengguna');
        $data_gejala = json_encode($gejala);
        $sql = "INSERT INTO tb_diagnosis (username, kerusakan, data_gejala, nilai_cf, nilai_cbr) VALUES ('$usernamePengguna', '$kode_kerusakan', '$data_gejala', '$nilai_akhir_cf', '$hasil_cbr')";
        $this->_db->insert($sql);
        // store to session
        session_set('sessData', $data);
        $res['status'] = 1;
        $res['msg'] = "Diagnosa berhasil";
        echo json_encode($res);
        die;
    }

    public function hasilDiagnosis()
    {
        $data = session_get('sessData');
        // pretty($data);
        view('layouts/_head');
        view('diagnosis/hasil', $data);
        view('layouts/_foot');
    }
   
}
