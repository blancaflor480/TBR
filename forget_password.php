<?php
require_once "controlleruserdata.php";
include('connection.php');
include('tags.php');
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["sendOtp"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $query = mysqli_query($conn, "SELECT * FROM tbl_user_credentials WHERE email='$email'");
    if (mysqli_num_rows($query) == 0) {
        $_SESSION['info'] = "The email does not exist!";
        $errors['email'] = "The email does not exist!";
    } else {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'billinghoa@gmail.com';
            $mail->Password   = 'sqtrxkdxrkbalgfu';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('billinghoa@gmail.com', 'Your App Name');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "Your OTP is: <b>$otp</b>";

            $mail->send();
            
            // Set success message in session
            $_SESSION['info'] = "
                <div class='alert alert-success text-center'>
                    <img src='data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"%23EA4335\"%3E%3Cpath d=\"M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z\"%2F%3E%3C%2Fsvg%3E' 
                        style='width: 24px; height: 24px; vertical-align: middle; margin-right: 5px;'>
                    <strong>OTP has been sent!</strong><br>
                    Please check your Gmail inbox and spam folder<br>
                    Email: " . maskEmail($email) . "
                </div>";
            
            echo json_encode(['status' => 'success', 'message' => 'OTP sent successfully']);
            exit();
        } catch (Exception $e) {
            $errors['otp-error'] = "Failed to send OTP! Error: " . $mail->ErrorInfo;
            echo json_encode(['status' => 'error', 'message' => $errors['otp-error']]);
            exit();
        }
    }
}

// Helper function to mask email
function maskEmail($email) {
    $parts = explode('@', $email);
    $name = $parts[0];
    $len = strlen($name);
    $masked = substr($name, 0, 1) . str_repeat('*', $len - 2) . substr($name, -1) . '@' . $parts[1];
    return $masked;
}

if (isset($_POST["verifyOtp"])) {
    $otp = mysqli_real_escape_string($conn, $_POST["otp"]);

    if ($otp == $_SESSION['otp']) {
        $_SESSION['success'] = 'OTP verified!';
        echo '<script> window.location="reset_password.php";</script>';
    } else {
        $_SESSION['info'] = "<div class='alert alert-danger text-center'>Invalid OTP!</div>";
        echo '<script> window.location="forget_password.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBR FORGET PASSWORD</title>
    <link rel="stylesheet" href="css/signup.css?v=1.1"><!--force css-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Add jQuery for AJAX -->
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="user_register.php" method="POST" autocomplete="">
                <div class="title">
                    <img src="img/tbrllogo_transparent.png" alt="TBR Logo" class="logo">
                    <h4>Reset Password</h4>
                    <p>Enter your email to reset your password.</p>
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
                if(isset($_SESSION['info'])){
                    echo $_SESSION['info'];
                }
                ?>
        
                <div class="form-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Email</label>
                    <div id="email-error" class="text-danger mt-1" style="display: none;"></div> <!-- Error message for email -->
                </div>

                <div class="form-group" id="otp-field" style="display: none;">
                    <input class="form-control" type="text" id="otp" name="otp" placeholder=" " required>
                    <label for="otp">Enter OTP</label>
                    <div id="otp-error" class="text-danger mt-1"></div>
                </div>
                
                <div class="form-group">
                    <button type="button" id="sendOtpBtn" class="form-control button">Send OTP</button>
                    <button type="button" id="verifyOtpBtn" class="form-control button" style="display: none;">Verify OTP</button>
                </div>

                <div class="form-group" id="resendOtp" style="display: none;">
                    <button type="button" class="btn btn-link">Resend OTP</button>
                </div>
                <p class="text-center" style="margin:10px"><a href="user_login.php">Go to Sign In Account</a></p>
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
   <script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const otpField = document.getElementById('otp-field');
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const verifyOtpBtn = document.getElementById('verifyOtpBtn');
    const emailError = document.getElementById('email-error');
    const otpError = document.getElementById('otp-error');

    // Handle Send OTP
    sendOtpBtn.addEventListener('click', function() {
        const email = emailInput.value.trim();
        
        if (!email) {
            emailError.textContent = 'Please enter your email!';
            emailError.style.display = 'block';
            return;
        }

        // Show loading state
        sendOtpBtn.disabled = true;
        sendOtpBtn.textContent = 'Sending...';

        $.ajax({
            url: 'forget_password.php',
            type: 'POST',
            data: { sendOtp: true, email: email },
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Show OTP field and verify button
                        otpField.style.display = 'block';
                        verifyOtpBtn.style.display = 'block';
                        sendOtpBtn.style.display = 'none';
                        
                        // Show success message
                        emailError.textContent = data.message;
                        emailError.style.color = 'green';
                        emailError.style.display = 'block';
                    } else {
                        emailError.textContent = data.message;
                        emailError.style.color = 'red';
                        emailError.style.display = 'block';
                    }
                } catch (e) {
                    // Still show OTP field if email was sent successfully
                    if (response.includes('OTP sent')) {
                        otpField.style.display = 'block';
                        verifyOtpBtn.style.display = 'block';
                        sendOtpBtn.style.display = 'none';
                    } else {
                        emailError.textContent = 'An error occurred. Please try again.';
                        emailError.style.display = 'block';
                    }
                } finally {
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.textContent = 'Send OTP';
                }
            },
            error: function() {
                emailError.textContent = 'Server error. Please try again later.';
                emailError.style.display = 'block';
                sendOtpBtn.disabled = false;
                sendOtpBtn.textContent = 'Send OTP';
            }
        });
    });

    // Handle Verify OTP
    verifyOtpBtn.addEventListener('click', function() {
        const otp = document.getElementById('otp').value.trim();
        
        if (!otp) {
            otpError.textContent = 'Please enter the OTP!';
            otpError.style.display = 'block';
            return;
        }

        // Submit form for OTP verification
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'forget_password.php';

        const otpInput = document.createElement('input');
        otpInput.type = 'hidden';
        otpInput.name = 'verifyOtp';
        otpInput.value = 'true';
        form.appendChild(otpInput);

        const otpValue = document.createElement('input');
        otpValue.type = 'hidden';
        otpValue.name = 'otp';
        otpValue.value = otp;
        form.appendChild(otpValue);

        document.body.appendChild(form);
        form.submit();
    });
});
</script>
</body>
</html>