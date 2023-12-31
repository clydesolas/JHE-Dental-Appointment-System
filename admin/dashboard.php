<?php
  $serverdpphp = '../database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['AdminLogin'])){
            $_SESSION['AdminLogin'];
            $email=strtoupper($_SESSION['AdminLogin']['username']);
            $id=strtoupper($_SESSION['AdminLogin']['id']);
            
            $s1sql="SELECT `status`, COUNT(`status`) as nums1 FROM appointment WHERE `status`='Approved' or  `status`='Declined' or  `status`='Pending'  GROUP BY `status`";
            $results1 = $con->query($s1sql);
            $s1 = array();
            $s1count = array();
            foreach ($results1 as $rows1) {
            $s1[] = $rows1['status'];
            $s1count[] = $rows1['nums1'];
            }

            $s2sql="SELECT CASE WHEN `available` = 'Yes' THEN 'Available' ELSE 'Busy' END as avail, COUNT(available) as nums2  FROM admindb WHERE `available` = 'Yes' OR `available` = 'No' GROUP BY `available` ORDER by avail";
            $results2 = $con->query($s2sql);
            $s2 = array();
            $s2count = array();
            foreach ($results2 as $rows2) {
            $s2[] = $rows2['avail'];
            $s2count[] = $rows2['nums2'];  
            }

            $s3sql="SELECT `status`, COUNT(`status`) as nums3 FROM appointment WHERE `status`='Done' OR `status`='Failed' GROUP BY `status`";
            $results3 = $con->query($s3sql);
            $s3 = array();
            $s3count = array();
            foreach ($results3 as $rows3) {
            $s3[] = $rows3['status'];
            $s3count[] = $rows3['nums3'];
            }

            $s4sql="SELECT COUNT(`user_id`) as nums4 FROM users WHERE `regdate`is not NULL ";
            $results4 = $con->query($s4sql);
            $s4 = array();
            $s4count = array();
            foreach ($results4 as $rows4) {
            $s4[] = "Total";
            $s4count[] = $rows4['nums4'];
            }


            

                mysqli_query($con,"UPDATE appointment set `status`='Failed' where `start_event`< CURDATE() AND `status`= 'Approved'  OR `start_event`< CURDATE() and `status`='Pending'")or die(mysqli_error($con)); 
         

            }
            else{
            	unset($_SESSION["AdminLogin"]);// depend on the value we use
                session_destroy();
                header("location: ../index.php");// find the login index
                 }
             if(!isset($_SESSION['AdminLogin']))
                {
                    unset($_SESSION["AdminLogin"]);// depend on the value we use
                    session_destroy();
                    header("location: ../index.php");// find the login index
                }

    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css ">
   
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.1/index.global.min.js "></script>
  <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js "></script>
  <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js "></script>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  const date = new Date();
	let day = date.getDate();
	let month = date.getMonth() + 1;
	let year = date.getFullYear();
	let currentDate = `${year}-${month}-${day}`;

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
     height: "auto",
    displayEventTime: false,
      defaultDate: currentDate,
    eventDidMount: function(info) {
      var tooltip = new Tooltip(info.el, {
        title: info.event.extendedProps.description,
        placement: 'top',
        trigger: 'hover',
        container: 'body'
      });
    },
 
    events: 'event.php'
  });

  calendar.render();
});

  </script>
    

    <title>J.H.E. Dental Clinic</title>
    <link href="../images/logo.png" rel="icon">
</head>
<style>
  /* for calendar tooltip starrrt*/
  .popper,
.tooltip {
  position: absolute;
  z-index: 9999;
  background: #305f82;
  color: white;
  width: 150px;
  border-radius: 3px;
  box-shadow: 0 0 2px rgba(0,0,0,0.5);
  padding: 10px;
  text-align: center;
  opacity: 1;
}
.fc-daygrid-dot-event .fc-event-title {
  cursor: pointer;
}
.tooltip-inner{
  background-color: transparent;
  color:white;
  white-space: pre-wrap;
  font-weight:bold;
}
.style5 .tooltip {
  background: #1E252B;
  color: #FFFFFF;
  max-width: 200px;
  width: auto;
  font-size: .8rem;
  padding: .5em 1em;
}
.popper .popper__arrow,
.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
}

