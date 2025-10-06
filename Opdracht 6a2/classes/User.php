<?php
class User {
    public $username;
    private $password;
    private $conn;
 
    // Constructor
    public function __construct($username = "", $password = "") {
        $this->username = $username;
        $this->password = $password;
    }
 
    // 🔌 Database connectie
    public function dbConnect() {
        $host = "localhost";
        $dbname = "Login";
        $user = "root";
        $pass = "";
 
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Database connectie mislukt: " . $e->getMessage());
        }
    }
 
    // 👇 Nieuw toegevoegde setters
    public function setUsername($username) {
        $this->username = $username;
    }
 
    public function setPassword($password) {
        $this->password = $password;
    }
 
    // 🔑 Login gebruiker
    public function loginUser($username = null, $password = null) {
        $this->dbConnect();
 
        // gebruik class-waarden als parameters leeg zijn
        $username = $username ?? $this->username;
        $password = $password ?? $this->password;
 
        try {
            $stmt = $this->conn->prepare("SELECT * FROM User WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                echo "❌ Ongeldige gebruikersnaam of wachtwoord.";
            }
        } catch (PDOException $e) {
            echo "❌ Fout bij inloggen: " . $e->getMessage();
        }
    }
public function registerUser() {
    $errors = [];
    $this->dbConnect();
    try {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO User (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    } catch (PDOException $e) {
        $errors[] = "❌ Fout bij registratie: " . $e->getMessage();
    }
    return $errors;
}
 
 
    // 🔍 Controleer of iemand is ingelogd
    public function isLoggedin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['username']);
    }
 
    // 🚪 Uitloggen
    public function Logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php");
        exit();
    }
 
    // 👤 Gebruikersgegevens ophalen
    public function getUser($username) {
        $this->dbConnect();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM User WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
 
            if ($data) {
                $this->username = $data['username'];
                $this->password = $data['password'];
            }
        } catch (PDOException $e) {
            echo "❌ Fout bij ophalen gebruiker: " . $e->getMessage();
        }
    }
 
    // 👁 Toon gebruikersgegevens
    public function showUser() {
        echo "Gebruikersnaam: " . htmlspecialchars($this->username);
    }
}
?>