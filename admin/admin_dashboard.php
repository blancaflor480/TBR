<?php
include('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TBR</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
  .fa-inverse {
            color: #7975fe !important;
        }

        .card {
          border: 1px solid rgba(0,0,0,.06);
          box-shadow: 0 10px 40px 0 rgb(62 57 107 / 7%), 0 2px 9px 0 rgb(62 57 107 / 6%);
        }


</style>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php 
            include('admin_sidebar.php');
         ?>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
          <?php 
            include('header.php');
         ?>  
            <!-- Page content-->
            <div class="container-fluid"><br>
                <h1>Dashboard</h1><br>
                <div class="row">
                  <div class="col-lg-8">
                    <canvas id="myChart"></canvas>
                  </div>
                  <div class="col-lg-4" >
                     <canvas id="myChart3"></canvas>
                  </div>
                    <canvas id="myChart2"></canvas>
                       <script>
                           // Random data for the bar chart
                           var barData = {
                               labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                               datasets: [{
                                   label: 'Bar Chart',
                                   backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                   borderColor: 'rgba(255, 99, 132, 1)',
                                   borderWidth: 1,
                                   data: [12, 19, 3, 5, 2, 3, 7]
                               }]
                           };

                           // Random data for the line chart
                           var lineData = {
                               labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                               datasets: [{
                                   label: 'Line Chart',
                                   borderColor: 'rgba(54, 162, 235, 1)',
                                   borderWidth: 1,
                                   data: [7, 5, 12, 8, 10, 6, 9]
                               }]
                           };

                           // Random data for the pie chart
                           var pieData = {
                               labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
                               datasets: [{
                                   backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                                   borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                                   borderWidth: 1,
                                   data: [12, 19, 3, 5, 2]
                               }]
                           };

                           // Create the bar chart
                           var barChart = new Chart(document.getElementById('myChart'), {
                               type: 'bar',
                               data: barData
                           });

                           // Create the line chart
                           var lineChart = new Chart(document.getElementById('myChart2'), {
                               type: 'line',
                               data: lineData
                           });

                           // Create the pie chart
                           var pieChart = new Chart(document.getElementById('myChart3'), {
                               type: 'pie',
                               data: pieData
                           });
                       </script>






                </div>


              

        
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>


