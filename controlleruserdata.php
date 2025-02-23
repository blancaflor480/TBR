<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

     //if user click verification code submit button
    if(isset($_POST["login_admin"])) {
       $email = mysqli_real_escape_string($conn, $_POST['email']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
       $check_email = "SELECT * FROM tbl_admin_credentials WHERE email = '$email'";
       $res = mysqli_query($conn, $check_email);
       if(mysqli_num_rows($res) > 0){
           $fetch = mysqli_fetch_assoc($res);
           $fetch_pass = $fetch['password'];
           if(password_verify($password, $fetch_pass)){
               $_SESSION['email'] = $email;
               $status = $fetch['status'];
                 $_SESSION['email'] = $email;
                 $_SESSION['password'] = $password;
                   header('location: admin_manage_users.php');
               
               echo "<script>console.log('{$email}');</script>";


           }

           else{
               $errors['email'] = "Incorrect email or password!"; // validates when user or pass incorrect
           }
       }
       else{
           $errors['email'] = "Incorrect email or password!"; // validates user and pass are not registered but shows "Incorrect" for security.
       }
    }

     //if user click verification code submit button
    else if(isset($_POST["login_user"])) {
       $email = mysqli_real_escape_string($conn, $_POST['email']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
       $check_email = "SELECT * FROM tbl_user_credentials WHERE email = '$email'";
       $res = mysqli_query($conn, $check_email);
       if(mysqli_num_rows($res) > 0){
           $fetch = mysqli_fetch_assoc($res);
           $fetch_pass = $fetch['password'];
           if(password_verify($password, $fetch_pass)){
               $_SESSION['email'] = $email;
               $status = $fetch['status'];
              
                 $_SESSION['email'] = $email;
                 $_SESSION['password'] = $password;
                   header('location: user_transaction.php');
               
               echo "<script>console.log('{$email}');</script>";

           }

           else{
               $errors['email'] = "Incorrect email or password!"; // validates when user or pass incorrect
           }
       }
       else{
           $errors['email'] = "Incorrect email or password!"; // validates user and pass are not registered but shows "Incorrect" for security.
       }
    }







    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: admin_login.php');
    }
?>