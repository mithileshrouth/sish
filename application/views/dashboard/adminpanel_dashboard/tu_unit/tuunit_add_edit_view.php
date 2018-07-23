<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/tuunitjs.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">TU ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Tuberculosis Unit </h3>
                 <a href="<?php echo base_url();?>tuberculosisunit" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"TUForm","name"=>"TUForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="TUID" id="TUID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['TuEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="block">Block</label> 
                    <select id="block" name="block" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                      <option value="0">Select</option>
                   
                      <?php 
                      if($bodycontent['blockList'])
                      {
                        foreach($bodycontent['blockList'] as $blocklist)
                        { ?>
                            <option value="<?php echo $blocklist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['TuEditdata']->block_id==$blocklist->id){echo "selected";}else{echo "";} ?> ><?php echo $blocklist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="tuunitname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="tuunitname" name="tuunitname" placeholder="Enter Tuberculosis Unit Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['TuEditdata']->name;}?>" >
                  </div>

                  <p id="tumsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="tusavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					           <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="tu_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

