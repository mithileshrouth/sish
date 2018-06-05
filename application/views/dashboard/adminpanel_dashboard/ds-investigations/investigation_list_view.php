    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Investigation List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Investigation List</h3>
              <a href="<?php echo base_url();?>investigation/addinvestigation" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped dataTables" id="investigationTable" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Center</th>
                  <th>Department</th>
                  <th>Sub-Department</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Rate</th>
                  <th>Deliver in days</th>
                  <th>Pre Conditions</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
                  
              		foreach ($bodycontent['investigationList'] as $key => $value) { 

                   
                    

              			$status = "";
              			if($value->invactiveStatus=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag investigatestatus" data-setstatus="N" data-investigationid="'.$value->investigationID.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag investigatestatus" data-setstatus="Y" 
              				data-investigationid="'.$value->investigationID.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->center_name; ?></td>
						<td><?php echo $value->departmentName; ?></td>
            <td><?php echo $value->sub_dep_name; ?></td>
            <td><?php echo $value->code; ?></td>
            <td><?php echo $value->investigationName; ?></td>
            <td><?php echo $value->rate; ?></td>
            <td align="center"><?php echo $value->deliver_in_days; ?></td>
            <td><?php echo $value->preConditions; ?></td>
            
            <td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>investigation/addinvestigation/<?php echo $value->investigationID; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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

 