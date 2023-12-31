<?php
    session_start();

    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
    require($serverdpphp);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">
    <script>document.documentElement.style.setProperty('--original-viewport-height', window.innerHeight+"px")</script>
    
<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- icon -->

    <title>J.H.E. Dental Clinic</title>
    <link href="images/logo.png" rel="icon">
</head>
<style>
    @media (min-width: 1000px) {
      .verifInfo{
        width:500px !important;
      }
    }
    .main_container{
      width: 28%;
    }
    @media (max-width: 991.98px){
      .main_container{
        width: 50%;
      }
    }
    @media (max-width: 767.98px){
      .main_container{
        width: 100%;
      }
    }
</style>
<body>
 <!--navbar start of code  -->
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #345c83">
        <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color:white ; "><img src="images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3></a>
            <!-- toggle button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-sm-0 px-4">
              <li class="nav-item px-4">
                <a class="nav-link active" aria-current="page" href="index.php">HOME </a>
              </li>
              <li class="nav-item">
                <a  type="button" class="btn btn-outline-info" href="login.php">LOG IN </a>
              </li>
            </ul>
           
          
          
            </div>
          </div>
        </div>
      </nav>
      <!--navbar end of code  -->
      <div class="container main_container" style="margin-top: 6em;">
        <div class="container-signup d-flex justify-content-center">
        <div class="bg-light p-3 rounded shadow p-3 mb-5 bg-body rounded">
        <!--Start Reg Form-->
        <form action="#" method="POST" id="registrationform">
        <h3 class="mb-2 text-center fw-bold">Sign Up</h3>
        <hr class="mb-2">
<?php

$problem = false;// kung may errro overall
$errormail =false;//email error
$errorlength =false;// password legnth error
$errordiff = false;// pasword and confirm pass weeor




if (isset($_POST["register"])&& $_POST['email']) {

  $selectionarr = explode(",", $_POST['hiddentext']);

  $gender = ($_POST['gender']);

//   $stuid = $_POST['stuid'];

  $fname= strtoupper($_POST['fname']);
  $lname= strtoupper($_POST['lname']);
  $mname= strtoupper($_POST['mname']);
  $email=$_POST['email'];
  $token = md5($_POST['email']).rand(10,9999);
  //$gender=$_POST['gender'];


  $phone=$_POST['phone'];
  $bday=$_POST['bday'];
//   $accesstoken="ALUMNI";
  $pass=$_POST['pass'];
  $cpass = $_POST['cpass'];

  $encpass = md5($pass);


  $sqlcode = "SELECT * FROM users WHERE email = '{$email}';";
  $result = mysqli_query($con,$sqlcode);
  $numrow = mysqli_num_rows($result);
  
  if ($numrow > 0) {//email 
    $errormail = true;
    $problem = true;
  }
  if ($pass != $cpass) {
    //echo "different";
    $errordiff = true;
    $problem = true;

  }

  if(strlen($pass) < 8){
    $errorlength = true;
    $problem = true;
  }
  
  if(!$problem){



    $sqlcode = "INSERT INTO users (`email`,`email_verification_link`,`pass`,`fname`, lname, birthday, contact, sex, mname) 
    VALUES ('{$email}','{$token}','{$encpass}','{$fname}', '{$lname}', '{$bday}', '{$phone}', '{$gender}', '{$mname}');";
    $result = mysqli_query($con,$sqlcode);

    $user_query = mysqli_query($con,"SELECT * from users where `email`= '$email'")or die(mysqli_error($con));
		$user_row = mysqli_fetch_array($user_query);
    $user_id = $user_row['user_id'];

    $sqlcode2 = "INSERT INTO medicalhistory (`user_id`) VALUES ('{$user_id}');";
    $result2 = mysqli_query($con,$sqlcode2);

    $link = "<a href='http://jhedental.infinityfreeapp.com/verify-email.php?key=".$_POST['email']."&token=".$token."'> Click and Verify Email</a>";
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "jhedentalclinic@gmail.com";
    // GMAIL password
    $mail->Password = "yzuytoszvhsxspgv";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "587";
    $mail->From='jhedentalclinic@gmail.com';
    $mail->FromName='J.H.E. DENTAL';
    $mail->AddAddress($email, $fname.' '.$lname);
    $mail->Subject  =  'Verify Your Account';
    $mail->IsHTML(true);
    $mail->Body    = '<H3>Hello '.$fname.', <br>Please Click On This Link to Verify Your Email <b style="color:green">'.$link.' </b></H3>';
    if($mail->Send())
    {
    echo '<div class="alert alert-success py-2 verifInfo">Please Check Your Email and Click on the email verification link to verify your account. If you do not see the email in a few minutes, check your “junk mail” folder or “spam” folder.</div>';
    }
    else
    {
    echo "Mail Error - >".$mail->ErrorInfo;
    }
        
      }
    }

