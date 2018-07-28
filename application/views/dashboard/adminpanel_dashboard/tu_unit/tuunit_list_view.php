<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/tuunitjs.js"></script> 
 <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />
<style type="text/css">

  </style>    
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of TU(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of TU(s)</h3>
              <a href="<?php echo base_url();?>tuberculosisunit/addtuunit" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

               <?php
              $attr = array("id"=>"TuunitListForm","name"=>"TuunitListForm");
              echo form_open('',$attr); ?>
              <div class="row">
      <div class="col-md-4 "><label for="roleList" class="searchby">Search By Block </label> </div>
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
              <div class="col-md-4 btnviewrow">
              <button type="submit" class="btn btn-primary formBtn" id="viewtullist">View</button>
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
                  <th style="width:10%;">Sl</th>
                  <th>TU</th>
                  <th>Block</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['tuList'] as $value) { 
              			$status = "";
              			if($value->active=="1")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag tustatus" data-setstatus="0" data-tuid="'.$value->tuid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag tustatus" data-setstatus="1" 
              				data-tuid="'.$value->tuid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->tuname; ?></td>
						<td><?php echo $value->blockname; ?></td>
						
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>tuberculosisunit/addtuunit/<?php echo $value->tuid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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