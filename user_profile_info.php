<?php 
  include('connection.php');
session_start();

 
  $username_session = $_SESSION['username']; //getting information of the user

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TBR</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
  <div class="d-flex" id="wrapper">
    <?php 
    include('user_sidebar.php');
   ?>
          <div id="page-content-wrapper">
          <?php
            include('header.php');
          ?>

<div class="container  bg-white fontStyle " style="margin-top: 50px !important;">

<?php 
     if(isset($_POST['updateData'])){    
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = mysqli_query($conn, "UPDATE tbl_user_credentials SET last_name='$last_name', first_name='$first_name', middle_name='$middle_name', 
        username='$username_session', password='$password' WHERE username='$username'");
        if($query) 
        {
            echo '<div class="alert alert-success" style="width: 100% !important; ">
                    <center>
                        Successfully Updated
                    </center>
            </div>';
        }
     }
?> 
<h2 class="text-center font-weight-bold">Profile Info</h2>
  
  <div class="row p-3">

<!-- <button class="btn btn-primary btn-sm " data-toggle="modal" data-target="#addBtn">Update Information</button>             -->
 <?php 
      if(!isset($_SESSION['username'])) { ?>

     <p class="text-center">In order to use this part of the reservation system, you must log in first.</p>
        
        <p class="text-center"><a href="login2.php">LOG IN NOW.</a></p>';
    <?php  } 

      else{
        $infoUser = mysqli_query($conn, "SELECT * from tbl_user_credentials where username = '$username_session'");
        while($row = mysqli_fetch_array($infoUser)) { ?>
       
    <form action="" method="post">
        <div class="form-group mt-2">
            <label for="usr">Last Name:</label>
                  <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" 
                  required value="<?php echo $row['last_name']; ?>">
          </div>
        
          <div class="form-group mt-2">
            <label for="usr">First Name:</label>
                  <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" required value="<?php echo $row['first_name']; ?>">
          </div>

          <div class="form-group mt-2">
            <label for="usr">Middle Name:</label>
                  <input type="text" class="form-control form-control-sm" name="middle_name" id="middle_name" required value="<?php echo $row['middle_name']; ?>">
          </div>

          <div class="form-group mt-2">
            <label for="usr">Username:</label>
                  <input type="text" class="form-control form-control-sm" name="username" readonly id="username" required value="<?php echo $row['username']; ?>">
          </div>
      

          <div class="form-group mt-2">
            <label for="usr">Password:</label>
              <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-sm" name="password" id="showpass" required name="showpass" 
                  required value="<?php echo $row['password']; ?>">
                   <div class="input-group-append">
                   <button class="btn btn-primary" type="button" onclick='showPass("showpass",this)'><i class="fas fa-eye"></i></button>
                     </div>
                   </div>
          </div>
          
        <div class="form-group mt-2 float-right">
          <button type="submit" name="updateData" class="btn btn-primary btn-sm">Update</button>
           
        </div>           
    </form>
<?php 
      }
    }
      ?>
  
</div>
  </div>
</div>
</div>
 


<!-- End of Add Modal --> 

</body>
</html>
 <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

<script>

  // hide and show password
function showPass(pass_id,icon_element) {
  var x = document.getElementById(pass_id);
  var iconChange = document.getElementById("changeIcon");

  if (x.type === "password") {
    x.type = "text";
    icon_element.innerHTML = "<i class='fa fa-eye-slash'></i>";

  } else {
    x.type = "password";
    icon_element.innerHTML = "<i class='fa fa-eye'></i>";
  }
}

</script>