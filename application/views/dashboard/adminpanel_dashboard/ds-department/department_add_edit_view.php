 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Department ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Department </h3>
                 <a href="<?php echo base_url();?>department" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"departmentForm","name"=>"departmentForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                     <input type="hidden" name="departmentID" id="departmentID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['departmentEditData']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="departmentMode" id="departmentMode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="departmentname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="departmentname" name="departmentname" placeholder="Enter department name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['departmentEditData']->name;}?>" >
                  </div>

                  <p id="department_err_msg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="departmntsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                     
                  </div>
                  
                </div>
              
              <?php echo form_close(); ?>

            <div class="custom_loader" style="display:none;" id="department_loader">
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


