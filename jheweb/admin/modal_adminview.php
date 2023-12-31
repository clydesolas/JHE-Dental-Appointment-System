                 <!-- modal -->             
                 <div class="modal" id="view<?php echo $id1; ?>"data-bs-backdrop="static">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title"><b><?php  echo $row['fname']." ".$row['mname']." ".$row['lname'];?></b> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST">
                <input type="hidden" id="inputEmail" name="id" value="<?php echo $id1; ?>" required>
               <table class="table  table-bordered  table-hover">
                    <tr>
                    <th>First Name</th>
                        <td><input class="form-control" value="<?php echo $row['fname']; ?>" onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="fname">    </td>
                    </tr>
                    <tr>
                    <th>Middle Name</th>
                        <td><input class="form-control" value="<?php echo $row['mname']; ?>" onkeypress="return /[a-z\-\ ]/i.test(event.key)" type="text"name="mname">    </td>
                    </tr>
                    <tr>
                    <th>Last Name</th>
                        <td><input class="form-control" value="<?php echo $row['lname']; ?>"  onkeypress="return /[a-z\-\ ]/i.test(event.key)"type="text"name="lname">    </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control" value="<?php echo $row['email']; ?>" type="email"name="email">    </td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><input class="form-control" value="<?php echo $row['contact']; ?>"onkeypress="return /[0-9]/i.test(event.key)" maxlength="11" placeholder="09123456789"type="text"name="contact">    </td>
                    </tr>
                    <tr>
                        <th>Position: </th>
                        <td>
                      <select name="position" class="form-select form-select-md " required="true">
                      <option value="" style="display: none;" ><?php echo $row['position']?></option>    
                      <option value="Doctor" <?php echo ($row['position']=="Doctor")? 'selected':'';?> >Doctor</option>
                      <option value="Assistant" <?php echo ($row['position']=="Assistant")? 'selected':'';?>>Assistant</option>
                    </select>
                   
                        </td>
                    </tr>
                    <?php
                   
                    if($row['position']=="Doctor"){?>
                    <tr>
                        <th>Availability Status: </th>
                        <td>
                      <select name="available" class="form-select form-select-md " required="true">
                      <option value="<?php echo $row['available']?>" style="display: none;" ><?php echo $row['available']?></option>    
                      <option value="Yes" <?php echo ($row['available']=="Yes")? 'selected':'';?> >Available</option>
                      <option value="No" <?php echo ($row['available']=="No")? 'selected':'';?>>Busy</option>
                    </select>
                   
                        </td>
                    </tr>
                    <?php
                    }
                    if($row['position']!="Doctor"){ ?>
                        <input type="hidden" name="available" value=" " required> 
                   <?php 
                   }
                    ?>
                   
						</table>
              
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
    $id1=$_POST['id'];
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $mname =$_POST['mname'];
    $contact =$_POST['contact'];
    $email =$_POST['email'];
    $available =$_POST['available'];
    $position =$_POST['position'];
  


	mysqli_query($con,"UPDATE admindb 
    set  `fname` = '$fname', `mname` = '$mname',`lname` = '$lname',`contact` = '$contact',`email` = '$email',`available` = '$available',`position` = '$position' where id='$id1'")or die(mysqli_error($con)); 
	
    ?>
	<script>
        alert("A profile has been updated.")
	window.location.href="administrators.php";
	</script>
	<?php
	}
	?>