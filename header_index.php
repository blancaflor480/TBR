<?php
include('connection.php');
?>

<style>


body {
    font-family: 'Montserrat', sans-serif;
}

.fontStyle{
  font-family: 'Montserrat', sans-serif;

}

a {
    text-decoration: none !important;
}

.navstyle{
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0px 5px 18px 1px rgba(0,0,0,0.10);
  background: white;
  padding: 25px;

}
.navbar-nav li a{
  color: black;
}

.navbar-nav li a:hover{
  color: blue;
  background: white !important;
}

.btnLogin{
  font-weight: 700;
    border-radius: 25px;
    padding-left: 20px;
    padding-right: 20px;
    line-height: 30px;
    color: #ffffff;
    
    background-color: #0000d0;   /* #7d1eff; */
    text-transform: uppercase;
    transition: .3s all ease-in-out;

}
.btnLogin:hover{
  background-color: #232c85;   /* #7d1eff; */
  color: white;
  transition: .3s all ease-in-out;
}

.align-center {
  float: none;
    margin: 0 auto;
}

.navbar-toggle{
  background-color: blue;
}

.navbar-toggle .icon-bar{
  background: white;
}

.mt-5 {
  margin-top: 115px;
}




</style>  <!-- Navigation -->


<?php 
      

?>

<link rel="stylesheet" type="text/css" href="style.css">

  <nav class="navbar navbar-fixed-top navstyle navbar-expand-sm" role="navigation" style="zoom: 110%;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" rel="home" href="index.php" title="Imus Institute of Science and Technology">
                  <img style="max-width:100px; margin-top: -10px;"
                  src="img/logotbr.jpg" width="100">
                </a>
       
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav mr-auto">
                </ul>

                <ul class="navbar-nav">
                     <li class="nav-item">
                       <a href="user_login.php">
                           <button class="btn btnLogin">Login</button>
                       </a>
                     </li>
                   </ul>&nbsp;&nbsp;&nbsp;
                   <ul class="navbar-nav">
                     <li class="nav-item">
                       <a href="#" data-toggle="modal" data-target="#registerModal">
                           <button class="btn btnRegister">Register</button>
                       </a>
                     </li>
                   </ul>

                   
                </ul> 
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title text-center">Choose an User type</h5>
         <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <a href="admin_login.php"  class="btn btn-primary btn-block">Login as Admin</a>
        
        <a href="user_login.php"  class="btn btn-outline-primary btn-block">Login as User</a>
        </div>

        </div>
        
      </div>
    </div>

    <!-- Add Modal -->
<div id="registerModal" class="modal fade fontStyle" role="dialog" style="zoom: 90%;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <form action="" method="post" role="form" enctype="multipart/form-data">  
      <div class="modal-header">
        <h4 class="modal-title">Register For New User</h4>
      </div>     

      <div class="modal-body">    
         
          

          <div class="form-group">
            <label for="usr">First Name:</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="usr">Middle Name:</label>
            <input type="text" name="middle_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="usr">Last Name:</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>

          <div class="form-group">
  <label for="usr">Username:</label>
  <input type="text" name="username" id="username" class="form-control" required>
  <div id="username-error" class="text-danger mt-1" style="display: none;"></div>
</div>
          <div class="form-group">
            <label for="usr">Password:</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          
          

        </div>

        <div class="modal-footer">
          <button type="submit" name="addUser" class="btn btn-primary">Register</button>
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>     
        </div>
      </form>
    </div>
  </div>
</div>   

<?php 
  if(isset($_POST["addUser"]))
     {  
        // $img = trim($_FILES['img']['name']);
        $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $middle_name = mysqli_real_escape_string($conn, $_POST["middle_name"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);  
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $password = password_hash($password, PASSWORD_BCRYPT);

      
        
        $query_show = mysqli_query($conn, "SELECT * FROM tbl_user_credentials");
        
        $query = mysqli_query($conn, "SELECT * FROM tbl_user_credentials WHERE username='$username'");
         if(mysqli_num_rows($query) > 0) 
         {
            $_SESSION['danger'] = 'The username already exists'; // Set the success message in the session
             echo '<script> window.location="user_login.php";</script>';              
         }
         else 
         {
           // ones na lumagpas sa 3 yung magreregister sa kanya, i-aalert nya yung baba.
          
              //else, i-eexecute nya yung insert query
              $query_insert = mysqli_query($conn, "INSERT INTO tbl_user_credentials 
                  VALUES('', '$last_name', '$first_name', '$middle_name', 
                  '$username', '$password')");
                if($query_insert)
                {            
                  $_SESSION['success'] = 'Registered Successfully!'; // Set the success message in the session
                   echo '<script> window.location="user_login.php";</script>';              
            
            }
          }
      }

     if(isset($_POST['delete'])){    
        $id = $_POST['delete_ids'];
        $query = mysqli_query($conn, "DELETE FROM tbl_user_credentials WHERE id='$id'");
        if($query) {
          $_SESSION['success'] = 'Data Deleted'; // Set the success message in the session
          echo '<script> window.location="admin_manage_users.php";</script>';              
          
        }
     }
?>  

<style>
#alert_popover{
  position:fixed; 
    bottom: 0px; 
    left: 0px; 
    width: 100%;
    z-index:9999; 
    border-radius:0px;
    background-color: #7975fe;
    
}

#inner-message {
    margin: 0 auto;
    background-color: #7975fe;
    color: white;
    font-size: 1rem;

}

</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let typingTimer;
    const doneTypingInterval = 500; // Wait for 500ms after user stops typing

    $('#username').on('keyup', function() {
        clearTimeout(typingTimer);
        const username = $(this).val();
        
        // Only check if username is not empty
        if (username) {
            typingTimer = setTimeout(function() {
                checkUsername(username);
            }, doneTypingInterval);
        } else {
            $('#username-error').hide();
        }
    });

    function checkUsername(username) {
        $.ajax({
            url: 'check_username.php',
            type: 'POST',
            data: {username: username},
            success: function(response) {
                if(response === 'exists') {
                    $('#username-error').html('This username is already taken').show();
                    $('button[name="addUser"]').prop('disabled', true);
                } else {
                    $('#username-error').hide();
                    $('button[name="addUser"]').prop('disabled', false);
                }
            }
        });
    }
});
</script>























