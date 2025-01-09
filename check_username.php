<?php
// check_username.php
include 'connection.php'; // Include your database connection

if(isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    
    $query = mysqli_query($conn, "SELECT username FROM tbl_user_credentials WHERE username='$username'");
    
    if(mysqli_num_rows($query) > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }
}
?>