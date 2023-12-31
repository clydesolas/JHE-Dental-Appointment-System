<?php
   $serverdpphp = '../database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['UserLogin'])){
            $_SESSION['UserLogin'];
            $user_id=($_SESSION['UserLogin']['user_id']);
            $email=strtoupper($_SESSION['UserLogin']['email']);
          
            $userr="SELECT * FROM users  WHERE user_id='$user_id'";
            $user = $con->query($userr) or die ($con->error);
            $row = $user->fetch_assoc();
            $totaluser = $user->num_rows;
              if ($totaluser>0)
              {
                  $_SESSION['fname']=$row["fname"];
                  $_SESSION['lname']=$row["lname"];
        
              }
            }
            else{
            header("location:../logout.php");
                 }
             if(!isset($_SESSION['UserLogin']))
                {
            header("location:../logout.php");
                }

    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/appointment.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css ">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css ">
    <title>J.H.E. Dental Clinic</title>
    <link href="../images/logo.png" rel="icon">
</head>
<body>
    
 <!--navbar start of code  -->
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #345c83">
        <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color:white ; "><img src="../images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3></a>
            <!-- toggle button -->
            <div class="btn-group yawa ms-auto ">
            <a  class="px-3 text-light"data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <i class="bi bi-list  yawa" style="font-size:30px"></i></a>
            <ul class="dropdown-menu dropdown-menu-end px-2">
            <style>.yawa:hover{
                        transform: scale(1.08);
                        color:lightskyblue
                      
                    }
                    .yawa{
                        border: none;
                        transition: .3s;
                             }
                  </style>
                    <li class="dropdown-item px-1 ">
                        <a class="nav-link" aria-current="page" href="user.php"><i class="bi bi-house"></i>&nbsp; Home</a>
                    </li>
                    <li class="dropdown-item px-1">
                    <a class="nav-link" href="profile.php"><i class="bi bi-person-gear"></i>&nbsp; Profile</a>
                    </li>
                    <li class="dropdown-item px-1">
                    <a class="nav-link" href="account.php"><i class="bi bi-shield-check"></i>&nbsp; Account Settings</a>
                    </li>
                    <li class="dropdown-item px-1 active">
                    <a class="nav-link" href="my_appointment.php"><i class="bi bi-bell"></i>&nbsp;  My Appointment </a>
                    </li>
                   <hr>
                    <li class="dropdown-item px-1">
                       <a class="nav-link"  data-bs-toggle="modal" href="#logoutModal"><i class="bi bi-box-arrow-left"></i>&nbsp; Log out</a>
                       <a  data-bs-toggle="modal" href="#medicalhistoryModal"></a>   
                    </li>
                </ul>
            </div>
        </div>
      </nav>
    <!--navbar end of code  -->


<!-- MAIN BODY start of code -->
<div class="content" style="margin-top: 4em;"></div>
<div class="container-fluid" style="margin: 2% 0 0 0; ">
        <div class="row">

    <!-- Left column start of code -->
    <div class="Left_container col-md-3  p-3 bg-body order-2 order-md-1">
      
            </div>
    <!-- Left column end of code -->
<!-- Center column start of code -->
         
<div class="center_container col-sm-6 shadow-none p-3 order-1 order-md-2 pt-5">
    <div class=" alert alert-primary py-2" style="text-align:center">My Appointment</div>
    <div class="container">
    <div class="table-responsive">
        <table id="example" class="table  table-bordered caption-top table-striped table-hover  nowrap"style="width:100%">       
        <thead class="text-white" style="background-color:#305f82;">
                        <tr>
                        <th rel="tooltip"  title="Appointment ID">Apt. ID</th>
                        <th>Service</th>
                        <th>Schedule</th>
                       
                        <th>Status</th>
                        <th>Action</th>
                               
                            
                        </tr>
                    </thead>
                    <tbody >
      
                      <?php 
                      $sqll = mysqli_query($con,"SELECT * FROM appointment WHERE `user_id` ='$user_id' ORDER BY `start_event` desc ")or die(mysqli_error($con));
                      
                      while($row = mysqli_fetch_array($sqll)){
                                    
									$appointment_id=$row['sched_id']; 
									$service_id = $row['service_id'];
                                    $status=$row['status'];
                                    $remark=$row['remark'];
                                    $sched = $row['start_event'];
                                    $date1 = new DateTime($sched);
                                    $datetime = $date1->format('M d, Y');
                                  
                                    $now = $row['applyDate'];
                                    $applyDate = new DateTime($now);
                                    $appliedDate = $applyDate->format('M d, Y - g:i A');
									/* user query  */
									$user_query = mysqli_query($con,"SELECT * from users where `user_id` = ' $user_id'")or die(mysqli_error($con));
									$user_row = mysqli_fetch_array($user_query);
									/* service query  */
									$service_query = mysqli_query($con,"SELECT * from `services` where `service_id` = '$service_id' ")or die(mysqli_error($con));
									$service_row = mysqli_fetch_array($service_query);
                                    ?>

									                 <tr class="del<?php echo $appointment_id ?>">
                                     <td><?php echo $row['sched_id']; ?></td>  
                                     <td><?php echo $service_row['service']; ?></td> 
                                     <td><?php echo $datetime; ?></td> 
                                    
                                    <td> 
                                        <?php if($row['status']=='Declined' || $row['status']=='Failed' ) {
                                    echo '<span style="color:red">'.
                                    $row['status']. '</span>'; }
                                        if($row['status']=='Approved') {
                                            echo '<span style="color:green">'.
                                    $row['status']. '</span>'; }
                                        if($row['status']=='Done') {
                                            echo '<span style="color:grey">'.
                                    $row['status']. '</span>'; }
                                    if($row['status']=='Pending') {
                                        echo '<span style="color:black">'.
                                $row['status']. '</span>'; }
                                        ?> 
                                    <td>
                                    <a rel="tooltip"  title="View Info" id="<?php echo $appointment_id; ?>"href="#statusView<?php echo $appointment_id; ?>" class="text-nowrap text-decoration-none"data-bs-toggle="modal" > View</a>
                                    <?php include('modal_decline-remark.php'); ?>
                                       
                                    </td>
                                    
                                 
                                    
                                    </tr>
									<?php } ?>
                                    
                                </tbody>
                                
                            </table>
    </div>
                            
    </div>
    <div class="container d-flex justify-content-center pb-3">
        <a  type="button"href="user.php" class="btn btn-outline-primary">Back to home</a>
</div>
</div>
    <!-- Center column end of code -->

    <!-- Right column start of code -->
            <div class="left_container col-md-3  p-3 bg-body rounded order-3 order-md-3">
                                     
                 
                    </div>
                    
    <!-- Right column end of code -->
            </div>
        </div>
<!-- MAIN BODY end of code -->

 <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js "></script>
 <script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true
        
    } );
} );


    (() => {
    'use strict'
    const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(tooltipTriggerEl => {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()
</script>
<?php include('logoutModal.php'); ?>
</body>
</html>