<?php
ob_start();
    session_start();

    $serverdpphp = '../database.php'; 
    require($serverdpphp);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- icon -->

    <title>J.H.E. Dental Clinic</title>
    <link href="../images/logo.png" rel="icon">
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
    width:40%;
    margin: 8% 30% 0 30%;
  }
  body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("../images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 42em;
  overflow-y: hidden;
}
}
@media (min-width: 768px)  and (max-width: 1023px) {

  .container-login{
    width:60%;
    margin: 8% 20% 0 20%;
    
  }
  body{
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("../images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 65em;
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
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("../images/aboutus.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 49em;
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
        <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color: white ;"><img src="../images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3>
        </div>
        
        <form method="post" class="form-horizontal">
<?php    
        if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $myPassword = $_POST['password'];
    $password = md5($myPassword);

    $sql = "SELECT * FROM admindb WHERE  `username` = '$email' AND `password` = '$password'";
    $admin = $con->query($sql) or die ($con->error);
    $row = $admin->fetch_assoc();
    $total = $admin->num_rows;

   if ($total>0){
     $_SESSION['AdminLogin'] = $row;  
     echo header ('Location: dashboard.php');
     
    }
    else{
     echo '<div class="alert alert-danger ">Incorrect Email/Password.</div>';

    }
}
?>
       <div class="row col-sm g-6 ">
       <div class=" form-floating col-sm-12 mb-2">
        <input type="text"  id="email" class="form-control"  name="email" placeholder="name@example.com" required>
        <label for="floatingInput" style="padding-left:22px">Username</label>
        </div>
        </div>        

        <div class="row col-sm g-6 ">
       <div class=" form-floating col-sm-12 mb-2">
        <input type="password"  id="password" class="form-control"  name="password" placeholder="password" required>
        <label for="floatingInput" style="padding-left:22px" >Password</label>
        </div>
        </div> 
        <div class="container" style="text-align:end">

        <div class="buttonl"style="margin:3% 0 1% 0">
            <button type="submit" name="submit" id="submit" class="btn btn-dark">Login</button>
      
        </div>
        </div>
    </form>





      </div>

</div>
      


 <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
ob_end_flush();
$con->close();
?>