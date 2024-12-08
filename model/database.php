<?php
require_once('../public/config.php');

class Database
{
    private null|mysqli $con = null;
    function __construct()
    {
        $this->con = $this->connectDB();
    }

    private function connectDB()
    {
        return mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    }

    public function get_connection()
    {
        return $this->con;
    }

    public function execute_result($sql)
    {
        $result = mysqli_query($this->con, $sql);
        $data  = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $result->free_result();
        return $data;
    }

    function execute($sql)
    {
        $conn = $this->con;
        //insert, update, delete
        $res = mysqli_query($conn, $sql);


        return $res;
    }

    public function execute_single_row($sql)
    {
        $result = mysqli_query($this->con, $sql);
        $data = mysqli_fetch_assoc($result);
        $result->free_result();
        return $data;
    }
}
