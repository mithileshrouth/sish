<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/nqpp.js"></script>   
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">NFHP <?php echo $bodycontent['mode']; ?></li>
      </ol>
    </section>

	
	
    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockMedium">
              <div class="box-header with-border">
                <h3 class="box-title">NFHP </h3>
                <a href="<?php echo base_url();?>nqpp" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"nqppForm","name"=>"nqppForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Primary Info</p>
                    <div class="row">
					
					<div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                           <label for="coordinator">Coordinator</label> 
							<select id="coordinator" name="coordinator" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
						   
							  <?php 
							  if($bodycontent['coordinatorList'])
							  {
								foreach($bodycontent['coordinatorList'] as $coordinatorlist)
								{ ?>
									<option value="<?php echo $coordinatorlist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['nqppEditdata']->coordinator_id==$coordinatorlist->id){echo "selected";}else{echo "";} ?> ><?php echo $coordinatorlist->name; ?></option>
						<?php   }
							  }
							  ?>

							</select>
                        </div>
                    </div>
					
					
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppname">Name</label>
                          <input type="text" class="form-control forminputs" id="nqppname" name="nqppname" placeholder="Enter Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->nqppname; } ?>" />

                          <input type="hidden" name="nqppID" id="nqppID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->nqppid;}else{echo "0";}?>" />
						  
						   <input type="hidden" name="nqppuid" id="nqppuid" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->userid;}else{echo "0";}?>" />

                         <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                         
                         
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppmobile">Mobile</label>
                          <input type="hidden" name="oldmobile" id="oldmobile" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->nqppmobile;}?>">
                          <input type="text" class="form-control forminputs numchk" id="nqppmobile" name="nqppmobile" placeholder="Enter Mobile No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->nqppmobile; } ?>" maxlength="10">
                        </div>
                      </div>

                     
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppgender">Gender</label>
                        <select id="nqppgender" name="nqppgender" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" > 
                          <option value="">Select</option>
                          <option value="M" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['nqppEditdata']->gender=="M" ){echo "selected";}else{echo "";} ?>>Male</option>
                          <option value="F" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['nqppEditdata']->gender=="F" ){echo "selected";}else{echo "";} ?>>Female</option>

                         </select>
                        </div>
                      </div>

                 
                    </div>

                   

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Address Info</p>
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                           <label for="nqppblock">Block</label> 
							<select id="nqppblock" name="nqppblock" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                <option value="0">Select</option>
						   
							  <?php 
							  if($bodycontent['blockList'])
							  {
								foreach($bodycontent['blockList'] as $blocklist)
								{ ?>
									<option value="<?php echo $blocklist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['nqppEditdata']->block_id==$blocklist->id){echo "selected";}else{echo "";} ?> ><?php echo $blocklist->name; ?></option>
						<?php   }
							  }
							  ?>

							</select>
                        </div>
                      </div>
                       <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppvill">Village</label>
                          <input type="text" class="form-control forminputs" id="nqppvill" name="nqppvill" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->village; } ?>"  />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                     
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqpppo">Post Office</label>
                          <input type="text" class="form-control forminputs" id="nqpppo" name="nqpppo" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->post_office; } ?>"  >
                        </div>
                      </div>
					  
					   <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqpppin">Pin</label>
                          <input type="text" class="form-control forminputs removeerr typeahead numchk" id="nqpppin" name="nqpppin" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->pin_code; } ?>" >
                        </div>
                      </div>
					  
					  
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppadd">Address</label>
                            <textarea id="nqppadd" name="nqppadd" class="form-control forminputs txtareastyle removeerr"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->full_address; } ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqpppanchayat">Panchayat</label>
                          <input type="text" class="form-control forminputs" id="nqpppanchayat" name="nqpppanchayat" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->panchayat; } ?>"  />
                        </div>
                      </div>
					</div>

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Document Info</p>
					
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqppaadhar">Aadhar Card</label>
                          <input type="text" class="form-control forminputs numchk" id="nqppaadhar" name="nqppaadhar" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->aadhar_no; } ?>"  />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="cnqppvoterid">Voter ID No</label>
                          <input type="text" class="form-control forminputs" id="nqppvoterid" name="nqppvoterid" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->voter_id; } ?>"  >
                        </div>
                      </div>
                    </div>

					<p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Login Info</p>
					
					<div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="nqpppassword">Password</label>
                          <input type="password" class="form-control forminputs" id="nqpppassword" name="nqpppassword" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['nqppEditdata']->nqpppsw; } ?>"  />
                        </div>
                      </div>
                     
                    </div>
					
                  <p id="nqppmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="nqppsavebtn"><?php echo $bodycontent['btnText']; ?></button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                      
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="nqpp_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


