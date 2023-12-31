<?php
    session_start();
    $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
    require($serverdpphp);
    ob_start();
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
    margin-top: 1%;
  }
  .container-login{
    width:50%;
    margin: 0% 25% 0 25%;
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

}
@media (max-width: 767px) {
  .modal{
    margin-top: 25%;
  }
  .container-login{
    width:96%;
    margin: 15% 2% 0 2%;
  }

}

    </style>


<body>   
    
<div class="container-login p-4 rounded" style=" background-color: #305f82;">
        <div class="container d-flex justify-content-center pb-4 pt-3">
        <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color: white ;"><img src="images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3>
        </div>


<form class="p-4 p-md-5 border rounded-3 bg-light shadow p-3 mb-5 bg-body rounded" method="post">
    <div class="login_header d-flex justify-content-center">
    <h2 style="font-weight: bold;" class="mb-5">Reset your Password</h2>
    </div>      
    
    
        <?php
if($_GET['key'] && $_GET['token'])
{

$email = $_GET['key'];
$token = $_GET['token'];
$query = mysqli_query($con,"SELECT * FROM `users` WHERE  `email`='".$email."';");


if (mysqli_num_rows($query) > 0) {
$row= mysqli_fetch_array($query);
$changepassToken=$row['changepassToken'];
if(is_null($changepassToken)){
    ob_start();
	session_start();
	unset($_SESSION["UserLogin"]);
	session_destroy();
    echo header ('Location: linkExpired.php');
	ob_end_flush();
   
}

if(isset($_POST['change'])){
    $newpass=md5($_POST['newpass']);
    $oldpass=$row['pass'];

if($newpass==$oldpass){
        echo '<div class="alert alert-danger py-2"> You entered an old password.
      </div>';
}
else{
    mysqli_query($con,"UPDATE users set pass ='$newpass', changepassToken=NULL  WHERE email='$email'")or die(mysqli_error($con));
$msg = "Your password has been changed successfully.";
echo '<div class="alert alert-success py-2"> Your password has been reset successfully.
 <a href="login.php">Click here to login</a></div>';


}
}
}

}
else
{
$msg = "Danger! Something goes  wrong.";
}
?>



<div class="form-floating my-3">
        <input type="password"class="form-control"pattern="(?=.*?[.#?!@$%^&*-\]\[])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                  title="Must contain at least 8 or more characters, a number, uppercase and lowercase letter, and a special character"
                    name="newpass" placeholder="name@example.com" required>
        <label for="floatingInput">Enter new password</label>
    </div>
    <br>
    <div class="button mt-3">
        <div class="row">
            
            <div class="col">
                <button class="w-100 btn btn-danger" type="reset">Cancel</button>
            </div>
            <div class="col">
                <button class="w-100 btn btn-success" type="submit" name="change">Submit</button>
            </div>
        </div>
    </div>
    

    <br>
    <hr>
    <div class="col  d-flex justify-content-center">
                <a class="w-30 btn btn-outline-secondary" href="index.php" >Go back to HOME PAGE</a>
            </div>
    </form>

      </div>

</div>
      


 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
 <script> 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>
</body>
</html>
<?php
ob_end_flush();
?>