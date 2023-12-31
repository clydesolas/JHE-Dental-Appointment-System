<?php
ob_start();
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
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- title -->
    <title>J.H.E. Dental Clinic</title>
    <!-- favicon -->
    <link href="images/logo.png" rel="icon">
    <script>document.documentElement.style.setProperty('--original-viewport-height', window.innerHeight+"px")</script>
    <style>
    body {
  min-height: 100vh;
  position: relative;
}
body::before {
  content: "";
  position: fixed;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.83)), url("images/aboutus.jpg");
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
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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
    @media(max-width: 991.98px){
        .jhe_logo{
            display: none;
        }
    }
    @media(max-width: 767.98px){
        .jhe_logo{
            display: none;
        }
    }
    @media(max-width: 599.99px){
        body{
            display: block;
            position: relative;
            height: 100vh;
            overflow-y: auto;
        }
        .jhe_logo{
            display: none;
        }
    }
    </style>
</head>
<body>
    <!--navbar start of code  -->
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #345c83">
        <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand " href="index.php"></a><h3 style = " margin-bottom:-.5%; color:white ; "><img src="images/logo.png" style="float:left;" height="55px"width="55px;">DENTAL <span>CLINIC</span><p class="logo_w3l_agile_caption">Smile More!</p></h3></a>
            <!-- toggle button -->
            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0 px-4">
                    <li class="nav-item px-4">
                        <a class="nav-link active" aria-current="page" href="index.php">HOME </a>
                    </li>
                    <li class="nav-item">
                        <a  type="button" class="btn btn-outline-info" href="signup.php">SIGN UP </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      <!--navbar end of code  -->
      <main>
        <div class="container col-xl-10 col-xxl-8 my-5 px-5 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <!-- JHE logo -->
                <div class="jhe_logo col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3 d-flex justify-content-center"><img src="images/logo.png" alt="" class="large_device_img" style="width: 100px; height: 100px;"><span style="color: #309A98;">J.H.E. <br> Dental Clinic </span></h1>
                    <p class="col-lg-10 fs-4 fst-italic d-flex justify-content-center text-white" style="font-weight: bolder;">Smile More!</p>
                </div>
                <!-- /JHE logo -->
                <div class="col-md-10 mx-auto col-lg-5">

                    <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST">
                        <h2 class="d-flex justify-content-center fw-bold">Login</h2>
                                                       <?php
                                        if(isset($_POST['submit'])){
                                          $email = $_POST['email'];
                                          $myPassword = $_POST['password'];
                                          $password = md5($myPassword);
                                      
                                          $sql = "SELECT * FROM users WHERE  email = '$email' AND pass = '$password'";
                                          $user = $con->query($sql) or die ($con->error);
                                          $row = $user->fetch_assoc();
                                          $total = $user->num_rows;
                                      
                                         if ($total>0 && !empty($row['regdate'])){
                                          session_start();
                                           $_SESSION['UserLogin'] = $row;  
                                           echo header ('Location: user/user.php');
                                           
                                          }
                                          else if ($total>0 && empty($row['regdate'])){
                                            echo '<div class="alert alert-danger py-2">Please verify your Email.</div>';
                                            }
                                          else{
                                           echo '<div class="alert alert-danger py-2">Incorrect Email/Password.</div>';
                                      
                                          }
                                      }
                                      ?>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="button mt-3">
                            <div class="row">
                                <div class="col">
                                    <button class="w-100 btn btn-primary" type="submit" name="submit" id="submit">Login</button>
                                </div>
                                <div class="col">
                                    <button class="w-100 btn btn-danger" type="reset">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div class="not_member mt-1 d-flex justify-content-end">
                            <a class="loginhere text-decoration-none text-nowrap" data-placement="bottom" href="forgotpassword.php">Forgot password?</a></p>
                        </div>
                        <br>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <p class="text-muted text-nowrap">Not a member? <a class="loginhere text-decoration-none" data-placement="bottom" href="signup.php">Sign Up Now</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </main>
      <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
ob_end_flush();
$con->close();
?>