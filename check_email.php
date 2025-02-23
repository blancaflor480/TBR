<?php
// check_username.php
include 'connection.php'; // Include your database connection

if(isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $query = mysqli_query($conn, "SELECT email FROM tbl_user_credentials WHERE email='$email'");
    
    if(mysqli_num_rows($query) > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }
}
?>