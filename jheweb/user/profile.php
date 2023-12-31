<?php
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['UserLogin'])){
            $_SESSION['UserLogin'];
            $email=strtoupper($_SESSION['UserLogin']['email']);
            $user_id=strtoupper($_SESSION['UserLogin']['user_id']);

            $regdate=strtoupper($_SESSION['UserLogin'] ['regdate']);
            
            
            $userr="SELECT * FROM users  WHERE user_id='$user_id'";
            $user = $con->query($userr) or die ($con->error);
            $row = $user->fetch_assoc();
            $totaluser = $user->num_rows;
              if ($totaluser>0)
              {
                  $_SESSION['fname']=$row["fname"];
                  $_SESSION['lname']=$row["lname"];
                  $_SESSION['mname']=$row["mname"];
                  $_SESSION['sex']=$row["sex"];
                  $_SESSION['contact']=$row["contact"];
                  $_SESSION['birthday']=$row["birthday"];
                  $birthday= $row['birthday'];
                  $currentDate = date("d-m-Y");
                  $age = date_diff(date_create($birthday), date_create($currentDate));
              }
            if(isset($_POST['updateProfile'])){
              $fname=strtoupper($_POST['fname']);
              $mname=strtoupper($_POST['mname']);
              $lname=strtoupper($_POST['lname']);
              $sex=strtoupper($_POST['sex']);
              $contact=$_POST['contact'];
              $birthday=$_POST['birthday'];
              mysqli_query($con,"UPDATE users
              set `fname`='$fname', `mname`='$mname',`lname`='$lname',`sex`='$sex', `contact`='$contact', `birthday`='$birthday' WHERE user_id = '$user_id'")or die(mysqli_error($con)); 
             
              echo'<script> alert("Profile has been updated");</script>';
            
                $_SESSION['fname']=$fname;
                $_SESSION['lname']=$lname;
                $_SESSION['mname']=$mname;
                $_SESSION['sex']=$sex;
                $_SESSION['contact']=$contact;
                $_SESSION['birthday']=$birthday;
                 $age = date_diff(date_create($birthday), date_create($currentDate));
                
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
    <!-- meta tags start -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="J.H.E Dental Clinic">
    <meta name="description" content="Free Web tutorials for HTML and CSS">
    <meta name="author" content="Faith Maquerme, Jan Rian Camingao, Clyde Solas, Jayson Tindugan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags end -->
    <!-- CSS links start -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="css/profile.css">
    <!-- CSS links end -->
    <!-- title -->
    <title>J.H.E Dental Clinic</title>
    <!-- J.H.E. Icon -->
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
                    <li class="dropdown-item px-1">
                        <a class="nav-link" aria-current="page" href="user.php"><i class="bi bi-house"></i>&nbsp; Home</a>
                    </li>
                    <li class="dropdown-item px-1 active">
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
                    <div class="Left_container col-md-3  p-3 bg-body order-3 order-md-1">
            
                    </div>
                    <!-- Left column end -->
                    <!-- Center column start of code -->
            <div class="center_container col-md-6 shadow-none p-3 mb-5 order-1 order-md-2">
<!-- E D I T _ P R O F I L E-->

<div class="d-flex justify-content-center ">

            <div class="col-md-7 shadow p-3 mb-5 bg-body rounded">
            <div class="d-flex alert alert-info justify-content-center py-2 text-nowrap">Edit Personal Information</div>
              <div class="wrap">
     
                <form method="POST" action="">
                <div class="form">
                  <div class="input_field">
                    <label>First Name</label>
                    <input type="text"onkeypress="return /[zA-Z]/i.test(event.key)" class="input" name="fname" value ="<?php echo $_SESSION['fname'] ?>">
                  </div>

                  <div class="input_field">
                    <label>Last Name</label>
                    <input type="text"onkeypress="return /[zA-Z]/i.test(event.key)" class="input"name="lname" value ="<?php echo $_SESSION['lname'] ?>">
                  </div>

                  <div class="input_field">
                    <label>Middle Name</label>
                    <input type="text"onkeypress="return /[zA-Z]/i.test(event.key)" class="input"name="mname" value ="<?php echo $_SESSION['mname'] ?>">
                  </div>

                  <div class="input_field">
                    <label>Birthday</label>
                    <input type="date" max="<?php echo date("Y-m-d",strtotime("-1 year"));?>" value="<?php echo $_SESSION['birthday']; ?>" name="birthday"  class="input" >
                  </div>

                  <div class="input_field">
                    <label>Contact No.</label>
                    <input type="text"onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" class="input" name="contact" value ="<?php echo $_SESSION['contact'] ?>">
                  </div>

                  <div class="input_field">
                    <label>Age</label>
                    <input type="text" class="input" disabled name="age" value ="<?php echo $age->format("%y"); ?>">
                  </div>

                  <div class="input_field">
                    <label>Gender</label>
                    <div class="custom_select">
                      <select name="sex">
                      <option value="<?php echo $_SESSION['sex']?>" style="display: none;" ><?php echo $sex?></option>    
                      <option value="MALE" <?php echo ($_SESSION['sex']=="MALE")? 'selected':'';?> >MALE</option>
                      <option value="FEMALE" <?php echo ($_SESSION['sex']=="FEMALE")? 'selected':'';?>>FEMALE</option>
                      <option value="OTHER" <?php echo ($_SESSION['sex']=="OTHER")? 'selected':'';?>>OTHER</option>
                    </select>
                    </div>
                  </div>

                  <div class="input_field">
                    <button type="submit" name="updateProfile" class="btn">
                        <span class="btn_text">Update</span>
                      </span>
                  </div>

                </div>

                </form>
                <hr>
                <form action="" method="POST" class="">
                            <!-- medical records start -->
                            <div class="wc-title">
                            <div class="d-flex alert alert-info justify-content-center py-2 text-nowrap">Medical History</div>
                               
                            </div>
                            <div class="widget-inner"style="padding:0 2% 0 2%;">
                                <div class="row">
                                    <div class="form-floating mb-3 col-12">
                                        <input type="text" 
                                        class="form-control" required
                                        name = "generalHealth"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['generalHealth'])){echo $_SESSION['generalHealth'];} ?>"
                                        style="height: 3em;">
                                        <label for="floatingInput"style="padding-left:22px">General Health:</label>
                                    </div>
                                    <div class="form-floating mb-3 col-md-6">
                                        <input type="text"
                                        class="form-control" required
                                        name = "existingIllness"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['existingIllness'])){ echo $_SESSION['existingIllness'];} ?>"
                                        style="height: 3em;">
                                        <label for="floatingInput"style="padding-left:22px">Existing Illness:</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3 col-md-6">
                                        <input type="text"
                                        class="form-control"
                                        name = "medicine" required
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['medicine'])){ echo $_SESSION['medicine'];} ?>"
                                        style="height: 3em;">
                                        <label for="floatingInput" style="padding-left:22px">Medicine/Drugs:</label>
                                    </div>

                                    <div class="form-floating mb-3 col-md-6">
                                        <input type="text"
                                        class="form-control"
                                        name = "allergies" required
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['allergies'])){ echo $_SESSION['allergies'];} ?>"
                                        style="height: 3em;">
                                        <label for="floatingInput" style="padding-left:22px">Allergies:</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3 col-md-6">
                                        <input type="text"
                                        class="form-control" required
                                        name = "bloodPressure"
                                        placeholder="Type 'N/A' if not applicable."
                                        value ="<?php if(!empty($_SESSION['bloodPressure'])){ echo $_SESSION['bloodPressure'];} ?>"
                                        style="height: 3em;">
                                        <label for="floatingInput" style="padding-left:22px">Blood Pressure:</label>
                                    </div>
                                    <div class="form-group col-12 d-flex justify-content-end">
                                        <button type="reset"id="reset" clear() class="btn btn-danger btn-md mx-2" > Clear</button>
                                        <button type="submit" name="updateMedical" class="btn btn-primary btn-md" > Submit</button>
                                    </div>
                                </div>
                            </div>
                                <!-- medical records end -->
                        </form>
              </div>
        
            </div>
            
</div>

<div class="container d-flex justify-content-center pb-3">
        <a  type="button"href="user.php" class="btn btn-outline-primary">Back to home</a>
</div>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- /Edit Profile -->                        
            </div>
    <!-- Center column end of code -->

                    <!-- right column start -->
                    <div class="left_container col-md-3  p-3 bg-body rounded order-2 order-md-3">
                     
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
 <script>
    (() => {
    'use strict'
    const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(tooltipTriggerEl => {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()

  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
<?php include('logoutModal.php'); ?>
</body>
</html>