<?php
include 'mydb.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $bio = htmlspecialchars($_POST['bio']);
    $userId = $_SESSION['user_id'];

    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['fileInput']['name']);
        $targetFilePath = $targetDir . $fileName;
    
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath; 
            } else {
                echo "Error uploading your file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    if ($imagePath === null) {
    
        $stmt = $conn->prepare("SELECT image FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($existingImagePath);
        $stmt->fetch();
        $imagePath = $existingImagePath;
        $stmt->close();
    }

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, bio = ?, image = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $username, $email, $bio, $imagePath, $userId);

    if ($stmt->execute()) {
        $_SESSION['image'] = $imagePath;
        header("Location: editProfile.php");
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
