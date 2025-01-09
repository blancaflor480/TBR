<?php
include('connection.php');
session_start();

// Add this function definition and variable here
function getNextReservationId($conn) {
  // Get the highest reservation_id from the table
  $query = mysqli_query($conn, "SELECT reservation_id FROM tbl_reservation ORDER BY CAST(SUBSTRING(reservation_id, 4) AS UNSIGNED) DESC LIMIT 1");
  $result = mysqli_fetch_assoc($query);
  
  
  if ($result) {
    // If records exist, get the last ID number and increment
    $last_id = intval(substr($result['reservation_id'], 3)); // Remove 'RS_' prefix
    $next_id = $last_id + 1;
} else {
    // If no records exist, start from 1001
    $next_id = 1001;
}
  // Format the ID with 'R' prefix
  return sprintf("RS_%d", $next_id);
}

// Generate the next ID before the form is rendered
$next_reservation_id = getNextReservationId($conn);
// Get the username from the session
if (!isset($_SESSION['username'])) {
  // Redirect to login page if user is not logged in
  header("Location: index.php");
  exit();
}
$username = $_SESSION['username'];

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
    <?php 
        // Fetch reservations data
        $res = mysqli_query($conn, "SELECT * FROM tbl_reservation ORDER BY id DESC");
        if ($res) {
            $rowcount = mysqli_num_rows($res);
        }
    ?>    


</div>


            <form action="" method="post">  
                <div class="modal-header">
                    <h4 class="modal-title">Add New Reservation</h4>
                </div>
                <div class="modal-body">
                    <!-- Fields for tbl_reservation -->
                    <?php 

echo "<div class='form-group'>
        <label for='reservation_id'>Reservation ID:</label>
        <input type='text' name='reservation_id' class='form-control' value='$next_reservation_id' readonly required>
      </div>";
      
                    $fields = [
                        'first_name' => 'First Name',
                        'middle_name' => 'Middle Name',
                        'last_name' => 'Last Name',
                        'age' => 'Age',
                        'contact_number' => 'Contact Number',
                        'address' => 'Address',
                        'nationality' => 'Nationality',
                        'no_of_guest' => 'Number of Guests',

                        'additional_guests' => 'Additional Guests'
                        
                    ];
                    // Render regular fields
                    foreach ($fields as $name => $label) {
                        echo "<div class='form-group'>
                                <label for='$name'>$label:</label>
                                <input type='text' name='$name' class='form-control' required>
                              </div>";
                    }
                    echo "<div class='form-group'>
        <label for='gender'>Gender:</label>
        <select name='gender' class='form-control' required>
            <option value=''>Select Gender</option>
            <option value='Male'>Male</option>
            <option value='Female'>Female</option>
        </select>
      </div>";
      
      echo "<div class='form-group'>
        <label for='check_in_date'>Check-In Date:</label>
        <input type='date' name='check_in_date' class='form-control' required>
      </div>
      <div class='form-group'>
        <label for='check_in_time'>Check-In Time:</label>
        <input type='time' name='check_in_time' class='form-control' required>
      </div>";

// Check-out date and time
echo "<div class='form-group'>
        <label for='check_out_date'>Check-Out Date:</label>
        <input type='date' name='check_out_date' class='form-control' required>
      </div>
      <div class='form-group'>
        <label for='check_out_time'>Check-Out Time:</label>
        <input type='time' name='check_out_time' class='form-control' required>
      </div>";

  echo "<div class='form-group'>
      <label for='sub_total'>Subtotal:</label>
      <input type='text' name='sub_total' class='form-control' readonly>
  </div>";

  echo "<div class='form-group'>
      <label for='total'>Total:</label>
      <input type='text' name='total' class='form-control' readonly>
  </div>";

// Status dropdown (assuming you want this as a dropdown as well)
echo "<div class='form-group'>
        <label for='status'>Status:</label>
        <input type='hidden' name='status' value='Pending'>
        <input type='text' class='form-control' value='Pending' readonly>
      </div>";


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
                    <div class="form-group">
                        <button type="submit" name="addData" class="btn btn-primary">Add Reservation</button>
                    </div>
                </div>
                
            </form>
 





                <!-- Update Modal -->
                <div id="editBtnAdmin" class="modal fade" role="">
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
           $username = $_SESSION['username'];
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


            // Get username from session
    
           // Check if reservation ID already exists
           $query_check = mysqli_query($conn, "SELECT * FROM tbl_reservation WHERE reservation_id='$reservation_id'");
           
           if (mysqli_num_rows($query_check) > 0) {
               echo '<div class="alert alert-danger fontStyle" style="width: 100% !important;">
                       <center> The reservation ID you entered already exists.</center>
                     </div>';
           } else {
               // Insert new reservation data
               $query_insert = mysqli_query($conn, "INSERT INTO tbl_reservation (
                   reservation_id, username,first_name, middle_name, last_name, age, gender, contact_number, 
                   address, nationality, no_of_guest, check_in_date, check_out_date, check_in_time, 
                   check_out_time, status, additional_guests, cottage, rooms, recreational_activity, 
                   other_amenities, sub_total, total
               ) VALUES (
                   '$reservation_id', '$username','$first_name', '$middle_name', '$last_name', '$age', '$gender', 
                   '$contact_number', '$address', '$nationality', '$no_of_guest', '$check_in_date', 
                   '$check_out_date', '$check_in_time', '$check_out_time', '$status', '$additional_guests', 
                   '$cottage', '$rooms', '$recreational_activity', '$other_amenities', '$sub_total', '$total'
               )");

               if ($query_insert) {            
                   $_SESSION['success'] = 'Data Inserted'; // Set the success message in the session
                   echo '<script> window.location="user_transaction.php";</script>';                        
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

     






<script src="js/pricing-calculator.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>


<script>
    $(document).ready(function(){
        $('.deleteAdmin').on('click', function(){
            
         //   $('#deleteUser').modal('show');

       //     $('#deleteUser').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
      //          console.log(data);
            }).get();
            $('#delete_id').val(data[0]);          
        });
    });




 $(document).ready(function(){
        $('.deleteUser').on('click', function(){
            
         //   $('#deleteUser').modal('show');

       //     $('#deleteUser').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
      //          console.log(data);
            }).get();
            $('#delete_ids').val(data[0]);          
        });
    });



$(document).ready(function(){
    $('.editBtnAdmin').on('click', function(){      
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
          //      console.log(data);
            }).get();
            $('#update_admin_id').val(data[0]);
            $('#city').val(data[1]);
            $('#total').val(data[2]);
            $('#description').val(data[3]);
            $('#areas').val(data[4]);   
    });
 });




$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});



 var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


$('input[type="file"]'). change(function(e){
    fileName = e. target. files[0]. name;
    $('#imgLabel').text(fileName);
    $('#imgPreview').attr('src','images/'+fileName);
});



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