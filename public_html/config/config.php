
<?php
class Config {
    
    private $host = "";
    private $username = "";
    private $password = "";
    private $database = "";
    private $connection;
    
    public function __construct() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            die("Failed to connect to database: " . mysqli_connect_error());
        }
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function __destruct() {
        mysqli_close($this->connection);
    }
    
}




