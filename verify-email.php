<?php
    session_start();

    $serverdpphp =  'database.php'; 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- icon -->

    <title>J.H.E. Dental Clinic</title>
    <link href="images/logo.png" rel="icon">
</head>

<style>

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
    margin: 8% 25% 0 25%;
  }
  body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
  overflow-y: hidden;
}
}
@media (min-width: 768px)  and (max-width: 1023px) {
  .modal{
    margin-top: 10%;
  }
  .container-login{
    width:96%;
    margin: 35% 2% 0 2%;
    
  }
  body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
  overflow-y: hidden;
}
}
@media (max-width: 767px) {
  .modal{
    margin-top: 25%;
  }
  .container-login{
    width:96%;
    margin: 38% 2% 0 2%;
  }
  body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
  overflow-y: hidden;
}
}
.btn{
  background-color:#132f43;
}
    </style>


<body>   
    
<div class="container-login p-4 rounded" style=" background-color: #305f82;">
        <div class="container d-flex justify-content-center pb-4 pt-3">
        <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color: white ;"><img src="images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3>
        </div>
        
        
        
   <div class="alert alert-primary" style="text-align:center"><h2 >     
        <?php

$email = $_GET['email'];
$query = mysqli_query($con,"SELECT * FROM `users` WHERE `email`='$email';");
if (mysqli_num_rows($query) > 0) {
$row= mysqli_fetch_array($query);
$exp=$row["expiration_time"];


$datetime = new DateTime($exp); // create a DateTime object
$timestamp = $datetime->getTimestamp(); // get Unix timestamp
$exp1 = $timestamp * 1000; // convert to milliseconds


$dateToday = new DateTime();
$timestamp2 = $dateToday->getTimestamp();
$dateToday1 = $timestamp2 * 1000; 
$msq="werrw".$email;


if(empty($row['regdate']) && $exp1 > $dateToday1 ){
?>

<p id="demo"></p>

<script>
// Set the date we're counting down to
var countDownDate = "<?php echo $exp1; ?>";

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML ="OTP code will expire in 5 minutes: "+ minutes + ":" + seconds + " ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = 'OTP expired!';
    window.location.href = window.location.href;
  }
}, 1000);
</script>
<form method="POST">
   <input type="text"onkeypress="return /[0-9]/i.test(event.key)" maxlength="6" class="input" name="otp" >
   <button type="submit" name="submitOtp">Submit</button>
</form>
<?php if(isset($_POST['submitOtp'])){
     $otp= $_POST['otp'];
        $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$email';");
        if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
        $otp=$row["otp"];
        $inputOtp= $_POST['otp'];
        if($otp==$inputOtp){
            $d = date('Y-m-d');
            mysqli_query($con,"UPDATE users set  otp = ' ' , expiration_time = ' ', regdate ='$d ' WHERE email='$email'");
           echo "Congratulations! Your email has been verified. Redirecting to Login page in 3 seconds";
           sleep(3);
           header("Location: login.php");
           
        }
        else{
            echo "You entered an invalid or expired otp code.";
        }
}
}

}



else if(empty($row['regdate']) && $exp1 < $dateToday1 ){
    mysqli_query($con,"UPDATE users set  otp = ' '  WHERE email='" . $email . "'");
    $newotp = random_int(100000, 999999);
    $newexpiration_time = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    ?>
    <form method="POST">
    <input type="hidden" name="otp" value="<?php echo $newotp; ?>">
     <input type="hidden" name="exp" value="<?php echo $newexpiration_time; ?>">
    <p>OTP expired,  <button type="submit" name="resend"> resend.</button></p>
    </form>
   <?php
   if(isset($_POST['resend'])){
       $d = date('Y-m-d');
     mysqli_query($con,"UPDATE users set otp ='$newotp', expiration_time= '$newexpiration_time',regdate ='$d '  WHERE email='$email'")or die(mysqli_error($con));
            // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);

     try {
        // Server settings
        //  $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'localhost';

        $mail->SMTPAuth = false; 
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
   

        // Sender and recipient settings
        $mail->setFrom('info@jhedentalclinic.online', 'VERIFY YOUR ACCOUNT');
        $mail->addAddress($email, 'J.H.E. Dental Clinic'); //receiver of contact us message
    

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = 'J.H.E. Dental Clinic Appointment System Account';
        $mail->Body = '<center><b><h2>Your otp is:</h2> <br><h1 style="background-color:green"> '.$newotp.'</h1></b></center>';
        $mail->AltBody = 'Your otp is: '.$newotp;

        $mail->send();
        
        header("Location: verify-email.php?email=$email");
    }
    catch (Exception $e){
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
    }
}
    else if(!empty($row['regdate']) ){
         echo "Your account is already verified";
    }
}
?>

     <br><br>
 <a href="login.php">Click here to login</a></h2></div>




      </div>

</div>
      


 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>