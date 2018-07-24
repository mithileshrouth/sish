<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/block.js"></script>  
<style type="text/css">
  .rolest{background-color: #ef7a25 !important;}
</style>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">SMS Role wise Action Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">SMS role wise action details</h3>
              <a href="<?php echo base_url();?>smsconfig/addsms" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th style="width:20%;">Phase</th>
                  <th style="width:65%;">Send sms alert to</th>
                
               
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['smsactionList'] as $value) { 
              	
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value['smsactionrolewiseData']->sms_name; ?></td>
					
						
						<td><?php 

                  foreach ($value['RoleData'] as $roledata) { ?>
                   
                  <span class="label label-warning rolest"><?php echo $roledata->name; ?></span>
                <?php  }
             ?>
              
            </td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>smsconfig/addsms/<?php echo $value['smsactionrolewiseData']->smsID; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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