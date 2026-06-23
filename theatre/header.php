<?php  
session_start();
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/adminstyle.css"> 
    <style>
        body {
            background-color: #f4f6f9;
        }
       
        .main-sidebar {
            background-color: #343a40;
            height: 100vh;
            position: fixed;
            width: 230px;
            padding-top: 50px;
        }
        .main-sidebar .sidebar {
            padding-top: 0;
        }
        .main-sidebar .sidebar .sidebar-menu li a {
            color: white;
            font-size: 16px;
                                }
        .main-sidebar .sidebar .user-panel {
            padding: 10px;
            color: white;           
        }
        .main-sidebar .sidebar .user-panel .image img {
            width: 45px;
            height: 45px;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

    <!-- Main Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 60px;">
            <a href="index.php" class="navbar-brand">Theatre Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                            <img src="theaterpic.png" class="user-image" alt="User Image">
                            <span>Theater Manager</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header text-center">
                                <img src="theaterpic.png" class="img-circle" alt="User Image">
                                <p style="color: black; margin-top: 5px;">Theatre Assistant</p>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-footer">
                                <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper">
        <!-- Left side column contains the sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="theaterpic.png" class="img-circle" alt="User Image" style="margin-left: 20px;">
                    </div>
                    <div class="pull-left info">
                        <p style="margin-left: 20px; margin-top: 7px; color: white;">Theater Manager</p>
                        <a href="#"><i class="fa fa-circle text-success" style="margin-left: 20px;"></i> Online</a>
                    </div>
                </div>
                <!-- Sidebar menu -->
                <ul class="sidebar-menu">
                    
                    <li class="treeview" style="list-style-type: none;">
                        <a href="index.php">
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    
                    <li class="treeview" style="list-style-type: none;">
                        <a href="add_movie.php">
                            <i class="fa fa-plus"></i> <span>Add Movie</span>
                        </a>
                    </li>
                   
                    <li class="treeview" style="list-style-type: none;">
                        <a href="view_movies.php">
                            <i class="fa fa-film"></i> <span>View Movies</span>
                        </a>
                    </li>
                   
                    <li class="treeview" style="list-style-type: none;">
                        <a href="add_show.php">
                            <i class="fa fa-calendar-plus"></i> <span>Add Show</span>
                        </a>
                    </li>
                   
                    <li class="treeview" style="list-style-type: none;">
                        <a href="view_shows.php">
                            <i class="fa fa-calendar"></i> <span>View Shows</span>
                        </a>
                    </li>
              
                    <li class="treeview" style="list-style-type: none;">
                        <a href="theatre_details.php">
                            <i class="fa fa-info-circle"></i> <span>Theatre Details</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>

        <!-- Main content of the page goes here -->
        <div class="content-wrapper">
            <div class="content">
                <!-- Your main content will be displayed here -->
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
