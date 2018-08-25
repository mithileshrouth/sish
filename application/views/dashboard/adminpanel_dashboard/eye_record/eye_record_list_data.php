    <div class="datatalberes" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Given Date</th>
                  <th>Car/Cluster</th>
                  <th>Group Coordinator</th>
                  <th>Catarat No</th>
                  <th>Spectacles No</th>
             
                 
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		
              	foreach ($recordList as $recordList) {
                 
              		?>

					<tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo date("d-m-Y", strtotime($recordList->given_date));?></td>
            <td><?php echo $recordList->clusture_car_name; ?></td>
            <td><?php echo $recordList->coordinator_name; ?></td>
            <td><?php echo $recordList->catarat_no; ?></td>
            <td><?php echo $recordList->spectacles_no; ?></td>
           
          
          
					
					
					</tr>
              			
             <?php } ?> 	

                </tbody>
               
              </table>

            </div>