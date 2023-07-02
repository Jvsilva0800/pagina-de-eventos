<?php

class DatabaseConnection {
    private $host = "localhost";
    private $username = "seu_usuario";
    private $password = "sua_senha";
    private $dbname = "seu_banco_de_dados";

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
