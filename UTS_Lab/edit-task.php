<?php
require_once 'mydb.php';

if (isset($_POST['task_id'], $_POST['task'], $_POST['status'], $_POST['priority'])) {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];

    $query = "UPDATE tasks SET user_task = ?, status = ?, priority = ? WHERE task_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('sssi', $task, $status, $priority, $task_id);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
} else {
    echo "All fields are required!";
}
?>
