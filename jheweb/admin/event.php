<?php
 $serverdpphp =  $_SERVER['DOCUMENT_ROOT'].'/database.php'; 
 require($serverdpphp);
 session_start();
 
$sqlEvents = "SELECT * FROM appointment WHERE `status`='Approved' ORDER BY `number` ASC ";
$resultset = mysqli_query($con, $sqlEvents) or die("database error:". mysqli_error($con));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {	
    $sched_userid=$rows['user_id'];
    $sched_serviceid=$rows['service_id'];
    $user_query = mysqli_query($con,"SELECT * from users where `user_id` = ' $sched_userid'")or die(mysqli_error($con));
    $user_row = mysqli_fetch_array($user_query);
    /* service query  */
    $service_query = mysqli_query($con,"SELECT * from `services` where `service_id` = '$sched_serviceid' ")or die(mysqli_error($con));
    $service_row = mysqli_fetch_array($service_query);
    $desc=  "Patient #".$rows['number'].": "."\n".$user_row['fname']. " ".$user_row['lname']."\n"." \n Doctor: \n".$rows['doctor']."\n";
    $service = "Service: \n".$service_row['service'];
	// convert  date to milliseconds

	$data[] = array(
        'sched_id' =>$rows['sched_id'],
        'title' => $rows['number'],
        'description' => $desc."\n".$service,
        'start'   => $rows["start_event"],
        'end'   => $rows["end_event"]
    );
}

echo json_encode($data);
?>