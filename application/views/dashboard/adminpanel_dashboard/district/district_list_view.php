<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/district.js"></script>     
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of District(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of District(s)</h3>
              <a href="<?php echo base_url();?>district/adddistrict" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>District</th>
                  <th>District Code</th>
                  <th>State</th>
                  <th>Dist. Coordinator</th>
                  <th>Dist. Coord. Mobile</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['districtList'] as $value) { 
              			$status = "";
              			if($value->is_active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag districtstatus" data-setstatus="0" data-disrictid="'.$value->id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag districtstatus" data-setstatus="1" 
              				data-disrictid="'.$value->id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
                   <td><?php echo $value->name; ?></td>
						<td><?php echo $value->dist_code; ?></td>
						<td><?php echo $value->state; ?></td>
						<td><?php echo $value->dist_coordinator; ?></td>
						<td><?php echo $value->dist_cordinator_mbl; ?></td>
						
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>district/adddistrict/<?php echo $value->id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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