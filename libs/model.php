<?php

class Model{

    public $conn;

    public function __construct()
    {

        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connected failed: ' . $e->getMessage());
        }
    }
}

?>