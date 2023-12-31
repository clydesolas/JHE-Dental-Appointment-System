
                 <!-- modal -->             
                 <div class="modal" id="delete<?php echo $announce_id; ?>" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-1"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                
                <form method="POST" action="">
                <br><h5 style="text-align:center">Are you sure you want to delete announcement #<?php echo $row['announce_id'];?>?</h5><br>
                <input type="hidden" id="inputEmail" name="announce_id" value="<?php echo $row['announce_id']; ?>" required>
                          
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
    $announce_id=$_POST['announce_id'];
	mysqli_query($con, "delete from announcement where announce_id='$announce_id'") or die(mysqli_error($con));?>
	<script>
	alert('Announcement#<?php echo $announce_id;?> Successfully Deleted!');
	window.location="web_content.php";
	</script>
	<?php
	}
	?>