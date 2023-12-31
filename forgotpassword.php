<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
    require($serverdpphp);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- icon -->

    <title>J.H.E. Dental Clinic</title>
    <link href="images/logo.png" rel="icon">
    <script>document.documentElement.style.setProperty('--original-viewport-height', window.innerHeight+"px")</script>
</head>

<style>
body {
  min-height: 100vh;
  position: relative;
}
body::before {
  content: "";
  position: fixed;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("../images/aboutus.jpg");
  background-size: cover;
  background-position: center;
  height: 100%;
  width: 100%;
  min-height: var(--original-viewport-height);
  left: 0;
  top: 0;
  will-change: transform;
  z-index: -1;
}
.loginhere:hover{
  color: black!important;
}
.loginhere{
  color: #309A98 !important;
}
p.logo_w3l_agile_caption {
        text-transform: uppercase;
        letter-spacing: 6.7px;
        font-size: 11px;
        color: rgb(210, 147, 144);
        text-shadow: 0px 1px 3px #454a47;
        font-family: 'Lato', sans-serif;
        font-weight: 600;
        
    }
.nav-item:hover{
background-color: gray;
}
@media (min-width: 1024px) {
  .modal{
    margin-top: 5%;
  }
  .container-login{
    width:50%;
    margin: 1% 25% 0 25%;
  }

}
@media (min-width: 768px)  and (max-width: 1023px) {
  .modal{
    margin-top: 10%;
  }
  .container-login{
    width:96%;
    margin: 20% 2% 0 2%;
    
  }

}
@media (max-width: 767px) {
  .modal{
    margin-top: 25%;
  }
  .container-login{
    width:96%;
    margin: 18% 2% 0 2%;
  }

}
.btn-primary{
    background-color:#305f82;   
}

    </style>


<body>   
  
<div class="container-login p-4 rounded" style=" background-color: #305f82;">
    
        <div class="container d-flex justify-content-center pb-4 pt-3">
        <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color: white ;"><img src="images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3>
        </div>
     <form class="p-4 p-md-5 border rounded-3 bg-light shadow p-3 mb-5 bg-body rounded" method="post">     
 
    <div class="login_header d-flex justify-content-center">
        <h2 style="font-weight: bold;" class="mb-5">Forgot Password</h2>
    </div>
 <?php
   
    if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $user_query = mysqli_query($con,"SELECT * from `users` where `email`='$email' AND regdate is not NULL")or die(mysqli_error($con));
	$user_row = mysqli_num_rows($user_query);
    $user = mysqli_fetch_array($user_query);
    if($user_row>0){
        $token = rand().$user['pass'].rand();
        $fname = $user['fname'];
        $lname = $user['lname'];
        mysqli_query($con,"UPDATE users set changepassToken='$token' where `email`='$email' ")or die(mysqli_error($con));   
    $link = "<a href='http://jhedental.infinityfreeapp.com/changepassword.php?key=".$_POST['email']."&token=".$token."'> Click and Change Password</a>";
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
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = '<H3>Click On This Link to Reset your Password <b style="color:green">'.$link.' </b></H3>';
    if($mail->Send())
    {
    echo '<div class="alert alert-success py-2"> Please check your email and click on the reset password link to change your password. If you do not see the email in a few minutes, check your “junk mail” folder or “spam” folder.</div>';
    }
    else
    {
    echo "Mail Error - >".$mail->ErrorInfo;
    }
}
else{
     echo 
     '<div class="alert alert-danger alert-dismissible" role="alert">
     <b>Account does not exist.</b>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div> '; 
    
 
}
        
      }
      
?>
                                <div class="form-floating my-3">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="name@example.com" required>
                                    <label for="floatingInput">Enter your Email address</label>
                                </div>
                                <br>
                                <div class="button mt-3">
                                    <div class="row">
                                        
                                        <div class="col">
                                            <button class="w-100 btn btn-danger" type="reset">Cancel</button>
                                        </div>
                                        <div class="col">
                                            <button class="w-100 btn btn-success" type="submit" name="submit" id="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                               

                               <br>
                                <hr>
                                <div class="col  d-flex justify-content-center">
                                            <a class="w-30 btn btn-primary text-white" href="login.php" >LOGIN PAGE</a>
                                        </div>
                         
                            </div>




      </div>
    </form>   
</div>
      


 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script> 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>
</body>
</html>