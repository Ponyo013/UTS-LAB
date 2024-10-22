<?php
include 'mydb.php'; 

$user_id = $_SESSION['user_id'];
$sql = "SELECT task_id, user_task, status, priority FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-status='" . htmlspecialchars($row['status']) . "'>";
        echo "<td>" . htmlspecialchars($row['user_task']) . "</td>";

        $statusClass = match($row['status']) {
            'Done' => 'status-done',
            'In progress' => 'status-in-progress',
            'In queue' => 'status-in-queue',
            default => ''
        };
        echo "<td><span class='$statusClass text-white px-4 rounded-5'>" . htmlspecialchars($row['status']) . "</span></td>";

        $priorityClass = match($row['priority']) {
            'Low' => 'priority-low',
            'Medium' => 'priority-medium',
            'High' => 'priority-high',
            default => ''
        };
        echo "<td><span class='$priorityClass text-white px-4 rounded-5'>" . htmlspecialchars($row['priority']) . "</span></td>";

      
        echo "<td>
                 <button class='btn btn-success btn-sm edit-btn'
                    data-bs-toggle='modal' 
                    data-bs-target='#editModal' 
                    data-task-id='" . htmlspecialchars($row['task_id']) . "' 
                    data-tasks='" . htmlspecialchars($row['user_task']) . "' 
                    data-status='" . htmlspecialchars($row['status']) . "' 
                    data-priority='" . htmlspecialchars($row['priority']) . "'>
                    Edit
                </button>

                <button class='btn btn-danger btn-sm delete-btn'
                    data-bs-toggle='modal' 
                    data-bs-target='#deleteModal' 
                    data-task-id='" . htmlspecialchars($row['task_id']) . "'>Delete
                </button>
            </td>";
        echo "</tr>";
    }
}
?>
