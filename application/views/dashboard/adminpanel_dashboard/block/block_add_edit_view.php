<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/block.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Block ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Block </h3>
                 <a href="<?php echo base_url();?>block" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"BlockForm","name"=>"BlockForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="blockID" id="blockID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['BlockEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="district">District</label> 
                    <select id="district" name="district" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                    <option value="0">Select</option>
                      <?php 
                      if($bodycontent['districtList'])
                      {
                        foreach($bodycontent['districtList'] as $districtlist)
                        { ?>
                            <option value="<?php echo $districtlist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['BlockEditdata']->district_id==$districtlist->id){echo "selected";}else{echo "";} ?> ><?php echo $districtlist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="blockname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="blockname" name="blockname" placeholder="Enter Block Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['BlockEditdata']->name;}?>" >
                  </div>

                  
                        <div class="form-group">
                          <label for="cordpin">Block Code</label>
                          <input type="text" minlength="2" maxlength="2"  class="form-control forminputs removeerr typeahead " id="blockcode" name="blockcode" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['BlockEditdata']->block_code; } ?>" >
                        </div>
                 

                  <p id="blockmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="blcksavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="blck_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

