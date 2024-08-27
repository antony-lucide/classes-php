<?php

class Database 
{
    protected $conn;

    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classes";


        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

?>
