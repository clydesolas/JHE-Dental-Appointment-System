                 <!-- modal -->             
                 <div class="modal" id="view<?php echo $appointment_id; ?>"data-bs-backdrop="static">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title"><b>View Pending Appointment</b> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                
                <form method="POST">
                <input type="hidden" id="inputEmail" name="appointment_id" value="<?php echo $appointment_id; ?>" required>
               <div style="width:100%; overflow-x:auto; ">
                <table class="table table-bordered" style=" width:100%">
                        <tr>
                    <th>Appointment Number</th>
                    <td><?php  echo $row['sched_id'];?></td>
                    </tr>
                    <tr>
                    <th>Full Name</th>
                        <td><?php  echo $user_row['fname']." ".$user_row['mname']." ".$user_row['lname'];?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?php  echo $user_row['email'];?></td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><?php  echo $user_row['contact'];?></td>
                    </tr>
                    <tr>
                        <th>Appointment Date</th>
                        <td><?php  echo $datetime;?></td>
                    </tr>
                    
                    <tr>
                        <th>Service</th>
                        <td><?php  echo $service_row['service'];?></td>
                    </tr>
                    <tr>
                        <th>Doctor</th>
                        <td><?php  echo $row['doctor'];?></td>
                    </tr>
                    <tr>
                        <th>Apply Date</th>
                        <td><?php  echo $appliedDate;?></td>
                    </tr>
                    

                    <tr>
                        <th>Status: </th>
                        <td>
                      <select name="status" class="form-select form-select-md " required="true">
                      <option value="" style="display: none;" ><?php echo $row['status']?></option>    
                      <option value="Approved" <?php echo ($row['status']=="Approved")? 'selected':'';?> >Approve</option>
                      <option value="Declined" <?php echo ($row['status']=="Declined")? 'selected':'';?>>Decline</option>
                    </select>
                   
                        </td>
                    </tr>
                    <tr>
                        <th>Remark: </th>
                        <td> <textarea class="form-control" name="input_remark" placeholder="Write a remark.."required></textarea></td>
                    </tr>
						</table>
               </div>
               <div class="modal-footer border-top-0">
                     
                        <button class="btn btn-md btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary" id="yes" name="yes">
                            Submit</button>
                        </div>
                      </form> 
                        </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	
	<?php
	if (isset($_POST['yes'])){
        $appointment_id=$_POST['appointment_id'];
	$status=$_POST['status'];
    $remark=$_POST['input_remark'];

	mysqli_query($con,"UPDATE appointment set `status`='$status', `remark`='$remark' where sched_id='$appointment_id'")or die(mysqli_error($con)); 
	
    ?>
	<script>
	window.location.href="appointment.php";
	</script>
	<?php
	}
	?>