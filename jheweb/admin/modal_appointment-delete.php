

<?php
	if (isset($_POST['delete'])){
       $appointment_id=$_POST['appointment_id'];
	mysqli_query($con,"DELETE from `appointment` where `sched_id`='$appointment_id'") or die(mysqli_error($con));?>
	<script>
	window.location="appointment.php";
	</script>
	<?php
	}
	?>

                 <!-- modal -->             
      <div class="modal" id="delete<?php echo $appointment_id; ?>" data-bs-backdrop="static">
        <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST">
                <br><h5 style="text-align:center">Are you sure you want to delete appointment <b>ID #<?php echo $row['sched_id'];?></b>?</h5><br>
                <input type="hidden" id="inputEmail" name="appointment_id" value="<?php echo $row['sched_id']; ?>" required>
                          
                       
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                        <button type="submit" class="btn btn-lg btn-danger w-100 mx-0 mb-2" id="delete" name="delete">Delete</button>
                        <button class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </form> 
                        </div>
                    </div>
                </div>
            <!-- modal --> 