.tooltip .tooltip-arrow,
.popper .popper__arrow {
  border-color: #FFC107;
}
.style5 .tooltip .tooltip-arrow {
  border-color: #1E252B;
}
.popper[x-placement^="top"],
.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}
.popper[x-placement^="top"] .popper__arrow,
.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.popper[x-placement^="bottom"],
.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}
.tooltip[x-placement^="bottom"] .tooltip-arrow,
.popper[x-placement^="bottom"] .popper__arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-top-color: transparent;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.tooltip[x-placement^="right"],
.popper[x-placement^="right"] {
  margin-left: 5px;
}
.popper[x-placement^="right"] .popper__arrow,
.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent;
  border-top-color: transparent;
  border-bottom-color: transparent;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}
.popper[x-placement^="left"],
.tooltip[x-placement^="left"] {
  margin-right: 5px;
}
.popper[x-placement^="left"] .popper__arrow,
.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.fc .fc-col-header-cell-cushion {
  display: inline-block;
  padding: 2px 4px;
  color: black;
}

.fc .fc-daygrid-day-number {
  color: grey;
}
.fc .fc-toolbar-title {
    font-size: 1.5em;
    padding: 5px 3px 0px 4px;
}
a.fc-event{
    background-image: linear-gradient(to right, rgba(47, 128, 255,1), rgba(60, 203, 255,1));
    color: darkblue;
}
a.fc-event:hover{
    background-image: linear-gradient(to right, rgba(47, 128, 255,.6), rgba(60, 203, 255,.6));
    color: darkblue;
}
.fc .fc-event .fc-daygrid-event-dot{
  border-color:darkblue;
    
}

  /* for calendar tooltip eeendd */
  
    .icons{
        font-size:3.5em !important;
        opacity:40%;
    }
    .lbl{
        opacity: 70%;
        font-style: italic;
    }
    .cardstat{
        opacity: 90%;
    }
   
    </style>



<body>
<div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle"><i class=" fs-3 bi bi-list"></i></a><a href="#"class="brand-logo"><img src="../images/logo.png"class="logo-navbar"> <span>DENTAL CLINIC</span></a></header>
        <nav class="dashboard-nav-list">
            <a href="dashboard.php  " class="dashboard-nav-item  active ">
            <i class="fs-5 bi-house"></i> Dashboard
            </a>
            <a href="appointment.php" class="dashboard-nav-item ">
            <i class="fs-5 bi-table"></i> Appointments
            <?php
           $select1="SELECT `status` FROM appointment WHERE `status`='Pending'";
           $user1 = $con->query($select1) or die ($con->error);
           $row = $user1->fetch_assoc();
           $totaluser1 = $user1->num_rows;
          if ($totaluser1>0){
             echo '<span rel="tooltip"  title="Pending Appointments" class="mx-2 badge bg-danger top-0  rounded-pill">'. $totaluser1 .'</span>'; 
             
            }    
            ?>
            </a>
            <a href="services.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-stack"></i> Services
            </a>
            <a href="manage.php" class="dashboard-nav-item">
            <i class="fs-5 bi-people"></i> Patients
            </a>
            <a href="web_content.php" class="dashboard-nav-item ">
            <i class="fs-5 bi bi-window-stack"></i> Website Content
            </a>
            <a href="administrators.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-person-vcard-fill"></i>Administrators
            </a>
            <a href="report.php" class="dashboard-nav-item">
            <i class="fs-5 bi bi-pc-display-horizontal"></i> Report
            </a>
            <div class="nav-item-divider"></div>
            <a data-bs-toggle="modal" href="#logout_admin" class="dashboard-nav-item"><i class="fs-5 bi bi-box-arrow-left"></i> Logout </a>
        </nav>
    </div>


