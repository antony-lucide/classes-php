<?php
include 'db.php';


class User extends Database
{
    private int $id;
    public string $login;
    public string $password;
    public string $email;
    public string $firstname;
    public string $lastname;
    public bool $IsConnected = false;

    public function __construct()
    {

        $this->db = $this->connect();
    }

?>