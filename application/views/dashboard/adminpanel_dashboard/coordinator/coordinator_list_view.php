<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/coordinator.js"></script>   
    <style>
   
    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Group Coordinator(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List Group Coordinator(s)</h3>
              <a href="<?php echo base_url();?>coordinator/addcoordinator" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table id="dataTable" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Mobile</th>
                  <th>Block</th>
                  <th style="width:30%;">Address</th>
                  <th>Pin</th>
                  <th>Aadhar No.</th>
                  <th>Voter No</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['coordinatorList'] as $key => $value) { 
              			$status = "";
              			if($value->active==1)
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag cordstatus" data-setstatus="0" data-cordid="'.$value->cordid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag cordstatus" data-setstatus="1" 
              				data-cordid="'.$value->cordid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value->cordname; ?></td>
						<td><?php if($value->gender=="M"){
              echo "Male";
            }elseif ($value->gender=="F") {
             echo "Female";
            } ?></td>
						<td><?php echo $value->cordmobile; ?></td>
						<td><?php echo $value->blockname; ?></td>
						<td style="width:30%;"><?php echo $value->full_address; ?></td>
						<td><?php echo $value->pin_code; ?></td>
						<td><?php echo $value->aadhar_no; ?></td>
						<td><?php echo $value->voter_id; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>coordinator/addcoordinator/<?php echo $value->cordid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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



<!-- Modal -->
<div class="modal fade" id="hubpinlistmodal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:0px;">
        <h5 class="modal-title" >Pin Assigned with <span id="hubname"></span></h5>
      </div>
      <div class="modal-body" id="pinassigned_detail"></div>
      <div class="modal-footer" style="border-top:0px;">
            <button class="btn btn-default modalbtn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


