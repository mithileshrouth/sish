<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/cbnaat.js"></script>    
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Activity Log</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Activity Log</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Activity Date</th>
                  <th>Activity Module</th>
                 
                  <th>Role</th>
                  <th>User Mobile</th>
                   <th>Action</th>
                  <th>From Method</th>
                  <th>IP Address</th>
                  <th>User Browser</th>
                  <th>User Platform</th>

                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['activityList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo ($value->activity_date == NULL ? "" : date("d-m-Y", strtotime($value->activity_date))); ?></td>
            <td><?php echo $value->activity_module; ?></td>
            
            <td><?php echo $value->rollname; ?></td>
            <td><?php echo $value->mobile_no; ?></td>
            <td><?php echo $value->action; ?></td>
            <td><?php echo $value->from_method; ?></td>
            <td><?php echo $value->ip_address; ?></td>
            <td><?php echo $value->user_browser; ?></td>
            <td><?php echo $value->user_platform; ?></td>
					
					</tr>
              			
              	<?php
              		}

              	?>

                </tbody>
               
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->

