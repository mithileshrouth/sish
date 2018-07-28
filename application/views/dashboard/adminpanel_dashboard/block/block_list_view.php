<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/block.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />    


  </style>


  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Block(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Block(s)</h3>
              <a href="<?php echo base_url();?>block/addblock" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php
              $attr = array("id"=>"BlockListForm","name"=>"BlockListForm");
              echo form_open('',$attr); ?>
              <div class="row">
      <div class="col-md-4 "><label for="roleList" class="searchby">Search By District </label> </div>
      <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_dist" name="sel_dist[]" class="form-control selectpicker" data-actions-box="true" multiple="multiple">
                        
                          <?php 
                            if($bodycontent['districtList'])
                            {
                              foreach($bodycontent['districtList'] as $value)
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
              <button type="submit" class="btn btn-primary formBtn" id="viewblocllist">View</button>
                                </div>
                </div>
             <?php echo form_close(); ?>    
               
                              

   <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
    </div>

    <section id="loadBlockList"> 

        <div class="datatalberes" style="overflow-x:auto;">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Block</th>
                  <th>Block Code</th>
                  <th>District</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
        
                  $i = 1;
                  foreach ($bodycontent['blockList'] as $value) { 
                    $status = "";
                    if($value->is_active=="1")
                    {
                      $status = '<div class="status_dv "><span class="label label-success status_tag blockstatus" data-setstatus="0" data-blockid="'.$value->blockid.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
                    }
                    else
                    {
                      $status = '<div class="status_dv"><span class="label label-danger status_tag blockstatus" data-setstatus="1" 
                      data-blockid="'.$value->blockid.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
                    }
                  ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->blockname; ?></td>
            <td><?php echo $value->block_code; ?></td>
            <td><?php echo $value->districtname; ?></td>
            
            <td><?php echo $status; ?></td>
            <td align="center"> 
              <a href="<?php echo base_url(); ?>block/addblock/<?php echo $value->blockid; ?>" class="btn btn-primary btn-xs" data-title="Edit">
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