<?php

function abort($status = 404)
{
    require "./../app/view/errors/$status.php";
    exit();
}

function pretty($arr, $is_die = true)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';

    if ($is_die) die();
}
function post()
{
    $arr = [];
    foreach ($_POST as $key => $dt) {
        htmlspecialchars($dt);
        $arr_data = [
            $key => $dt
        ];
        $arr = array_merge($arr, $arr_data);
    }
    return $arr;
}

function view($view, $data = [])
{
    extract($data);

    require "../app/view/" . $view . ".php";
}

function asset($path = '')
{
    return BASE_URL . trim($path, '/');
}

function url($url = '')
{
    return str_replace('public/', '', APP_URL) . trim($url, '/');
}

function base_url($url = '')
{
    return str_replace('public/', '', BASE_URL) . trim($url, '/');
}

function redirect($url = '')
{
    if ($url) {
        $location = APP_URL . trim($url, '/');
        header("location: $location");
        die();
    }
}

function session_get($key)
{
    if ($key && isset($_SESSION[$key])) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
}

function session_set($key = '', $value = '')
{
    if (!session_id()) session_start();
    if ($key && $value) {
        return $_SESSION[$key] = $value;
    }
}

function session_has($key)
{
    return isset($_SESSION[$key]);
}

function session_del($key = '')
{
    if ($key && isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}
if (!function_exists('bulan')) {
    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

if (!function_exists('hari_indo')) {
    function hari_indo($hari)
    {
        switch ($hari) {
            case 'Monday':
                return "Senin";
                break;
            case 'Tuesday':
                return "Selasa";
                break;
            case 'Wednesday':
                return "Rabu";
                break;
            case 'Thursday':
                return "Kamis";
                break;
            case 'Friday':
                return "Senin";
                break;
            case 'Saturday':
                return "Sabtu";
                break;
            case 'Sunday':
                return "Minggu";
                break;
        }
    }
}
