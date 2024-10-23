<?php
session_start();
require 'mydb.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userId = $_SESSION['user_id']; 

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error_message'] = 'New passwords do not match.';
        header('Location: editProfile.php'); 
        exit();
    }

    $sql = "SELECT password FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if (password_verify($currentPassword, $hashedPassword)) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateSql = "UPDATE users SET password = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('si', $newHashedPassword, $userId);

        if ($updateStmt->execute()) {
            $_SESSION['success_message'] = 'Password changed successfully.';
        } else {
            $_SESSION['error_message'] = 'An error occurred while changing your password. Please try again.';
        }
    } else {
        $_SESSION['error_message'] = 'Current password is incorrect.';
    }

    header('Location: editProfile.php'); 
    exit();
} else {
    header('Location: editProfile.php');
    exit();
}
?>
