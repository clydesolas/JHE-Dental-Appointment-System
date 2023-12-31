<?php
 $serverdpphp = '../database.php'; 
    require($serverdpphp);
    session_start();

        if(isset($_SESSION['UserLogin'])){
            $_SESSION['UserLogin'];
            $user_id=($_SESSION['UserLogin']['user_id']);
            $email=strtoupper($_SESSION['UserLogin']['email']);

            $user_id=strtoupper($_SESSION['UserLogin']['user_id']);
            $userr="SELECT * FROM users  WHERE user_id='$user_id'";
            $user = $con->query($userr) or die ($con->error);
            $row = $user->fetch_assoc();
            $totaluser = $user->num_rows;
              if ($totaluser>0){
                  $_SESSION['fname']=$row["fname"];
                  $_SESSION['lname']=$row["lname"];
                }

            $sqlcode2 = "SELECT * FROM `medicalhistory` WHERE `user_id` = '$user_id'";
            $queryy = $con->query($sqlcode2) or die ($con->error);
            $rowss = $queryy->fetch_assoc();
            $result2 = $queryy->num_rows;
                
                if ($result2>0){
                    $_SESSION['generalHealth'] = $rowss["generalHealth"];
                    $_SESSION['existingIllness']  =$rowss["existingIllness"];
                    $_SESSION['medicine'] = $rowss["medicine"];
                    $_SESSION['bloodPressure'] = $rowss["bloodPressure"];
                    $_SESSION['allergies'] = $rowss["allergies"];
                }
      
                if(isset($_POST['updateMedical'])){
                $generalHealth = strip_tags($_POST['generalHealth']);
                $existingIllness = strip_tags($_POST['existingIllness']);
                $medicine = strip_tags($_POST['medicine']);
                $allergies = strip_tags($_POST['allergies']);
                $bloodPressure = strip_tags($_POST['bloodPressure']);
                $sql4 = "UPDATE `medicalHistory`
                        SET `generalHealth` = '$generalHealth',
                            `existingIllness`='$existingIllness',
                            `medicine`='$medicine',
                            `allergies`='$allergies',
                            `bloodPressure`='$bloodPressure'
                            WHERE  `user_id`='$user_id'";
                            echo'<script> alert("Medical history has been submitted.");</script>';
                    if($con->query($sql4)==TRUE)
                    {
                        $_SESSION['generalHealth']=$generalHealth;
                        $_SESSION['existingIllness']=$existingIllness;
                        $_SESSION['medicine']=$medicine;
                        $_SESSION['bloodPressure']=$bloodPressure;
                        $_SESSION['allergies']=$allergies;
                    }
                }
            
                $sqlEvents = "SELECT  DATE_FORMAT(start_event,'%Y-%c-%d') as fullEvents FROM appointment WHERE `status`='Pending' or `status`='Approved' GROUP BY start_event HAVING COUNT(start_event) >  10";
                $sqlEvents2 = "SELECT  COUNT(start_event)as cnt,DATE_FORMAT(start_event,'%Y-%c-%d') as hasEvents FROM appointment WHERE `status`='Pending' or `status`='Approved' GROUP BY start_event HAVING cnt > 0 AND cnt< 10;";
                $resultset = mysqli_query($con, $sqlEvents) or die("database error:". mysqli_error($con));
                $resultset2 = mysqli_query($con, $sqlEvents2) or die("database error:". mysqli_error($con));
                $data = array();
                $data2 = array();
                while($rows = mysqli_fetch_assoc($resultset) ) {	
                    while($rows2 = mysqli_fetch_assoc($resultset2)){
                
                    $data[] = $rows["fullEvents"];
                    $data2[] = $rows2["hasEvents"];
                }
                }
                
           
        
        }
        else{
            header("location:../logout.php");
        }
        if(!isset($_SESSION['UserLogin'])){
            header("location:../logout.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags start -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="J.H.E Dental Clinic">
    <meta name="description" content="J.H.E. Dental Clinic">
    <meta name="author" content="Faith Maquerme, Jan Rian Camingao, Clyde Solas, Jayson Tindugan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags end -->
    <!-- CSS links start -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="css/user.css">
    <!-- CSS links end -->
    <!-- title -->
    <title>J.H.E Dental Clinic</title>
    <!-- J.H.E. Icon -->
    <link href="../images/logo.png" rel="icon">
</head>
<style>
    .ui-state-holiday .ui-state-default {
    background-color: #D70040;
    pointer-events: auto;
    opacity: 1 !important;
    color: black;
}

.ui-state-disabled[title="Full"]{
     opacity: .9 !important;
}
.ui-datepicker-today a.ui-state-highlight {
    background-color: #f6f6f6;
    border: lightgray 1px solid;
}

.ui-datepicker-calendar a.ui-state-default { background: rgba(180, 248, 200, .6)
; }

#slots-full {
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid grey;
    clear: both;
    background-color: #D70040;
}
#slots-open {
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid grey;
    clear: both;
    background-color: rgba(180, 248, 200, .6);
}
#slots-label {
    display: inline-block;
    padding-left: 10px;
}
#calendar{
    pointer-events: none;
}
@media (min-width: 1024px) {
    .calendardes{
    font-size: 23px;
    margin-bottom: 10px;
}
}
@media (min-width: 768px)  and (max-width: 1023px) {
    .calendardes{
    font-size: 15px;
    margin-bottom: 10px;
}
}
@media (max-width: 767px) {
    .calendardes{
    font-size: 22px;
    margin-bottom: 10px;
}
  }


    </style>
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
                    <li class="dropdown-item px-1 active">
                        <a class="nav-link" aria-current="page" href="user.php"><i class="bi bi-house"></i>&nbsp; Home</a>
                    </li>
                    <li class="dropdown-item px-1">
                    <a class="nav-link" href="profile.php"><i class="bi bi-person-gear"></i>&nbsp; Profile</a>
                    </li>
                    <li class="dropdown-item px-1">
                    <a class="nav-link" href="account.php"><i class="bi bi-shield-check"></i>&nbsp; Account Settings</a>
                    </li>
                    <li class="dropdown-item px-1">
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
    <!-- main content start -->
    <main>
        <div class="content" style="margin-top: 4em;"></div>
            <div class="container-fluid">
                <!-- row start -->
                <div class="row">
                    <!-- Left column start -->
                    <div class="Left_container col-md-3  p-3 bg-body order-2 order-md-1">
                          <!-- SQL Get Announcement -->
                          <?php
                            $sqll = mysqli_query($con,"SELECT * FROM announcement WHERE announce_id=(SELECT max(announce_id) FROM announcement);")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($sqll);?>
                        <!-- /SQL Get Announcement -->
                        <!-- Announcement -->
                        <div class="alert py-2 px-3 mb-3 mx-2 rounded alert-primary border" style="box-sizing:border-box; ">
                            <h4 class="announce_title fst-italic mb-0">Announcement!</h4>
                             <p class="announce_text"><?php if(!empty($row['announce_details'])){echo $row['announce_details'];} else {echo '<i class="text-secondary"> No announcement as of the moment.</i>';}?></p>
                           <p class="announce_text text-muted d-flex justify-content-end" style="font-size: 15px;"><?php if(!empty($row['announce_date'])){echo $row['announce_date'];}?></p>
                        </div>
                        <!-- /Announcement -->
                        <div class="container">
                            <div class="calendardes">
                            <div id="calendar" class="mb-1 d-flex justify-content-center" ></div>
                            </div>
                    
                        <table style="width:100%" class="mb-1 d-flex justify-content-center" >
                        <tr>
                            <td> <b> Note: </b></td>
                            <td> </td>
                            
                        </tr>
                        <tr>
                            <td><div id="slots-open"></div></td>
                            <td>With available appointment booking slots.</td>
                        </tr>
                        <tr>
                            <td><div id="slots-full"></div></td>
                            <td>Slots on this day have been booked.</td>
                        </tr>
                        </table>
                        </div>
                      

                       
                    </div>
                    <!-- Left column end -->
         <!-- Center column start of code -->
         
   <div class="center_container col-md-6 shadow-none p-3 mb-5 order-1 order-md-2">
    <?php if (isset($_POST['yes'])){ 
		$user_id = $_POST['user_id'];
        $date = $_POST['date1'];
        date_default_timezone_set('Asia/Manila');
        $now = date('Y-m-d H-i-s');
        $date1 = new DateTime($date.' 00:00:00');
         $date2 = new DateTime($date.' 00:00:00');
         $start_datetime = $date1->format('Y-m-d H-i-s');
         $end_datetime = $date2->format('Y-m-d H-i-s');
         $newDate = date("F d, Y", strtotime($date));  
	
		$service1 = $_POST['service1'];
        $doctor = $_POST['doctor1'];
		$equal = $_POST['equal'];
		$sqlcode=mysqli_query($con,"INSERT into appointment (`user_id`,`service_id`,`start_event`,`end_event`,`number`,`status`,`applyDate`,`doctor`) 
        values('$user_id','$service1','$start_datetime','$end_datetime','$equal','Pending','$now','$doctor')")or die(mysqli_error($con));
        $result=mysqli_query($con,$sqlcode);
		?>
		<div class="alert alert-success py-4 rounded">
            <h3 style="text-align:justify">
            You have requested an appointment on  
            <u><?php echo  $newDate; ?></u> . <br>
            Please expect a response from us within 24 hrs, you may check 
            'My Appointment' page for the status of your appointment request. 
            Thank you ! ! 
            </h3>
        </div>
		<?php }else{ ?>
		<script>
		alert('error');
		</script>
		<?php } ?>
		<br>
		<br>

 

            </div>
    <!-- Center column end of code -->
                    <!-- right column start -->
                    <div class="left_container col-md-3  p-3 bg-body rounded order-3 order-md-3">
                        <!-- list of services start -->
                        <div class="alert alert-primary py-2">Lists of services</div>
                            <div class="table_service"style=" display: inline-block;
                                                                height: 260px;
                                                                width: 100%;
                                                                overflow-y: auto;
                                                                overflow-x: hidden;
                                                                font-size: small;" >
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Services Offer</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sqll = mysqli_query($con,"SELECT * FROM services")or die(mysqli_error($con));
                                            while($row = mysqli_fetch_array($sqll)){
                                            $service_id=$row['service_id'];
                                            ?>
                                            <td><?php echo $row['service']; ?></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                             <!-- Office Hours start -->
                        
                        <!-- Office Hours end -->
                        <!-- msg us start -->
                        <div class="left_text">
                            <div class="alert alert-primary py-2">For more info, contact us via:</div>
                                <ol class="list-unstyled mb-3">
                                    <li><span class="fw-bold">Facebook:</span>
                                    <a href="https://www.facebook.com/profile.php?id=100072208115413" style="text-decoration: none;">jhedental@facebook.com</a></li>
                                    <li><span class="fw-bold">Email:</span> jhedental@gmail.com</li>
                                    <li><span class="fw-bold">Call us:</span> 0919 617 7260</li>
                                </ol>
                        </div>
                        <!-- msg us end -->
                         <!-- Office Hours start -->
                         <div class="left_text">
                            <div class="alert alert-primary py-2">Office Hours</div>
                                <ol class="list-unstyled mb-3">
                                    <li>Monday - Saturday (9:00am - 5:00pm)</li>
                                </ol>
                        </div>
                        <!-- Office Hours end -->
                       
                        </div>
                        <!-- list of services end -->
                    </div>
                    <!-- right column end -->
                </div>
                <!-- row end  -->
            </div>
        </div>
    </main>
 
    <!-- main content end -->
    <!-- scripts/links section start -->
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  

    <script type="text/javascript">

$(document).ready(function() {
  $('#medicalhistoryy').modal('show');
});


    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }


        (() => {
        'use strict'
        const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })()


    $("#date").attr( 'readOnly' , 'true' );
    function IsEmpty() {
    if (document.forms['apt'].question.value === "") {
        alert("empty");
        return false;
    }
    return true;
    }
   
    var fullEvents = <?php echo json_encode($data); ?>;
    var hasEvents = <?php echo json_encode($data2); ?>;
    
    // var fullEvents= ["2023-1-12"];
    var dateToday = new Date();
    $(function() {
        $( "#date" ).datepicker({
            beforeShowDay: highLight,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            minDate: dateToday,
            
        });
        function highLight(date) {
        for (var i = 0; i < fullEvents.length; i++) {
            if (new Date(fullEvents[i]).toString() == date.toString()) {
                return [false, 'ui-state-holiday','Full'];
            }
        }
    
        return [true];
   
        
    } 
      
    });

//    claendar dislapy
    $("#calendar").attr( 'readOnly' , 'false' );
    function IsEmpty() {
    if (document.forms['apt'].question.value === "") {
        alert("empty");
        return false;
    }
    return true;
    }
   
    var fullEvents2 = <?php echo json_encode($data); ?>;
    var hasEvents2 = <?php echo json_encode($data2); ?>;
    
    // var fullEvents= ["2023-1-12"];
    var dateToday2 = new Date();
    $(function() {
        $( "#calendar" ).datepicker({
            beforeShowDay: highLight2,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            minDate: dateToday2,
            
        });
        function highLight2(calendar) {
        for (var i = 0; i < fullEvents2.length; i++) {
            if (new Date(fullEvents2[i]).toString() == calendar.toString()) {
                return [false, 'ui-state-holiday','Full'];
            }
        }
        
        return [true];
   
        
    } 
      
    });
        
    
   
    </script>
   
<?php include('logoutModal.php'); ?>

</body>
</html>