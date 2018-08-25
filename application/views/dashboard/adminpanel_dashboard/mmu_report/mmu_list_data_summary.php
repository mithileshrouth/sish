    <div class="datatalberes" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>MMU Date</th>
                  <th>Entry Date</th>
                  <th>Coordinator</th>
                  <th>Clusture/Car</th>
                  <th>OPD</th> 
                  <th>ANC</th>
                  <th>OCP</th>
                  <th>CC</th>
                  <th>MS</th>
                  <th>LAB</th>
                  <th>RDT</th>
                  <th>REFD</th>
                  <th>NCD</th>
                 
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		
              	foreach ($reportList as $reportList) {
                 
              		?>

					<tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo date("d-m-Y", strtotime($reportList->mmu_date));?></td>
            <td><?php echo date("d-m-Y", strtotime($reportList->entry_date));?></td>
            <td><?php echo $reportList->coordinator_name;?></td>
            <td><?php echo $reportList->clusture_car_name;?></td>
            <td><?php echo $reportList->opd;?></td>
            <td><?php echo $reportList->anc;?></td>
            <td><?php echo $reportList->ocp;?></td>
            <td><?php echo $reportList->cc;?></td>
            <td><?php echo $reportList->ms;?></td>
            <td><?php echo $reportList->lab;?></td>
            <td><?php echo $reportList->rdt;?></td>
            <td><?php echo $reportList->refd;?></td>
            <td><?php echo $reportList->ncd;?></td>
          
          
					
					
					</tr>
              			
             <?php } ?> 	

                </tbody>
               
              </table>

            </div>