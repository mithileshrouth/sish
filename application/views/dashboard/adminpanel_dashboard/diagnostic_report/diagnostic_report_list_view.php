  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/diagnostic_report.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" /> 
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>   


  <style type="text/css">
  .exportExcel{
  padding: 5px;
  border: 1px solid grey;
  margin: 5px;
  cursor: pointer;
}
    .formBlock{
      box-shadow: -1px -1px 5px 6px #939393;
    }

.nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #ffffff;background: #5a4080; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; }
        .nav-tabs > li > a::after { content: ""; background: #5a4080; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: ##5a4080 none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}
.nav-tabs > li  {width:20%; text-align:center;}
.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }


@media all and (max-width:724px){
.nav-tabs > li > a > span {display:none;} 
.nav-tabs > li > a {padding: 5px 5px;}
}

/* tr.group,
tr.group:hover {
    background-color: #ddd !important;
} */

  </style>   
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Diagnostic Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Diagnostic Report</h3>
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
 

   <?php /*Payment list*/
              $attr = array("id"=>"DiagnosticReportForm","name"=>"DiagnosticReportForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                <div class="row">
                   <div class="col-md-6">
                <div class="form-group">
                  <label for="fromdate"> From Date </label> 
                    <input type="text" id="frndt"  class="form-control custom_frm_input datepicker"  name="from_date"  placeholder=""  />
                     
                    </div>
                    </div>
                  <div class="col-md-6">
                 <div class="form-group">
                  <label for="fromdate"> To Date </label> 
                    <input type="text" id="todt"  class="form-control custom_frm_input datepicker"  name="to_date"  placeholder=""  />
                     </div>
                    </div>
                  
                  </div> 
                  
                  <div class="form-group">
                     <label for="distcoordinatorList">District</label> 
                     <div id="distcoordinatorview">
                        <select id="distcoordinator" name="distcoordinator" class="form-control selectpicker" data-show-subtext="true"  data-live-search="true">
                          <option value="0">Select</option>
                   <?php 
                      if($bodycontent['distCoordinatorList'])
                      {
                        foreach($bodycontent['distCoordinatorList'] as $value)
                        { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php   }
                      }
                      ?>
                        </select>
                      </div>
                  </div>

                    <div class="form-group">
                     <label for="blockList">Block</label> 
                     <div id="blockview">
                        <select id="sel_block" name="sel_block[]" class="form-control selectpicker" data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                   
                        </select>
                      </div>
                  </div>


                    <div class="form-group">
                     <label for="grpcoordinatorList">Group Coordinator</label> 
                     <div id="grpcoordinatorview">
                        <select id="grpcoordinator" name="grpcoordinator[]" class="form-control selectpicker" data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                
                        </select>
                      </div>
                  </div>
                 <div class="form-group">
                     <label for="nqppList">NFHP</label> 
                     <div id="nqppview">
                        <select id="sel_nqpp" name="sel_nqpp[]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                     
                         
                        </select>
                        </div>
                  </div>
                <div class="form-group">
                     <label for="distcoordinatorList">Report Type</label> 
                     <div id="distcoordinatorview">
                        <select id="report_type" name="report_type" class="form-control selectpicker" data-show-subtext="true"  data-live-search="true">
                        <option value="S">Summary</option>
                        <option value="D">Details</option>
                        </select>
                      </div>
                  </div>
              
           
                <p id="report_msg"></p>
                  <p id="report_manual_err_msg" class="form_error"></p>

            <div class="btnDiv">
               <button type="submit" class="btn btn-primary formBtn" id="projectListView" style="display: inline-block;">View</button> 
            </div>
                  
          </div>
               
              <?php echo form_close(); 
                /*End of payment list*/

              ?>            

        </div><!--End of from block -->
            
      </div>
    </div>


    </section>
    <!-- /.content -->




    <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
    </div>

    <section id="loadProjectReportList" style="padding: 15px;">
         
    </section>






