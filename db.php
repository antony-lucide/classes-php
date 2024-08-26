<?php

class Database 
{
    protected $conn;

    // Method to establish the database connection
    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classes";

        // Create a new mysqli connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

?>
