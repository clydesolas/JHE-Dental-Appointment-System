                 <!-- modal -->               
                 <div class="modal" id="add_service" data-bs-backdrop="static">
                    <div class="modal-dialog" >
                        <div class="modal-content rounded-4 shadow">
                        <div class="modal-header border-bottom-0">
                        <h5><b>Add a service</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                           
                           
                
                            <form method="POST" action=""enctype="multipart/form-data">
                               
                                    <div class="form-group pb-2">
                                    <label for="service">Service</label>
                                    <input class="form-control" required type="text"name="input_service" ID="service">    
                                    </div>
                                    <div class="form-group pb-2">
                                    <label for="service_imgs1">Image <i>(5mb max. size)</i></label>
                                    <input class="form-control"value="" required onchange='validate(this)' type="file" name="image1" id="file1" accept="image/*">  
                                    </div> 
                                    <p id="output1"></p>
                                    <div class="form-group pb-2"> 
                                    <label for="descp">Description</label>
                                    <textarea class="form-control" required id="descp"name="input_description" ></textarea>    
                                    
                              
                                </div>
                                
                            
                   
                         
                            <br>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            
                            
                        <a type="button" style="text-decoration: none" class="btn btn-md btn-secondary mx-0" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" 
                                        id="add"
                                        name="submit"
                                        style="text-decoration: none" 
                                        class="btn btn-md btn-success" 
                                        onsubmit='return validate()'>Add</button>
                            
                            </form>
                    </div>
                        </div>
                    </div>
                </div>
            <!-- modal -->  
<?php
            if(isset($_POST['submit'])){
                $post_service = $_POST['input_service'];
              
                $post_description = $_POST['input_description'];
                
                $select1="SELECT `service` FROM services WHERE `service`='$post_service'";
                $user1 = $con->query($select1) or die ($con->error);
                $row = $user1->fetch_assoc();
                $totaluser1 = $user1->num_rows;
              if ($totaluser1>0){
                echo '<script>alert("Service already exists ! ! ")</script>';}
              else{
                $image = $_FILES['image1']['name'];
                $target = "image/".basename($image);
                move_uploaded_file($_FILES['image1']['tmp_name'], $target);
                $sqlcode = "INSERT INTO `services` (`service`,`service_imgpath`,`description`) 
                VALUES ('$post_service','$image','$post_description')";
                $result = mysqli_query($con,$sqlcode);
               ?> 
                <div class="alert alert-success alert-dismissible" role="alert">
                Added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
           
           <?php }}
?>
