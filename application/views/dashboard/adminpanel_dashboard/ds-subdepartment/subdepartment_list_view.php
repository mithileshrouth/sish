    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sub-Department List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sub-Department List</h3>
              <a href="<?php echo base_url();?>subdepartment/addsubdepartment" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Sub Department</th>
                  <th>Department</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['subepartmentList'] as $key => $value) { 
              			$status = "";
              			if($value->subActiveStatus=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag subdepartstatus" data-setstatus="N" data-subdepartid="'.$value->subdepartmentID.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag subdepartstatus" data-setstatus="Y" 
              				data-subdepartid="'.$value->subdepartmentID.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->sub_dep_name; ?></td>
            <td><?php echo $value->departmentName; ?></td>
            <td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>subdepartment/addsubdepartment/<?php echo $value->subdepartmentID; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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