  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/mmu_report.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/admin_style.css" /> 
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>   
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8"/>
<title>Title of the document</title>

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


/* tr.group,
tr.group:hover {
    background-color: #ddd !important;
} */

  </style>
  </head>

<body>   
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">MMU Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">MMU Report</h3>
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
 

   <?php /*Payment list*/
              $attr = array("id"=>"MmuReportForm","name"=>"MmuReportForm");
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
                     <label for="distcoordinatorList">Group Coordinator</label> 
                     <div id="distcoordinatorview">
                        <select id="grpcoordinator" name="grpcoordinator[]" class="form-control selectpicker" data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                          <option value="0">Select</option>
                   <?php 
                      if($bodycontent['grCoordinatorList'])
                      {
                        foreach($bodycontent['grCoordinatorList'] as $value)
                        { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php   }
                      }
                      ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="form-group">
                     <label for="distcoordinatorList">Clusture/Car</label> 
                     <div id="distcoordinatorview">
                        <select id="clustercar" name="clustercar" class="form-control selectpicker" data-show-subtext="true"  data-live-search="true">
                         
                   <?php 
                      if($bodycontent['clusturecarList'])
                      {
                        foreach($bodycontent['clusturecarList'] as $value)
                        { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php   }
                      }
                      ?>
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

</body>

</html>




