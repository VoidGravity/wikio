<?php


include "../model/connection.php";
include "../model/user.php";
class UserController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function register()
    {
        // die("sqdsdqsd  test test test");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->userModel->username = $_POST['username'];
            $this->userModel->password = $_POST['password'];
            $this->userModel->email = $_POST['email'];
            $this->userModel->role = "username";

            $result = $this->userModel->register();

            if ($result) {
                header("Location: ../views/pages/signIn.php");
            } else {
                echo "damn";
            }
        }
    }
    public function login()
    {
        // die("heeeeeeeeeeeeeey");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['LoginUsername'];
            $password = $_POST['LoginPassword'];

            $user = $this->userModel->findUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();

                $result = $this->userModel->getUserRole($username);

                if ($result) {
                    $_SESSION['user_role'] = $result['role'];
                    // Redirect and stop script execution
                    header("Location: ../views/pages/no-sidebar.php");
                    exit();
                } else {
                    // Handle the case where no role is found
                    echo "Role not found for user.";
                }
            } else {
                echo "Invalid username or password";
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: ../views/pages/no-sidebar.php"); 
    }
}
$db = new Database();
$dbConnection = $db->getConnection();

$userModel = new User($dbConnection);
$userController = new UserController($userModel);

// Call the register method

if (isset($_POST["SubmitRegister"])) {
    $userController->register();
}
if (isset($_POST["SubmitLogin"])) {
    $userController->login();
}
// Existing code...

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $userController->logout();
}

