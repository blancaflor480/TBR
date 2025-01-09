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
    <title>TBR</title>
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

        .text-warning { color: #ffc107 !important; font-weight: bold; }
.text-primary { color: #007bff !important; font-weight: bold; }
.text-info { color: #17a2b8 !important; font-weight: bold; }
.text-success { color: #28a745 !important; font-weight: bold; }
.text-danger { color: #dc3545 !important; font-weight: bold; }
.text-secondary { color: #6c757d !important; font-weight: bold; }
</style>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php 
            include('admin_sidebar.php');
         ?>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
          <?php 
            include('header.php');
         ?>  
            <!-- Page content-->
            <div class="container-fluid">
    <br>
    <h3>Reservations</h3>
    <br>
    <?php 
        // Fetch reservations data
        $res = mysqli_query($conn, "SELECT * FROM tbl_reservation ORDER BY id DESC");
        if ($res) {
            $rowcount = mysqli_num_rows($res);
        }
    ?>    
    <input type="text" id="searchUser" onkeyup="searchBar()" class="form-control" placeholder="Search by Reservation ID or Guest Name">
    <br>

    <!-- Reservations Table -->
    <table class='table table-bordered table-striped' id="tableUser">
    <thead>
        <tr style="background: #d9d9d9 !important; text-align: center;">
            <th>ID</th>
            <th>Reservation ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Check-In Date</th>
            <th>Check-Out Date</th>
            <th>Cottage</th>
            <th>Rooms</th>
            <th>Recreational Activity</th>
            <th>Other Amenities</th>
            <th>Status</th>
            <th>Total</th>
            <th>Actions</th>                                                           
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_array($res)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?> </td>
            <td><?php echo $row["reservation_id"]; ?></td>
            <td><?php echo $row["first_name"]; ?></td>
            <td><?php echo $row["last_name"]; ?></td>
            <td><?php echo $row["contact_number"]; ?></td>
            <td><?php echo $row["check_in_date"]; ?></td>
            <td><?php echo $row["check_out_date"]; ?></td>
            <td><?php echo $row["cottage"]; ?></td> <!-- Display Cottage -->
            <td><?php echo $row["rooms"]; ?></td> <!-- Display Rooms -->
            <td><?php echo $row["recreational_activity"]; ?></td> <!-- Display Recreational Activities -->
            <td><?php echo $row["other_amenities"]; ?></td> <!-- Display Other Amenities -->
            <td><?php echo $row["status"]; ?></td>
            <td><?php echo $row["total"]; ?></td>
            <td>
    <button type="button" class="btn btn-sm btn-primary changeStatus" 
            data-toggle="modal" 
            data-target="#changeStatusModal" 
            data-id="<?php echo $row['id']; ?>"
            data-status="<?php echo $row['status']; ?>">
        Change Status
    </button>
</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>

<div id="changeStatusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Update Reservation Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="reservation_id" id="status_reservation_id">
                    <div class="form-group">
                        <label>Status:</label>
                        <select name="new_status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Checked In">Checked In</option>
                            <option value="Checked Out">Checked Out</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateStatus" class="btn btn-primary">Update Status</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Reservation Modal -->
<!-- Add Reservation Modal -->
<div id="addReservation" class="modal fade fontStyle" role="dialog" style="zoom: 90%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">  
                <div class="modal-header">
                    <h4 class="modal-title">Add New Reservation</h4>
                </div>
                <div class="modal-body">
                    <!-- Fields for tbl_reservation -->
                    <?php 
                    $fields = [
                        'reservation_id' => 'Reservation ID',
                        'first_name' => 'First Name',
                        'middle_name' => 'Middle Name',
                        'last_name' => 'Last Name',
                        'age' => 'Age',
                        'gender' => 'Gender',
                        'contact_number' => 'Contact Number',
                        'address' => 'Address',
                        'nationality' => 'Nationality',
                        'no_of_guest' => 'Number of Guests',
                        'check_in_date' => 'Check-In Date',
                        'check_out_date' => 'Check-Out Date',
                        'check_in_time' => 'Check-In Time',
                        'check_out_time' => 'Check-Out Time',
                        'status' => 'Status',
                        'additional_guests' => 'Additional Guests',
                        'sub_total' => 'Subtotal',
                        'total' => 'Total'
                    ];
                    // Render regular fields
                    foreach ($fields as $name => $label) {
                        echo "<div class='form-group'>
                                <label for='$name'>$label:</label>
                                <input type='text' name='$name' class='form-control' required>
                              </div>";
                    }
                    ?>

                    <!-- Cottage Checkboxes -->
                    <div class="form-group">
                        <label>Cottage:</label><br>
                        <label><input type="checkbox" name="cottage" value="Pavillion"> Pavillion</label><br>
                        <label><input type="checkbox" name="cottage" value="Small Hut"> Small Hut</label><br>
                        <label><input type="checkbox" name="cottage" value="Big Hut"> Big Hut</label><br>
                        <label><input type="checkbox" name="cottage" value="Cabana"> Cabana</label><br>
                        <label><input type="checkbox" name="cottage" value="Round Picnic Hut"> Round Picnic Hut</label><br>
                        <label><input type="checkbox" name="cottage" value="Tent Pitching"> Tent Pitching</label>
                    </div>

                    <!-- Rooms Checkboxes -->
                    <div class="form-group">
                        <label>Rooms:</label><br>
                        <label><input type="checkbox" name="rooms" value="Aircon Room (Family)"> Aircon Room (Family)</label><br>
                        <label><input type="checkbox" name="rooms" value="Aircon Room (Standard)"> Aircon Room (Standard)</label><br>
                        <label><input type="checkbox" name="rooms" value="Aircon Room (Air Fan)"> Aircon Room (Air Fan)</label>
                    </div>

                    <!-- Recreational Activity Checkboxes -->
                    <div class="form-group">
                        <label>Recreational Activities:</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Banana Boat"> Banana Boat</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Island Hopping"> Island Hopping</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Kayak"> Kayak</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Snorkelling"> Snorkelling</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Fishing"> Fishing</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Bonfire"> Bonfire</label><br>
                        <label><input type="checkbox" name="recreational_activity" value="Volleyball"> Volleyball</label>
                    </div>

                    <!-- Other Amenities Checkboxes -->
                    <div class="form-group">
                        <label>Other Amenities:</label><br>
                        <label><input type="checkbox" name="other_amenities" value="Catering"> Catering</label><br>
                        <label><input type="checkbox" name="other_amenities" value="Light and Sounds Rental"> Light and Sounds Rental</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="addData" class="btn btn-primary">Add Reservation</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>





                <!-- Update Modal -->
                <div id="editReservation" class="modal fade" role="">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form action="" method="post">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Damage</h4>
                      </div>     
                      <div class="modal-body">      
                        <input id="update_admin_id" name="update_admin_id" type="hidden">
                            
                           <div class="form-group">
                              <label for="usr">City</label>
                              <input type="text" name="city" id="city" class="form-control">
                            </div>    
                            <div class="form-group">
                              <label for="usr">Total:</label>
                              <input type="text" name="total" id="total" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="usr">Description:</label>
                              <input type="text" name="description" id="description" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="usr">Areas:</label>
                              <input type="text" name="areas" id="areas" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="submit" name="updateData" class="btn btn-primary">Update</button>
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>     
                        </div>
                      </form>
                    </div>
                  </div>
                </div>     
                <!-- End of Update Modal -->


                <!-- Delete Modal -->
                <div id="deleteAdmin" class="modal fade fontStyle" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Damage</h4>
                        </div>
                      <form action="" method="post">
                        <div class="modal-body">
                          <input id="delete_id" name="delete_id" type="hidden">
                          <p>Are you sure you want to delete this Damage?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" name="deleteData" class="btn btn-danger">Delete</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </form>
                    </div>  
                  </div>
                </div>
                <?php
                      // Check if the success message is set in the session and display it
                      if (isset($_SESSION['success'])) {
                          echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                          unset($_SESSION['success']); // Clear the success message from the session
                      }
                      else if (isset($_SESSION['danger'])) {
                          echo '<div class="alert alert-danger">' . $_SESSION['danger'] . '</div>';
                          unset($_SESSION['danger']); // Clear the success message from the session
                      }

                      ?>
       <?php 
       if (isset($_POST["addData"])) {
           // Collect data from the form
           $reservation_id = $_POST['reservation_id'];
           $first_name = $_POST['first_name'];
           $middle_name = $_POST['middle_name'];
           $last_name = $_POST['last_name'];
           $age = $_POST['age'];
           $gender = $_POST['gender'];
           $contact_number = $_POST['contact_number'];
           $address = $_POST['address'];
           $nationality = $_POST['nationality'];
           $no_of_guest = $_POST['no_of_guest'];
           $check_in_date = $_POST['check_in_date'];
           $check_out_date = $_POST['check_out_date'];
           $check_in_time = $_POST['check_in_time'];
           $check_out_time = $_POST['check_out_time'];
           $status = $_POST['status'];
           $additional_guests = $_POST['additional_guests'];
           $cottage = $_POST['cottage'];
           $rooms = $_POST['rooms'];
           $recreational_activity = $_POST['recreational_activity'];
           $other_amenities = $_POST['other_amenities'];
           $sub_total = $_POST['sub_total'];
           $total = $_POST['total'];

           // Check if reservation ID already exists
           $query_check = mysqli_query($conn, "SELECT * FROM tbl_reservation WHERE reservation_id='$reservation_id'");
           
           if (mysqli_num_rows($query_check) > 0) {
               echo '<div class="alert alert-danger fontStyle" style="width: 100% !important;">
                       <center> The reservation ID you entered already exists.</center>
                     </div>';
           } else {
               // Insert new reservation data
               $query_insert = mysqli_query($conn, "INSERT INTO tbl_reservation (
                   reservation_id, first_name, middle_name, last_name, age, gender, contact_number, 
                   address, nationality, no_of_guest, check_in_date, check_out_date, check_in_time, 
                   check_out_time, status, additional_guests, cottage, rooms, recreational_activity, 
                   other_amenities, sub_total, total
               ) VALUES (
                   '$reservation_id', '$first_name', '$middle_name', '$last_name', '$age', '$gender', 
                   '$contact_number', '$address', '$nationality', '$no_of_guest', '$check_in_date', 
                   '$check_out_date', '$check_in_time', '$check_out_time', '$status', '$additional_guests', 
                   '$cottage', '$rooms', '$recreational_activity', '$other_amenities', '$sub_total', '$total'
               )");

               if ($query_insert) {            
                   $_SESSION['success'] = 'Data Inserted'; // Set the success message in the session
                   echo '<script> window.location="reservation.php";</script>';                        
               }
           }
       }

       // DELETE reservation logic
       if (isset($_POST['deleteData'])) {    
           $id = $_POST['delete_id'];
           $query_delete = mysqli_query($conn, "DELETE FROM tbl_reservation WHERE id='$id'");
           if ($query_delete) {
               $_SESSION['success'] = 'Successfully Deleted'; // Set the success message in the session
               echo '<script> window.location="reservation.php";</script>';                  
           }
       }
       ?>





        <!-- UPDATE QUERY [EDIT ADMIN USER] -->                 
        <?php 
             if(isset($_POST['updateData'])){    
                $id = $_POST['update_admin_id'];
                $city = $_POST['city'];
                $total = $_POST['total'];
                $description = $_POST['description'];       
                $areas = $_POST['areas'];
                $query = mysqli_query($conn, "UPDATE tbl_admin_damages 
                  SET 
                  city='$city', 
                  total='$total', 
                  description='$description', 
                  areas='$areas
'                  WHERE id='$id'");
              if ($query) {
                    $_SESSION['success'] = 'Successfully Updated'; // Set the success message in the session
                    echo '<script> window.location="admin_damages.php";</script>';
                 }
             }
        ?>


<?php
// Handle manual status updates
if(isset($_POST['updateStatus'])) {
  $reservation_id = $_POST['reservation_id'];
  $new_status = $_POST['new_status'];
  
  $query = mysqli_query($conn, "UPDATE tbl_reservation 
                               SET status='$new_status' 
                               WHERE id='$reservation_id'");
                               
  if($query) {
      $_SESSION['success'] = 'Status Updated Successfully';
      echo '<script>window.location="admin_transaction.php";</script>';
  }
}

// Automated status updates based on dates
$today = date('Y-m-d');
$time_now = date('H:i:s');

// Update status to Done for passed checkout dates
$auto_update = mysqli_query($conn, "UPDATE tbl_reservation 
                                 SET status='Done' 
                                 WHERE check_out_date < '$today' 
                                 AND status != 'Cancelled' 
                                 AND status != 'Done'");

// Update status to Checked In for current check-in date
$check_in_update = mysqli_query($conn, "UPDATE tbl_reservation 
                                     SET status='Checked In' 
                                     WHERE check_in_date = '$today' 
                                     AND status = 'Confirmed'
                                     AND check_in_time <= '$time_now'");
?>

     







    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>


<script>




function searchBar() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchUser");
  filter = input.value.toUpperCase();
  table = document.getElementById("tableUser");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}



</script>

<script>// Handle status change modal
$(document).ready(function(){
    $('.changeStatus').on('click', function(){
        var id = $(this).data('id');
        var currentStatus = $(this).data('status');
        
        $('#status_reservation_id').val(id);
        $('select[name="new_status"]').val(currentStatus);
    });
    
    // Color-code status cells
    $('td:contains("Pending")').addClass('text-warning');
    $('td:contains("Confirmed")').addClass('text-primary');
    $('td:contains("Checked In")').addClass('text-info');
    $('td:contains("Checked Out")').addClass('text-success');
    $('td:contains("Cancelled")').addClass('text-danger');
    $('td:contains("Done")').addClass('text-secondary');
}); 
</script>
<script>
   // Get all the alerts with the "auto-close" class
  var alerts = document.querySelectorAll('.alert');

  // Loop through the alerts and set a timeout function to remove them after 4 seconds
  alerts.forEach(function(alert) {
    setTimeout(function() {
      alert.remove();
    }, 4000);
  });
</script>