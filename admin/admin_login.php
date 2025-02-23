<?php 
require_once "../controlleruserdata.php"; 
include('../connection.php');
include('../tags.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBR | ADMIN</title>
    <link rel="stylesheet" href="../css/login.css?v=1.1"><!--force css-->
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="admin_login.php" method="POST" autocomplete="">
            <div class="title">
            <img src="../img/tbrllogo_transparent.png" alt="TBR Logo" class="logo">
                <h4>Welcome to</h4>
                <span>Ternate Beach Resort</span>
                <p >Login with your administration account</p>
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
                    <input class="form-control" type="email" name="email" placeholder=" " required value="<?php echo $email ?>">
                    <label for="username">Email</label>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder=" " required>
                    <label for="password">Password</label>
                    <p class="text-right" style="margin:10px"><a href="forget_password.php">Forgot Password?</a></p>
                </div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="login_admin" value="Sign In">
                </div>
              
            </form>
        </div>
    </div>
</body>
</html>