<style type="text/css">
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
        <li class="active">Investigation Import</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Investigation - Import </h3>
                 <a href="<?php echo base_url();?>investigation" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
            
              <?php 
              $attr = array("id"=>"investigationForm","name"=>"investigationForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                    <label for="centerList">Center</label> 
                      <div id="department_dropdown">
                        <select id="sel_center" name="sel_center" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                          if($bodycontent['centerList'])
                          {
                            foreach($bodycontent['centerList'] as $center_list)
                            { ?>
                                <option value="<?php echo $center_list->id; ?>" ><?php echo $center_list->center_name ; ?></option>
                    <?php   }
                          }
                          ?>

                        </select>
                      </div>

                  </div>

                  <div class="form-group">
                    <label for="subdepartname">Import</label>
                    <input type="file" name="investigationUploadFile" class="file forminputs investigationUploadFile" id="investigationUploadFile">
                    <div class="input-group col-xs-12">
                        <input type="text" name="investigationUploaduserFileName" id="investigationUploaduserFileName" class="form-control input-xs userfilesname" readonly placeholder="Upload Document" >

                        <span class="input-group-btn">
                          <button class="browse btn btn-primary input-xs" type="button" id="">
                              <i class="fa fa-folder-open" aria-hidden="true"></i>
                          </button>
                        </span>

                    </div>
                  </div>

                  <p id="investigation_errmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="investigatesavebtn" style="display: inline-block;"><?php echo $bodycontent['btnText']; ?></button>
                      <a href="<?php echo base_url();?>application/assets/UploadedDocs/InvestigationUpload/template/investigation_import_template.xls" class="btn btn-success formBtn" style="display: inline-block;" download ><i class="fa fa-download"></i> Template</a>
                  </div>
                  
                </div>
               
              <?php echo form_close(); ?>

              
            <div class="custom_loader" style="display:none;" id="investigation_loader">
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


    <!--- Success Modal---->
<div class="modal fade xlsinvModal" id="investigation_procee_modal">
         <div class="modal-dialog">
           <div class="modal-content">
              <div id="modal_investigation_content"></div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<!-- end success modal-->

