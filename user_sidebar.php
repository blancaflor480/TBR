<style>
    .list-group-item{
        border:  1px solid white;
    }

    .list-group-item-light {
        color:  #41464b;
    }

    #sidebar-wrapper {
        background: #f9f9f9 !important;
    }

    .list-group-item {
        background: #f9f9f9;
        color:  #7975fe;
        border: solid 5px #f0f0f0;
        zoom:  100%;
    }

    .list-group-item:hover {
        background: #7975fe;
        color:  white;

    }

    .list-group-item.active {
  background-color: #007bff;
  border-color: #007bff;
}


    hr {


  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
    
</style>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<div class="border-end" id="sidebar-wrapper"> 
<div class="sidebar-heading " style="font-weight: bold; color: #7975fe; background: #f9f9f9;"> 
     TBR
 </div> 
    <div class="list-group list-group-flush"> 
      </a>
      <a class="list-group-item list-group-item-action p-3 <?php if(strpos($_SERVER['PHP_SELF'], 'user_transaction.php') !== false) echo 'active'; ?>" href="user_transaction.php">
        &nbsp; Transaction
      </a>
      <a class="list-group-item list-group-item-action p-3 <?php if(strpos($_SERVER['PHP_SELF'], 'user_reservation.php') !== false) echo 'passive'; ?>" href="user_reservation.php">
        &nbsp; Reservation List
      </a>
    </div>
</div>

