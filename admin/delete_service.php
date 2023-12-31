              <!-- modal -->             
              <div class="modal" id="delete<?php echo $service_id; ?>" data-bs-backdrop="static">
        <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST" action="">
                <br><h5 style="text-align:center">Are you sure you want to delete '<?php echo $row['service'];?>'?</h5><br>
                <input type="hidden" id="inputEmail" name="service_id" value="<?php echo $row['service_id']; ?>" required>
                          
                            <br>
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

            <?php
	if (isset($_POST['delete'])){
       $service_id=$_POST['service_id'];
	mysqli_query($con,"DELETE from services where service_id='$service_id'") or die(mysqli_error($con));?>
	<script>
     alert('You deleted a service');
	window.location="services.php";
	</script>
   
	<?php
	}
	?>           