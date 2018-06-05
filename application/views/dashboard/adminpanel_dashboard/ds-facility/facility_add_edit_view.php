    <style>
  .file {
  visibility: hidden;
  position: absolute;
}
</style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Facility ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Facility </h3>
                <a href="<?php echo base_url();?>facility" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
             // $attr = array("id"=>"FacilityForm","name"=>"FacilityForm");
            //  echo form_open('',$attr); 
              ?>

              <form action="#" name="FacilityForm" id="FacilityForm" enctype="multipart/form-data">
                <div class="box-body">
                  
                  <div class="form-group">

                   <input type="hidden" name="facilityID" id="facilityID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['facilityEditData']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="facilityMode" id="facilityMode" value="<?php echo $bodycontent['mode']; ?>" />
                    
                    <label for="facilitytitle">Title</label>
                    <input type="text" class="form-control forminputs typeahead" id="facilitytitle" name="facilitytitle" placeholder="Facility Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['facilityEditData']->title;}?>">
                  </div>

                  <div class="form-group">
                    <label for="faciltyicon">Icon</label>
                    
                    <input type="file" class="form-control forminputs file" id="faciltyicon" name="faciltyicon" />
                    <div class="input-group col-xs-12">
                     <input type="hidden" name="isFileUpload" id="isFileUpload" value="N" readonly />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span> 
                      <input name="facility_userfile_name" id="facility_userfile_name" class="form-control input-xs userfilesname" readonly="" placeholder="Upload Icon" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['facilityEditData']->icon_name;}?>">

                      <span class="input-group-btn">
                          <button class="browse btn btn-primary input-xs" type="button" id="uploadBtn">
                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                          </button>
                      </span>
                  </div>
                </div>

                  <p id="facilitymsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="facilitysavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>facility'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              </form>

              <div class="response_msg" id="facilty_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

