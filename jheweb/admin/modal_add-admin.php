                 <!-- modal -->               
                 <div class="modal" id="modal_add-admin" data-bs-backdrop="static">
                    <div class="modal-dialog" >
                        <div class="modal-content rounded-4 shadow">
                        <div class="modal-header border-bottom-0">
                        <h5><b>Add an Admin</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                
                <form method="POST">
             
               <table class="table table-bordered">
                    <tr>
                    <th>First Name</th>
                        <td><input class="form-control" required onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="fname">    </td>
                    </tr>
                    <tr>
                    <th>Middle Name</th>
                        <td><input class="form-control"required onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="mname">    </td>
                    </tr>
                    <tr>
                    <th>Last Name</th>
                        <td><input class="form-control"required  onkeypress="return /[a-z\-\ ]/i.test(event.key)"type="text"name="lname">    </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control"required type="email"name="email">    </td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><input class="form-control"required onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" placeholder="09123456789"type="text"name="contact">    </td>
                    </tr>
                    <tr>
                        <th>Position: </th>
                        <td>
                      <select name="position"required class="form-select form-select-md " required="true">
                      <option value="" style="display: none;" ></option>    
                      <option value="Doctor" >Doctor</option>
                      <option value="Assistant">Assistant</option>
                    </select>
                   
                        </td>
                    </tr>
                    <tr>
                    <th>Username</th>
                        <td><input class="form-control" minlength="8" required type="text"name="username">    </td>
                    </tr>
                    <tr>
                    <th>Password</th>
                        <td><input class="form-control" minlength="8"  required type="password"name="password">    </td>
                    </tr>
						</table>
              
               <div class="modal-footer border-top-0">
                     
                        <button class="btn btn-md btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary" id="add" name="add">
                            Submit</button>
                        </div>
                      </form> 
                        </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	
	<?php
	if (isset($_POST['add'])){
 
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $mname =$_POST['mname'];
    $contact =$_POST['contact'];
    $email =$_POST['email'];
    $position =$_POST['position'];
    $username =$_POST['username'];
    $pass =$_POST['password'];
    $password =md5($pass);
        

    $select1="SELECT `username` FROM admindb WHERE `username`='$username'";
               $user1 = $con->query($select1) or die ($con->error);
               $row = $user1->fetch_assoc();
               $totaluser1 = $user1->num_rows;
             if ($totaluser1>0){
                 echo '<script>alert("Username already exists !!")</script>'; 
                }    
            if ($totaluser1==0){
	mysqli_query($con,"INSERT INTO `admindb` 
      (`fname` ,  `mname` ,`lname`, `contact` ,`email`, `position`,`username`,`password`,`available`)
      VALUES ('$fname','$mname','$lname','$contact','$email','$position','$username','$password',' ')")or die(mysqli_error($con)); 
	
    ?>
	<script>
    alert("An Admin has been added.")
	window.location.href="administrators.php";
	</script>
	<?php
             }}
	?>