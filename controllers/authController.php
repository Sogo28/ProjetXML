<?php
require_once __DIR__ . '/../data/load_users.php';

class AuthController {
    public function login() {
        include __DIR__ . '/../views/login.php';
    }

    public function authenticate() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        global $xml;
        $admin = $xml->admin;
        if ($admin->username == $username && $admin->password == $password) {
            $_SESSION['authenticated'] = true;
            header("Location: /index.php");
            exit();
        } else {
            echo "Authentication failed. Invalid username or password.";
        }
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: /index.php");
        exit();
    }
}
?>
