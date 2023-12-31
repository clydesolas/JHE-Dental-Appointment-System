<?php
    session_start();

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
        
        <?php
if($_GET['key'] && $_GET['token'])
{

$email = $_GET['key'];
$token = $_GET['token'];
$query = mysqli_query($con,
"SELECT * FROM `users` WHERE `email_verification_link`='".$token."' and `email`='".$email."';"
);
$d = date('Y-m-d');
if (mysqli_num_rows($query) > 0) {
$row= mysqli_fetch_array($query);
if($row['regdate'] == NULL){
mysqli_query($con,"UPDATE users set regdate ='" . $d . "' WHERE email='" . $email . "'");
$msg = "Congratulations! Your email has been verified.";
}else{
$msg = "You have already verified your account with us";
}
} else {
$msg = "This email is not registered with us";
}
}
else
{
$msg = "Danger! Something goes  wrong.";
}
?>
<div class="alert alert-primary" style="text-align:center"><h2 ><?php echo $msg; ?>. <br><br>
 <a href="login.php">Click here to login</a></h2></div>




      </div>

</div>
      


 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>