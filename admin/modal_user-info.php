                 <!-- modal -->             
                 <div class="modal" id="userview<?php echo $user_id; ?>"data-bs-backdrop="static">
    <div class="modal-dialog" >
<div class="modal-content rounded-4 shadow">
<div class="modal-header border-bottom-0">
<h6 class="modal-title"><b><?php  echo $user_row['fname']."'s Info"?></b></h6>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<b>Profile:</b>
<div style="width:100%; overflow-x:auto; ">
<table class="table table-bordered" style=" width:100%">
        <tr>
    <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">User ID</th>
    <td><?php  echo $user_row['user_id'];?></td>
    </tr>
    <tr>
    <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Full Name</th>
        <td><?php  echo $user_row['fname']." ".$user_row['mname']." ".$user_row['lname'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Gender</th>
        <td><?php  echo $user_row['sex'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Birthday</th>
        <td><?php  echo $user_row['birthday'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Email</th>
        <td><?php  echo $user_row['email'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Mobile Number</th>
        <td><?php  echo $user_row['contact'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Registration Date</th>
        <td><?php  echo $user_row['regdate'];?></td>
    </tr>
    
        </table>
</div>
<b>Medical History:</b>
<div style="width:100%; overflow-x:auto; ">
<table class="table table-bordered" style=" width:100%">
       
    <tr>
    <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">General Health</th>
        <td><?php  echo $row['generalHealth']; ?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Existing Illness</th>
        <td><?php   echo $row['existingIllness'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Medicine/Drugs</th>
        <td><?php  echo $row['medicine'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Allergies</th>
        <td><?php  echo $row['allergies'];?></td>
    </tr>
    <tr>
        <th style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey" style="color:grey">Blood Pressure</th>
        <td><?php  echo $row['bloodPressure'];?></td>
    </tr>
    
        </table>
</div>
<div class="modal-footer border-top-0">
        
        
        </div>
        
        </div>
    </div>
    </div></div>
<!-- modal -->  

