<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/xray.js"></script>    
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Xray Center List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Xray Center List</h3>
              <a href="<?php echo base_url();?>xraycenter/addxray" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Center</th>
                  <th>Address</th>
                  <!-- <th>LT Name</th>
                  <th>Mobile No</th> -->
                  <th>TU</th>
                  <th>Block</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['xraycntrlist'] as $value) { 
              			$status = "";
              			if($value->active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag xraystatus" data-setstatus="0" data-xraycntid="'.$value->xraycenter_id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag xraystatus" data-setstatus="1" 
              				data-xraycntid="'.$value->xraycenter_id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->xray_center_name; ?></td>
						<td><?php echo $value->xray_center_add; ?></td>
						<!-- <td><?php echo $value->lt_name; ?></td>
            <td><?php echo $value->ltmobile; ?></td> -->
						<td><?php echo $value->tuname; ?></td>
						<td><?php echo $value->blockname; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>xraycenter/addxray/<?php echo $value->xraycenter_id; ?>" 
                                                           class="btn btn-primary btn-xs" data-title="Edit">
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
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->

