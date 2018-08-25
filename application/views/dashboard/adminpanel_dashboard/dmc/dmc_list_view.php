<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/dmc.js"></script>  
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of DMC(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of DMC(s)</h3>
              <a href="<?php echo base_url();?>dmc/adddmc" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
               <?php
              $attr = array("id"=>"DmcListForm","name"=>"DmcListForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-4 "><label for="blockList" class="searchby"> Block </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_block" name="sel_block[]" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                        
                          <?php 
                            if($bodycontent['blockList'])
                            {
                              foreach($bodycontent['blockList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
                  <div class="row">
            <div class="col-md-4 "><label for="tuList" class="searchby"> TU </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     <div id="tuview">
                       <select id="sel_tu" name="sel_tu[]" class="form-control selectpicker"
                       data-show-subtext="true" data-live-search="true" multiple="multiple">
                       
                        </select>
                         </div>
                        </div>
                 
                  </div>
             
                </div>

                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary formBtn" id="viewdmcllist">View</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div>

              <section id="loadTuList"> 
             
              <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:5%;">Sl</th>
                  <th>DMC</th>
                  <th>Address</th>
                  <th>LT Name</th>
                  <th>Mobile No</th>
                  <th>TU</th>
                  <th>Block</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['dmcList'] as $value) { 
              			$status = "";
              			if($value->active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag dmcstatus" data-setstatus="0" data-dmcid="'.$value->dmcid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag dmcstatus" data-setstatus="1" 
              				data-dmcid="'.$value->dmcid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->dmcname; ?></td>
						<td><?php echo $value->dmcadd; ?></td>
						<td><?php echo $value->lt_name; ?></td>
						<td><?php echo $value->ltmobile; ?></td>
						<td><?php echo $value->tuname; ?></td>
						<td><?php echo $value->blockname; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>dmc/adddmc/<?php echo $value->dmcid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->