 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pincode ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Pincode </h3>
                <a href="<?php echo base_url();?>pincode" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"PincodeForm","name"=>"PincodeForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
      
                    <input type="hidden" name="pincodeID" id="pincodeID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PinEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="pincodeMode" id="pincodeMode" value="<?php echo $bodycontent['mode']; ?>" />

                      <label for="district">District</label> 
                      <div id="district_dropdown">
                        <select id="district" name="district" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                          if($bodycontent['districtList'])
                          {
                            foreach($bodycontent['districtList'] as $districtlist)
                            { ?>
                                <option value="<?php echo $districtlist->distID; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['PinEditdata']->district_id==$districtlist->distID){echo "selected";}else{echo "";}}?> ><?php echo $districtlist->districtname ; ?></option>
                    <?php   }
                          }
                          ?>

                        </select>
                      </div>

                  </div>

                  <div class="form-group">
                    <label for="pincode">Pin</label>
                    <input type="text" class="form-control forminputs typeahead" id="pincode" name="pincode" placeholder="Enter Pincode" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PinEditdata']->pincode;}?>" onkeyup="return numericFilter(this);" maxlength="6">
                  </div>

                  <p id="pincodemsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="pincodesavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="pincode_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


