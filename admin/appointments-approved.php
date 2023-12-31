<?php
  $serverdpphp = '../database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['AdminLogin'])){
            $_SESSION['AdminLogin'];
            $email=strtoupper($_SESSION['AdminLogin']['username']);
            $id=strtoupper($_SESSION['AdminLogin']['id']);
          

           }
            else{
            	unset($_SESSION["AdminLogin"]);// depend on the value we use
                session_destroy();
                header("location: ../index.php");// find the login index
                 }
             if(!isset($_SESSION['AdminLogin']))
                {
                    unset($_SESSION["AdminLogin"]);// depend on the value we use
                    session_destroy();
                    header("location: ../index.php");// find the login index
                }

    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="../css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css ">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css ">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css ">
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
          


    <title>J.H.E. Dental Clinic</title>
    <link href="../images/logo.png" rel="icon">
</head>
<style>
    @media(max-width:767px){
.modal{
    padding-top:16%;
}
}
@media screen and (min-width:768px)and (max-width:1023px) {
    .modal{
    padding-top:16%;
} 
}
@media screen and (min-width:1024px){
    .modal{
    padding-top:5%;
}
}
</style>
<body>
<div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle"><i class=" fs-3 bi bi-list"></i></a><a href="#"
                                                                                   class="brand-logo"><img src="../images/logo.png"class="logo-navbar"> <span>DENTAL CLINIC</span></a>
        </header>
        <nav class="dashboard-nav-list">
            <a href="dashboard.php  " class="dashboard-nav-item">
            <i class="fs-5 bi-house"></i> Dashboard
            </a>
            <a href="appointment.php" class="dashboard-nav-item  active">
            <i class="fs-5 bi-table"></i> Appointment
            </a>
            <a href="services.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-stack"></i> Services
            </a>
            <a href="manage.php" class="dashboard-nav-item">
            <i class="fs-5 bi-people"></i> Patients
            <?php
           $select1="SELECT `status` FROM appointment WHERE `status`='Pending'";
           $user1 = $con->query($select1) or die ($con->error);
           $row = $user1->fetch_assoc();
           $totaluser1 = $user1->num_rows;
          if ($totaluser1>0){
             echo '<span rel="tooltip"  title="Pending Appointments" class="mx-2 badge bg-danger top-0  rounded-pill">'. $totaluser1 .'</span>'; 
             
            }    
            ?>
            </a>
           
            <a href="report.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-pc-display-horizontal"></i> Report
            </a>
         
            <a href="web_content.php" class="dashboard-nav-item ">
            <i class="fs-5 bi bi-window-stack"></i> Website Content
            </a>
            <a href="administrators.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-person-vcard-fill"></i>Administrators
            </a>
            <div class="nav-item-divider"></div>
            <a data-bs-toggle="modal" href="#logout_admin" class="dashboard-nav-item"><i class="fs-5 bi bi-box-arrow-left"></i> Logout </a>
        </nav>
    </div>


