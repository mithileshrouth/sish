<style>
.ui.multiple.dropdown > .label {
	color: #094e89;
    font-weight: 400;
    font-family: verdana;
    font-size: 12px;


}
.ui.selection.dropdown .menu > .item {
    border-top: 1px solid #f3f3f3;
    padding: .78571429rem 1.14285714rem !important;
    white-space: normal;
    word-wrap: normal;
    font-size: 1em;
}
.ui.label > .close.icon, .ui.label > .delete.icon {
    cursor: pointer;
    margin-right: 0;
    margin-left: .5em;
    font-size: .92857143em;
    opacity: .5;
    -webkit-transition: background .1s ease;
    transition: background .1s ease;
}
.ui.label > .icon {
    width: auto;
    margin: 0 .75em 0 0;
       
}
.ui.selection.active.dropdown .menu {
    border-color: #e6e6e6;
  
}
.ui.label > .close.icon, .ui.label > .delete.icon {

    cursor: pointer;
    margin-right: 0;
    margin-left: .5em;
    font-size: .92857143em;
    opacity: .5;
    -webkit-transition: background .1s ease;
    transition: background .1s ease;
	font-size: 14px;
	font-weight: 700;
	font-family: verdana;

}
.ui.label > .icon {

    width: auto;
    margin: 0 .75em 0 0;
        margin-right: 0.75em;
        margin-left: 0px;

}
i.icon, i.icons {

    font-size: 1em;

}
i.icon {

    display: inline-block;
    opacity: 1;
    margin: 0 .25rem 0 0;
    width: 1.18em;
    height: 1em;
    font-family: Icons;
    font-style: normal;
    font-weight: 400;
    text-decoration: inherit;
    text-align: center;
    speak: none;
    font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;

}

i.icon.delete::before {
    content: "x";
}

i.icon::before {
    background: 0 0 !important;
}
</style>
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hub ADD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockMedium">
              <div class="box-header with-border">
                <h3 class="box-title">Hub </h3>
                <a href="<?php echo base_url();?>hub" class="link_tab"><span class="glyphicon glyphicon-list"></span> Go to List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"HubForm","name"=>"HubForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Primary Info</p>
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hubname">Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="hubname" name="hubname" placeholder="Enter Hub Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->name; } ?>" />

                          <input type="hidden" name="hubID" id="hubID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->id;}else{echo "0";}?>" />

                         <input type="hidden" name="hubMode" id="hubMode" value="<?php echo $bodycontent['mode']; ?>" />
                         
                         
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hubcontact">Contact</label>
                          <input type="text" class="form-control forminputs removeerr numchk" id="hubcontact" name="hubcontact" placeholder="Enter Hub Contact No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->contact_no; } ?>" maxlength="10">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hubname">Email</label>
                          <input type="text" class="form-control forminputs removeerr" id="hubemail" name="hubemail" placeholder="Enter Email" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->email; } ?>" >
                        </div>
                      </div>
                    
                    </div>

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Address Info</p>
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hublongitude">Longitude</label>
                          <input type="text" class="form-control forminputs" id="hublongitude" name="hublongitude" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->longitude; } ?>"  onkeyup="return numericFilter(this)" />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hublatitude">Latitude</label>
                          <input type="text" class="form-control forminputs" id="hublatitude" name="hublatitude" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->latitude; } ?>" onkeyup="return numericFilter(this)" >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      

                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hubaddress">Address</label>
                            <textarea id="hubaddress" name="hubaddress" class="form-control forminputs txtareastyle removeerr"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['HubEditdata']->address; } ?></textarea>
                        </div>
                      </div>


                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="hubaddress">Pin</label>
                          <input type="text" class="form-control forminputs removeerr typeahead pinsearch" id="hubpincode" name="hubpincode" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['pindata']->pincode; } ?>" >
                        </div>
                      </div>


                    </div>

                    <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Pin Code Assign</p>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">

                          <input type="hidden" name="pinassignedval" id="pinassignedval" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['pinassignedids'];} ?>" />

                          <label for="assignedpincode">Assign pincode with hub</label> 
                          <select id="assignedpincode" name="assignedpincode[]" class="ui fluid search dropdown removeerr" multiple="">
                            <option value="0">Select</option>
                              <?php 
                              foreach ($bodycontent['pincodeList'] as $pincode) { ?>
                                <option value="<?php echo $pincode->pincodeID; ?>" ><?php echo $pincode->pincode; ?></option>
                              <?php 
                              }
                              ?>
                          </select>
                        </div>
                      </div>
                    </div>

                  <p id="hubcodemsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="hubsavebtn"><?php echo $bodycontent['btnText']; ?></button>

                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                      
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>pincode'">Go to List</button> -->
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="hub_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

    <!-- bootstrap time picker -->


