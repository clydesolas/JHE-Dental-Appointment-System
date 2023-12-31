<?php
  $serverdpphp = '../database.php'; 
    require($serverdpphp);
    session_start();

           if(isset($_SESSION['AdminLogin'])){
            $_SESSION['AdminLogin'];
            $email=strtoupper($_SESSION['AdminLogin']['username']);
            $id=strtoupper($_SESSION['AdminLogin']['id']);
        
            $appt="SELECT COUNT(*) as num, monthname(start_event) as syear, year(start_event) as `year` FROM appointment where `status`='Done' GROUP BY monthname(start_event) order by start_event";
            $resultappt = $con->query($appt);
            $apptnum = array();
            $apptyear = array();
            foreach ($resultappt as $rowappt) {
            $apptnum[] = $rowappt['num'];
            $apptyear[] = $rowappt['syear']." ".$rowappt['year'];
   
            }

            $appt2="SELECT year(start_event) as syear, COUNT(*) as num  FROM appointment where `status`='Done' GROUP BY year(start_event) order by year(start_event)";
            $resultappt2 = $con->query($appt2);
            $apptnum2 = array();
            $apptyear2 = array();
            foreach ($resultappt2 as $rowappt2) {
            $apptnum2[] = $rowappt2['num'];
            $apptyear2[] = $rowappt2['syear'];
   
            }
            $appt3="SELECT year(regdate) as syear, COUNT(*) as num  FROM users where `regdate`IS NOT NULL GROUP BY year(regdate) order by year(regdate)";
            $resultappt3 = $con->query($appt3);
            $apptnum3 = array();
            $apptyear3 = array();
            foreach ($resultappt3 as $rowappt3) {
            $apptnum3[] = $rowappt3['num'];
            $apptyear3[] = $rowappt3['syear'];
   
            }
            }
            else{
            	unset($_SESSION["AdminLogin"]);// depend on the value we use
                session_destroy();
                header("location: index.php");// find the login index
                 }
             if(!isset($_SESSION['AdminLogin']))
                {
                    unset($_SESSION["AdminLogin"]);// depend on the value we use
                    session_destroy();
                    header("location: index.php");// find the login index
                }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="../css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css ">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css ">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css ">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js">
    
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <title>J.H.E. Dental Clinic</title>
    <link href="../images/logo.png" rel="icon">
</head>
<style>
@media (min-width: 900px) {
 .apptChart{
    width:44%;
    margin: 0 28% 0 28%;
 }
}
@media (min-width: 601px)  and (max-width: 899px) {
    .apptChart{
    width:70%;
    margin: 0 15% 0 15%;
 }
  
}
@media (max-width: 600px) {
    .apptChart{
    width:100%;
 }
  }
    </style>
