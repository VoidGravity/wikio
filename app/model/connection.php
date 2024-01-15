<?php

class Database {
    private $host = "localhost";
    private $db_name = "wikio";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct() {
       $this->getConnection();
    }

    public function getConnection() {
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>