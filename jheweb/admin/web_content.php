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
            <a href="appointment.php" class="dashboard-nav-item ">
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
            <a href="web_content.php" class="dashboard-nav-item active">
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
                        <h2>Website Content</h2>
                    </div>
                    
                    <div class='card-body'>
                        <div class="container">
                            <?php
                                if (isset($_POST['btn_abtUs'])) {
                                    $about_id=$_POST['about_id'];
                                    $about_details=$_POST['abt_us'];
                                    mysqli_query($con,"update about_us set about_details='$about_details' where about_id='$about_id'")or die(mysqli_error($con));
                                    echo '<div class="alert alert-success alert-dismissible d-flex justify-content-center" role="alert">
                                    About Us Content Successfully Updated!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                }elseif (isset($_POST['btn_number'])) {
                                    $details_id=$_POST['details_id'];
                                    $contact=$_POST['contact'];
                                    mysqli_query($con,"update jhedetails set contact='$contact' where details_id='$details_id'")or die(mysqli_error($con));
                                    echo '<div class="alert alert-success alert-dismissible d-flex justify-content-center" role="alert">
                                    Mobile Number Successfully Change!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                }elseif (isset($_POST['btn_email'])) {
                                    $details_id=$_POST['details_id'];
                                    $email=$_POST['email'];
                                    mysqli_query($con,"update jhedetails set email='$email' where details_id='$details_id'")or die(mysqli_error($con));
                                    echo '<div class="alert alert-success alert-dismissible d-flex justify-content-center" role="alert">
                                    Email Updated Successfully!.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    }
                            ?>
                            <div class="row">
                                <!-- aboutUs -->
                                <div class="col-md aboutus border p-2">
                                    <div class="header">
                                        <h3 class="text-center fw-bold">About Us</h3>
                                    </div>
                                    <form action="" method="POST" class="aboutUs">
                                        <!-- sql command about us -->
                                        <?php
                                            $sqll = mysqli_query($con,"SELECT * FROM about_us WHERE about_id=1;")or die(mysqli_error($con));
                                            $row = mysqli_fetch_array($sqll);
                                        ?>
                                        <!-- /sql command about us -->
                                        <div class="announceTextArea mb-3">
                                            <div class="row">
                                                <div class="col d-flex justify-content-start fw-bold">
                                                    Edit About Us:
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group" style="height: 13.8em;">
                                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square"></i></span>
                                                        <input type="hidden" id="aboutId" name="about_id" value="<?php echo $row['about_id']; ?>" required>
                                                        <textarea type="text" class="form-control text-muted" name="abt_us" placeholder="<?php echo $row['about_details']?>" aria-label="Username" aria-describedby="basic-addon1"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" name="btn_abtUs" id="btn_abtUs"><i class="bi bi-pencil-square"></i>Modify</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /aboutUs -->
                                <!-- contactus -->
                                <div class="col-md contactus  border p-2">
                                    <div class="header">
                                        <h3 class="text-center fw-bold">Contact Us</h3>
                                    </div>
                                    <form action="" method="POST">
                                        <!-- sql command contact us -->
                                            <?php
                                                $sqll = mysqli_query($con,"SELECT * FROM jhedetails WHERE details_id=1;")or die(mysqli_error($con));
                                                $row = mysqli_fetch_array($sqll);
                                            ?>
                                        <!-- /sql command contact us -->
                                        <div>
                                            <div class="col-md d-flex justify-content-start fw-bold">
                                                Edit Mobile Number:
                                            </div>
                                            <div class="input-group" style="height: 70px;">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone"></i></span>
                                                <input type="hidden" id="details_d" name="details_id" value="<?php echo $row['details_id']; ?>" required>
                                                <input type="text" class="form-control" name="contact" placeholder="<?php echo $row['contact']?>" onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="button d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary" name="btn_number"><i class="bi bi-check-circle"></i>Update</button>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-md d-flex justify-content-start fw-bold">
                                                Edit Email:
                                            </div>
                                            <div class="input-group" style="height: 70px;">
                                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                                                <input type="hidden" id="details_d" name="details_id" value="<?php echo $row['details_id']; ?>" required>
                                                <input type="email" class="form-control" name="email" placeholder="<?php echo $row['email']?>" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="button d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary" name="btn_email"><i class="bi bi-check-circle"></i>Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /contactus -->
                            </div>
                            <!-- announcement start -->
                            <br>
                            
                            <div class=" border p-3">
                            <header>
                                <h3 class="text-center fw-bold">Announcement</h3>
                            </header>
                            <div class="announcemnentForm ">
                                <form action="" method="POST">
                                    <div class="announceTextArea mb-3">
                                        <?php
                                            //create announcement start
                                            if(isset($_POST['post_announce'])){
                                                $announce=$_POST['write_announcement'];
                                                $regdate = date("Y-m-d");
                                                if ($announce == "") {
                                                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                                    Announcement Form is Empty!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                } else {
                                                    $sqlcode = "INSERT INTO announcement (announce_details, announce_date) VALUES ('{$announce}', '{$regdate}')";
                                                    $result = mysqli_query($con,$sqlcode);
                                                    echo '<div class="alert alert-success alert-dismissible" role="alert">
                                                    Announcement Successfully Posted!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                }
                                            }
                                            //create announcement end
                                        ?>
                                        <!-- create announcement form start -->
                                        <div class="row">
                                            <div class="col d-flex justify-content-start fw-bold">
                                                Create Announcement Form:
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="announce_textArea input-group mb-2" style="width:100%; height: 70px;">
                                                    <span class="input-group-text"><i class="bi bi-megaphone"></i></span>
                                                    <textarea class="form-control" placeholder="Create Announcement Here" aria-label="With textarea" name="write_announcement"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button d-flex justify-content-end mb-2">
                                        <button type="submit" class="btn btn-primary" name="post_announce" onClick="reloadFunction()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-megaphone-fill" viewBox="0 0 16 16">
                                            <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-11zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25.222 25.222 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56V3.224zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009a68.14 68.14 0 0 1 .496.008 64 64 0 0 1 1.51.048zm1.39 1.081c.285.021.569.047.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a65.81 65.81 0 0 1 1.692.064c.327.017.65.037.966.06z"/>
                                            </svg> Post Announcement</button>
                                            <span> | </span>
                                        <button type="reset" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                            </svg> Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <!-- create announcement form end -->
                            <!-- announcement table start -->
                            <br>
                            <table id="example" class="table  table-bordered caption-top table-striped table-hover dt-responsive nowrap" style="width:100%;">
                                <thead class="text-white" style="background-color:#305f82;">
                                    <tr>
                                    <th>Announcement_ID</th>
                                    <th>Announcements</th>
                                    <th>Announcement Created</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqll = mysqli_query($con,"SELECT * FROM announcement")or die(mysqli_error($con));
                                        while($row = mysqli_fetch_array($sqll)){
                                        $announce_id=$row['announce_id']; ?>
                                        <tr class="">
                                            <td><?php echo $row['announce_id']; ?></td>
                                            <td style="overflow:hidden;"><div style="word-break:break-all; vertical-align:top; white-space: normal !important;height:50px; overflow-y:auto;"><?php echo $row['announce_details']; ?></div></td>
                                            <td><?php echo $row['announce_date']; ?></td>
                                            <td>
                                                <a rel="tooltip"  title="Delete" id="<?php echo $announce_id; ?>"href="#delete<?php echo $announce_id; ?>" data-bs-toggle="modal" data-bs-target="#delete<?php echo $announce_id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                                <?php include('delete_announcement.php'); ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                            <!-- announcement table end -->
                            </div>
                            <!-- announcement end -->
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
        scrollY:     '325px',
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true,
        order: [[0, 'desc']],
        
    } );
} );
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php include('logout_admin.php'); ?>
</body>
</html>