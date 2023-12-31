<?php
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['UserLogin'])){
            $_SESSION['UserLogin'];
            $oldpass=$_SESSION['UserLogin']['pass'];
            $email=strtoupper($_SESSION['UserLogin']['email']);
            $user_id=strtoupper($_SESSION['UserLogin']['user_id']);
            $userr="SELECT * FROM users  WHERE user_id='$user_id'";
            $user = $con->query($userr) or die ($con->error);
            $row = $user->fetch_assoc();
            $totaluser = $user->num_rows;
              if ($totaluser>0)
              {
                  $_SESSION['fname']=$row["fname"];
                  $_SESSION['lname']=$row["lname"];
                  $_SESSION['email']=$row["email"];
                  $_SESSION['regdate']=$row["regdate"];
        
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
    <link rel="stylesheet" href="css/account.css">

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
                    <li class="dropdown-item px-1">
                        <a class="nav-link" aria-current="page" href="user.php"><i class="bi bi-house"></i>&nbsp; Home</a>
                    </li>
                    <li class="dropdown-item px-1">
                    <a class="nav-link" href="profile.php"><i class="bi bi-person-gear"></i>&nbsp; Profile</a>
                    </li>
                    <li class="dropdown-item px-1 active">
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



<!-- MAIN BODY start of code -->
<div class="content" style="margin-top: 4em;"></div>
<div class="container-fluid" style="margin: 2% 0 0 0; ">
        <div class="row">

   <!-- Left column start of code -->
   <div class="Left_container col-md-3  p-3 bg-body order-2 order-md-1">
           
            </div>
    <!-- Left column end of code -->
         
   <!-- Center column start of code -->
         
   <div class="center_container col-md-6 shadow-none p-3 order-1 order-md-2">
       <div class="content-box">
       <div class="content">
       <div class="row p-0" style="text-align: center">
       <div class="alert alert-light">
    <div class="col-sm-12">
   Email:  <i> &nbsp;<?php echo $_SESSION['email']?></i>
    </div>
    <div class="col-sm-12">
    Registration Date:  <i> &nbsp;<?php echo $_SESSION['regdate']?> </i>
    </div>
       </div>
  </div>

<div class="card mb-4"style="border:none; margin-top:2%">

<!--start of table 1 -->

<div class="row d-flex justify-content-center">
    <div class="col-lg-10 m-b30 "style="padding-bottom:5%;">
    <div class="box1"style="margin-bottom:2%;
                            background-color: white;
                            padding:5%;
                            border-radius:1%;
                            box-shadow: 1px 3px 4px 1px rgb(0,0,0,.20);">

    <div class="wc-title">
    <h4>Change Password</h4><hr>

  <?php
  //verify password, compare Password from db and entered old password.
  if(isset($_POST['changepassword'])){
    $newpass = $_POST['newpass'];
    $md5pass=md5($newpass);
    $confirm_newpass = $_POST['confirm_newpass'];
    $md5cpass=md5($confirm_newpass);
    $confirm_oldpass = $_POST['confirm_oldpass'];
    $md5oldpass=md5($_POST['confirm_oldpass']);
    
    $select2="SELECT * FROM users WHERE `pass`='$md5pass' AND `email`='$email'";
    $user2 = $con->query($select2) or die ($con->error);
        $row = $user2->fetch_assoc();
        $totaluser2 = $user2->num_rows;

      if ($totaluser2>0)
      {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
        Password must differ from your old password.
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>'; }
      else if($md5pass != $md5cpass){
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                Password and Confirm Password Field do not match  !!
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>'; }
      else if($md5oldpass != $oldpass) {
        echo '<div class="alert alert-danger alert-dismissible" role="alert">
              You entered an incorrect Current Password.
              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
      else
      {
        $sql ="UPDATE `users` SET `pass`= '$md5pass' where `email`= '$email'";
          mysqli_query($con,$sql);

              echo '<div class="alert alert-success alert-dismissible" role="alert">
              Your Password has been changed.
              <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
              </div>';
              echo'';
              sleep(2);
              unset($_SESSION['UserLogin']);
              echo'<script>if(!alert("Password has been changed. Please log in again..")){window.location.reload();}</script>';          
      }
     }
    ?>
</div>
<div class="widget-inner">
<form name="chngpwd" onSubmit="return valid();" class="edit-profile m-b30" method="POST" id="formPassword">
<div class="row">
    <div>
        <label class="col-form-label text-nowrap pt-3">Enter Current Password</label>
        <div>
            <input class="form-control"
                  type="password"
                  id="confirm_oldpass"
                  name="confirm_oldpass"
                  required="" >
   
    </div>
    <div>
        <label class="col-form-label text-nowrap pt-3">Enter New Password</label>
        
            <input class="form-control"
                  type="password"
                  id="newpass"
                  name="newpass"
                  required=""
                  pattern=".{8,20}"
                  pattern="(?=.*?[.#?!@$%^&*-\]\[])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                  title="Must contain at least 8 or more characters, a number, uppercase and lowercase letter, and a special character"
                 required="">
          
   
    </div>
    <div>
        <label class="form-label text-nowrap pt-3">Confirm New Password</label>
      
            <input class="form-control"
                    type="password"
                    id="confirm_newpass"
                    name="confirm_newpass"
                    pattern="(?=.*?[.#?!@$%^&*-\]\[])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    title="Must contain at least 8 or more characters, a number, uppercase and lowercase letter, and a special character"
                    required="" >
        
    </div>
    <div class="col-12">
        <button style="margin-top:5%;float:right;"
                        type="submit"
                        class="btn btn-primary btn-md text-nowrap"
                        name="changepassword" 
                        id="changepassword">Submit</button>
    </div>
</div>
</form>
</div>
</div>
</div>




</div>
</div>
</div>
       </div>

<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>   

      <!--clyde  -->            



      <div class="container d-flex justify-content-center pb-3">
        <a  type="button"href="user.php" class="btn btn-outline-primary">Back to home</a>
</div>

<!-- Center column end of code -->
             
            </div>
    <!-- Center column end of code -->

    <!-- Right column start of code -->
            <div class="right_container col-md-3 p-3 bg-body rounded order-3 order-md-3">
                             
                 
                    </div>
                    
    <!-- Right column end of code -->
            </div>
        </div>
<!-- MAIN BODY end of code -->



 <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
 <script>

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


var dateToday = new Date(); 
$(function() {
    $( "#date" ).datepicker({
      dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        minDate: dateToday
    });
    
});


        $(function () {
           var dateArray  = [ "2022-12-12"];
            $("#date").datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: function (date) {
                    // First convert all values in dateArray to date Object and compare with current date
                    var dateFound =  dateArray.find(function(item) {
                        var formattedDate = new Date(item);
                        return date.toLocaleDateString() === formattedDate.toLocaleDateString();
                    })
                     // check if date is in your array of dates
                    if(dateFound) {
                        // if it is return the following.
                        return [true, 'css-class-to-highlight', 'tooltip text'];
                    } else {
                        // default
                        return [true, '', ''];
                    }

                }
            });

        });
    </script>
    <style type="text/css">
       

        .css-class-to-highlight a{
           background-color: blue !important;
           color: #fff !important;
        }
    </style>
<?php include('logoutModal.php'); ?>
</body>
</html>