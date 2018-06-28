<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/coordinator.js"></script>   
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Coordinator <?php echo $bodycontent['mode']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockMedium">
              <div class="box-header with-border">
                <h3 class="box-title">Coordinator </h3>
                <a href="<?php echo base_url();?>coordinator" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"cordForm","name"=>"cordForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Primary Info</p>
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordname">Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="cordname" name="cordname" placeholder="Enter Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->cordname; } ?>" />

                          <input type="hidden" name="cordID" id="cordID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->cordid;}else{echo "0";}?>" />
						  
						   <input type="hidden" name="cuid" id="cuid" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->userid;}else{echo "0";}?>" />

                         <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                         
                         
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordmobile">Mobile</label>
                          <input type="text" class="form-control forminputs removeerr numchk" id="cordmobile" name="cordmobile" placeholder="Enter Mobile No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->cordmobile; } ?>" maxlength="10">
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordgender">Gender</label>
                        <select id="cordgender" name="cordgender" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" > 
                          <option value="">Select</option>
                          <option value="M" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['cordEditdata']->gender=="M" ){echo "selected";}else{echo "";} ?>>Male</option>
                          <option value="F" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['cordEditdata']->gender=="F" ){echo "selected";}else{echo "";} ?>>Female</option>

                         </select>
                        </div>
                      </div>

                     </div>



                   

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Address Info</p>
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                           <label for="cordblock">Block</label> 
							<select id="cordblock" name="cordblock" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
						   
							  <?php 
							  if($bodycontent['blockList'])
							  {
								foreach($bodycontent['blockList'] as $blocklist)
								{ ?>
									<option value="<?php echo $blocklist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['cordEditdata']->block_id==$blocklist->id){echo "selected";}else{echo "";} ?> ><?php echo $blocklist->name; ?></option>
						<?php   }
							  }
							  ?>

							</select>
                        </div>
                      </div>
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordvill">Village</label>
                          <input type="text" class="form-control forminputs" id="cordvill" name="cordvill" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->village; } ?>"  />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                     
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpo">Post Office</label>
                          <input type="text" class="form-control forminputs" id="cordpo" name="cordpo" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->post_office; } ?>"  >
                        </div>
                      </div>
					  
					   <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpin">Pin</label>
                          <input type="text" class="form-control forminputs removeerr typeahead " id="cordpin" name="cordpin" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->pin_code; } ?>" >
                        </div>
                      </div>
					  
					  
                    </div>

                    <div class="row">
                      

                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordadd">Address</label>
                            <textarea id="cordadd" name="cordadd" class="form-control forminputs txtareastyle removeerr"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->full_address; } ?></textarea>
                        </div>
                      </div>


                     
					  



                    </div>

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Document Info</p>
					
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordaadhar">Aadhar Card</label>
                          <input type="text" class="form-control forminputs numchk" id="cordaadhar" name="cordaadhar" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->aadhar_no; } ?>"  />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordvoterid">Voter ID No</label>
                          <input type="text" class="form-control forminputs" id="cordvoterid" name="cordvoterid" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->voter_id; } ?>"  >
                        </div>
                      </div>
                    </div>

					<p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Login Info</p>
					
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cordpassword">Password</label>
                          <input type="password" class="form-control forminputs" id="cordpassword" name="cordpassword" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['cordEditdata']->cordpsw; } ?>"  />
                        </div>
                      </div>
                     
                    </div>
					
                  <p id="cordmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="cordsavebtn"><?php echo $bodycontent['btnText']; ?></button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                      
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="cord_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


