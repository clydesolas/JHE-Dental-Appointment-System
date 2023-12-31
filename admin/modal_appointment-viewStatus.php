                 <!-- modal -->             
                 <div class="modal" id="statusView<?php echo $appointment_id; ?>"data-bs-backdrop="static">
                 <div class="modal-dialog" >
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title"><b>View Done Appointment</b> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST">
                <input type="hidden" id="inputEmail" name="appointment_id" value="<?php echo $appointment_id; ?>" required>
                <div style="width:100%; overflow-x:auto; ">
                <table class="table table-bordered" style=" width:100%">
                        <tr>
                    <th>Appointment Number</th>
                    <td><?php  echo $row['sched_id'];?></td>
                    </tr>
                    <tr>
                    <th>Full Name</th>
                        <td><?php  echo $user_row['fname']." ".$user_row['mname']." ".$user_row['lname'];?></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?php  echo $user_row['email'];?></td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><?php  echo $user_row['contact'];?></td>
                    </tr>
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
                        <td><?php echo $row['status']?>
                        </td>
                    </tr>
                    <tr>
                        <th>Remark: </th>
                        <td> <textarea class="form-control" name="input_remark"disabled><?php echo $row['remark'] ;?></textarea></td>
                    </tr>
						</table>
                </div>
              
               <div class="modal-footer border-top-0">
                     
                      
                        </div>
                      </form> 
                        </div>
                    </div>
                 </div></div>
            <!-- modal -->  

	