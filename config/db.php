<!-- <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'ql_nhansu';
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);
?> -->

<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'ql_nhansu';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>