<!-- MAIN BODY start of code -->
<div class='dashboard-app'>
<header class='dashboard-toolbar' ><a href="#!" class="menu-toggle"><i class="fs-3 bi bi-list"></i></a>
            <div class="btn-group btnhover ms-auto ">
            <a href="admin_account.php" class=" fs-5 text-nowrap text-decoration-none text-light"data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <i class="btnhov bi bi-gear"style="font-size:30px"></i></a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><div class="diva dropdown-item text-decoration-none">
                <style>.btnhov:hover{ 
                    transform: scale(1.03);
                    color:lightskyblue
                      }
                      .btnhov{
                        border: none;
                       
                        transition: scale(1.03);;
                        transform: .3s;
                        } .diva:hover 
                        {background-image: none;
                        background-color: white;
                        color: black;}
                  </style>
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                    <i class="bi bi-person-circle  text-secondary" style="font-size:30px"></i>
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">
                      <?php 
                       $sqll = mysqli_query($con,"SELECT * FROM admindb WHERE id='$id'")or die(mysqli_error($con));
                      while($row = mysqli_fetch_array($sqll)){
                        if ($row['position']=='Doctor')
                      {echo strtoupper("DR. ".$row['fname']." ".$row['lname']);} 
                      else{echo strtoupper($row['fname']." ".$row['lname']);} ?></span>

                    <small class="text-muted">
                    <?php if ($row['position']=='Doctor') { 
            
                      if ($row['available']=="No"||empty($row['available'])){
                        $checked = "";     
                      }
                        if ($row['available']=="Yes"){
                        $checked = "checked";
                      }
                      ?>
                      <div class="form-check form-switch">
                      <input class="form-check-input opacity-10 " data-bs-toggle="modal" data-bs-target="#avail-modal" type="checkbox" <?php echo $checked; ?> role="switch">
                      <label class="form-check-label" id="flexSwitchResult"for="flexSwitch">Available</label>
                    </div>
                    <?php include('modal-availability.php'); ?>
                    
                    <?php } 
                    if ($row['position']=='Assistant'){
                      echo strtoupper($$row['position']);
                    }
                  
                  }
                  ?>
               </small>
                  </div>
                </div>
          </div>
              </li>
             <hr class="pb-2 my-0">
              <li><a class="dropdown-item text-decoration-none" href="profile.php">
           <i class="bi bi-person-fill"></i>&nbsp; Profile</a>
         </li>
              <li><a class="dropdown-item text-decoration-none" href="account.php">
                <i class="bi bi-shield-lock"></i>&nbsp; Account Security</a>
              </li>
             
              <li>
              </li>

            </ul>
          </div>
      </header>

        <div class='dashboard-content py-0 my-2'>
        <div class="col">
        <div class='card'>
        <div class='card-header'>
        <div class="d-flex justify-content-start text-nowrap"style="color:gray"><p><?php date_default_timezone_set('Asia/Manila');echo "Today is: &nbsp;". date('F j, Y - h:i A');?></p>
       </div>
 
<?php

$today = mysqli_query($con,"SELECT COUNT(*) as `today` FROM `appointment`   WHERE DATE(`start_event`) = CURRENT_DATE() AND `status`='Approved'")or die(mysqli_error($con));
$today_row = mysqli_fetch_assoc($today);

$tom = mysqli_query($con,"SELECT COUNT(*) as `tomorrow` FROM `appointment`   WHERE DATE(`start_event`) = CURRENT_DATE() + INTERVAL 1 DAY AND `status`='Approved'")or die(mysqli_error($con));
$tom_row = mysqli_fetch_assoc($tom);

$thisWeek = mysqli_query($con,"SELECT COUNT(*) as `week` FROM appointment WHERE YEARWEEK(`start_event`, 1) = YEARWEEK(CURDATE(), 1) AND `status`='Approved';")or die(mysqli_error($con));
$thisWeek_row = mysqli_fetch_assoc($thisWeek);

$thisMonth = mysqli_query($con,"SELECT COUNT(*) as `month` FROM appointment WHERE MONTH(start_event) = MONTH(now()) AND YEAR(start_event) = YEAR(now()) AND `status`='Approved';")or die(mysqli_error($con));
$thisMonth_row = mysqli_fetch_assoc($thisMonth);

