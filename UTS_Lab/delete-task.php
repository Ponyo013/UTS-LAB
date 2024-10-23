<?php
session_start();

require "mydb.php";

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    $deleteStmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ? AND user_id = ?");
    $user_id = $_SESSION['user_id']; 
    $deleteStmt->bind_param("ii", $task_id, $user_id);

    if ($deleteStmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error deleting task: " . $conn->error;
    }

    $deleteStmt->close();
} else {
    echo "No task ID provided.";
}

$conn->close();
?>
