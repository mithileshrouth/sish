<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/stls.js"></script>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">STLS <?php echo $bodycontent['mode']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">STLS </h3>
                 <a href="<?php echo base_url();?>stls" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"stlsForm","name"=>"stlsForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="form-group">
                    
                    <input type="hidden" name="stlsID" id="stlsID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['stlsEditdata']->id;}else{echo "0";}?>" />
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="seltu">TU</label> 
                    <select id="seltu" name="seltu" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                      <option value="0">Select</option>
                   
                      <?php 
                      if($bodycontent['tuList'])
                      {
                        foreach($bodycontent['tuList'] as $tulist)
                        { ?>
                            <option value="<?php echo $tulist->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['stlsEditdata']->tu_id==$tulist->id){echo "selected";}else{echo "";} ?> ><?php echo $tulist->name; ?></option>
                <?php   }
                      }
                      ?>

                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="stlsname">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="stlsname" name="stlsname" placeholder="Enter Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['stlsEditdata']->name;}?>" >
                  </div>

                  <div class="form-group">
                    <label for="stlsmobile">Mobile</label>
                     <input type="hidden" name="oldmobile" id="oldmobile" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['stlsEditdata']->mobile;}?>">
                    <input type="text" class="form-control forminputs typeahead numchk" id="stlsmobile" name="stlsmobile" placeholder="Enter Mobile No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['stlsEditdata']->mobile;}?>" maxlength="10">
                  </div>

                  <p id="stlsmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="stlssavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					           <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="stls_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

