<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/patient.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" />  

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>   
    <style>
.exportExcel{
  padding: 5px;
  border: 1px solid grey;
  margin: 5px;
  cursor: pointer;
}
   
    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">PTC Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">PTC Report</h3>
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
              $attr = array("id"=>"PatientReportListForm","name"=>"PatientReportListForm");
              echo form_open('',$attr); ?>
              <div class="row">
            <div class="col-md-4 "><label for="districtList" class="searchby"> District </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     
                       <select id="sel_dist" name="sel_dist[]" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                        
                          <?php 
                            if($bodycontent['districtList'])
                            {
                              foreach($bodycontent['districtList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                 
                  </div>
             
                </div>
                  <div class="row">
            <div class="col-md-4 "><label for="blockList" class="searchby"> Block </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     <div id="blockview">
                       <select id="sel_block" name="sel_block[]" class="form-control selectpicker"
                       data-show-subtext="true" data-live-search="true" multiple="multiple">
                       
                        </select>
                         </div>
                        </div>
                 
                  </div>
             
                </div>

            <div class="row">
            <div class="col-md-4 "><label for="coordinatorList" class="searchby"> Group Coordinator </label> </div>
            <div class="col-md-4">
                      <div class="form-group">
                     
                     <div id="cordinatorview">
                       <select id="sel_coordinator" name="sel_coordinator[]" class="form-control selectpicker"
                       data-show-subtext="true" data-live-search="true" multiple="multiple">
                       
                        </select>
                         </div>
                        </div>
                 
                  </div>
             
                </div>
            <div class="row">
                <div class="col-md-4 ">
                  <label for="fromdate" class="searchby"> From Date </label> </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <input type="text" id="frndt"  class="form-control custom_frm_input datepicker"  name="from_date"  placeholder=""  />
                     
                     </div>
                 
                  </div>
             
             </div>

              <div class="row">
                <div class="col-md-4 ">
                  <label for="fromdate" class="searchby"> To Date </label> </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <input type="text" id="todt" class="form-control custom_frm_input datepicker"  name="to_date"  placeholder=""  />
                     
                     </div>
                 
                  </div>
             
             </div>
            <p id="reportmsg" class="form_error"></p>

                 <div class="row">
                    <div class="col-md-offset-4 col-md-4 btnview">
              <button type="submit" class="btn btn-primary formBtn" id="viewblocllist">View</button>
              </div>
                 </div>
             <?php echo form_close(); ?>

              <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
            </div>
            <section id="loadpatientreport"> 
              

             </section>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->





