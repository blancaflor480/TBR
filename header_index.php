<?php
include('connection.php');
?>

<style>


body {
    font-family: 'Montserrat', sans-serif;
}

.fontStyle{
  font-family: 'Montserrat', sans-serif;

}

a {
    text-decoration: none !important;
}

.navstyle{
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0px 5px 18px 1px rgba(0,0,0,0.10);
  background: white;
  padding: 25px;

}
.navbar-nav li a{
  color: black;
}

.navbar-nav li a:hover{
  color: blue;
  background: white !important;
}

.btnLogin{
  font-weight: 700;
    border-radius: 25px;
    padding-left: 20px;
    padding-right: 20px;
    line-height: 30px;
    color: #ffffff;
    
    background-color: #0000d0;   /* #7d1eff; */
    text-transform: uppercase;
    transition: .3s all ease-in-out;

}
.btnLogin:hover{
  background-color: #232c85;   /* #7d1eff; */
  color: white;
  transition: .3s all ease-in-out;
}

.align-center {
  float: none;
    margin: 0 auto;
}

.navbar-toggle{
  background-color: blue;
}

.navbar-toggle .icon-bar{
  background: white;
}

.mt-5 {
  margin-top: 115px;
}




</style>  <!-- Navigation -->


<?php 
      

?>

<link rel="stylesheet" type="text/css" href="style.css">

  <nav class="navbar navbar-fixed-top navstyle navbar-expand-sm" role="navigation" style="zoom: 110%;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" rel="home" href="index.php" title="Imus Institute of Science and Technology">
                  <img style="max-width:100px; margin-top: -10px;"
                  src="img/logotbr.jpg" width="100">
                </a>
       
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav mr-auto">
                </ul>

                <ul class="navbar-nav">
                     <li class="nav-item">
                       <a href="user_login.php">
                           <button class="btn btnLogin">Login</button>
                       </a>
                     </li>
                   </ul>&nbsp;&nbsp;&nbsp;
                   <ul class="navbar-nav">
                     <li class="nav-item">
                       <a href="user_register.php">
                           <button class="btn btnRegister">Register</button>
                       </a>
                     </li>
                   </ul>

                   
                </ul> 
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
  

























