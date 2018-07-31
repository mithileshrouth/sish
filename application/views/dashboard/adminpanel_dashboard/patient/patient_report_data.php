<div class="datatalberes" >
              <table class="table table-bordered table-striped dataTables nowrap" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Registration Date</th>
                  <th>Name</th>
                  <th>Patient ID</th>
                  <th>Mobile</th>
                  <th>District</th>
                  <th>Block</th>
                  <th>Coordinator</th>
                  <th>Sputum Test Date</th>
                  <th>Sputum Collection Date</th>
                  <th>Dmc Center</th>
                  <th>Sputum Result</th>
                  <th>X-Ray Date</th>
                  <th>X-Ray Center</th>
                  <th>X-Ray Result</th>
                  <th>CBNAAT Test date</th>
                  <th>CBNAAT Collection date</th>
                  <th>CBNAAT Center</th>
                  <th>CBNAAT Result</th>
                  <th>Diagnosed</th>
                  <th>Treatment Start Date</th>
                  <th>Treatment End Date</th>
                  <th>Outcome</th>
                  
             
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($patientList as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo ($value->patient_reg_date == NULL ? "" : date("d-m-Y", strtotime($value->patient_reg_date))); ?></td>
            <td><?php echo $value->patient_name; ?></td>
            <td><?php echo $value->patient_uniq_id; ?></td>
            <td><?php echo $value->patient_mobile_primary; ?></td>
            <td><?php echo $value->district_name; ?></td>
            <td><?php echo $value->block_name; ?></td>
            <td><?php echo $value->coordinator_name; ?></td>
            <td><?php echo ($value->dmc_sputum_test_date == NULL ? "" : date("d-m-Y", strtotime($value->dmc_sputum_test_date))); ?></td>
            <td><?php echo ($value->dmc_sputum_date == NULL ? "" : date("d-m-Y", strtotime($value->dmc_sputum_date))); ?></td>
            <td><?php echo $value->dmc_name; ?></td>
            <td><?php if($value->dmc_spt_is_positive=='Y'){
                        echo "Positive";
            }elseif ($value->dmc_spt_is_positive=='N') {
                        echo "Negative";
            } ?></td>
           <td><?php echo ($value->xray_date == NULL ? "" : date("d-m-Y", strtotime($value->xray_date))); ?></td>
            
					<td><?php echo $value->xray_center_name; ?></td>
           <td><?php if($value->xray_is_postive=='Y'){
                        echo "Suggestive";
            }elseif ($value->xray_is_postive=='N') {
                        echo "Non Suggestive";
            } ?></td>

             <td><?php echo ($value->cbnaat_test_date == NULL ? "" : date("d-m-Y", strtotime($value->cbnaat_test_date))); ?></td>
             <td><?php echo ($value->cbnaat_date == NULL ? "" : date("d-m-Y", strtotime($value->cbnaat_date))); ?></td>
            <td><?php echo $value->cbnaat_center_name; ?></td>
             <td><?php if($value->cbnaat_pstv=='Y'){
                        echo "Positive";
            }elseif ($value->cbnaat_pstv=='N') {
                        echo "Negative";
            } ?></td>

             <td><?php if($value->is_tb_diagnosed=='Y'){
                        echo "Yes";
            }elseif ($value->is_tb_diagnosed=='N') {
                        echo "No";
            } ?></td>

            <td><?php echo ($value->trtmnt_start_date == NULL ? "" : date("d-m-Y", strtotime($value->trtmnt_start_date))); ?></td>
            <td><?php echo ($value->trtmnt_end_date == NULL ? "" : date("d-m-Y", strtotime($value->trtmnt_end_date))); ?></td>
            <td><?php echo $value->outcome ?></td>
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>

              </div>