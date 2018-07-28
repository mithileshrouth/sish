  <div class="datatalberes" style="overflow-x:auto;">
              <table id="dataTable" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Mobile</th>
                  <th>Block</th>
                  <th style="width:30%;">Address</th>
                  <th>Pin</th>
                  <th>Aadhar No.</th>
                  <th>Voter No</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($coordinatorList as $key => $value) { 
              			$status = "";
              			if($value->active==1)
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag cordstatus" data-setstatus="0" data-cordid="'.$value->cordid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag cordstatus" data-setstatus="1" 
              				data-cordid="'.$value->cordid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->cordname; ?></td>
						<td><?php if($value->gender=="M"){
              echo "Male";
            }elseif ($value->gender=="F") {
             echo "Female";
            } ?></td>
						<td><?php echo $value->cordmobile; ?></td>
						<td><?php echo $value->blockname; ?></td>
						<td style="width:30%;"><?php echo $value->full_address; ?></td>
						<td><?php echo $value->pin_code; ?></td>
						<td><?php echo $value->aadhar_no; ?></td>
						<td><?php echo $value->voter_id; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>coordinator/addcoordinator/<?php echo $value->cordid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
            </td>
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>
            </div>
