                 <!-- modal -->             
                 <div class="modal" id="imgview<?php echo $service_id; ?>"data-bs-backdrop="true">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0 mb-0">
              
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php echo "<img src='../admin/image/".$row['service_imgpath']."'style='width:100%;' alt='Image not available'>"; ?>
            <div class="d-flex justify-content-center">
            <b class="fs-5 py-2"><?php echo $row['service']; ?></b>
            </div>
            <?php if( $row['description']==""){echo '<i><center>No description as of the moment</center></i>';}
            else{echo '<p class="px-3">'.$row['description'].'</p>  ';} ?>    </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	