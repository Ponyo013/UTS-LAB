<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require "mydb.php";
    require "load-foto.php";
}

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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SCRIPT JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="script.js"></script><script defer src="script-val.js"></script>
    <script defer src="script-color.js"></script>
    <title>Online To-Do List</title>
</head>
<body>
    <div class="wrapper">
        <!-- SIDE BAR -->
        <?php require_once 'sidebar.php';?>

        <div class="main my-4 mx-5">
            <!-- HEADER -->
            <div id="Header" class="d-flex justify-content-between">
                <!-- WELCOME -->
                <div>
                <h6><b>Welcome Back, <?php echo isset($username) ? htmlspecialchars($username) : 'Guest'; ?></b></h6>
                    <p class="text-secondary">
                        <small><?php echo date('M d, Y'); ?></small>
                    </p>
                </div>
                <div class="h-50">
                    <?php if (isset($username)): ?>
                        <button type="button" class="btn text-white ms-4" data-bs-toggle="modal" data-bs-target="#createModal" style="background: #6665ee;">
                            <b>&nbsp;<i class="lni lni-plus py-1"></i>&nbsp;&nbsp;Create New Task</b>
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn text-white ms-4" data-bs-toggle="modal" data-bs-target="#loginWarningModal" style="background: #6665ee;">
                            <b>&nbsp;<i class="lni lni-plus py-1"></i>&nbsp;&nbsp;Create New Task</b>
                        </button>
                    <?php endif; ?>
                </div>


                <!-- MODAL CREATE TASK -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #6665ee;">
                                <h1 class="modal-title fs-5 text-white" id="createModalLabel">Create New Task</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-secondary">
                                <form id="createTaskForm" method="POST" action="create-task.php">
                                    <!-- Input Task -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="taskInput" name="user_task" required placeholder="Enter your task here...">
                                        <label for="taskInput">Enter Your Task here....</label>
                                    </div>

                                    <!-- Select Priority -->
                                    <label class="">Priority:</label>
                                    <select id="prioritySelect" class="form-select w-25 rounded-5 text-white" name="priority" aria-label="Default select example">
                                        <option value="High" selected>High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer border border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="createTaskForm" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- PROGRESS -->
            <?php require "con-task.php"?>
            <div id="Progress" class="d-flex">
                <!-- TASK LEFT -->
                <div class="bg-white p-4 rounded-3">
                    <div class="container mx-5">
                        <i id="LogoTask" class="lni lni-pencil-alt rounded-circle p-3 mb-2"></i>
                        <p>Task Left</p>
                        <h1><?php echo $totalLeft; ?></h1>
                    </div>
                </div>
                
                <!-- TASK STATUS -->
                <div class="bg-white px-3 ms-3 me-2 w-50 rounded-3">
                    <div class="d-flex justify-content-between p-4 mx-3">
                        <div>
                            <i id="Done" class="lni lni-checkmark rounded-circle p-3 mb-2"></i>
                            <p class="text-center">Done</p>
                            <h1><?php echo $totalDone; ?></h1>
                        </div>
                        <div>
                            <i id="In" class="lni lni-hourglass rounded-circle p-3 mb-2"></i>
                            <p class="text-center">In Progress</p>
                            <h1><?php echo $totalInProgress; ?></h1>
                        </div>
                        <div>
                            <i id="Queue" class="lni lni-layers rounded-circle p-3 mb-2"></i>
                            <p class="text-center">In Queue</p>
                            <h1><?php echo $totalInQueue; ?></h1>
                        </div>
                    </div>
                </div>

                <!-- PROFILE BOX -->
                <div class="ms-5 bg-white w-25 rounded-3 text-center">
                    <img src="<?php echo isset($image) ? htmlspecialchars($image): 'uploads/default.jpg'; ?>" alt="Foto Profile" class="mt-3 img-fluid rounded-circle mb-3" style="width: 90px; height: 90px; object-fit: cover;">
                    <div>
                        <p class="mb-0"><?php echo isset($username) ? htmlspecialchars($username) : 'Guest'; ?></p>
                        <p class="mb-0 text-muted" style="font-size: .8rem;"><?php echo isset($username) ? htmlspecialchars($email) : 'No email registered'; ?></p>
                    </div>
                </div>
            </div>
            
            <!-- TASK VIEW -->
            <div class="container mt-4 bg-white py-2 rounded-3">
                <div id="scrollableDiv" style="max-height: 370px; overflow-y: auto; overflow-x: hidden;">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="taskFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter Tasks
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="taskFilter">
                                <li><a class="dropdown-item" href="#" onclick="filterTasks('all')">All</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterTasks('done')">Done</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterTasks('not-done')">Not Done</a></li>
                            </ul>
                        </div>
                    </div>
                    <table id="TaskTable" class="table" style="width:100%">
                        <thead>
                            <tr id="table-head">
                                <th style="min-width: 150px;">Task</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    require "data.php";
                                }
                             ?>
                        </tbody>
                    </table>
                </div>
                
                
                <!-- MODAL EDIT -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5 text-white" id="editModalLabel">Edit Data</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="edit-task.php" method="POST" enctype="multipart/form-data">
                                    <!-- Task ID (readonly) -->
                                    <div class="form-floating my-3">
                                        <input type="hidden" class="form-control" name="task_id" id="editTaskId" placeholder="Task ID" readonly>
                                    </div>
                                    
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="task" id="editTasks" placeholder="Halo">
                                        <label for="editTask">Task</label>
                                    </div>
                                    
                                    <!-- Status Selection -->
                                    <label class="text-secondary">Status:</label>
                                    <select id="statusSelect" class="form-select w-50 rounded-5 text-white mb-3" name="status">
                                        <option value="Done">Done</option>
                                        <option value="In progress">In Progress</option>
                                        <option value="In queue">In Queue</option>
                                    </select>


                                    <!-- Priority Selection -->
                                    <label class="text-secondary">Priority:</label>
                                    <select id="editPrioritySelect" class="form-select w-25 rounded-5 text-white" name="priority" aria-label="Default select example">
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer border border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" form="editForm">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Warning Modal -->
                <div class="modal fade" id="loginWarningModal" tabindex="-1" aria-labelledby="loginWarningModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #6665ee;">
                                <h1 class="modal-title fs-5 text-white" id="loginWarningModalLabel">Warning</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-secondary">
                                You must be logged in to create new task or update profile.
                            </div>
                            <div class="modal-footer border border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="Login/login.php" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL DELETE -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h1 class="modal-title fs-5 text-white" id="deleteModalLabel">Delete Data</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="deleteForm" action="delete-task.php" method="POST"> 
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="task_id" id="deleteInput" placeholder="Task ID" readonly>
                                    <label for="caption" class="">Are you sure you want to delete this Task?</label>           
                                </div>
                            </form>
                            <div class="modal-footer border border-0">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" form="deleteForm">Delete</button>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
