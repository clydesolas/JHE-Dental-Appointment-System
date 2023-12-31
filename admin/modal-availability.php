    <!-- modal -->
    <div class="modal" id="avail-modal"  name="avail-modal" data-bs-backdrop="static">
            <div class="modal-dialog" >
                <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"onclick="javascript:window.location.reload()" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                <div class="modal-body py-0">
                   
                    <br><h4 style="text-align:center">Availability Status: <?php if($row['available']=="Yes"){echo '<span style="color:red">Not Available</span>';}else{echo '<span style="color:green">Available</span>';} ?></h4><br>
                    <input type="hidden"  name="id" value="<?php echo $row['id']; ?>" required>
                </div>
                <div class="modal-footer flex-column border-top-0">
                    <button type="submit" name="availbtn" style="text-decoration:none" class="btn btn-lg btn-primary w-100 mx-0 mb-2" >Confirm</button>
                    <button type="button" style="text-decoration:none"onclick="javascript:window.location.reload()"class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php
         if(isset($_POST['availbtn'])){
          if ($row['available']=="No" or $row['available']==""){
          mysqli_query($con,"UPDATE admindb set available='Yes' where id='$id'")or die(mysqli_error($con)); 
        }
          if ($row['available']=="Yes"){
            mysqli_query($con,"UPDATE admindb set available='No' where id='$id'")or die(mysqli_error($con)); 
        } 
        
        ?>
        <script>
        alert("Availability Status has been changed.")
        window.location="dashboard.php";
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }

	    </script>
      <?php } ?>