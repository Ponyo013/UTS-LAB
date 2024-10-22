<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLE SHEET -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- SCRIPT JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script defer src="script.js"></script>
    <title>Online To-Do List</title>

</head>
<body>
     <!-- SIDE BAR -->
     <aside id="sidebar" class="m-4 px-3">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a href="dashboard.php">To-Do List</a>
             </div>
        </div>
        <ul class="sidebar-nav">
            <?php if (isset($username)): ?>
                <a href="editProfile.php" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            <?php else: ?>
                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#loginWarningModal">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            <?php endif; ?>
            <li class="sidebar-item  mb-3">
                 <a href="dashBoard.php" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Task</span>
                 </a>
            </li>
            <a href="Login\login.php" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </ul>
    </aside>
</body>
</html>
