<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    // private $host = '207.180.246.8';
    private $host = '35.199.119.236';
    // private $host = '127.0.0.1';
    private $username = 'sa';
    private $password = 'yp257sjtfBpqnNK8F%5s'; // yp257sjtfBpqnNK8F%5s / geraISLA123$
    private $name = 'miruta'; // ChasquiDB / miruta
    function connectDb()
    {
        try {

            // $sql = "sqlsrv:Server=$this->host;Database=$this->name"; //LOCAL
            $sql = "sqlsrv:Server=$this->host;Database=$this->name;Encrypt=false"; 
            $cn = new PDO($sql, $this->username, $this->password);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
};
