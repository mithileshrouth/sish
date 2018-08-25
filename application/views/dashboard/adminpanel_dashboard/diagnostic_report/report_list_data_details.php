    <div class="datatalberes" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Block</th>
                  <th>PTC Reg.</th>
                  <th>Sputum</th>
                  <th>X-Ray</th>
                  <th>CBNAAT</th> 
                  <th>Diagnosed</th>
                  <th>Treatment</th>
                 
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
                 /* echo "<pre>";
                  print_r($reportList['reportbyblock']);
                  echo "</pre>";*/
              		foreach ($reportList['reportbyblock'] as $value) {
                  if ($value['ptc_reg_count']>0) {
                 
              		?>

					<tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['block_name'];?></td>
            <td><?php echo $value['ptc_reg_count'];?></td>
            <td><?php echo $value['sputum_count'];?></td>
						<td><?php echo $value['xray_count'];?></td>
            <td><?php echo $value['cbnaat_count'];?></td>
           
            <td><?php echo $value['diagnosed_count'];?></td>
            <td><?php echo $value['treatment_count'];?></td>
           
					
					
					</tr>
              			
              	<?php } }?>

                </tbody>
               
              </table>

            </div>