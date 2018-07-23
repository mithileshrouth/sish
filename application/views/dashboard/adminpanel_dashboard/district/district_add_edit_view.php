<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/district.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">District ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">District </h3>
                 <a href="<?php echo base_url();?>district" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"DistrictForm","name"=>"DistrictForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="districtID" id="districtID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['DistrictEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="state">State</label> 
                    <select id="state" name="state" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                    <!-- <option value="0">Select</option> -->
                      <?php 
                      if($bodycontent['stateList'])
                      {
                        foreach($bodycontent['stateList'] as $statelist)
                        { ?>
                            <option value="<?php echo $statelist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['DistrictEditdata']->state_id==$statelist->id){echo "selected";}else{echo "";} ?> ><?php echo $statelist->state; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="blockname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="districtname" name="districtname" placeholder="Enter District Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['DistrictEditdata']->name;}?>" >
                  </div>

                  
                        <div class="form-group">
                          <label for="cordpin">District Code</label>
                          <input type="text" minlength="2" maxlength="3"  class="form-control forminputs removeerr typeahead " id="districtcode" name="districtcode" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['DistrictEditdata']->dist_code; } ?>" >
                        </div>
                 

                  <p id="districtmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="distsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="dist_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

