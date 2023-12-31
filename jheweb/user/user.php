<?php
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php';
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
                $sql4 = "UPDATE `medicalhistory`
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
                        <div class="alert py-2 px-3 mb-3 mx-2 rounded alert-warning border-secondary" style="box-sizing:border-box; ">
                            <h3 class="announce_title fst-italic mb-2"><i class=" mr-2 bi bi-megaphone"></i> Announcement!</h3>
                           <p class="announce_text"><?php if(!empty($row['announce_details'])){echo $row['announce_details'];} else {echo '<i class="text-secondary"> No announcement as of the moment.</i>';}?></p>
                           <p class="announce_text py-0 my-0 text-muted d-flex justify-content-end" style="font-size: 15px;"><?php if(!empty($row['announce_date'])){echo $row['announce_date'];}?></p>
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
                    <!-- center column start -->
                    <div class="center_container col-md-6 shadow-none p-3 order-1 order-md-2">
                    <?php
                        if (isset($_POST['submit']))  {
                            if ((isset($_POST['submit'])) AND $_POST['date']!=null)  {
                                $date = $_POST['date'];
                                $service = $_POST['service'];
                                $date1 = new DateTime($date.' 00:00:00');
                                $date2 = new DateTime($date.' 00:00:00');
                                $start_datetime = $date1->format('Y-m-d H-i-s');
                                $end_datetime = $date2->format('Y-m-d H-i-s');
                                $query = mysqli_query($con,"SELECT * from appointment where `start_event` = '$start_datetime' and `user_id` = '$user_id' ")or die(mysqli_error($con));
                                $query2 = mysqli_query($con,"SELECT   `start_event` from appointment where `start_event` = '$start_datetime' AND `status`='Pending' or `status`='Approved'")or die(mysqli_error($con));
                                
                                $myCount = mysqli_num_rows($query);
                                $allCount = mysqli_num_rows($query2);

                                /* 	echo $count; */
                               
                                if($allCount >= 10){
                                ?>
                                <script>alert('This date is already full.');</script>
                                <?php
                                }
                                if($allCount < 10){
                                $equal = $allCount + 1 ;
                                $sqll = mysqli_query($con,"SELECT * FROM services WHERE service_id='$service'")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($sqll)){
                                $serviceName=$row['service'];}
                                $sql2 = mysqli_query($con,"SELECT * FROM admindb WHERE position='Doctor' and available='Yes'")or die(mysqli_error($con));
                                while($row2= mysqli_fetch_array($sql2)){
                                $doctor="Dr. ".$row2['fname']." ".$row2['mname']." ".$row2['lname'];}
                                $newDate = date("F d, Y", strtotime($date));  
                             
                                ?>
                        <div class="container bg-light p-5 mt-3  rounded shadow ">
                            <div class="alert alert-success">
                            Queue:&emsp; <strong><?php echo $equal; ?>/10</strong>
                            <br> Date: &nbsp;&nbsp; &emsp;<strong><?php echo $newDate; ?></strong>
                            <br> Doctor: &emsp;<strong><?php echo $doctor; ?></strong>
                            <br> Service: &emsp;<strong><?php echo $serviceName; ?></strong></div>
                            <form method="POST" action="yes.php">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >
                                <input type="hidden" name="date1" value="<?php echo $date; ?>" >
                                <input type="hidden" name="service1" value="<?php echo $service; ?>" >
                                <input type="hidden" name="doctor1" value="<?php echo $doctor; ?>" >
                                <input type="hidden" name="equal" value="<?php echo $equal; ?>" >
                                <h6 class="d-flex justify-content-center">Are you sure you want to set an Appointment on this date?</h6><br>
                                <div class="container d-flex justify-content-center">
                                    <a href="user.php" class="btn btn-secondary"><i class="icon-remove"></i>&nbsp;Cancel</a>&nbsp; 
                                <button name="yes" class="btn btn-success "><i class="icon-check icon-large"></i>&nbsp;Yes</button>  
                                </div>
                            </form>
                        </div>
                        <br><br>
                            <?php }}
                            else{
                            echo'<script> alert("Date field is empty ! !");</script>';
                            }}
                        ?>
                        
                       
                        <form method="POST" class="border p-4 rounded" id="apt" name="apt">
                            <div class="d-flex alert alert-primary justify-content-center py-2">
                                Select the Date of Appointment And Service
                            </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-floating col-sm-9 mt-4 mb-2 ">
                                    <?php date_default_timezone_set('Asia/Manila');echo "Today is: ". date('F j, Y');?>
                                        <div class="form-floating mb-2">
                                        <input type="date" autocomplete="off" style="cursor: pointer;"
                                        name="date" id="date" class="date form-control datepicker" required>
                                        <label for="floatingInput">Appointment Schedule</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-floating col-sm-9 mb-2">
                                        <div class="form-floating mb-2">
                                            <select name="service" class="select form-select" required>
                                                <option value=""hidden>Select a service</option>
                                                <?php
                                                $query ="SELECT `service_id`, `service` FROM services";
                                                $result = $con->query($query);
                                                if($result->num_rows> 0){
                                                    while($optionData=$result->fetch_assoc()){
                                                    $option =$optionData['service'];
                                                    $id =$optionData['service_id'];
                                                ?>
                                                <option value="<?php echo $id; ?>" ><?php echo $option; ?> </option>
                                                <?php
                                                }}?>
                                            </select>
                                            <label for="floatingSelectGridGender">Services</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-floating col-sm-9 mb-2">
                                        <div class="form-floating mb-2">
                                            <select name="doctor" class="select form-select" required>
                                                <option value=""hidden>Select..</option>
                                                <?php
                                                $query2 ="SELECT * FROM admindb WHERE position='Doctor' and available='Yes'";
                                                $result2 = $con->query($query2);
                                                if($result2->num_rows> 0){
                                                    while($optionData2=$result2->fetch_assoc()){
                                                    $option2 ="Dr. ".$optionData2['fname']." ".$optionData2['mname']." ".$optionData2['lname'];
                                                    $id2 =$optionData2['id'];
                                                ?>
                                                <option value="<?php echo $id2; ?>" ><?php echo $option2; ?> </option>
                                                <?php
                                                }}?>
                                            </select>
                                            <label for="floatingSelectGridGender">Available Doctor/s</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="button mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                    Submit</button>
                                </div>
                                <div class="alert alert-light border mx-5"><b>Note: <br> We can accomodate up to 10 patients daily, if the date on the calendar has been marked <span style="color:red">RED</span> it means that the slot on that day have been booked.</b></div>
                        </form>
                       
                    </div>
                    <!-- center column end -->
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
                                            <th>Info</th>
                                           
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
                                            <td><a rel="tooltip"  title="View Image" id="<?php echo $service_id; ?>"href="#imgview<?php echo $service_id; ?>" data-bs-toggle="modal" class="p-0 m-0 text-decoration-none">View</a></td> 
                                            <?php include('modal_imgview.php'); ?>
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
     <?php 
     if($_SESSION['generalHealth']==NULL){
     ?>                                           
    <div class="modal" id="medicalhistoryy" data-bs-backdrop="static">
                                            <div class="modal-dialog" >
                                                <div class="modal-content rounded-4 shadow">
                                                <div class="modal-header border-bottom-0">
                                                    <h1 class="modal-title fs-5">Medical History </h1>
                                                   
                                                </div>
                                                <div class="modal-body py-0">
                                                <form action="" method="POST" class="">
                            <!-- medical records start -->

                               
                            <div class=" alert alert-info border d-flex justify-content-center  p-0 mx-2 px-2">
                                    Please fill up this form to let us know about your Medical History before making an appointment. Thank you.
                                </div>
                            <div class="widget-inner"style="padding:0 2% 0 2%;">
                                <div class="row">
                                <label class="text-secondary"style="font-size:12px">Type 'N/A' if not applicable</label>
                                    <div class="col-12 py-0 my-0">
                                    <div class="form-floating mb-3">
                                        <input type="text" 
                                        class="form-control"
                                        name = "generalHealth"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['generalHealth'])){echo $_SESSION['generalHealth'];} ?>"
                                        style="height: 3em;" required>
                                        <label for="floatingInput"style="padding-left:22px">General Health:</label>
                                    </div>
                                    </div>
                                   
                                    <div class="col-md-6 py-0 my-0">
                                    <label class="text-secondary"style="font-size:12px">Type 'N/A' if not applicable</label>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                        class="form-control"
                                        name = "existingIllness"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['existingIllness'])){ echo $_SESSION['existingIllness'];} ?>"
                                        style="height: 3em;" required>
                                        <label for="floatingInput"style="padding-left:22px">Existing Illness:</label>
                                    </div>
                                    </div>

                                    <div class="col-md-6 py-0 my-0">
                                    <label class="text-secondary"style="font-size:12px">Type 'N/A' if not applicable</label>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                        class="form-control"
                                        name = "medicine"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['medicine'])){ echo $_SESSION['medicine'];} ?>"
                                        style="height: 3em;" required>
                                        <label for="floatingInput" style="padding-left:22px">Medicine/Drugs:</label>
                                    </div>
                                    </div>
                                    <div class="col-md-6 py-0 my-0">
                                    <label class="text-secondary"style="font-size:12px">Type 'N/A' if not applicable</label>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                        class="form-control"
                                        name = "allergies"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['allergies'])){ echo $_SESSION['allergies'];} ?>"
                                        style="height: 3em;"required>
                                        <label for="floatingInput" style="padding-left:22px">Allergies:</label>
                                    </div>
                                    </div>
                                    <div class="col-md-6 py-0 my-0">
                                    <label class="text-secondary"style="font-size:12px">Type 'N/A' if not applicable</label>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                        class="form-control"
                                        name = "bloodPressure"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['bloodPressure'])){ echo $_SESSION['bloodPressure'];} ?>"
                                        style="height: 3em;" required>
                                        <label for="floatingInput" style="padding-left:22px">Blood Pressure:</label>
                                    </div>
                                    </div>
                                   
                                                </div>
                                                <div class="modal-footer flex-column border-top-0">
                                                
                                                <div class="form-group col-12 d-flex justify-content-end">
                                        <button type="reset"id="reset" clear() class="btn btn-danger btn-md mx-2" ><i class="bi bi-x-circle"></i> Clear</button>
                                        <button type="submit" name="updateMedical" class="btn btn-primary btn-md" ><i class="bi bi-check-circle"></i> Submit</button>
                                    </div>
                                </div>
                                
                            </div>
                                <!-- medical records end -->
                        </form>  
                                                </div>
                                                </div>
                                            </div>
                                        </div>

            <?php 
     }
     ?>
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