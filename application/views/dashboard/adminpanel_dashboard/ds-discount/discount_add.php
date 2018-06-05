  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Discount ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Discount - ADD</h3>
                <a href="<?php echo base_url();?>testdiscount" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"centerTestdiscForm","name"=>"centerTestdiscForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                    <input type="hidden" name="discountMode" id="discountMode" value="<?php echo $bodycontent['mode']; ?>" />

                      <label for="centerList">Center</label> 
                        <select id="test_center" name="test_center" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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


                  


               

                  <p id="centerdisc_manual_err_msg" class="form_error"></p>

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

    <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
    </div>

    <section id="loadcenterTest">
         
    </section>


