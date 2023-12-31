                 <!-- modal -->             
                 <div class="modal" id="statusView<?php echo $appointment_id; ?>"data-bs-backdrop="true">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title"><b>View Appointment Status</b> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST">
                <input type="hidden" id="inputEmail" name="appointment_id" value="<?php echo $appointment_id; ?>" required>
               <table class="table table-bordered">
                        <tr>
                    <th>Appointment Number</th>
                    <td><?php  echo $row['sched_id'];?></td>
                    </tr>
                    <tr>
                    
                    <tr>
                        <th>Appointment Date</th>
                        <td><?php  echo $datetime;?></td>
                    </tr>
                    
                    <tr>
                        <th>Service</th>
                        <td><?php  echo $service_row['service'];?></td>
                    </tr>
                    <tr>
                        <th>Doctor</th>
                        <td><?php  echo $row['doctor'];?></td>
                    </tr>
                    <tr>
                        <th>Apply Date</th>
                        <td><?php  echo $appliedDate;?></td>
                    </tr>
                    

                    <tr>
                        <th>Status: </th>
                        <td>
                        <?php if($row['status']=='Declined' || $row['status']=='Failed' ) {
                       echo '<span style="color:red">'.
                       $row['status']. '</span>'; }
                        if($row['status']=='Approved') {
                            echo '<span style="color:blue">'.
                       $row['status']. '</span>'; }
                        if($row['status']=='Done') {
                            echo '<span style="color:grey">'.
                       $row['status']. '</span>'; }
                       if($row['status']=='Pending') {
                        echo '<span style="color:black">'.
                   $row['status']. '</span>'; }
                         ?>

                        </td>
                    </tr>
                    <tr>
                        <th>Remark: </th>
                        <td>
                        <?php if($row['status']=='Declined' || $row['status']=='Failed' ) {
                       echo '<textarea style="color:red; height: 150px" class="form-control" name="input_remark"disabled>'.
                       $row['remark']. '</textarea>'; }
                        if($row['status']=='Approved') {
                            echo '<textarea style="color:blue; height: 150px" class="form-control" name="input_remark"disabled>'.
                            $row['remark']. '</textarea>'; }
                        if($row['status']=='Done') {
                            echo '<textarea style="color:grey; height:150px" class="form-control" name="input_remark"disabled>'.
                            $row['remark']. '</textarea>'; }
                         ?>

                        </td>
                    </tr>
						</table>
              
               <div class="modal-footer border-top-0">
                     
                      
                        </div>
                      </form> 
                        </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	