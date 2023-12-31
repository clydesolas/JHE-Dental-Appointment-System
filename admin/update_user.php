<?php
	if (isset($_POST['update'])){
	$user_id=$_POST['user_id'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
    $md5pass = md5($pass);
	mysqli_query($con,"update users set email='$email', pass='$md5pass' where user_id='$user_id'")or die(mysqli_error($con)); 
    echo '<div class="alert alert-success alert-dismissible" role="alert">
    Patients Profile Successfully Updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    ?>
	<script>
	window.location="manage.php";
	</script>
	<?php
	}
?>
<!-- modal -->
<div class="modal" id="update<?php echo $user_id;?>" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5>Update <?php echo $user_row['fname'];?>'s Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <form method="POST" action="">
                    <div class="form-group pb-2">
                        <label for="email">Email: <?php echo $user_row['email']; ?></label>
                        <input type="hidden"
                                id="inputEmail"
                                name="user_id"
                                value="<?php echo $user_row['user_id']; ?>"
                                required>
				        <input class="form-control"
                                type="text"
                                id="email"
                                name="email"
                                required>
                    </div>
                    <div class="form-group pb-2">
                        <label for="pass">Password:</label>
                        <input class="form-control"
                                type="password"
                                name="pass"
                                id="pass"
                                pattern=".{8,20}"
                                required=""
                                title="Password must be 8 to 20 characters">
                    </div>
                    <div class="form-group pb-2">
                        <label for="conpass">Confirm Password:</label>
                        <input class="form-control"
                                type="password"
                                name="conpass"
                                id="conpass"
                                pattern=".{8,20}"
                                required=""
                                title="Password must be 8 to 20 characters">
                    </div>
                    <br>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit"
                                id="update"
                                name="update"
                                style="text-decoration: none"
                                class="btn btn-md btn-success"
                                >Update
                        </button>
                        <a type="reset" style="text-decoration: none;" class="btn btn-md btn-danger mx-0" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal -->