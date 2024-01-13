<?php

class User
{

    private $conn;

    public $username;
    public $password;
    public $email;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function register()
    {

        $query = "INSERT INTO users (username, password, email, Role) VALUES (:username, :password, :email, :Role)";
        // here e will be going through diferent steps to increase security
        // etape 1 using prepared statment to avoid SQL injection
        $stmt = $this->conn->prepare($query);

        // etape 2 Cleaning the data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // etape 3 password_hash
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        // etape 4 Bind parameters
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":Role", $this->role);

        // 5 Execute the query

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function findUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        } else {
            return null;
        }
    }
    public function getUserRole($username) {
        $query = "SELECT role FROM users WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ... other methods like login, update, etc.
}
