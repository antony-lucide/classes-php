<?php
include 'db_pdo.php';


class Userpdo extends Database
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

        $this->pdo = $this->connect();
    }

    public function register($id, $login, $password, $email, $firstname, $lastname)
    {
        try{
            
            $stmt = $this->pdo->prepare('INSERT INTO utilisateurs (id, login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?, ?)');

            $stmt->execute([$id, $login, $password, $email, $firstname, $lastname]);

            echo "User registered successfully!";

          
            $this->signIn($login);

         
            $result = $this->pdo->query('SELECT * FROM utilisateurs');
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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

    public function signIn($login,$password)
    {
       
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE login = ?, password = ?');
        $stmt->bind_param('s', $login, password_verify($password));
        if($stmt->execute()){
            session_start();
            echo "Success";
            IsConnect();
        }
    }

    public function disconnect()
    {
        session_abort();
        session_destroy();
        session_reset();
        
        echo "Disconnecting Success";
    }

    public function delete($login)
    {
        try {

            $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE login = ?, password = ?, email = ?, firstname = ?, lastname = ?");
            

            $stmt->execute([$login, $password,  $email, $firstname, $lastname]);


            if ($stmt->rowCount() > 0) {
                echo "User deleted successfully.";
            } else {
                echo "No user found with the provided login.";
            }
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Update($login, $password, $email, $firstname, $lastname)
    {
        $stmt = $this->pdo->prepare('UPDATE utilisateurs SET password = ?, email = ?, firstname = ?, lastname = ? WHERE login = ?');

        $stmt->execute($password, $email, $firstname, $lastname, $login]);

        if ($stmt->rowCount() > 0) {
            echo "User updated successfully.";
        } else {
            echo "No user found with the provided login or no changes were made.";
        }
    }

    public function IsConnect()
    {
     

        if (isset($_SESSION['login'])) {
            $this->IsConnected = true;  /
            echo "User " . htmlspecialchars($_SESSION['login']) . " is connected";
        } else {
            $this->IsConnected = false;  
            echo "No user is connected.";
        }
    }

    public function GetAllInfos()
    {
        $result = $this->pdo->query('SELECT * FROM utilisateurs');
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo htmlspecialchars($row['id']) . ' ' .
                     htmlspecialchars($row['login']) . ' ' .
                     htmlspecialchars($row['email']) . ' ' .
                     htmlspecialchars($row['firstname']) . ' ' .
                     htmlspecialchars($row['lastname']) . '<br>';
            }
    }

    public function GetLogin($login)
    {
        $this->login;
    }

    public function Getemail($email)
    {
        $this->email;
    }

    public function GetFirstname($firstname)
    {
        $this->firstname;
    }

    public function GetLastname($lastname)
    {
        $this->lastname;
    }
  }


$player = new Userpdo();
$player->register(2,"Tony","123456","antony.lucide@laplateforme.io","Antony", "Lucide");
?>