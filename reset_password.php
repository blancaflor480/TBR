<?php
session_start();
include('tags.php');
include('connection.php');
if (!isset($_SESSION['email'])) {
    header('Location: forget_password.php');
    exit();
}

if (isset($_POST["resetPassword"])) {
    $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    if ($new_password == $confirm_password) {
        $email = $_SESSION['email'];
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);

        $query = mysqli_query($conn, "UPDATE tbl_user_credentials SET password='$new_password' WHERE email='$email'");

        if ($query) {
            $_SESSION['success'] = 'Password reset successfully!';
            echo '<script> window.location="user_login.php";</script>';
        } else {
            $_SESSION['danger'] = 'Password reset failed!';
            echo '<script> window.location="reset_password.php";</script>';
        }
    } else {
        $_SESSION['danger'] = 'Passwords do not match!';
        echo '<script> window.location="reset_password.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/signup.css?v=1.1">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="reset_password.php" method="POST" autocomplete="">
                <div class="title">
                    <img src="img/tbrllogo_transparent.png" alt="TBR Logo" class="logo">
                    <h4>Reset Password</h4>
                    <p>Enter your new password.</p>
                </div>
               
                <?php
                // Show any error messages
                if(!empty($errors)){
                    foreach($errors as $error){
                        echo "<div class='alert alert-danger text-center'>$error</div>";
                    }
                }

                // Show success message if set
                if(isset($_SESSION['success'])){
                    echo "<div class='alert alert-success text-center'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }
                ?>
        
                <div class="form-group">
                    <input class="form-control" type="password" id="new_password" name="new_password" placeholder=" " required>
                    <label for="new_password">New Password</label>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder=" " required>
                    <label for="confirm_password">Confirm Password</label>
                </div>
                
                <div class="form-group">
                    <input class="form-control button" type="submit" name="resetPassword" value="Reset Password">
                </div>
            </form>
        </div>
    </div>
    <script>
    // Add password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const password = document.getElementById('new_password').value;
        const confirmPassword = this.value;
        
        if (password !== confirmPassword) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
    </script>
</body>
</html>