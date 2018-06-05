  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Investigation ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Investigation - ADD</h3>
                <a href="<?php echo base_url();?>investigation" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"investigationManualForm","name"=>"investigationManualForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                    <input type="hidden" name="investigationID" id="investigationID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['investigationEditData']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="investigationMode" id="investigationMode" value="<?php echo $bodycontent['mode']; ?>" />

                      <label for="centerList">Center</label> 
                        <select id="investigation_center" name="investigation_center" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['centerList'])
                            {
                              foreach($bodycontent['centerList'] as $center_list)
                              { ?>
                                  <option value="<?php echo $center_list->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['investigationEditData']->center_id==$center_list->id){echo "selected";}else{echo "";}}?> ><?php echo $center_list->center_name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>

                  <div class="form-group">
                      <label for="sel_inv_department">Department</label> 
                     
                        <select id="sel_inv_department" name="sel_inv_department" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                          if($bodycontent['departmentList'])
                          {
                            foreach($bodycontent['departmentList'] as $depart_list)
                            { ?>
                                <option value="<?php echo $depart_list->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['investigationEditData']->department_id==$depart_list->id){echo "selected";}else{echo "";}}?> ><?php echo $depart_list->name ; ?></option>
                    <?php   }
                          }
                          ?>

                        </select>
                      
                  </div>
                  
                  <div class="form-group">
                      <label for="sel_subdepartment">Sub-Department</label> 
                      <div id="subdepartment_dropdown">
                        <select id="sel_subdepartment" name="sel_subdepartment" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                          <option value="0">Select</option>
                          <?php if($bodycontent['mode']=="EDIT"){ ?>
                          <option value="<?php echo $bodycontent['subdepartmentListEdit']->id; ?>" selected ><?php echo $bodycontent['subdepartmentListEdit']->sub_dep_name; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                  </div>

                  <div class="form-group">
                    <label for="investigation_code">Code </label>
                    <input type="text" name="investigation_code" class="form-control forminputs" id="investigation_code" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['investigationEditData']->code; } ?>" autocomplete="off" />
                  </div>
                  <div class="form-group">
                    <label for="investigation_name">Test </label>
                    <input type="text" name="investigation_name" class="form-control forminputs typeahead" id="investigation_name" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['investigationEditData']->name; } ?>" autocomplete="off" />
                  </div>
                  <div class="form-group">
                    <label for="investigation_rate">Rate </label>
                    <input type="text" name="investigation_rate" class="form-control forminputs" id="investigation_rate" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['investigationEditData']->rate; } ?>" autocomplete="off" onkeyup = "return numericFilter(this);" />
                  </div>
                  <div class="form-group">
                    <label for="investigation_delivery_days">Delivery In Days </label>
                    <input type="text" name="investigation_delivery_days" class="form-control forminputs" id="investigation_delivery_days" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['investigationEditData']->deliver_in_days; } ?>" autocomplete="off" onkeyup = "return numericFilter(this);" />
                  </div>
                  <div class="form-group">
                    <label for="investigation_rate">Pre Conditions </label>
                      <textarea name="invst_pre_conditions" class="form-control forminputs" id="invst_pre_conditions" style="resize:none;"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['preConditionEdit']->pre_conditions; } ?></textarea>
                  </div>

                  <p id="invest_manual_err_msg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="investManualSave" style="display: inline-block;"><?php echo $bodycontent['btnText']; ?></button>
                  </div>
                  
                </div>
               
              <?php echo form_close(); ?>

              
            <div class="custom_loader" style="display:none;" id="investigationmanual_loader">
              <div class="loader_spinner"></div>
              <p class="loading-text">Please wait ...</p>
            </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->


