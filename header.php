 <?php 
// session_start();
 // $_SESSION["id"] = $id;

 ?>
 <style>
    body {
    font-family: 'Montserrat', sans-serif;
}

.fontStyle{
  font-family: 'Montserrat', sans-serif;

}
   .navbar-light .navbar-nav .nav-link {
    color:  rgb(0 0 0 / 68%);
   }
 </style>
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">

        <a data-toggle="tooltip" title="Toggle Sidebar"><button class="btn" style="background-color: #7975fe; color: white;" id="sidebarToggle">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
            <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
          </svg>
      </button>
    </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                
                <?php 
           // echo '  <li class="nav-item">Welcome, '.$_SESSION["username"].' </li>';
                echo ' <li class="nav-item active">
                          <a class="nav-link" href="admin_profile_info.php" data-toggle="tooltip" data-placement="left" title="Profile Info"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                              </svg> Welcome, '.$_SESSION["email"].'
                            
                          </a>
                        </li> ';

               echo ' <li class="nav-item active">
                   <a class="nav-link" href="../logout.php" data-toggle="tooltip" title="Log Out">
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                      </svg>
                  </a>
              </li> ';





              ?>

            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
