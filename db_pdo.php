<?php

class Database 
{
    protected $pdo;

    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classes";


        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);


        // if ($this->pdo->connect_error) {
        //     die("Connection failed: " . $this->pdo->connect_error);
        // }

        return $this->pdo;
    }
}

?>
