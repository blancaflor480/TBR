<?php
include('connection.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];


// Handle cancellation
if (isset($_POST['cancel_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    
    // Update the reservation status to 'Cancelled'
    $cancel_query = "UPDATE tbl_reservation SET status = 'Cancelled' WHERE reservation_id = ? AND email = ? AND status = 'Pending'";
    $stmt = mysqli_prepare($conn, $cancel_query);
    mysqli_stmt_bind_param($stmt, "ss", $reservation_id, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Reservation successfully cancelled.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['error'] = "Failed to cancel reservation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TBR</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .reservation-card {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .reservation-header {
            padding: 15px;
            cursor: pointer;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        .reservation-header:hover {
            background-color: #e9ecef;
        }

        .reservation-body {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .reservation-body.active {
            max-height: 1000px;
            padding: 15px;
        }

        .info-row {
            padding: 8px;
            margin-bottom: 8px;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        .info-label {
            font-weight: 600;
            color: #7975fe;
            margin-right: 8px;
        }

        .chevron-icon {
            transition: transform 0.3s;
        }

        .chevron-icon.active {
            transform: rotate(180deg);
        }
        .cancel-btn {
            padding: 6px 12px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .cancel-btn:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .status-badge {
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .alert {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php include('user_sidebar.php'); ?>
        
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php include('user_header.php'); ?>
            
            <!-- Page content-->
            <div class="container-fluid">
                <div class="modal-header">
                    <h4 class="modal-title">Reservation Record</h4>
                </div>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php endif; ?>
                <div class="mt-4">
                <?php
                    $query = "SELECT * FROM tbl_reservation WHERE email = ? ORDER BY check_in_date DESC";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $isPending = $row['status'] == 'Pending';
                            $statusClass = '';
                            
                            switch($row['status']) {
                                case 'Pending':
                                    $statusClass = 'warning';
                                    break;
                                case 'Confirmed':
                                    $statusClass = 'success';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'danger';
                                    break;
                                default:
                                    $statusClass = 'secondary';
                            }
                            ?>
                             <div class="reservation-card">
                                <div class="reservation-header" onclick="toggleReservation(this)">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Check-in Date:</strong> 
                                            <?php echo date('F d, Y', strtotime($row['check_in_date'])); ?>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-<?php echo $statusClass; ?> status-badge mr-2">
                                                <?php echo $row['status']; ?>
                                            </span>
                                           
                                            <i class="fas fa-chevron-down chevron-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="reservation-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-row">
                                                <span class="info-label">Reservation ID:</span>
                                                <?php echo $row['reservation_id']; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Guest Name:</span>
                                                <?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Contact:</span>
                                                <?php echo $row['contact_number']; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Check-in Time:</span>
                                                <?php echo date('h:i A', strtotime($row['check_in_time'])); ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Check-out Time:</span>
                                                <?php echo date('h:i A', strtotime($row['check_out_time'])); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-row">
                                                <span class="info-label">Cottage:</span>
                                                <?php echo $row['cottage'] ?: 'None'; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Room:</span>
                                                <?php echo $row['rooms'] ?: 'None'; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Activities:</span>
                                                <?php echo $row['recreational_activity'] ?: 'None'; ?>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Total Amount:</span>
                                                ₱<?php echo number_format($row['total'], 2); ?>
                                            </div>
                                            <?php if ($row['status'] != 'Cancelled'): ?>
                                                <form method="post" class="mr-2" style="margin-bottom: 0;" onsubmit="return confirmCancel()">
                                                    <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
                                                    <button type="submit" 
                                                            name="cancel_reservation" 
                                                            class="btn btn-danger btn-sm cancel-btn" 
                                                            <?php echo !$isPending ? 'disabled' : ''; ?>
                                                            <?php echo !$isPending ? 'title="Cannot cancel confirmed reservation"' : ''; ?>>
                                                        Cancel
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="alert alert-info">No reservation records found.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script>
        // Previous toggleReservation function remains the same
        
        function confirmCancel() {
            return confirm('Are you sure you want to cancel this reservation?');
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    </script>
    <script>
        function toggleReservation(element) {
            const body = element.nextElementSibling;
            const icon = element.querySelector('.chevron-icon');
            
            // Toggle active class on body
            body.classList.toggle('active');
            
            // Toggle active class on icon for rotation
            icon.classList.toggle('active');
        }
    </script>
</body>
</html>