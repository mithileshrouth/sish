    <div class="datatalberes" style="overflow-x:auto;">
     
              <table id="dataTable" class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>NFHP</th>
                  <th>District Coordinator</th>
                  <th>Block</th>
                  <th>Group Coordinator</th>
                  <th>Registration</th>
                  <th>Diagnosed</th>
                  <th>Payment Gen.</th>
                  <th>Pending<br>(Payment not gen.)</th>
                  <th>Paid</th>
                 
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($projectReportList as $key => $value) { 
              	
              		?>

					<tr>
            <td><?php echo $i++; ?></td>
             <td><?php echo $value['nqpp_name']; ?></td>
            <td><?php echo $value['dist_coordinator']; ?></td>
						<td><?php echo $value['block']; ?></td>
            <td><?php echo $value['coordinator']; ?></td>
           
            <td><?php echo $value['totalReg']; ?></td>
            <td><?php echo $value['totalDiagnosed']; ?></td>
            <td><?php  echo $value['totalPaymentGenerated']; ?></td>
            <td><?php 
            $pending=$value['totalDiagnosed']-($value['totalPaymentGenerated']+$value['totalPaid']);

                echo $pending;
            ?>
              

            </td>
						<td><?php  echo $value['totalPaid']; ?></td>
					
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>

            </div>