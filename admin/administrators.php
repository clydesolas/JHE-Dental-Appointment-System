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
            <a href="services.php" class="dashboard-nav-item ">
            <i class="fs-5 bi bi-stack"></i> Services
            </a>
            <a href="manage.php" class="dashboard-nav-item">
            <i class="fs-5 bi-people"></i> Patients
            </a>
            <a href="web_content.php" class="dashboard-nav-item ">
            <i class="fs-5 bi bi-window-stack"></i> Website Content
            </a>
            <a href="administrators.php" class="dashboard-nav-item active">
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
<!-- <div class="alert alert-danger alert-dismissible" role="alert">
          Submitted.sdfsdffd
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> -->
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
                        <h2>Manage Admin</h2>
                    </div>
                    <div class='card-body'>
                    <?php include('modal_add-admin.php'); ?>
                    
                    <a data-bs-toggle="modal" style="text-decoration: none" href="#modal_add-admin" type="button" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Add Admin</a>
                    <br>
                
                    
                    <div class="container">
                    <table id="example" class="table  table-bordered caption-top table-striped table-hover dt-responsive nowrap" style="width:100%;">
                            
                    <thead class="text-white" style="background-color:#305f82;">
                                    <tr>
                                         <th>No.</th>
                                        <th>First Name</th>
                                        <th>Middle Name </th>
                                        <th>Last Name</th>   
                                        <th>Action: </th>                              
                                        
                                    </tr>
                                </thead>
                                <tbody >
								
                                  <?php 
                                   $i = 1;
                                  $sqll = mysqli_query($con,"SELECT * FROM admindb ORDER BY `fname` ASC")or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($sqll)){
									$id1=$row['id']; 
                                    $number=0;?>
                                   
									
									      <td><?php echo $i++?></td>
                                    <td><?php echo $row['fname']; ?></td> 
                                    <td><?php echo $row['mname']; ?></td> 
                                    <td><?php echo $row['lname']; ?></td> 
                                    
                                    <td width="110">
                                     
                                        <a rel="tooltip"  title="View Info" id="<?php echo $id1; ?>" href="#view<?php echo $id1; ?>" data-bs-toggle="modal" class="btn btn-primary"><i class="bi bi-eye"></i></a> 
                                        <a rel="tooltip"  title="Delete" id="<?php echo $id1; ?>"href="#del<?php echo $id1; ?>" data-bs-toggle="modal" class="btn btn-danger mx-2"><i class="bi bi-trash"></i></a>
                                        <?php include('modal_adminview.php'); ?>
                                        <?php include('modal_delete-admin.php'); ?>
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

$('#file').on('change', function() {
          
          var size = (this.files[0].size / 1024 / 1024).toFixed(2);
          var upl = document.getElementById("file");
          if (size > 5) {
            $("#output").html('<b style="color:red">' +
                 'Image size is higher than 5MB'+'</b><br>Image size: ' + size + " MB");
              upl.value = "";
          } else {
              $("#output").html('<b>' +
                 'Image size: ' + size + " MB" + '</b>');
          }
      });
	
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


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
        paging:         true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false
        
    } );
} );

</script>
<?php include('logout_admin.php'); ?>
</body>
</html>