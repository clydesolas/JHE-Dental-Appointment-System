
                 <!-- modal -->             
                 <div class="modal" id="del<?php echo $id1; ?>" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST" action="">
                <br><h5 style="text-align:center">Are you sure you want to permanently delete '<b><?php echo $row['fname']." ".$row['mname']." ".$row['lname'];?></b>' 's admin account?</h5><br>
                <input type="hidden"  name="id" value="<?php echo $row['id']; ?>" required>
                          
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
    $id1=$_POST['id'];
	mysqli_query($con,"DELETE from admindb where id='$id1'") or die(mysqli_error($con));
    
    ?>
	<script>
        alert("An account has been deleted permanently.")
	window.location="administrators.php";
	</script>
	<?php
	}
	?>