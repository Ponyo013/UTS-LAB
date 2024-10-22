<?php
session_start();
require 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT user_id, username, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $email;

            header('Location: ../dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid email or password. Try again';
            header('Location: login.php');
        }
    } else {
        $_SESSION['error'] = 'Invalid email or password. Try again';
        header('Location: login.php');
    }

    $stmt->close();
    $conn->close();
}
?>