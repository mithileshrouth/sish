    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Area ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Area </h3>
                 <a href="<?php echo base_url();?>area" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"AreaForm","name"=>"AreaForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="areaID" id="areaID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['AreaEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="areaMode" id="areaMode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="exampleInputEmail1">City</label> 
                    <select id="city" name="city" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="0">Select</option>
                      <?php 
                      if($bodycontent['CityList'])
                      {
                        foreach($bodycontent['CityList'] as $citylist)
                        { ?>
                            <option value="<?php echo $citylist->id; ?>" <?php if($bodycontent['mode']=="EDIT"){if($bodycontent['AreaEditdata']->city_id==$citylist->id){echo "selected";}else{echo "";}}?> ><?php echo $citylist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="areaname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="areaname" name="areaname" placeholder="Area Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['AreaEditdata']->area_name;}?>">
                  </div>

                  <p id="areamsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="savebtn"><?php echo $bodycontent['btnText']; ?></button>
                     <!--  <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>area'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="area_response_msg" id="area_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->


    <div class="modal fade in" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>