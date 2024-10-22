<?php
require "mydb.php"; 

$totalLeft = 0;
$totalDone = 0;
$totalInProgress = 0;
$totalInQueue = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
    $queries = [
        'total_left' => "SELECT COUNT(*) AS total_left FROM tasks WHERE user_id = ? AND status != ?",
        'total_done' => "SELECT COUNT(*) AS total_done FROM tasks WHERE user_id = ? AND status = ?",
        'total_in_progress' => "SELECT COUNT(*) AS total_in_progress FROM tasks WHERE user_id = ? AND status = ?",
        'total_in_queue' => "SELECT COUNT(*) AS total_in_queue FROM tasks WHERE user_id = ? AND status = ?"
    ];

    $done_status = 'Done';
    $in_progress_status = 'In Progress';
    $in_queue_status = 'In Queue';
    $not_done_status = 'Done'; 

    $totalLeftStmt = $conn->prepare($queries['total_left']);
    $totalLeftStmt->bind_param("is", $user_id, $not_done_status);
    $totalLeftStmt->execute();
    $totalLeftResult = $totalLeftStmt->get_result();
    $totalLeft = $totalLeftResult->fetch_assoc()['total_left'];

    $totalDoneStmt = $conn->prepare($queries['total_done']);
    $totalDoneStmt->bind_param("is", $user_id, $done_status);
    $totalDoneStmt->execute();
    $totalDoneResult = $totalDoneStmt->get_result();
    $totalDone = $totalDoneResult->fetch_assoc()['total_done'];

    $totalInProgressStmt = $conn->prepare($queries['total_in_progress']);
    $totalInProgressStmt->bind_param("is", $user_id, $in_progress_status);
    $totalInProgressStmt->execute();
    $totalInProgressResult = $totalInProgressStmt->get_result();
    $totalInProgress = $totalInProgressResult->fetch_assoc()['total_in_progress'];

    $totalInQueueStmt = $conn->prepare($queries['total_in_queue']);
    $totalInQueueStmt->bind_param("is", $user_id, $in_queue_status);
    $totalInQueueStmt->execute();
    $totalInQueueResult = $totalInQueueStmt->get_result();
    $totalInQueue = $totalInQueueResult->fetch_assoc()['total_in_queue'];

    $totalLeftStmt->close();
    $totalDoneStmt->close();
    $totalInProgressStmt->close();
    $totalInQueueStmt->close();
}

$conn->close();
?>