<!-- MAIN BODY start of code -->
<div class='dashboard-app'>
<header class='dashboard-toolbar' ><a href="#!" class="menu-toggle"><i class="fs-3 bi bi-list"></i></a>
            <div class="btn-group btnhover ms-auto ">
            <a href="admin_account.php" class="fs-5 text-nowrap text-decoration-none text-light"data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <i class="bi bi-gear"style="font-size:30px"></i></a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><div class="diva dropdown-item text-decoration-none">
                <style>.btnhover:hover{background-image: none;background-color: #15364f;color: black;} .diva:hover {background-image: none;background-color: white;color: black;}</style>
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                    <i class="bi bi-person-circle  text-secondary" style="font-size:30px"></i>
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">
                      <?php 
                       $sqll = mysqli_query($con,"SELECT * FROM admindb WHERE id='$id'")or die(mysqli_error($con));
                      while($row = mysqli_fetch_array($sqll)){
                        if ($row['position']=='Doctor')
                      {echo strtoupper("DR. ".$row['fname']." ".$row['lname']);} 
                      else{echo strtoupper($row['fname']." ".$row['lname']);} ?></span>

                    <small class="text-muted">
                    <?php if ($row['position']=='Doctor') { 
            
                      if ($row['available']=="No"||empty($row['available'])){
                        $checked = "";     
                      }
                        if ($row['available']=="Yes"){
                        $checked = "checked";
                      }
                      ?>
                      <div class="form-check form-switch">
                      <input class="form-check-input opacity-10 " data-bs-toggle="modal" data-bs-target="#avail-modal" type="checkbox" <?php echo $checked; ?> role="switch">
                      <label class="form-check-label" id="flexSwitchResult"for="flexSwitch">Available</label>
                    </div>
                    <?php include('modal-availability.php'); ?>
                    
                    <?php } 
                    if ($row['position']=='Assistant'){
                      echo strtoupper($$row['position']);
                    }
                  
                  }
                  ?>
               </small>
                  </div>
                </div>
          </div>
              </li>
             <hr class="pb-2 my-0">
              <li><a class="dropdown-item text-decoration-none" href="profile.php">
           <i class="bi bi-person-fill"></i>&nbsp; Profile</a>
         </li>
              <li><a class="dropdown-item text-decoration-none" href="account.php">
                <i class="bi bi-shield-lock"></i>&nbsp; Account Security</a>
              </li>
             
              <li>
              </li>

            </ul>
          </div>
      </header>
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <div class='card-header'>
                        <h4 class="pt-2">Appointments</h4>
                       
                    </div>
                    <div class='card-body'>
                    <div class="container d-flex justify-content-end px-0 mx-0">
                    <div class="btn-group flex-wrap" role="group" >
                         <a type="button" href="appointments-all.php"class="btn btn-secondary rounded-0 text-decoration-none mx-1 text-nowrap">All</a>
                    <a type="button" href="appointment.php"class="btn btn-secondary rounded-0 text-decoration-none text-nowrap" >Pending</a>
                    <button type="button" href="appointments-approved.php" class="btn btn-secondary text-nowrap"disabled>Approved</button>
                    <a type="button" href="appointments-declined.php"class="btn btn-secondary rounded-0 text-decoration-none text-nowrap">Declined</a>
                    <a type="button" href="appointments-done.php" class="btn btn-secondary text-decoration-none text-nowrap">Done</a>
                    <a type="button" href="appointments-failed.php"class="btn btn-secondary rounded-0 text-decoration-none text-nowrap">Failed</a>
                </div>
                    </div>
                    <div class="container border">
                    
                    <table id="example" class="table  table-bordered caption-top table-striped table-hover dt-responsive nowrap" style="width:100%;">
                            
                    <thead class="text-white" style="background-color:#305f82;">
                                    <tr>
                                    
                                    <th>Appt. ID</th>
                                    <th>Schedule</th> 
                                    <th>Patient</th>
                                    <th>Service</th>
                                  
                                    <th>Status</th>
                                    <th>Action</th>                                 
                                        
                                    </tr>
                                </thead>
                                <tbody >
								 
                                  <?php 
                                  $sqll = mysqli_query($con,"SELECT * FROM appointment where `status`= 'Approved'")or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($sqll)){
                                    
									$appointment_id=$row['sched_id']; 
									$user_id = $row['user_id'];
									$service_id = $row['service_id'];
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
                                     <td><?php echo $datetime; ?></td> 
                                     <td><?php echo $user_row['fname']." ".$user_row['lname']; ?></td>     
                                     <td><?php echo $service_row['service']; ?></td> 
                                  
                                    <td><?php echo $row['status']; ?></td> 
                                    <td>
                                    <a rel="tooltip"  title="View Appointment" id="<?php echo $appointment_id; ?>" href="#approvedView<?php echo $appointment_id; ?>" data-bs-toggle="modal" >View</a> 
                                    <?php include('modal_appointment-approve.php'); ?>
                                    </td>
                                
                                   
                                   

                                   
									</tr>
                                   
									<?php } ?>
                                    
                                </tbody>
                                
                            </table>
                </div>
                    </div>			
                </div>
                </div>

            


            </div>
        </div>
    </div>

</div>

<!-- MAIN BODY end of code -->

<script src="assets/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/dataTables.responsive.min.js"></script>
<script src="assets/js/jquery-3.5.1.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/responsive.bootstrap5.min.js"></script>    
<script src="https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js "></script>
<script>
const mobileScreen = window.matchMedia("(max-width: 760px )");
$(document).ready(function () {
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
    $(".dashboard-nav-item").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
}); 


$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true
        
    } );
} );

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php include('logout_admin.php'); ?>
</body>
</html>
