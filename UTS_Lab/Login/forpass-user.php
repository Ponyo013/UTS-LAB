<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['check-email'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            $updateStmt = $conn->prepare('UPDATE users SET password = ? WHERE email = ?');
            $updateStmt->bind_param('ss', $hashedPassword, $email);

            if ($updateStmt->execute()) {
                $_SESSION['success'] = 'Password updated successfully!';
                header('Location: forpass.php');
                exit();
            } else {
                $_SESSION['error'] = 'Error updating password. Please try again.';
                header('Location: forpass.php');
                exit();
            }

            $updateStmt->close();
        } else {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: forpass.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Email not found. Please enter a valid email address.';
        header('Location: forpass.php');
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
