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
                header("location: index.php");// find the login index
                 }
             if(!isset($_SESSION['AdminLogin']))
                {
                    unset($_SESSION["AdminLogin"]);// depend on the value we use
                    session_destroy();
                    header("location: index.php");// find the login index
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
  @media (min-width: 1024px) {
    .tableadmin {
    width: 50% !important;
    
   
}

}
@media (min-width: 760px)  and (max-width: 900px) {
    .tableadmin {
    width: 60% !important;
   
}

}
@media (max-width: 760px) {
    .tableadmin {
    width: 100% !important;
    
}  }
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
            <a href="appointment.php" class="dashboard-nav-item">
            <i class="fs-5 bi-table"></i> Appointment
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
            <a href="services.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-stack"></i> Services
            </a>
            <a href="manage.php" class="dashboard-nav-item">
            <i class="fs-5 bi-people"></i> Patients
            </a>
  
            <a href="web_content.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-window-stack"></i> Website Content
            </a>
            <a href="administrators.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-person-vcard-fill"></i>Administrators
            </a>

            <a href="report.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-pc-display-horizontal"></i> Report
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
                        <h2>Profile</h2>
                    </div>
                    
                    <div class='card-body'>
                        <div class="container">
                            <!-- container -->
                            <div class="row  d-flex justify-content-evenly">
            <div class="tableadmin p-3">
                            <?php
            $sqll = mysqli_query($con,"SELECT * FROM admindb WHERE id='$id'")or die(mysqli_error($con));
                    while($row = mysqli_fetch_array($sqll)){
                    
                   
                    ?>
                <form method="POST">
            
              <label >First name</label>
              <input class="form-control mb-2 mb-2" value="<?php echo $row['fname']; ?>" onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="fname">    
              <label> Middle Name</label>
                <input class="form-control mb-2" value="<?php echo $row['mname']; ?>" onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="mname">    
                  
               <label>Last Name </label>
                <input class="form-control mb-2" value="<?php echo $row['lname']; ?>"  onkeypress="return /[a-z\-\ ]/i.test(event.key)"type="text"name="lname">    
                  
                <label>Email</label>
                 <input class="form-control mb-2" value="<?php echo $row['email']; ?>" type="email"name="email">    
                 <label>   Mobile Number</label>
                <input class="form-control mb-2" value="<?php echo $row['contact']; ?>"onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" placeholder="09123456789"type="text"name="contact">    
                 <label> Position: </label>
                      <select name="position" class="form-select form-select-md mb-2" required="true">
                      <option value="" style="display: none;" ><?php echo $row['position']?></option>    
                      <option value="Doctor" <?php echo ($row['position']=="Doctor")? 'selected':'';?> >Doctor</option>
                      <option value="Assistant" <?php echo ($row['position']=="Assistant")? 'selected':'';?>>Assistant</option>
                    </select>
                   
                    <?php
                                  
                    if($row['position']=="Doctor"){?>
                    
                     <label>   Availability Status: </label>
                       
                      <select name="available" class="form-select form-select-md mb-2 " required="true">
                      <option value="<?php echo $row['available']?>" style="display: none;" ><?php echo $row['available']?></option>    
                      <option value="Yes" <?php echo ($row['available']=="Yes")? 'selected':'';?> >Available</option>
                      <option value="No" <?php echo ($row['available']=="No")? 'selected':'';?>>Busy</option>
                    </select>
                   
                        
                    
                    <?php
                    }
                    if($row['position']!="Doctor"){ ?>
                        <input type="hidden" name="available" value="" required> 
                   <?php 
                   }
                }
                    ?>
                   
						
              
               <div class="modal-footer border-top-0">
                     
                        <button class="btn btn-md btn-light mx-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary" id="yes" name="yes">
                            Submit</button>
                        </div>
                      </form> 
               
	<?php
	if (isset($_POST['yes'])){
    
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $mname =$_POST['mname'];
    $contact =$_POST['contact'];
    $email =$_POST['email'];
    $available =$_POST['available'];
    $position =$_POST['position'];
  


	mysqli_query($con,"UPDATE admindb 
    set  `fname` = '$fname', `mname` = '$mname',`lname` = '$lname',`contact` = '$contact',`email` = '$email',`available` = '$available',`position` = '$position' where id='$id'")or die(mysqli_error($con)); 
    ?>
  
    <script>
     alert("Profile has been updated.")   
	window.location.href="profile.php";
	</script>
    <?php
    }
    ?>
            </div>
           
                               
                            </div>
                        </div>
                        <!-- /container -->
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