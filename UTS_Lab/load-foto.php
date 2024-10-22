<?php 
  $userId = $_SESSION['user_id'];

  $sql = "SELECT image, username, email FROM users WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $stmt->store_result();

  $stmt->bind_result($image, $username, $email);
  $stmt->fetch();

  $image = !empty($image) ? $image : 'uploads/default.jpg';
?>
