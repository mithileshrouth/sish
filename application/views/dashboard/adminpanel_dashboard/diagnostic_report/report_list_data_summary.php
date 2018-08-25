    <div class="datatalberes" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th>Sl</th>
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
              		
              	
              		?>

					<tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $reportList['ptc_reg_count'];?></td>
            <td><?php echo $reportList['sputum_count'];?></td>
						<td><?php echo $reportList['xray_count'];?></td>
            <td><?php echo $reportList['cbnaat_count'];?></td>
           
            <td><?php echo $reportList['diagnosed_count'];?></td>
            <td><?php echo $reportList['treatment_count'];?></td>
           
					
					
					</tr>
              			
              	

                </tbody>
               
              </table>

            </div>