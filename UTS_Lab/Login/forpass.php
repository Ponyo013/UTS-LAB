<?php
    session_start();
    $success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['success'], $_SESSION['error']);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLE SHEET -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styleForm.css">

    <!-- SCRIPT JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <title>Online To-Do List</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forpass-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>

                    <?php if ($success): ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <div><?php echo $success; ?></div>
                    </div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Change Password">
                    </div>
                   
                </form>
                <div class="link login-link text-center">Back to <a href="login.php">Login</a></div>
            </div>
        </div>
    </div>
</body>
</html>
