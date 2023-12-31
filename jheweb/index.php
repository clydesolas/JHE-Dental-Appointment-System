<!-- CONTACT US -backend code start -->
<?php

$serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
require($serverdpphp);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';


if(isset($_POST['send'])){
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $message = $_POST['message'];

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

    try {
        // Server settings
        //  $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'themasqueradereveler@gmail.com'; // YOUR gmail email
        $mail->Password = 'zpqbxuteiuaoawkk'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('themasqueradereveler@gmail.com', 'J.H.E. DENTAL CLINIC WEBSITE');
        $mail->addAddress('sclyd13@gmail.com', 'J.H.E. Dental Clinic'); //receiver of contact us message
        $mail->addReplyTo($email, $fullname); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = 'Message From J.H.E. Website';
        $mail->Body = $message;
        $mail->AltBody = $message;

        $mail->send();
        
        echo'<script>alert("Email message sent to JHE@gmail.com. Thank you for contacting us!");</script>';   
    }
    catch (Exception $e){
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!-- CONTACT US -backend code end -->
<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- meta tags start -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="J.H.E Dental Clinic, Bacoor Cavite">
    <meta name="description" content="J.H.E. Dental Clinic. Excellent Dental Care in Bacoor, Cavite. Licensed and qualified dentist. Offer a wide range of inexpensive services. Visit us.">
    <meta name="author" content="Faith Maquerme, Jan Rian Camingao, Clyde Solas, Jayson Tindugan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta tags end -->
    <!-- CSS/Bootstrap links -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- navbar -->
    <link rel="canonical" href="https:/0/getbootstrap.com/docs/5.2/examples/navbar-fixed/">
    <!-- navbar -->
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- icon -->
    <title>J.H.E. Dental Clinic</title>
    <link href="images/logo.png" rel="icon">
</head>
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
            <!-- navBar menus start -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-sm-0 px-4">
                    <li class="nav-item px-2">
                        <a class="nav-link active" aria-current="page" href="#home">HOME</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#abtus">ABOUT US</a>
                    </li>
                    <li class="nav-item px-2 ">
                        <a class="nav-link" href="#services">SERVICES</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#contactUs">CONTACT US</a>
                    </li>
                    <li class="nav-item px-2">
                        <a  class="nav-link" href="signup.php">SIGN UP </a>
                    </li>
                    <li class="nav-item px-2">
                        <a  class="nav-link" href="login.php">LOG IN </a>
                    </li>
                </ul>
            </div>
            <!-- navBar menus end -->
        </div>
    </nav>
    <!--navbar end of code  -->
    <!-- main start -->
    <main>
        <!-- hero start -->
        <section class="hero">
        <h1 class="visually-hidden" id="home">home</h1>
        <div class="hero_container" id="home">
            <div class="hero_content">
                <div class="px-4 py-5 my-5 text-center">
                    <h1 class="hero_title display-5 fw-bold">J.H.E. Dental Clinic</h1>
                    <div class="col-lg-6 mx-auto">
                        <!-- hero text  -->
                        <p class="lead mb-4">Here in J.H.E we value your smile!</p>
                        <!-- hero button -> login page -->
                        <div class="d-flex justify-content-center mt-1">
                            <a href="login.php"><button type="button" class="btn btn-outline-info btn-lg px-4 mt-1">Login</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- hero end -->
        <div class="container-fluid">
            <div class="row">
                <!-- left column start -->
                <div class="col-md-9 order-2 order-md-1" style="margin-top:-1%;" >
                    <div class="bg-transparent p-3 rounded">
                        <!-- home start -->
                        <section class="home_section">
                            <div class="home">
                            
                                <!-- Carousel -->
                                <div id="demo1" class="carousel carousel-fade carousel-dark " data-bs-ride="carousel">
                                    <!-- Indicators/dots start -->
                                    <div class="alert alert-light">
                                        <div class="carousel-indicators ">
                                            <button type="button" data-bs-target="#demo1" data-bs-slide-to="0" class="active"></button>
                                            <button type="button" data-bs-target="#demo1" data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#demo1" data-bs-slide-to="2"></button>
                                        </div>
                                        <div class="carousel-inner " style="border-radius:10px;">
                                            <div class="carousel-item active "data-bs-interval="3000">
                                                <img src="images/homepic1.jpg" style="width:100%"alt="pic">
                                            </div>
                                            <div class="carousel-item"data-bs-interval="3000">
                                                <img src="images/homepicture2.jpg"style="width:100%"alt="pic">
                                            </div>
                                            <div class="carousel-item"data-bs-interval="3000">
                                                <img src="images/homepic3.jpg"style="width:100%"alt="pic">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Indicators/dots end -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#demo1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#demo1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </section>
                        <!-- home end -->

                        <!-- about us start -->
                        <h1 class="visually-hidden" id="abtus">aboutus</h1>
                        <section class="aboutUs_section" id="about">
                            <div class="row alert alert-info text-dark">
                                <div class="left_side_about col-md-6 mt-1">
                                    <h2 class="abt_title">About <span style="color:#309A98;">Us</span></h2>
                                    <p class="mt-0" style="text-align: justify; font-size: 18px;">
                                 &emsp;   <?php
                            $sql = mysqli_query($con,"SELECT * FROM about_us")or die(mysqli_error($con));
                            $about = mysqli_fetch_array($sql);
                             echo $about['about_details'];
                        ?>

                       
                        </p>
                                </div>
                                <div class="right_side_about col-md-6 d-flex justify-content-center">
                                    <img class="abt_img img-fluid rounded" src="images/aboutus.jpg" alt="">
                                </div>
                            </div>
                        </section>
                        <!-- about us end -->

                        <!-- Dentist info start -->
                        <section class="dentist_section">
                            <div class="dentistInfo">
                                <div class="team bg-transparent mt-1">
                                    <h2 style="text-align: center; font-size: 45px;">Our <span style="color:#309A98;">Team</span></h2>
                                    <!-- row start -->
                                    <div class="row row-cols-1 row-cols-md-3 g-4">
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="images/jhe.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">Dr. Jemaylyn Rose ave Gamutuan</h4>
                                                    <h5 class="card-title">Owner</h5>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="images/jhe3.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">Jeramie Flogencio</h4>
                                                    <h5 class="card-title">Assistant</h5>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="images/jhe2.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">Erika Jane Ave</h4>
                                                    <h5 class="card-title">Assistant</h5>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- row end -->
                                </div>
                            </div>
                        </section>
                        <!-- Dentist info end -->

                        <!-- Services -->
                        <h1 class="visually-hidden" id="services">services</h1>
                        <section class="services_section" id="services">
                            <hr style="margin-top: 5%;">
                            <h2 style="font-size: 45px;">Services</h2>
                            <div class="container pt-3" style="justify-content:center">
                                <div class="row">
                                    <!-- 1st half of services start -->
                                    <!-- cosmetic dentistry card start -->
                                    <div class="col-lg-6">
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/CosmeticDentistry.png" class="h-100 card-img" style="border-radius: 6px;" alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title p-5" > Cosmetic Dentistry </h5 >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- cosmetic dentistry and bridges card end -->
                                        <!-- crown and bridges card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/CrownAndBridges.png" class="h-100 card-img"style="border-radius: 6px;" alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8 mb-4">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5"> Crown And Bridges </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- crown and bridges card end -->
                                        <!-- dental prosthesis dentures card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/DentalProsthesisDentures.png" class="h-100 card-img"style="border-radius: 6px;" alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Dental Prosthesis Dentures </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- dental prosthesis dentures card end -->
                                        <!-- dental consultation card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/OralDiagnosisDentalConsultation.png" class="h-100 card-img"style="border-radius: 6px;" alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Oral Diagnosis / Dental Consultation </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- dental consultatio card end -->
                                        <!-- teeth cleaning card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/OralProphylaxisTeethCleaning.png" class="h-100 card-img"style="border-radius: 6px;" alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Oral Prophylaxis / Teeth Cleaning </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- teeth cleaning card end -->
                                        <!-- tooth extraction card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/OralSurgeryToothExtraction.png" class="h-100 card-img" style="border-radius: 6px;"alt="..."
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title p-5" > Oral Surgery / Tooth Extraction </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tooth extraction card end -->
                                    </div>
                                    <!-- 1st half of services end -->
                                    <!-- 2nd half of services start -->
                                    <div class="col-lg-6">
                                        <!-- orthodontics card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/Orthodontics.png" class="h-100 card-img" alt="..."style="border-radius: 6px;"
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Orthodontics </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- orthodontics card end -->
                                        <!-- pediatic dentistry card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/PediatricDentistry.png" class="h-100 card-img" alt="..."style="border-radius: 6px;"
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Pediatric Dentistry </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- pediatic dentistry card end -->
                                        <!-- restoration card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/RestorationToothFilling.png" class="h-100 card-img" alt="..."style="border-radius: 6px;"
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Restoration / Tooth Filling </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tooth fillig card end -->
                                        <!-- root canal therapy card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/RootCanalTherapy.png" class="h-100 card-img" alt="..."style="border-radius: 6px;"
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Root Canal Therapy </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- root canal card end -->
                                        <!-- teeth whitening card start -->
                                        <div class="cardo mb-4">
                                            <div class="row g-0">
                                                <div class="col-sm-4">
                                                    <img src="images/TeethWhitening.png" class="h-100 card-img" alt="..."style="border-radius: 6px;"
                                                    style="object-fit: cover;">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-body ">
                                                        <h5 class="card-title p-5" > Teeth Whitening </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- teeth whitening card end -->
                                    </div>
                                    <!-- 2nd half of services start -->
                                </div>
                            </div>
                        </section>
                        <!-- /Services -->
                        
                        <!-- Contact Us -->
                        <!-- jhe details start -->
                        <?php
                            $jhedetailsSQL = mysqli_query($con,"SELECT * FROM jhedetails WHERE details_id=1;")or die(mysqli_error($con));
                            $jherow = mysqli_fetch_array($jhedetailsSQL);
                            $contact = $jherow['contact'];
                            $email = $jherow['email'];
                        ?>
                        <!-- jhe details end -->
                        <h1 class="visually-hidden" id="contactUs">contactus</h1>
                        <section class="contactUs_section mt-3">
                            <hr style="margin-top: 2%;">
                            <div class="contactUs" id="contact">
                                <h2 style="text-align: center; font-size: 45px;">Contact Us</h2>
                                <p style="text-align:center">Email us with any questions or inquiries or call.
                                <br>We would be happy to answer your questions.
                                J.H.E Dental Clinic is happy to serve you!</p>
                                <div class="container" style="margin-top: 20px;">
                                    <div class="row align-items-start" style="border:1px solid #d6d6d6">
                                        <!-- left column start -->
                                        <div class="col-md conInfo mt-4">
                                            <div class="box">
                                                <div class="text">
                                                    <h5>&nbsp;<i class="bi bi-geo-alt-fill" style="padding-right: 10px;"></i>Address</i></h5>
                                                    <p>Unit L, 03 Piñahan Unit L Lolalu Building, 03 Piñahan, Mabolo 3, Bacoor Cavite</p>
                                                </div>
                                            </div>
                                            <div class="box">
                                                <div class="text">
                                                    <h5 class="Phone">&nbsp;<i class="bi bi-telephone-fill" style="padding-right: 10px;"></i>Phone</h5>
                                                    <p>0<?php echo $contact?></p>
                                                </div>
                                            </div>
                                            <div class="box">
                                                <div class="text">
                                                    <h5 class="Email">&nbsp;<i class="bi bi-envelope-paper" style="padding-right: 10px;"></i>Email</h5>
                                                    <p><?php echo $email?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- left column end -->
                                        <!-- center column start -->
                                        <div class="col-md mt-3" style="position: relative; width: 100%;">
                                            <form class="conInfo" method="post">
                                                <h5 class="text-center">Send Message</h5>
                                                <div class="inputBox">
                                                    <span>Full Name</span>
                                                    <input type="text" id="fullname" class="msghere" name="fullname" required placeholder="Your name" style="width: 100%;">
                                                </div>
                                                <div class="inputBox">
                                                    <span>Email</span>
                                                    <input type="text" id="email" class="msghere" name="email" required placeholder="Your email" style="width: 100%; margin-bottom:2%">
                                                </div>
                                                <div class="inputBox">
                                                    <span>Message</span>
                                                    <textarea required id="message" class="msghere" name="message" placeholder="Type your message..." style="width: 100%;"></textarea>
                                                </div>
                                                <div class="inputBox">
                                                    <button class="btn btn-primary" type="submit" id="send" name="send"style="width: 100%; padding: 5px 20px;  margin: 8px 0;">
                                                    Send
                                                </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- center column end -->
                                        <!-- right column start -->
                                        <div class="col-md col-end" style="margin-top: 2%">
                                            <div class="mapouter">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15454.403164072164!2d120.9334343!3d14.4501552!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d3571765a57b%3A0x3e9f757876b5218c!2sJ.H.E%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1669470202766!5m2!1sen!2sph" width="100%"; height="275px"; style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                        <!-- right column start -->
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /Contact Us -->
                    </div>
                </div>
                <!-- left column end -->
                <!-- right column start -->
                <div class="col-md-3 order-1 order-md-2"style="box-shadow: 0px 2px 1px 0px rgba(0,0,0,0.2);">
                    <div class="bg-transparent p-3 rounded sticky-top">
                        <!-- SQL Get Announcement -->
                        <?php
                            $sqll = mysqli_query($con,"SELECT * FROM announcement WHERE announce_id=(SELECT max(announce_id) FROM announcement);")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($sqll);
                        ?>
                        <!-- /SQL Get Announcement -->
                      <!-- Announcement -->
                        <div class="alert py-2 px-3 mb-3 rounded alert-warning border-secondary" style="box-sizing:border-box; ">
                            <h3 class="announce_title fst-italic mb-2"><i class=" mr-2 bi bi-megaphone"></i> Announcement!</h3>
                           <p class="announce_text"><?php if(!empty($row['announce_details'])){echo $row['announce_details'];} else {echo '<i class="text-secondary"> No announcement as of the moment.</i>';}?></p>
                           <p class="announce_text py-0 my-0 text-muted d-flex justify-content-end" style="font-size: 15px;"><?php if(!empty($row['announce_date'])){echo $row['announce_date'];}?></p>
                        </div>
                        <!-- /Announcement -->

                    <!--reviews -- review -- facebook-- Carousel -->
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v15.0" nonce="TNj9bJcj"></script>
                        <div class="container p-2" style="height:350px;
                            overflow-y: scroll; border:1px solid #dcdcdc; border-radius: 10px;">
                            <p>Reviews From our <a href="https://www.facebook.com/profile.php?id=100072208115413" target="_blank">FB Page</a></p>
                            <hr>
                            <div class="fb-post pt-5" style="border-radius: 10px;" data-href="https://www.facebook.com/rea.entong/posts/pfbid0xD6bPDdzneeCNNUMmQoNkPcGFWvs4v1Kd2nKBAZdhEJNanKM2rSzBVW4o4eqiWRHl" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/rea.entong/posts/4889103967821198" class="fb-xfbml-parse-ignore"><p>Highly recommended dental clinic, very clean,and complete for all your dental concerns. 100 stars 🤩</p>Posted by <a href="#" role="button">Rea Entong</a> on&nbsp;<a href="https://www.facebook.com/rea.entong/posts/4889103967821198">Monday, 15 November 2021</a></blockquote>
                            </div>

                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/anamariepan/posts/pfbid02WRFD5HmsKR5VQS599eH9BkrXwrzhfFScnhQXGyCCnHYLx5BzeZgVtjfhCfW8ckHVl" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/anamariepan/posts/3958549380911690" class="fb-xfbml-parse-ignore"><p>100 stars 🤩 Highly recommended!
                            My beloved mother desperately needed tooth extraction, she is very anxious  and...</p>Posted by <a href="#" role="button">Marie Mindajao</a> on&nbsp;<a href="https://www.facebook.com/anamariepan/posts/3958549380911690">Friday, 5 November 2021</a></blockquote>
                            </div>
                    
                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/josephinejane.gaje/posts/pfbid0JdGG3CmYNNJMxBTDNEpUTHQoQUJMHLrErGJyHg89uy71MyuHR9jguedjk6VL1AyKl" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/josephinejane.gaje/posts/1792158814306860" class="fb-xfbml-parse-ignore"><p>Highly recommended ! Super bait pa ni Doc ! ❤️</p>Posted by <a href="https://www.facebook.com/josephinejane.gaje">Josephine Jane Vertudazo Gaje</a> on&nbsp;<a href="https://www.facebook.com/josephinejane.gaje/posts/1792158814306860">Tuesday, 4 January 2022</a></blockquote>
                            </div>

                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/agnesmaryanne1015/posts/pfbid0DtVSuHrabMkeFsWVUHF9r7piZKEAAYv8wMNDA5LiLxDucSsjbhVmiADVxvXSkPcol" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/agnesmaryanne1015/posts/4270624666325858" class="fb-xfbml-parse-ignore"><p>Thankyou JHE dental for accomodating me today sobrang satisfied ako sa new set of braces ko. Magaling ang dentist nag...</p>Posted by <a href="#" role="button">Agnes Mary Anne Landicho</a> on&nbsp;<a href="https://www.facebook.com/agnesmaryanne1015/posts/4270624666325858">Thursday, 30 September 2021</a></blockquote>
                            </div>

                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/hyacinth.delatorre.3/posts/pfbid0tSTDNEpUTHQoQUJMHLrErGJyHg89uy71MyuH7fZ5AC63uMDKLr56ik6DriENhuqhl" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/hyacinth.delatorre.3/posts/1371679533289694" class="fb-xfbml-parse-ignore"><p>A highly recommended Dental Clinic!  
                            I will rate 5 out of 5! 🤩 It&#039;s our second time to visit J.H.E. dental and I am so...</p>Posted by <a href="#" role="button">Hyacinth Dela Torre</a> on&nbsp;<a href="https://www.facebook.com/hyacinth.delatorre.3/posts/1371679533289694">Friday, 12 November 2021</a></blockquote>
                            </div>

                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/permalink.php?story_fbid=pfbid0xKyfwDpu7WLb6eu9RtZDHVGCSiWp2EynJ64dFUomeBLYdG3dCiKhyYday8WEDN2fl&amp;id=100009081598019" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/permalink.php?story_fbid=3036608096651880&amp;id=100009081598019" class="fb-xfbml-parse-ignore"><p>Gusto ko yung vibe sa clinic unang tapak ko palang dun sabi ko agad ayy okey dito. Tapos super galing mag explain ni...</p>Posted by <a href="https://www.facebook.com/people/Anne-Dheng/100009081598019/">Anne Dheng</a> on&nbsp;<a href="https://www.facebook.com/permalink.php?story_fbid=3036608096651880&amp;id=100009081598019">Thursday, 31 March 2022</a></blockquote>
                            </div>
                    
                            <div class="fb-post pt-2" style="border-radius: 10px;" data-href="https://www.facebook.com/martymiraj/posts/pfbid035AjiCHsxTDNEpUTHQoQUJMHLrErGJyHg89uy71MyuH1tmvybQSGFn8y2iYvcfNELl" data-width="auto" data-show-text="true"><blockquote cite="https://www.facebook.com/martymiraj/posts/5768680833177194" class="fb-xfbml-parse-ignore"><p>Grabe tong si doc.. ang galing!!! Hehhee</p>Posted by <a href="https://www.facebook.com/martymiraj">Marty Relle David</a> on&nbsp;<a href="https://www.facebook.com/martymiraj/posts/5768680833177194">Tuesday, 23 August 2022</a></blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right column end -->
            </div>
        </div>
    </main>
    <!-- main end -->
    <!-- footer start -->
        <!-- Copyright -->
        <div class="d-flex justify-content-center" style="background-color: #309A98;">
            <p style="margin-top: 1%; color: #fff;">© 2021 J.H.E. Dental Clinic, All rights reserved.</p>
        </div>
        <!-- Copyright -->
    <!-- footer end -->
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>