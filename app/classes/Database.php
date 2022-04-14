<?php

namespace App\Classes;

use mysqli;

class Database
{
    protected $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if (!$this->conn) {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Check connection
            if ($this->conn->connect_errno) {
                echo "Failed to connect to MySQL: " . $this->conn->connect_error;
                exit();
            }
        }
    }
    function get($sql)
    {
        $result = $this->conn->query($sql);

        $row = $result->fetch_object();
        $data = null;
        if ($result->num_rows != 0) {
            $data = $row;
        }
        $result->free_result();
        return $data;
    }
    function getAll($tabel)
    {
        $sql = 'SELECT * FROM ' . $tabel;
        $result = $this->conn->query($sql);

        $row = $result->fetch_all(MYSQLI_ASSOC);

        // Free result set
        $result->free_result();

        return $row;
    }
    function other_query($query, $type = 1)
    {
        $result = $this->conn->query($query);
        if ($type == 1) {
            $data = $result->fetch_object();
        } else {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $data;
    }
    function insert($sql)
    {
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }
    function edit($sql)
    {
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }
    function delete($tabel, $field, $data)
    {
        return $this->conn->query("DELETE FROM `$tabel` WHERE `$field` = $data");
    }
    function sinkronisasi($tabel, $jenis)
    {
        $countData = $this->conn->query("SELECT * FROM m_kecamatan GROUP BY id")->num_rows;
        for ($i = 1; $i <= $countData; $i++) :
            $this->conn->query("UPDATE tr_dataset 
            SET total_" . $jenis . " = (
                SELECT
                    SUM( a.total_kejadian ) AS total_kejadian 
                FROM
                    `$tabel` a
                    JOIN m_kecamatan b ON a.id_kecamatan = b.id 
                WHERE
                    a.id_kecamatan = $i 
                GROUP BY
                    a.id_kecamatan 
                ) 
            WHERE
                tr_dataset.id_kecamatan = $i");
        endfor;
        return true;
    }
    function bind_param($sql, $param1, $param2)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $param1, $param2);

        $param1 = $param1;
        $param2 = $param2;

        $stmt->execute();
    }
}
