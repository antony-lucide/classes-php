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

    public function register($id, $login, $password, $email, $firstname, $lastname)
    {
        try {
          
            $stmt = $this->db->prepare('INSERT INTO utilisateurs (id, login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?, ?)');
            

            $stmt->bind_param('isssss', $id, $login, $password, $email, $firstname, $lastname);

            if ($stmt->execute()) {
                echo "User registered successfully!" . "";
                $this->signIn($login);
            } else {
                echo "Error: " . $stmt->error;
            }

            $result = $this->db->query('SELECT * FROM utilisateurs');
            while ($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row['id']) . ' ' .
                     htmlspecialchars($row['login']) . ' ' .
                     htmlspecialchars($row['email']) . ' ' .
                     htmlspecialchars($row['firstname']) . ' ' .
                     htmlspecialchars($row['lastname']) . '<br>';
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function SignIn($login)
    {
        session_start();

        $_SESSION['login'] = $login;
        if(!empty($_SESSION['id'])){
            echo htmlspecialchars($_SESSION['login']);
        }
    }

    public function disconnect()
    {
        session_abort();
        session_destroy();
        session_reset();

        if($_SESSION == NULL){
            echo "Session is now reset";
        }
    }

    public function Delete($login)
    {
        $stmt = $this->db->prepare('DELETE FROM utilisateurs WHERE login = ?');
      
        $stmt->bind_param('s', $login);     
        if ($stmt->execute()) {
            echo "User Deleted Successfully" . "";
        } else {
            echo "Error: " . $stmt->error;
        }   
    }

    public function Update($login, $password, $email, $firstname, $lastname)
    {
        $stmt = $this->db->prepare('UPDATE utilisateurs SET password = ?, email = ?, firstname = ?, lastname = ? WHERE login = ?');
        $stmt->bind_param('sssss',$login, $password, $email, $firstname, $lastname);
        if ($stmt->execute()) {
            echo "User Deleted Successfully" . "";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    
    public function IsOnline()
    {
        if(isset($_SESSION['login'])){
            $this->isconnected = true;
            echo "User" . htmlspecialchars($login) . "is Connected";
        } else {
            $this->isConnected = false;
            echo "Not Connected";
        }
    }

    public function GetAllInfo()
    {
        $result = $this->db->query('SELECT * FROM utilisateurs');
        while ($row = $result->fetch_assoc()) {
            echo htmlspecialchars($row['id']) . ' ' .
                 htmlspecialchars($row['login']) . ' ' .
                 htmlspecialchars($row['email']) . ' ' .
                 htmlspecialchars($row['firstname']) . ' ' .
                 htmlspecialchars($row['lastname']) . '<br>';
        }
    }

    public function Getlogin($login)
    {
        $this->login;
    }

    public function GetEmail($email)
    {
        $this->email;
    }

    public function GetFirstname($firstname)
    {
        $this->firstname;
    }

    public function Getlastname($lastname)
    {
        $this->lastname;
    }
}


$user = new User();
$user->register(1, 'tony', '123456', 'antony.lucide@laplateforme.io', 'Antony', 'Lucide');
?>