?> 
<style>.yawa:hover{
        transform: scale(1.04);
        box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.3);
      }
      .yawa{
        border: none;
        box-shadow: 2px 2px 6px 0px rgba(0,0,0,0.2);
        border-radius: 10px;
        transition: .3s;
  }
  .cardstat1:hover{
        transform: scale(1.04);
        box-shadow: 2px 2px 6px 0px rgba(0,0,0,0.2);
      }
      .cardstat1{
        border-radius: 10px;
        transition: .3s;
  }
  </style>
  <div class="px-2 py-2 border rounded mb-2 ">
<h5 class=" text-start text-secondary"><i>Approved Appointments for:</i></h5>
  <div class="row">
    <div class="col-lg-3 cardstat" >
      <div class="yawa card rounded  mb-2">
        <a class="card-body shadow rounded bg-primary text-white py-0 text-decoration-none"rel="tooltip"  title="Approved Appointments for Today" href="appointments-approved.php" >
          <div class="row">
            <div class="col-3 align-start">
              <i class="bi bi-bullseye icons"></i>
            </div>
            <div class="col-9 text-end">
              <h1><?php echo $today1=$today_row['today']?></h1>
              <h5 class="lbl ">TODAY</h5>
            </div>
          </div>
          </a>
      </div>
    </div>
    <div class="col-lg-3 cardstat">
      <div class="yawa card rounded  mb-2">
      <a class="card-body shadow rounded bg-danger text-white py-0 text-decoration-none"rel="tooltip"  title="Approved Appointments for Tomorrow" href="appointments-approved.php" >
          <div class="row">
            <div class="col-3 ">
            <i class="bi bi-bookmark icons"></i>
            </div>
            <div class="col-9 text-end text-nowrap">
              <h1><?php echo $tom=$tom_row['tomorrow']?></h1>
              <h5 class="lbl">TOMORROW</h5>
            </div>
          </div>
          </a>
      </div>
    </div>
    <div class="col-lg-3 cardstat">
      <div class="yawa card rounded  mb-2">
      <a class="card-body shadow rounded bg-info text-white py-0 text-decoration-none"rel="tooltip"  title="Approved Appointments for this Week" href="appointments-approved.php" >
          <div class="row">
            <div class="col-3">
            <i class="bi bi-calendar-week icons"></i>
            </div>
            <div class="col-9 text-end  text-nowrap">
              <h1><?php echo $thisWeek=$thisWeek_row['week']?></h1>
              <h5 class="lbl">THIS WEEK</h5>
            </div>
          </div>
          </a>
      </div>
    </div>
    <div class="col-lg-3 cardstat">
      <div class="yawa card rounded  mb-2">
      <a class="card-body shadow rounded bg-success text-white py-0 text-decoration-none"rel="tooltip"  title="Approved Appointments for this Month" href="appointments-approved.php" >
          <div class="row">
            <div class="col-3">
            <i class="bi bi-calendar3 icons"></i>
            </div>
            <div class="col-9 text-end  text-nowrap">
              <h1><?php echo $thisMonth=$thisMonth_row['month']?></h1>
              <h5 class="lbl">THIS MONTH</h5>
            </div>
          </div>
          </a>
      </div>
    </div>
   
</div>
  </div>
<div class="row py-2 ">
    <div class="col-lg-6" >
    <div class=" py-2 px-2 shadow rounded cardstat1">
    <h5 class=" text-start text-secondary"><i>Total Appointments:</i></h5>
    <div class="row">
    <div class="col-lg-6">
   
   <canvas id="apptChart1"></canvas> <h5>
    </div>
    <div class="col-lg-6 ">

   <canvas id="apptChart3"></canvas> <h5>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-6" >
    
    <div class="row">
    
    <div class="col-lg-6  ">
    <div class="py-2  px-2 shadow rounded cardstat1">        
    <h5 class=" text-start text-secondary"><i>Total Doctors:</i></h5>
   <canvas id="apptChart2"></canvas> <h5>
    </div>
    </div>
    <div class="col-lg-6   ">
    <div class="py-2  px-2 shadow rounded cardstat1">
    <h5 class=" text-start text-secondary "><i>Registered Patients:</i></h5>
   <canvas id="apptChart4"></canvas> <h5>
    </div>
    </div>
    </div>
    </div>
    
   
  
    </div>
   
   





                    </div>
                    <div class='card-body'>
        
             
   <div id="calendar"></div>





                 
                    </div>
							
                </div>
        </div>
    </div>

