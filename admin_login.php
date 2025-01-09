<?php 
require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <div style="font-size: 2rem; margin-top: 15px; margin-left: -25px;">
            <a href="index.php"><button class="btn btn-light">Back</button></a>
        </div> 
        <div class="row text-center" >
            <div class="login-form">
                <form action="admin_login.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your username and password.</p>
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
                        <input class="form-control" type="text" name="username" placeholder="Username" required value="<?php echo $username ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                   
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login" style="background: #7975fe; color: white;">
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>