<?php 
require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');


if (isset($_POST["addUser"])) {
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $middle_name = mysqli_real_escape_string($conn, $_POST["middle_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $query = mysqli_query($conn, "SELECT * FROM tbl_user_credentials WHERE email='$email'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['danger'] = 'The email already exists!';
        echo '<script> window.location="user_register.php";</script>';
    } else {
        $query_insert = mysqli_query($conn, 
        "INSERT INTO tbl_user_credentials (last_name, first_name, middle_name, email, password) 
         VALUES ('$last_name', '$first_name', '$middle_name', '$email', '$password')");
    
        
        if ($query_insert) {
            $_SESSION['success'] = 'Registered Successfully!';
            echo '<script> window.location="user_login.php";</script>';
        } else {
            $_SESSION['danger'] = 'Registration failed!';
            echo '<script> window.location="user_register.php";</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBR REGISTER</title>
    <link rel="stylesheet" href="css/signup.css?v=1.1"><!--force css-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Add jQuery for AJAX -->
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="user_register.php" method="POST" autocomplete="">
                <div class="title">
                    <img src="img/tbrllogo_transparent.png" alt="TBR Logo" class="logo">
                    <h4>Register for a New Account</h4>
                    <p>Create an account to access all features.</p>
                </div>
               
                <?php
                if(count($errors) > 0){
                    ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        foreach($errors as $showerror){
                            echo $showerror;
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
        
                <div class="form-group">
                    <input class="form-control" type="text" name="first_name" placeholder=" " required>
                    <label for="firstname">First Name</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="middle_name" placeholder=" " required>
                    <label for="middlename">Middle Name</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="last_name" placeholder=" " required>
                    <label for="lastname">Last Name</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Email</label>
                    <div id="email-error" class="text-danger mt-1" style="display: none;"></div> <!-- Error message for email -->
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" id="password" name="password" placeholder=" " required>
                    <label for="password">Password</label>
                    <span id="toggle-password" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">👁️</span> <!-- Show/Hide Password -->
                    
                </div>
                <div class="form-group text-right">
                <input type="checkbox" name="Terms & Condition" required>
                <span for="Terms & Condition"> Terms & Condition</span><br>
                 </div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="addUser" value="Sign Up">
                </div>
                <p class="text-center" style="margin:10px"><a href="user_login.php">Already have an account?</a></p>
            </form>
        </div>
    </div>

    <script>
        // Show/Hide Password
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.textContent = '🙈'; // Change icon to "hide"
            } else {
                passwordInput.type = 'password';
                this.textContent = '👁️'; // Change icon to "show"
            }
        });

        // Email Validation (AJAX)
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailError = document.getElementById('email-error');

            if (email) {
                $.ajax({
                    url: 'check_email.php', // PHP file to check email
                    type: 'POST',
                    data: { email: email },
                    success: function(response) {
                        if (response === 'exists') {
                            emailError.textContent = 'Email already exists!';
                            emailError.style.display = 'block';
                        } else {
                            emailError.style.display = 'none';
                        }
                    }
                });
            } else {
                emailError.style.display = 'none';
            }
        });
    </script>
</body>
</html>