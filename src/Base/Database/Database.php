<?php

namespace App\Base\Database;

// require_once __DIR__.'config.php';

abstract class Database{
    private $conn;

    public function __construct(){
        $dbServername = "127.0.0.1";
        // $dbUsername = "user";
        $dbUsername = "root";
        $dbPassword = "password";
        $dbName = "dev_server";
        $dbPort = "6606";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $conn = \mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, $dbPort);
        
        if (!$conn){
            echo 'connection error: '.mysqli_connect_error();
        }

        $this->conn = $conn;

    }

    protected function getConnection(){
        return $this->conn;
    }
}

?>