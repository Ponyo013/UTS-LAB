<?php
session_start();

require "mydb.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_task = $_POST['user_task'];
    $priority = $_POST['priority'];

    $stmt = $conn->prepare("INSERT INTO tasks (user_id, user_task, status, priority) VALUES (?, ?, 'In queue', ?)");
    $stmt->bind_param("iss", $user_id, $user_task, $priority);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
