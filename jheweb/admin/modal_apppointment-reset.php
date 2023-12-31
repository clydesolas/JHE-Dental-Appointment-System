                 <!-- modal -->             
                 <div class="modal" id="reset<?php echo $appointment_id; ?>"data-bs-backdrop="true">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST" action="">
                <br><h5 style="text-align:center">Reset the appointment status for Appointment <B>ID #<?php echo $appointment_id; ?> </B>? </h5><br>
                <input type="hidden" id="inputEmail" name="appointment_id" value="<?php echo $appointment_id; ?>" required>
                <input type="hidden" id="inputEmail" name="status" value="Pending" required>
                          
                            <br>
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                     <button type="submit" class="btn btn-lg btn-secondary w-100 mx-0 mb-2" id="yes" name="yes">
                         <a href="appointment.php" class="text-decoration-none text-white">Yes</a></button>
                        <button class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </form> 
                        </div>
                    </div>
            <!-- modal -->  

	
	<?php
	if (isset($_POST['yes'])){
        $appointment_id=$_POST['appointment_id'];
	$status=$_POST['status'];

	mysqli_query($con,"UPDATE appointment set `status`='$status' where sched_id='$appointment_id' AND `status`==`Pending`")or die(mysqli_error($con)); 
	?>
	<script>
	window.location="appointment.php";
	</script>
	<?php
	}
	?>