<body>
<div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle"><i class=" fs-3 bi bi-list"></i></a><a href="#"
                                                                                   class="brand-logo"><img src="../images/logo.png"class="logo-navbar"> <span>DENTAL CLINIC</span></a>
        </header>
        <nav class="dashboard-nav-list">
            <a href="dashboard.php  " class="dashboard-nav-item">
            <i class="fs-5 bi-house"></i> Dashboard
            </a>
            <a href="appointment.php" class="dashboard-nav-item ">
            <i class="fs-5 bi-table"></i> Appointment
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
            <a href="report.php" class="dashboard-nav-item active">
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
            <a href="admin_account.php" class="fs-5 text-nowrap text-decoration-none text-light"data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <i class="bi bi-gear"style="font-size:30px"></i></a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><div class="diva dropdown-item text-decoration-none">
                <style>.btnhover:hover{background-image: none;background-color: #15364f;color: black;} .diva:hover {background-image: none;background-color: white;color: black;}</style>
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
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <div class='card-header'>
                        <h2>Report</h2>
                    </div>
                    <div class='card-body px-2'>
                    <div class="container px-0">

                        <!-- chart 1 -->
                        <div class="graphbox border rounded my-1 py-2">
                    <h4 style="color: grey;text-align:center;">Monthly Done Appointments</h4>
                     <div class="apptChart border shadow">   <canvas id="apptChart"></canvas> </div>
                      
                        <table id="example" style="width:100%"  class="table  table-bordered caption-top table-striped table-hover ">
                            
                            <thead class="text-white" style="background-color:#305f82;">
                                            <tr>
                                            
                                           
                                            <th></th>
                                            <th>Services</th>
                                            <th>Appointment Count</th>   
                                            
                                                                       
                                                
                                            </tr>
                                        </thead>
                                        <tbody >
                                         
                                          <?php 
                                          $sqll = mysqli_query($con,"SELECT service_id, COUNT(*) as num, monthname(start_event) as months, year(start_event) as year FROM appointment where status='Done' GROUP BY service_id, monthname(start_event) order by start_event")or die(mysqli_error($con));
                                          while($row = mysqli_fetch_array($sqll)){
                                        
                                            $service_id = $row['service_id'];
                                            $num = $row['num'];
                                            $appt = $row['year']." ".$row['months'];
                                            /* user query  */
                                            $service_query = mysqli_query($con,"SELECT * from services where `service_id` = ' $service_id'")or die(mysqli_error($con));
                                            $service_row = mysqli_fetch_array($service_query);
                                            ?>
                                           
                                            
                                             <td><?php echo $appt; ?></td>   
                                             <td><?php echo $service_row['service']; ?></td>  
                                             <td><?php echo $num; ?></td> 
                                             
                                            
                                           
                                           
                                            </tr>
                                           
                                            <?php } ?>
                                            
                                        </tbody>
                                        
                                    </table>
                    </div>
                    <br>
                                    <!-- chart 2 -->
                                    <div class="graphbox border rounded my-1 py-2">
                   
                   <h4 style=" color: grey; text-align:center;">Yearly Done Appointment</h4>
                   <div class="apptChart border shadow">   <canvas id="apptChart2"></canvas> </div>
                  
                       <table id="example2" style="width:100%" class="table  table-bordered caption-top table-striped table-hover">
                           
                           <thead class="text-white" style="background-color:#305f82;">
                                           <tr>
                                           <th>Year</th>
                                           <th>Services</th>
                                           <th>Appointment Count</th>   
                                           </tr>
                                       </thead>
                                       <tbody >
                                        
                                         <?php 
                                         $sqll = mysqli_query($con,"SELECT service_id, COUNT(*) as num, Year(start_event) as months, year(start_event) as year FROM appointment where status='Done' GROUP BY service_id, year(start_event) order by start_event")or die(mysqli_error($con));
                                         while($row = mysqli_fetch_array($sqll)){
                                       
                                           $service_id = $row['service_id'];
                                           $num = $row['num'];
                                           $appt = $row['year'];
                                           /* user query  */
                                           $service_query = mysqli_query($con,"SELECT * from services where `service_id` = ' $service_id'")or die(mysqli_error($con));
                                           $service_row = mysqli_fetch_array($service_query);
                                           ?>
                                          
                                           
                                            <td><?php echo $appt; ?></td>   
                                            <td><?php echo $service_row['service']; ?></td>  
                                            <td><?php echo $num; ?></td> 
                                            
                                           
                                          
                                          
                                           </tr>
                                          
                                           <?php } ?>
                                           
                                       </tbody>
                                       
                                   </table>
                   </div>
                   <br>
                        <!-- chart 3 -->
                   <div class="graphbox border rounded my-1 py-2">
                   
                   <h4 style="font-size:2vw; color: grey; text-align:center;">Yearly Registered Patients</h4>
                   <div class="apptChart border shadow">   <canvas id="apptChart3"></canvas> </div>
                      
                       <table id="example3" style="width:100%" class="table  table-bordered caption-top table-striped table-hover ">
                           
                           <thead class="text-white" style="background-color:#305f82;">
                                           <tr>
                                           
                                          
                                           <th style="width: 50%; text-align: center;">Year</th>
                                           <th style="width: 50%; text-align: center;">Total Registered Patients</th>
                                           
                                                                      
                                               
                                           </tr>
                                       </thead>
                                       <tbody >
                                        
                                         <?php
                                         $regsql = mysqli_query($con,"SELECT COUNT(*) as regiscount, year(regdate) as year FROM users GROUP BY year(regdate) order by year")or die(mysqli_error($con));
                                         while($rowreg = mysqli_fetch_array($regsql)){
                                           $regiscount = $rowreg['regiscount'];
                                           $regisyear = $rowreg['year'];
                                           ?>
                                            <td style="text-align: center;"><?php echo $regisyear; ?></td>
                                            <td style="text-align: center;"><?php echo $regiscount;?></td>
                                            
                                           
                                          
                                          
                                           </tr>
                                          
                                           <?php } ?>
                                           
                                       </tbody>
                                       
                                   </table>
                   </div>
                </div>
                    </div>			
                </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MAIN BODY end of code -->
 

   
<script src="https://code.jquery.com/jquery-3.5.1.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js "></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js "></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js "></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script> 
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js "></script> 
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js "></script> 


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
     const data = {
        labels: <?php echo json_encode($apptyear)?>,
        datasets: [{
        label: 'Monthly Appointment',
        data:<?php echo json_encode($apptnum)?>,
        backgroundColor: [
            'rgba(48, 95, 130,.5)'
        ],
        borderColor: [
            'rgba(48, 95, 130, .8)'
        ],
        borderWidth:3
        }]
    };

    const con = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        
    },
    };

    var apptchart = new Chart(
        document.getElementById('apptChart'),
        con
    ); 

    const data2 = {
        labels: <?php echo json_encode($apptyear2)?>,
        datasets: [{
        label: 'Yearly Appointment',
        data:<?php echo json_encode($apptnum2)?>,
        backgroundColor: [
            'rgba(48, 95, 130,.5)','rgba(167, 199, 231,.5)','rgba(255,179,71,.5)'
        ],
        borderColor: [
            'rgba(48, 95, 130, .8)'
        ],
        borderWidth:3
        }]
    };

    const con2 = {
    type: 'bar',
    data: data2,
    options: {
        responsive: true,
        
    },
    };
    var apptchart2 = new Chart(
        document.getElementById('apptChart2'),
        con2
    );

    const data3 = {
        labels: <?php echo json_encode($apptyear3)?>,
        datasets: [{
        label: 'Yearly Registered Patients',
        data:<?php echo json_encode($apptnum3)?>,
        backgroundColor: [
            'rgba(48, 95, 130,.5)','rgba(167, 199, 231,.5)','rgba(255,179,71,.5)'
        ],
        borderColor: [
            'rgba(48, 95, 130, .8)'
        ],
        borderWidth:3
        }]
    };

    const con3 = {
    type: 'bar',
    data: data3,
    options: {
        responsive: true,
        
    },
    };
    var apptchart3 = new Chart(
        document.getElementById('apptChart3'),
        con3
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


$(document).ready(function() {
    var table = $('#example').DataTable( {

        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true,
        order: [[0, 'desc']],
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel', 'print'
        ]
        
    } );
} );

$(document).ready(function() {
    var table = $('#example2').DataTable( {

        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true,
        order: [[0, 'desc']],
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel', 'print'
        ]
        
    } );
} );

$(document).ready(function() {
    var table = $('#example3').DataTable( {
        scrollY:     '210px',
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        responsive: true,
        order: [[0, 'desc']],
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel', 'print'
        ]
        
    } );
} );

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php 
    include('logout_admin.php'); 
    $con->close();
?>
</body>
</html>