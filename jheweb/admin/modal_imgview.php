                 <!-- modal -->             
                 <div class="modal" id="imgview<?php echo $service_id; ?>"data-bs-backdrop="static">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0 mb-0">
              
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php echo "<img src='image/".$row['service_imgpath']."'style='width:100%;' >"; ?>
                
                        </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	