?>

<script>
   if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
   }
   </script>  
                         <input type="hidden" name="hiddentext" value="01qwe" id="hidevalue">
                          <div class="row col-sm g-6">
                            <div class=" form-floating col-sm-6 mb-2 mt-2">
                              <div class="form-floating mb-2">
                                <input type="text" id="fiid" onkeypress="return /[a-z\-\ ]/i.test(event.key)" class="form-control form-control-sm<?php if (isset($_POST['fname'])&& $problem) {echo "is-valid";}?>" value ="<?php if (isset($_POST['fname'])&& $problem) {echo $_POST['fname'];}?>"   name="fname" placeholder="name@example.com" required>
                                <label for="floatingInput">First Name</label>
                              </div>
                            </div>
                          
                            <div class=" form-floating col-sm-6 mb-2 mt-2">
                              <div class="form-floating mb-2">
                              <input type="text" id="midid"  onkeypress="return /[a-z\-\ ]/i.test(event.key)" class="form-control  <?php if (isset($_POST['mname']) && $problem) {echo "is-valid";}?>" value ="<?php if (isset($_POST['mname']) && $problem) {echo $_POST['mname'];}?>"  name="mname" placeholder="name@example.com" required>
                                <label for="floatingInput">Middle Name</label>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row col-sm g-6">
                            <div class=" form-floating col-sm-6 mb-2">
                              <div class="form-floating mb-2">
                              <input type="text" id="lastid"  onkeypress="return /[a-z\-\ ]/i.test(event.key)" class="form-control <?php if (isset($_POST['lname']) && $problem) {echo "is-valid";}?>" value ="<?php if (isset($_POST['lname']) && $problem) {echo $_POST['lname'];}?>"   name="lname" placeholder="name@example.com" required>
                                <label for="floatingInput">Last Name</label>
                              </div>
                            </div>
                            <!-- sex -->
                            <div class="col-sm-6 mb-2">
                                <div class="form-floating mb-2">
                                  <select class="form-select form-select-xs  <?php if (isset($gender) && $problem) {echo "is-valid";}?>" 
                                  name="gender" id="floatingSelectGridGender" aria-label="Floating label select example" required>
                                   <option value="">Select...</option>
                                    <option value="MALE" <?php if (isset($gender) && $gender == "MALE" && $problem) {echo "selected";}?>>MALE</option>
                                    <option value="FEMALE"  <?php if (isset($gender) && $gender == "FEMALE" && $problem) {echo "selected";}?>>FEMALE</option>
                                    <option value="OTHERS"  <?php if (isset($gender) && $gender == "OTHERS" && $problem) {echo "selected";}?>>OTHERS</option>
                                  </select>
                                  <label for="floatingSelectGridGender">Sex</label>
                                  <!--floatingSelectGridGender-->
                                </div>
                              </div>
                          </div>

                            <div class="row col-sm g-6">
                            <div class=" form-floating col-sm-12 mb-2">
                              <div class="form-floating mb-2">
                                <input type="email" id="emailid"  class="form-control <?php if (isset($_POST['email']) && $errormail && $problem) {echo "is-invalid";}else if(isset($_POST['email']) && !$errormail && $problem){echo "is-valid";}?>" value="<?php if(isset($_POST['email']) && !$errormail && $problem){echo $_POST['email'];}?>"
                                  name="email" placeholder="name@example.com" required>
                                <label for="floatingInput">Email Address</label>
                                 <?php if (isset($_POST['email']) &&  $errormail) {echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Email already exists.</div>';}?>
                              </div>
                            </div>
                            </div>
                            <div class="row col-sm g-6">
                              <div class=" form-floating col-sm-6 mb-2">
                                <div class="form-floating mb-2">
                                  <input type="text"   onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" class="form-control <?php if (isset($_POST['phone'])&& $problem) {echo "is-valid";}?>" value ="<?php if (isset($_POST['phone'])&& $problem) {echo $_POST['phone'];}?>"   name="phone" placeholder="name@example.com" required>
                                  <label for="floatingInput">Mobile Number</label>
                                </div>
                            </div>

                              <div class=" form-floating col-sm-6 mb-2">
                                <div class="form-floating mb-2">
                                  <input type="date" max="<?php echo date("Y-m-d",strtotime("-1 year"));?>" title="Age must be at least 1 year or older." class="form-control <?php if (isset($_POST['bday'])&& $problem) {echo "is-valid";}?>" value ="<?php if (isset($_POST['bday'])&& $problem) {echo $_POST['bday'];}?>"   name="bday" placeholder="name@example.com" required>
                                  <label for="floatingInput">Birthday</label>
                                </div>
                              </div>
                            </div>

<!--Passwords-->
                            <div class="row col-sm g-6">
                              <div class=" form-floating col-sm-6 mb-2">
                                <div class="form-floating mb-2">
                                  <input type="password"  pattern="(?=.*?[.#?!@$%^&*-\]\[])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least 8 or more characters, a number, uppercase and lowercase letter, and a special character"class="form-control <?php if (isset($_POST['cpass']) &&  $errorlength && $problem) {echo "is-invalid";}?>"  name="pass" placeholder="name@example.com" id="passwordid1" required>
                                  <label for="floatingInput">Enter Password</label>
                                  
                                    <p style="font-size:.6rem; font-weight: bold;">Note: Password must contain at least 8 or more characters, a number, uppercase and lowercase letter, and special character</p>
                                  
                                  <?php if (isset($_POST['pass']) &&  $errorlength) {echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Passwords should be atleast 8 character</div>';}?>
                                  
                                </div>
                              </div>
  
                              <div class=" form-floating col-sm-6 mb-2">
                                <div class="form-floating mb-2">
                                  <input type="password" class="form-control <?php if (isset($_POST['cpass']) &&  $errordiff && $problem) {echo "is-invalid";}?>"
                                     name="cpass" placeholder="name@example.com" id="passwordid2" required>
                                  <label for="floatingInput">Confirm Password</label>
                                  <?php if (isset($_POST['cpass']) &&  $errordiff) {echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Password doesnt match</div>';}?>
                                </div>
                                <div class="form-check d-flex justify-content-end">
                                  <input class="form-check-input"  type="checkbox" value="" onclick="flexCheckDefault()" id="flex">
                                  <label class="form-check-label" for="flex">
                                    Show Password
                                  </label>
                                </div>
                              </div>
                            </div>

                            <!--Button Start-->
                        <!--<div class="d-flex justify-content-end pt-2">
                          <button type="submit" class="btn btn-md ms-2 btnregister">Register</button>
                        </div>-->

                        <div class="d-flex justify-content-center mt-2 login_container">
                          <input type="submit" name="register" id="register" value = "Register" class="btn btn-primary">
                          </div>
                  
                        <p class="text-center text-muted mt-3 mb-0 fw-normal">Already have an account? <a href="login.php"
                          class= "loginhere text-decoration-none">Login here</a></p>
                                <small class="text-muted d-flex justify-content-center">By clicking Sign up, you agree to the &nbsp;<a  data-bs-toggle="modal" href="#clickModal"> Terms of Use.</a></small>
                        </form>
                            


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <script src="debug.js"></script>
      <script>
          var addressid = document.getElementById("addressid");
          //var emailid = document.getElementById("emailid");
          var midid = document.getElementById("midid");
          var lastid = document.getElementById('lastid');
          var fiid = document.getElementById('fiid');


          addressid.addEventListener("input",()=>{
            addressid.value = addressid.value.toUpperCase();
          })
          //emailid.addEventListener("input",()=>{
            //emailid.value = emailid.value.toUpperCase();
          //})
          midid.addEventListener("input",()=>{
            midid.value = midid.value.toUpperCase();
          })
          lastid.addEventListener("input",()=>{
            lastid.value = lastid.value.toUpperCase();
          })
          fiid.addEventListener("input",()=>{
            fiid.value = fiid.value.toUpperCase();
          })


         function flexCheckDefault() {
        var pass1 = document.getElementById("passwordid1");
        var pass2 = document.getElementById("passwordid2");
        if (pass1.type === "password") {
          pass1.type = "text"
        } 
        if (passwordid2.type === "password") {
          pass2.type = "text";
        } else {
          pass1.type = "password";
          pass2.type = "password";
        }
      }


    </script>


      </div>
    </div>
</div>
        </div>


 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<?php include('termsofuse.php'); ?>
</body>
</html>