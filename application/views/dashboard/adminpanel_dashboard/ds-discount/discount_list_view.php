  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Discount List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Discount - List</h3>
                <a href="<?php echo base_url();?>testdiscount/addtestdiscount" class="link_tab"><span class="glyphicon glyphicon-plus"></span> Add</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"discListFilterForm","name"=>"discListFilterForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                     <label for="centerList">Center</label> 
                        <select id="test_center" name="test_center" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['centerList'])
                            {
                              foreach($bodycontent['centerList'] as $center_list)
                              { ?>
                                  <option value="<?php echo $center_list->id; ?>"><?php echo $center_list->center_name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>
                  <p id="centerdisc_manual_err_msg" class="form_error"></p>

            <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="discListView" style="display: inline-block;">View</button>
            </div>
                  
          </div>
               
              <?php echo form_close(); ?>
        </div>
            
      </div>
    </div>

    </section>
    <!-- /.content -->

    <div class="dashboardloader" style="width: 100%; clear: both;display:none; ">
            <img src="<?php echo base_url();?>application/assets/images/verify_logo.gif"
             style="margin-left:auto;margin-right:auto;display:block;" />
           <p style="text-align:center;color:#055E87;letter-spacing:1px;">Please wait loading...</p>
    </div>

    <section id="loadcenterTestDiscList">
         
    </section>


