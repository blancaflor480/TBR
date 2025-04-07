<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TBR | Home Page</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<style>
  .fa-inverse {
            color: #7975fe !important;
        }

        .card {
          border: 1px solid rgba(0,0,0,.06);
          box-shadow: 0 10px 40px 0 rgb(62 57 107 / 7%), 0 2px 9px 0 rgb(62 57 107 / 6%);
        }

</style>
<body>
  
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php 
            include('user_sidebar.php');
         ?>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
          <?php 
            include('user_header.php');
         ?>  
            <!-- Page content-->
            <div class="container-fluid">
                <!-- Hero Section -->
                <div class="jumbotron jumbotron-fluid bg-primary text-white">
                    <div class="container">
                        <h1 class="display-4">Welcome to TBR</h1>
                        <p class="lead">Your one-stop solution for all your reservation needs.</p>
                        <a href="reserve.php" class="btn btn-light btn-lg">Reserve Now</a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Upcoming Reservations</h5>
                                <p class="card-text"><?php echo $rowcount; ?> reservations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Notifications</h5>
                                <p class="card-text">You have 3 new notifications</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Available Services</h5>
                                <p class="card-text">5 services available</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Reserve Now</h5>
                                <a href="reserve.php" class="btn btn-primary">Go to Reservation</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">My Reservations</h5>
                                <a href="my_reservations.php" class="btn btn-primary">View Reservations</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Account Management</h5>
                                <a href="account.php" class="btn btn-primary">Manage Account</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    // Fetch reservations data
                    $res = mysqli_query($conn, "SELECT * FROM tbl_reservation ORDER BY id DESC");
                    if ($res) {
                        $rowcount = mysqli_num_rows($res);
                    }
                ?>    
            </div>
        </div>
    </div>
</body>
</html>