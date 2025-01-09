<?php 
session_start();
require "connection.php";
$username = "";
$email = "";
$name = "";
$errors = array();

     //if user click verification code submit button
    if(isset($_POST["login"])) {
       $username = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
       $check_username = "SELECT * FROM tbl_admin_credentials WHERE username = '$username'";
       $res = mysqli_query($conn, $check_username);
       if(mysqli_num_rows($res) > 0){
           $fetch = mysqli_fetch_assoc($res);
           $fetch_pass = $fetch['password'];
           if(password_verify($password, $fetch_pass)){
               $_SESSION['username'] = $username;
               $status = $fetch['status'];
                 $_SESSION['username'] = $username;
                 $_SESSION['password'] = $password;
                   header('location: admin_manage_users.php');
               
               echo "<script>console.log('{$username}');</script>";


           }

           else{
               $errors['username'] = "Incorrect username or password!"; // validates when user or pass incorrect
           }
       }
       else{
           $errors['username'] = "Incorrect username or password!"; // validates user and pass are not registered but shows "Incorrect" for security.
       }
    }

     //if user click verification code submit button
    else if(isset($_POST["login_user"])) {
       $username = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
       $check_username = "SELECT * FROM tbl_user_credentials WHERE username = '$username'";
       $res = mysqli_query($conn, $check_username);
       if(mysqli_num_rows($res) > 0){
           $fetch = mysqli_fetch_assoc($res);
           $fetch_pass = $fetch['password'];
           if(password_verify($password, $fetch_pass)){
               $_SESSION['username'] = $username;
               $status = $fetch['status'];
              
                 $_SESSION['username'] = $username;
                 $_SESSION['password'] = $password;
                   header('location: user_transaction.php');
               
               echo "<script>console.log('{$username}');</script>";

           }

           else{
               $errors['username'] = "Incorrect username or password!"; // validates when user or pass incorrect
           }
       }
       else{
           $errors['username'] = "Incorrect username or password!"; // validates user and pass are not registered but shows "Incorrect" for security.
       }
    }







    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: admin_login.php');
    }
?>