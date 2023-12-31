                 <!-- modal -->             
                 <div class="modal" id="edit<?php echo $service_id; ?>"data-bs-backdrop="static">
        <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
            <h5><b>Update a service</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
               
                <form method="POST" action="" enctype="multipart/form-data">
                               
                               <div class="form-group pb-2">
                               <label for="service">Service</label>
                               <input type="hidden" id="inputEmail" name="service_id" value="<?php echo $row['service_id']; ?>" required>
                               <input class="form-control" value="<?php echo $row['service']; ?>" type="text"name="input_service" ID="service">    
                               </div>
                               <div class="form-group pb-2">
                               <label for="service_imgs">Image <i>(5mb max. size)</i></label>
                               <input class="form-control"value="" onchange='validate(this)' type="file" name="image" id="file" accept="image/*">  
                               </div> 
                               <p id="output"></p>
                               <div class="form-group pb-2"> 
                               <label for="descp">Description</label>
                               <textarea class="form-control"  id="descp"name="input_description" ><?php echo $row['description']; ?></textarea>    
                               
                         
                           </div>
                        
                       <br>
                   </div>
                   <div class="modal-footer d-flex justify-content-end">
                       
                       
                   <a type="button" style="text-decoration: none" class="btn btn-md btn-secondary mx-0" data-bs-dismiss="modal">Cancel</a>
                   <button type="submit" 
                                   id="btnservice"
                                   name="update"
                                   style="text-decoration: none" 
                                   class="btn btn-md btn-success" 
                                   onsubmit='return validate()'>Update</button>
                       
                       </form>
              
                        </div>
                    </div>
                </div>
            <!-- modal -->  

	
	<?php
	if (isset($_POST['update'])){
        $service_id=$_POST['service_id'];
        $service=$_POST['input_service'];
    
        $description=$_POST['input_description'];
            
    // Get image name
    
 
    if (empty($_FILES['image']['name'])) {
           
    mysqli_query($con,"update services set service='$service', description='$description' where service_id='$service_id'")or die(mysqli_error($con)); 
    }
    if (!empty($_FILES['image']['name'])){
    // image file directory
    
    $image = $_FILES['image']['name'];
    $target = "image/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    mysqli_query($con,"update services set service='$service', service_imgpath='$image', description='$description' where service_id='$service_id'")or die(mysqli_error($con)); 
    }    

   
	
	
    
    
    ?>
	
    <script>

	window.location="services.php";
	</script>
	<?php
	}
	?>