
<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/nqpp.js"></script>   
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
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">NFHP Import</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">NFHP - Import </h3>
                 <a href="<?php echo base_url();?>nqpp" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
            
              <?php 
              $attr = array("id"=>"nqppimportForm","name"=>"nqppimportForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  

                  <div class="form-group">
                    <label for="subdepartname">Import</label>
                    <input type="file" name="nqppUploadFile" class="file forminputs nqppUploadFile" id="nqppUploadFile">
                    <div class="input-group col-xs-12">
                        <input type="text" name="nqppUploaduserFileName" id="nqppUploaduserFileName" class="form-control input-xs userfilesname" readonly placeholder="Upload Document" >

                        <span class="input-group-btn">
                          <button class="browse btn btn-primary input-xs" type="button" id="">
                              <i class="fa fa-folder-open" aria-hidden="true"></i>
                          </button>
                        </span>

                    </div>
                  </div>

                  <p id="investigation_errmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="nqppimpsavebtn" style="display: inline-block;"><?php echo $bodycontent['btnText']; ?></button>
                     
                  </div>
                  
                </div>
               
              <?php echo form_close(); ?>

              
            <div class="custom_loader" style="display:none;" id="nqpp_loader">
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

