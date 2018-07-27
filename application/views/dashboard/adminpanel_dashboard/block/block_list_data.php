<div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Block</th>
                  <th>Block Code</th>
                  <th>District</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($blockList as $value) { 
              			$status = "";
              			if($value->is_active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag blockstatus" data-setstatus="0" data-blockid="'.$value->blockid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag blockstatus" data-setstatus="1" 
              				data-blockid="'.$value->blockid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->blockname; ?></td>
						<td><?php echo $value->block_code; ?></td>
						<td><?php echo $value->districtname; ?></td>
						
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>block/addblock/<?php echo $value->blockid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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