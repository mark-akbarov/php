<?php

class Database {
    private $host = "localhost";
    private $dbname = "php_first_db";
    private $username = "php_first_user";
    private $password = "2404";
    private $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    private function connect() {
        return pg_connect(
            "host={$this->host} 
            dbname={$this->dbname} 
            user={$this->username} 
            password={$this->password}"
        );
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            pg_close($this->conn);
        }
    }
}
?>
