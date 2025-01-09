<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<?php
include('connection.php');

session_start();  
//  if(!isset($_SESSION["username"]))  
//  {  
//       header("location:login.php");  
//       exit();
//  }  

// ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <title>TBR</title>
     <link rel="stylesheet" type="text/css" href="style.css">


</head>

<body>

    <!-- Navigation -->
	<?php 
		include('header_index.php');
	?>

    <!-- Page Content -->
    <div class="container-fluid fontStyle p-5" style="background: #00215e;">
        <div class="content-wrapper">
		<center>
            <div class="row" style="max-width: 1500px;">
                <div class="col-md-6 col-lg-6 text-left">
                    <p>
                    <h1 class="font arrange-content left-pad" style="color: #7975fe;"><span style="color: white;">Welcome to</span> <br/> <b>Your gateaway nature trip</b></h1>
                    </p>
                    <p class="description left-pad" style="color: white;"> The perfect place to spend your much needed break from the hustle and bustle of your hectic schedule. Relax in the calm and refreshing breeze of the sea and have an experience close to nature by cutting your cost and increasing your leisure. <br/>the cracks.</p>
                </div>
                <div class="col-md-6 col-lg-6 text-left ">
                    <img  src="img/header.jpg"  class="hidden-xs hidden-sm laptop arrange-content" alt="evernote image" >
                </div>
            </div>
			</center>
        </div>
    </div>

    <div class="container-fluid fontStyle p-5" style="background: #fc4100;">
        <div class="content-wrapper">
        <center>
            <h1 class="text-center">Accomodations</h1>
            <br><br>
            <div class="row" style="max-width: 1500px;">
                
                <br>
                <div class="col-md-4 col-lg-4">
                    <img src="img/tbr3.jpg" width="300">
                    <br><br>
                    <h3>Open Cottages</h3>
                    <p>6-8 pax capacity</p>
                </div>
                <div class="col-md-6 col-lg-4 ">
                    <img src="img/tbr2.jpg" width="450">
                    <br><br><br>
                    <h3>Tent Pitching</h3>
                    <p>from ₱400 - 600 </p>
                </div>
                <div class="col-md-6 col-lg-4 ">
                    <img src="img/tbr1.jpg" width="300">
                    <br><br>
                    <h3>Standard Room</h3>
                    <p>6-8 pax capacity</p>
                </div>
            </div>
            </center>
        </div>
    </div>

</body>

</html>
