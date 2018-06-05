    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pathology Center List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" id="centerListing">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pathology Center List</h3>
              <a href="<?php echo base_url();?>pathologycenter/addpathologycenter" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>District</th>
                 
                  <th>Facility</th>
                  <th>Timing</th>
                  <th>Documents</th>
                  <th style="width:2%;">Status</th>
                  <th style="text-align:right;width:3%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['centerList'] as $key => $value) {

                    echo $value['centerMasterData']->center_name;

              			$status = "";
              			if($value['centerMasterData']->centerStatus=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag centerstatus" data-setstatus="N" data-pinid="'.$value['centerMasterData']->centerID.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag centerstatus" data-setstatus="Y" 
              				data-pinid="'.$value['centerMasterData']->centerID.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value['centerMasterData']->center_name; ?></td>
            <td><?php echo $value['centerMasterData']->contact_no; ?></td>
            <td><?php echo $value['centerMasterData']->center_email; ?></td>
            <td><?php echo $value['centerMasterData']->center_full_add; ?></td>
            <td><?php echo $value['centerMasterData']->districtName; ?></td>
            
            <td>
              <button type="button" class="btn btn-sm bg-maroon margin centerDtl" data-toggle="modal" data-target="#pop_modal_detail_admin"  data-centerid=<?php echo $value['centerMasterData']->centerID;?> data-centerdtlmode ="FACILITY" data-centername="<?php echo $value['centerMasterData']->center_name; ?>"> Facility <span class="badge" style="color:#d81b60;"><?php echo count($value['centerFacilitiesData']); ?></span></button> 
            </td>
            <td>
              <button type="button" class="btn btn-sm bg-orange margin centerDtl" data-toggle="modal" data-target="#pop_modal_detail_admin" data-centerid=<?php echo $value['centerMasterData']->centerID;?> data-centerdtlmode ="TIMING" data-centername="<?php echo $value['centerMasterData']->center_name; ?>" >Timing </button> 
            </td>
						<td>
              <button type="button" class="btn btn-sm bg-purple margin centerDtl" data-toggle="modal" data-target="#pop_modal_detail_admin" data-centerid=<?php echo $value['centerMasterData']->centerID;?> data-centerdtlmode ="DOCS" data-centername="<?php echo $value['centerMasterData']->center_name; ?>" >Documents <span class="badge" style="color:#605ca8;"><?php echo count($value['centerUploadedDocsData']); ?></span></button> 
            </td>
						<td style="vertical-align:middle;"><?php echo $status; ?></td>
						<td align="center" style="vertical-align:middle;"> 
							<a href="<?php echo base_url(); ?>pathologycenter/addpathologycenter/<?php echo $value['centerMasterData']->centerID; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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



