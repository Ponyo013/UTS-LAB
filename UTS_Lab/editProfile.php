<?php
    session_start();
    require "pre-profile.php";
    require "load-foto.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLE SHEET -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- SCRIPT JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script defer src="script.js"></script>
    <title>Online To-Do List</title>
</head>
<body>
    <div class="wrapper">
        <!-- SIDE BAR -->
        <?php require_once 'sidebar.php';?>

        <div class="main my-4 mx-5">
            <div id="Header" class="d-flex my-3">
                <h1>Account Information</h1>
            </div>

            <div class="bg-white rounded-3 p-4 px-5">
                <form id="editProfile" action="edit-profile.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Profile Picture" id="profileImage" class="mt-3 img-fluid rounded-circle mb-3"
                            style="width: 90px; height: 90px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('fileInput').click();">
                        <input type="file" id="fileInput" name="fileInput" style="display: none;" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="row text-secondary">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                        </div>

                        <!-- Right column for Bio -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="6"><?php echo htmlspecialchars($bio); ?></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Messages -->
                <div class="d-flex">
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                                        
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success text-center">
                            <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>
                </div>
                   

                    <!-- Save and Change Password buttons -->
                    <div>
                        <label for="inputPassword5" class="form-label text-secondary">Password and Authentication</label>
                        <div>
                            <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#passwordModal"  
                            style="background: #6665ee;">Change Password</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn text-white" style="background: #6665ee;" form="editProfile">Save Changes</button>
                        </div>
                    </div>
               
                    <!-- Modal -->
                    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background: #6665ee;">
                                    <h5 class="modal-title" id="passwordModalLabel"><b>Change Password</b></h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-secondary">
                                    <form id="passwordForm" action="change-pass.php" method="POST">
                                        <div class="mb-3">
                                            <label for="currentPassword" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                            <div class="invalid-feedback">
                                                Please enter your current password.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                            <div class="invalid-feedback">
                                                Please enter a new password.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                            <div class="invalid-feedback">
                                                Please confirm your new password.
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer border border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn text-white" form="passwordForm" 
                                        style="background: #6665ee;">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
const hamBurger = document.querySelector(".toggle-btn");
hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
</script>
