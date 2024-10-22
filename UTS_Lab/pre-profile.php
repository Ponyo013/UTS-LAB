<?php 
    require_once 'mydb.php'; 
    $user_id = $_SESSION['user_id']; 

    $sql = "SELECT username, email, bio FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($username, $email, $bio);
        $stmt->fetch();
        $stmt->close();
    }
?>