</div>

<!-- MAIN BODY end of code -->



<script src="assets/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/dataTables.responsive.min.js"></script>
<script src="assets/js/jquery-3.5.1.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/responsive.bootstrap5.min.js"></script>    
<script src="https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>

<script>
   
   
  const datas1 = {
        labels: <?php echo json_encode($s1)?>,
        datasets: [{
        label: 'Approved',
        data:<?php echo json_encode($s1count)?>,
        backgroundColor: [
          'rgb(167, 199, 231)','rgb(253, 253, 150)','rgb(203,153,201)'],
        borderColor: 'rgb(125, 157, 156,.7)',
        borderWidth: 1
        }]
    };

    const cons1 = {
    type: 'pie',
    data: datas1,
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'right'
  },
        plugins:{
          labels: {
          render: 'value',
          fontSize: 14,
          fontStyle: 'bold',
          fontColor: '#000',
          fontFamily: '"Lucida Console", Monaco, monospace'
        },
         
        }
        
    },
    };

    var s1chart = new Chart(
        document.getElementById('apptChart1'),
        cons1
    ); 

    const datas2 = {
        labels: <?php echo json_encode($s2)?>,
        datasets: [{
        label: 'Declined',
        data:<?php echo json_encode($s2count)?>,
        backgroundColor: [
            'rgb(167, 199, 231)','rgb(255,179,71)'],
        borderColor: 'rgb(125, 157, 156,.7)',
        borderWidth: 1
        }]
    };

    const cons2 = {
    type: 'pie',
    data: datas2,
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'right'
  },
        plugins:{
          labels: {
          render: 'value',
          fontSize: 14,
          fontStyle: 'bold',
          fontColor: '#000',
          fontFamily: '"Lucida Console", Monaco, monospace'
        },
          
        }
        
    },
    };

    var s2chart = new Chart(
        document.getElementById('apptChart2'),
        cons2
    ); 

    const datas3 = {
        labels: <?php echo json_encode($s3)?>,
        datasets: [{
        label: 'Approved',
        data:<?php echo json_encode($s3count)?>,
        backgroundColor: [
            'rgb(119,221,119)','rgb(255,105,97)'],
        borderColor: 'rgb(125, 157, 156,.7)',
        borderWidth: 1
        }]
    };

    const cons3 = {
    type: 'pie',
    data: datas3,
    options: {
      legend: {
            display: true,
            position: 'right'
  },
        responsive: true,
        plugins:{
          labels: {
          render: 'value',
          fontSize: 14,
          fontStyle: 'bold',
          fontColor: '#000',
          fontFamily: '"Lucida Console", Monaco, monospace'
        },
         
        }
        
    },
    };

    var s3chart = new Chart(
        document.getElementById('apptChart3'),
        cons3
    ); 


    const datas4 = {
        labels: <?php echo json_encode($s4)?>,
        datasets: [{
        label: ' ',
        data:<?php echo json_encode($s4count)?>,
        backgroundColor: [
            'rgb(119,221,119)','rgb(255,105,97)'],
        borderColor: 'rgb(125, 157, 156,.7)',
        borderWidth: 1
        }]
    };
    const cons4 = {
    type: 'pie',
    data: datas4,
    options: {
      legend: {
            display: true,
            position: 'right'
  },
        responsive: true,
        plugins:{
          labels: {
          render: 'value',
          fontSize: 14,
          fontStyle: 'bold',
          fontColor: '#000',
          fontFamily: '"Lucida Console", Monaco, monospace'
        },
         
        }
        
    },
    };

    var s4chart = new Chart(
        document.getElementById('apptChart4'),
        cons4
    ); 

    
  

const mobileScreen = window.matchMedia("(max-width: 760px )");
$(document).ready(function () {
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
    $(".dashboard-nav-item").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
}); 



</script>
<?php include('logout_admin.php'); ?>
</body>
</html>