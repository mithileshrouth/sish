<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/block.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Patient List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patient List</h3>
              <a href="<?php echo base_url();?>patient" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Patient</th>
                  <th>Mobile</th>
                  <th>Village</th>
                  <th>Symptom</th>
                  <th>Adhar</th>
                  

                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['patientList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->patient_name; ?></td>
            <td><?php echo $value->patient_mobile_primary; ?></td>
            <td><?php echo $value->patient_village; ?></td>
            <td><?php echo $value->patient_symptom; ?></td>
						<td><?php echo $value->patient_adhar; ?></td>

						<td align="center"> 
							<a href="<?php echo base_url(); ?>patient<?php //echo $value->patient_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->