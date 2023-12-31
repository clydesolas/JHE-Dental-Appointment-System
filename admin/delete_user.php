
                 <!-- modal -->             
                 <div class="modal" id="delete<?php echo $user_id; ?>" data-bs-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST" action="">
                <br><h5 style="text-align:center">Are you sure you want to delete '<?php echo $user_row['fname'];?>'?</h5><br>
                <input type="hidden" id="inputEmail" name="user_id" value="<?php echo $user_row['user_id']; ?>" required>
                          
                            <br>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="submit"
                                        id="delete"
                                        name="delete"
                                        style="text-decoration: none"
                                        class="btn btn-md btn-outline-danger" 
                                        >Delete
                            </button>
                            <a type="button" style="text-decoration: none" class="btn btn-md btn-outline-secondary mx-0" data-bs-dismiss="modal">Cancel</a>
                        </div>
                      </form> 
                        </div>
                    </div>
                </div>
            <!-- modal --> 
<?php
	if (isset($_POST['delete'])){
    $user_id=$_POST['user_id'];
	mysqli_query($con,"DELETE from users where user_id='$user_id'") or die(mysqli_error($con));
    mysqli_query($con,"DELETE from appointment where user_id='$user_id'") or die(mysqli_error($con));
    mysqli_query($con,"DELETE from medicalhistory where user_id='$user_id'") or die(mysqli_error($con));
    ?>
	<script>
	window.location="manage.php";
	</script>
	<?php
	}
	?>