

  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/sms.js"></script>

  <style type="text/css">
    
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
.check-mark{
  color:#5bce5b;
}


  </style>   
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $bodycontent['mode']; ?> SMS to Role</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              
               <div class="box-header with-border">
                <h3 class="box-title"> SMS to Role</h3>
                 <a href="<?php echo base_url();?>smsconfig" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->

              <?php
               $selected_role_dtl="";
                  foreach($bodycontent['smsEditdata'] as $role_dtls)
               {
                 $selected_role_dtl.= $role_dtls->send_to_roleid.",";
               }
                $selected_role_dtl = rtrim($selected_role_dtl,",!");


              ?>
 

   <?php /*Payment list*/
              $attr = array("id"=>"SmsForm","name"=>"SmsForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
<input type="hidden" id="selected_role_dtl_id" name="selected_role_dtl_id" value="<?php echo $selected_role_dtl ;?>"/>

     <input type="hidden" name="smsID" id="smsID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['smsphaseid'];}else{echo "0";}?>" />
      
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
                  <div class="form-group">
                   <input type="hidden" name="oldsmsphase" id="oldsmsphase" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['smsphaseid'];}else{echo "0";}?>" />  
                     <label for="smsphaseList">Phase</label> 
                        <select id="smsphase" name="smsphase" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['smsnameList'])
                            {
                              foreach($bodycontent['smsnameList'] as $value)
                              { ?>
                                  <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['smsphaseid']==$value->id){echo "selected";}else{echo "";} ?>><?php echo $value->sms_name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>
                      <div class="form-group">
                     <label for="roleList">Role</label> 
                     <div id="roleview">
                       <select id="sel_role" name="sel_role[]" class="form-control selectpicker" multiple="multiple">
                        
                          <?php 
                            if($bodycontent['roleList'])
                            {
                              foreach($bodycontent['roleList'] as $value)
                              { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>
                  </div>
                
             
                  <p id="smsmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="smssavebtn"><?php echo $bodycontent['btnText']; ?></button>
                    
            <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
          </div>
               
              <?php echo form_close(); 
              

            
              ?>            
  <div class="response_msg" id="sms_response_msg">
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

 






