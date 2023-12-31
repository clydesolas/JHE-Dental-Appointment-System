<?php
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php';
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
            <div class="btn-group btnhover  ms-auto ">
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
                        <h2>Account Security</h2>
                    </div>
                    
                    <div class='card-body'>
                        <div class="container">
                            <!-- container -->
                            <div class="row  d-flex justify-content-evenly">
        
                                <!-- edit username-->
                                <div class="col-md-5 shadow p-3 mb-5 bg-body rounded">
                                    
                                    <?php
                                    //change username start
                                        $sql = mysqli_query($con,"SELECT * FROM admindb WHERE id='$id';")or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($sql);
                                        $curUName = $row['username'];
                                        $conPass=$row['password'];
                                        $availability = $row['available'];
                                       
                                        if (isset($_POST['btnUserName'])) {
                                            $oldUName = $_POST['currentUName'];
                                            $newUName = $_POST['newUser'];
                                            $pass = $_POST['pass'];
                                            $md5pass = md5($pass);
                                            $select1="SELECT `username` FROM admindb WHERE `username`='$newUName'";
                                            $user1 = $con->query($select1) or die ($con->error);
                                            $row = $user1->fetch_assoc();
                                            $totaluser1 = $user1->num_rows;
                                            if ($totaluser1>0){
                                                echo '<script>alert("Username already exists !!")</script>'; 
                                                }  
                                            if ($con->connect_error) {
                                                die("Database Connection Failed!: ". $con->connect_error);
                                            }
                                            
                                            if ($newUName == $curUName) {
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                New Username must differ from your old Username!.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            }elseif ($curUName != $oldUName) {
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                Current Username does not match!.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            }elseif ($conPass != $md5pass) {
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                Please insert a valid password!.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            } elseif ($totaluser1==0 && $newUName != $curUName && $curUName == $oldUName && $conPass == $md5pass) {
                                                $sql ="UPDATE `admindb` SET `username`= '$newUName' where `id`= '$id'";
                                                mysqli_query($con,$sql);
                                                $curUName=$newUName;
                                                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                                                   Username Successfully Changed !.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    echo'';
                                                    sleep(2);
                                                    unset($_SESSION['AdminLogin']);
                                                    echo'<script>if(!alert("Password has been changed. Please log in again..")){window.location.reload();}</script>';
                                            } 
                                        }
                                    //change username end
                                    ?>
                                    <form action="" method="POST">
                                        <div class="col">
                                            <header>
                                                <span style="font-size: 1.5em; font-weight: bold;">Edit Username:</span>
                                            </header>
                                            <hr>
                                            <div class="form_body">
                                                <span>Current Username:</span>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="currentUName" name="currentUName" required>
                                                </div>
                                                <span>New Username:</span>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="newUser" name="newUser" required>
                                                </div>
                                                <span>Password</span>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="pass" name="pass">
                                                </div>
                                                <div class="button d-flex justify-content-end mb-2">
                                                    <button type="submit" class="btn btn-primary" id="btnUsername" name="btnUserName"><i class="bi bi-check-circle"></i>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /edit username -->
                                <!-- change password-->
                                <div class="col-md-5 shadow p-3 mb-5 bg-body rounded">
                                    <?php
                                        $sql = mysqli_query($con,"SELECT * FROM admindb WHERE id='$id';")or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($sql);
                                        $admin_id = $row['id'];
                                        $curPass=$row['password'];
                                        //Change Password Start
                                        if(isset($_POST['btnPass'])){
                                            //oldpass
                                            $currentPass = $_POST['currentPass'];
                                            $md5currentPass = md5($currentPass);
                                            //newpass
                                            $newpass = $_POST['newPass'];
                                            $md5newpass = md5($newpass);
                                            //confirmpass
                                            $conpass = $_POST['conPass'];
                                            $md5conpass = md5($conpass);
                                            //sqlcommand
                                            $changepass="SELECT * FROM admindb WHERE id='$id';";
                                            $admin = $con->query($changepass) or die ($con->error);
                                            $row1 = $admin->fetch_assoc();
                                            $adminRows = $admin->num_rows;

                                            if($md5newpass == $curPass){
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                Password must differ from your old password.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            }
                                            if($md5currentPass != $curPass){
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                Old Password does not match.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            }
                                            if($md5newpass != $md5conpass){
                                                echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                New Password and Confirm Password does not match.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                            }
                                            if($md5currentPass == $curPass && $md5newpass == $md5conpass && $md5newpass != $md5currentPass){
                                                $sql ="UPDATE `admindb` SET `password`= '$md5newpass' where `id`= '$id'";
                                                mysqli_query($con,$sql);
                                                $curPass=$md5newpass;
                                                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                                                    Password Successfully Change.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                                    echo'';
                                                    sleep(2);
                                                    unset($_SESSION['AdminLogin']);
                                                    echo'<script>if(!alert("Password has been changed. Please log in again..")){window.location.reload();}</script>';
                                            }
                                        }
                                        $con->close();
                                    //Change Password End
                                    ?>
                                    <form action="" method="POST">
                                        <div class="col">
                                            <header>
                                                <span style="font-size: 1.5em; font-weight: bold;">Change Password:</span>
                                            </header>
                                            <hr>
                                            <div class="form_body">
                                                <span>Enter Current Password</span>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="currentPass" name="currentPass">
                                                </div>
                                                <span>Enter New Password</span>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="newPass" name="newPass">
                                                </div>
                                                <span>Confirm Password</span>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="conPass" name="conPass">
                                                </div>
                                                <div class="button d-flex justify-content-end mb-2">
                                                <button type="submit" class="btn btn-primary" id="btnPass" name="btnPass"><i class="bi bi-check-circle"></i>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /change password -->
                               
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