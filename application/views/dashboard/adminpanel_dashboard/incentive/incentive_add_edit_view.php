<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/incentive.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Incentive <?php echo $bodycontent['mode'];?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Incentive </h3>
                 <a href="<?php echo base_url();?>incentive" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"IncentiveForm","name"=>"IncentiveForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                 
 

                  <div class="form-group">
                    <input type="hidden" name="IncentiveID" id="IncentiveID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['incentiveEditdata']->id;}else{echo "0";}?>" />

                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="role">Role</label>
                        <select id="sel_role" name="sel_role" class="form-control selectpicker" >
                       
                          <?php 
                            if($bodycontent['roleList'])
                            {
                              foreach($bodycontent['roleList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"
                       <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['incentiveEditdata']->role_id==$value->id){echo "selected";}else{echo "";} ?>><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>
                   <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control forminputs typeahead" id="amount" name="amount" placeholder="Enter Amount" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['incentiveEditdata']->amount;}?>" >
                  </div>

                  <p id="insmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="insavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					           <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="ins_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

