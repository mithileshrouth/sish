  <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th>DMC</th>
                  <th>Address</th>
                  <th>LT Name</th>
                  <th>Mobile No</th>
                  <th>TU</th>
                  <th>Block</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($dmcList as $value) { 
              			$status = "";
              			if($value->active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag dmcstatus" data-setstatus="0" data-dmcid="'.$value->dmcid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag dmcstatus" data-setstatus="1" 
              				data-dmcid="'.$value->dmcid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->dmcname; ?></td>
						<td><?php echo $value->dmcadd; ?></td>
						<td><?php echo $value->lt_name; ?></td>
						<td><?php echo $value->ltmobile; ?></td>
						<td><?php echo $value->tuname; ?></td>
						<td><?php echo $value->blockname; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>dmc/adddmc/<?php echo $value->dmcid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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