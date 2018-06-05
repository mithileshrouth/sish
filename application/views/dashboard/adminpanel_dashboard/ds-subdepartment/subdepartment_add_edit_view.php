 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sub-Department ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Sub-Department </h3>
                <a href="<?php echo base_url();?>subdepartment" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"subDepartForm","name"=>"subDepartForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
      
                    <input type="hidden" name="subdepartID" id="subdepartID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['subDepartmentEditData']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="subdepartMode" id="subdepartMode" value="<?php echo $bodycontent['mode']; ?>" />

                      <label for="departmentlist">Department</label> 
                      <div id="department_dropdown">
                        <select id="sel_department" name="sel_department" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                          if($bodycontent['departmentList'])
                          {
                            foreach($bodycontent['departmentList'] as $department_list)
                            { ?>
                                <option value="<?php echo $department_list->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['subDepartmentEditData']->department_id==$department_list->id){echo "selected";}else{echo "";}}?> ><?php echo $department_list->name ; ?></option>
                    <?php   }
                          }
                          ?>

                        </select>
                      </div>

                  </div>

                  <div class="form-group">
                    <label for="subdepartname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="subdepartname" name="subdepartname" placeholder="Enter Sub Department Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['subDepartmentEditData']->sub_dep_name;}?>" >
                  </div>

                  <p id="sub_depart_errmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="subdepartsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                  </div>
                  
                </div>
               
              <?php echo form_close(); ?>

              
            <div class="custom_loader" style="display:none;" id="sub_depart_loader">
              <div class="loader_spinner"></div>
              <p class="loading-text">Please wait ...</p>
            </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


