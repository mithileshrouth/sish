<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/cbnaat.js"></script>   
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">CB-NAAT <?php echo $bodycontent['mode']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">CB-NAAT Center </h3>
                 <a href="<?php echo base_url();?>cbnaat" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"cbnatForm","name"=>"cbnatForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="cbnatId" id="cbnatId" 
                           value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->cbnatId;}else{echo "0";}?>" />
		    <!-- <input type="hidden" name="uid" id="uid" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->userid;}else{echo "0";}?>" /> -->
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="seltu">TU</label> 
                    <select id="seltu" name="seltu" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                      <option value="0">Select</option>
                  
                      <?php 
                      if($bodycontent['tuList'])
                      {
                        foreach($bodycontent['tuList'] as $tulist)
                        { ?>
                            <option value="<?php echo $tulist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['cbnaatEditdata']->tuid==$tulist->id){echo "selected";}else{echo "";} ?> ><?php echo $tulist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="cbnatname">Organization Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="cbnatcntrname" name="cbnatcntrname" placeholder="Enter Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->cbnat_name;}?>" >
                  </div>
				  
				   <div class="form-group">
                    <label for="cbnatadd">Organization Address</label>
                    <textarea class="form-control forminputs typeahead" id="cbnatcntradd" name="cbnatcntradd" style="resize:none;"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->cbnat_add;}?></textarea>
                  </div>
				  
				  <!--  <div class="form-group">
                              <label for="ltname">LT Name</label>
                              <input type="text" class="form-control forminputs typeahead " id="ltname" name="ltname" placeholder="Enter Name of LT" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->lt_name;}?>" >
                            </div>
          
                            <div class="form-group">
                              <label for="mobile">Mobile</label>
                              <input type="text" class="form-control forminputs typeahead numchk" id="mobile" name="mobile" placeholder="Enter Mobile No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->ltmobile;}?>" maxlength="10">
                            </div>
                    
          <div class="form-group">
                              <label for="ltpass">Password</label>
                              <input type="password" class="form-control forminputs typeahead " id="ltpass" name="ltpass" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cbnaatEditdata']->userpass;}?>" >
                            </div> -->

                  <p id="cbnatmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="cbnaatsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                    
					  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="cbnaat_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->


