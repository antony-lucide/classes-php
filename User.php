<?php
include 'db.php';

// User class that extends Database
class User extends Database
{
    private int $id;
    public string $login;
    public string $password;
    public string $email;
    public string $firstname;
    public string $lastname;


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
}


$user = new User();
$user->register(1, 'tony', '123456', 'antony.lucide@laplateforme.io', 'Antony', 'Lucide');
?>