


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
.tab-nav > li > a::after { background: #5a4080 none repeat scroll 0% 0%; color: #006600; }
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
        <li class="active">Register patient</li>
      </ol>
</section>

<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockLarge">
              <div class="box-header with-border">
                <h3 class="box-title">Patient Register </h3>
                 <a href="<?php echo base_url();?>patient" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"patientregform","name"=>"patientregform");
              echo form_open('',$attr); ?>
                <div class="box-body">
                
                    <div class="alert alert-danger alert-dismissible rpterr" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                
                </div>
                  
                    <div class="row">
                        <div class="col-md-4">
                              <div class="form-group">
                    
                            <input type="hidden" name="patient_id" id="patient_id" value="<?php if($bodycontent['mode']=="EDIT")
                                {echo ($bodycontent['patientregister']->ptcid);}else{echo "0";}?>" />
                            <input type="hidden" name="uid" id="uid" value="<?php if($bodycontent['mode']=="EDIT")
                                {echo $bodycontent['patientregister']->registered_by_user;}else{echo "0";}?>" />
                            <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                            <label for="state">Patient Name *</label> 
                            <input type="text" 
                                   class="form-control forminputs typeahead" 
                                   id="patient_name" name="patient_name" 
                                   placeholder="Enter patient name" autocomplete="off" 
                                   value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_name;}?>" 
                                   >

                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="blockname">Mobile *</label>
                            <input type="text" class="form-control forminputs typeahead" id="patient_mobile_primary" name="patient_mobile_primary" 
                            placeholder="Enter mobile no" autocomplete="off" 
                            value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_mobile_primary;}?>" 
                           >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="cordpin">Age *</label>
                                    <input type="text" minlength="2" maxlength="3"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_age" name="patient_age" placeholder="" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_age; } ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Sex</label>
                                        <select id="patient_sex" name="patient_sex" class="form-control">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="O">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        
                        </div>
                        
                    </div>
                    
                   <hr>
                  <div class="row">
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="cordpin">Village</label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_village" name="patient_village" placeholder="Village" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_village; } ?>" >
                                    </div>
                               </div>
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="cordpin">Gram panchyat</label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_gram_panchayat" name="patient_gram_panchayat" placeholder="Enter Gram panchyat" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_gram_panchayat; } ?>" >
                                    </div>
                               </div>
                               <div class="col-xs-4">
                                   <div class="form-group">
                                    <label for="cordpin">Post office</label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_postoffice" name="patient_postoffice" placeholder="Enter Post office" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_postoffice; } ?>" >
                                    </div>
                               </div>
                      
                               <div class="col-xs-2">
                                   <div class="form-group">
                                    <label for="cordpin">Pin *</label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_pin" name="patient_pin" placeholder="Enter pin number" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_pin; } ?>" >
                                    </div>
                               </div>
                  </div>
                   
                   <hr>
                   <div class="row">
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label for="distcoordinatorList">District *</label> 
                               <div id="distcoordinatorview">
                                   <select id="patient_district" name="patient_district" 
                                           class="form-control selectpicker" data-show-subtext="true"  
                                           data-live-search="true">
                                       <option value="0">Select</option>
                                       <?php
                                       if ($bodycontent['district']) {
                                           foreach ($bodycontent['district'] as $value) {
                                               ?>
                                               <option value="<?php echo $value->id; ?>"
                                               <?php if($bodycontent['mode']=="EDIT"){
                                                   if($bodycontent['patientregister']->patient_district==$value->id){echo('selected');} 
                                               
                                               } ?>        
                                               >
                                                   <?php echo $value->name; ?>
                                               </option>
                                           <?php
                                           }
                                       }
                                       ?>
                                   </select>
                               </div>
                           </div>
                       </div>
                       
                       <div class="col-sm-3">
                           <div class="form-group">
                               <label for="blockList">Block *</label> 
                               <div id="blockview">
                                   <select id="patient_block" name="patient_block" 
                                           class="form-control selectpicker"
                                           data-show-subtext="true" data-actions-box="true" 
                                           data-live-search="true" >
                                       <option value="0">Select</option>
                                       <?php if(!empty($bodycontent['block'])){ 
                                         foreach ($bodycontent['block'] as  $value) {
                                        ?>
                                            <option value="<?php echo($value->id); ?>"
                                            <?php if($bodycontent['mode']=="EDIT"){
                                                   if($bodycontent['patientregister']->patient_block==$value->id){echo('selected');} 
                                               
                                               }?> 
                                            >
                                                <?php echo($value->name); ?>
                                            </option>
                                        
                                       <?php } } ?>
                                   </select>
                               </div>
                            </div>
                           
                       </div>
                       <div class="col-md-3">
                          <div class="form-group">
                               <label for="blockList">TU *</label> 
                           <div id="blockview">
                           <select id="patient_block" name="patient_block" 
                                           class="form-control selectpicker"
                                           data-show-subtext="true" data-actions-box="true" 
                               data-live-search="true" >
                               <option value="0">Select</option>
                                 <?php if(!empty($bodycontent['block'])){ 
                                         foreach ($bodycontent['block'] as  $value) {
                                        ?>
                                            <option value="<?php echo($value->id); ?>"
                                            <?php if($bodycontent['mode']=="EDIT"){
                                                   if($bodycontent['patientregister']->patient_block==$value->id){echo('selected');} 
                                               
                                               }?> 
                                            >
                                                <?php echo($value->name); ?>
                                            </option>
                                        
                                       <?php } } ?>                
                           </select>
                           </div>
                        </div>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                  <label>Address</label>
                  <textarea id="patient_full_address" name="patient_full_address" class="form-control" rows="3" placeholder="Enter full address ..."><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_full_address; } ?>
                  </textarea>
                </div>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="col-md-4">
                           <label for="cordpin">Aadhaar number </label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_adhar" name="patient_adhar" placeholder="" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_adhar; } ?>" >
                                    
                       </div>
                       <div class="col-md-4">
                           
                            <label for="cordpin">Ration Card ID </label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_ration" name="patient_ration" placeholder="" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_voter; } ?>" >
                       
                     
                       </div>
                       <div class="col-md-4">
                           <label for="cordpin">Voter ID </label>
                                    <input type="text"  class="form-control forminputs removeerr typeahead " 
                                    id="patient_voter" name="patient_voter" placeholder="" autocomplete="off" 
                                    value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_adhar; } ?>" >
                           
                       </div>
                           
                           
                           
                           
                   </div>
                   
                   <hr>
                   <div class="row">
                       <div class="col-md-4">
                <div class="form-group">
                  <label for="fromdate"> Referal Date </label> 
                  <input type="text" id="patient_referal_date" class="form-control custom_frm_input datepicker" name="patient_referal_date" placeholder="" 
                         value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_referal_date; } ?>"
                   >
                     
                    </div>
                       </div>
                       
                       <div class="col-md-4">
                           <div class="form-group">
                            <label for="coordinatorList">Group Coordinator *</label> 
                               <select id="coordinator" name="coordinator" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                               <option value="0">Select</option>
                                 <?php 
                                   if($bodycontent['coordinatorList'])
                                   {
                                     foreach($bodycontent['coordinatorList'] as $coordinator_list)
                                     { ?>
                                         <option value="<?php echo $coordinator_list->id; ?>"
                                          <?php if($bodycontent['mode']=="EDIT"){
                                                   if($bodycontent['patientregister']->group_cord_id==$coordinator_list->id){echo('selected');} 
                                               
                                               } ?>      
                                          >
                                             
                                             <?php echo $coordinator_list->name; ?></option>
                                   <?php 
                                     }
                                   }
                                 ?>
                               </select>
                            </div>
                           
                       </div>
                       <div class="col-md-4">
                           
                             <div class="form-group">
                     <label for="nqppList">NFHP(Non Formal Health Provider)*</label> 
                     <div id="nqppview">
                        <select id="sel_nqpp" name="sel_nqpp" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                        <?php if(!empty($bodycontent['nfhp'])){
                                foreach ($bodycontent['nfhp'] as $value) {
                            ?> 
                        <option value="<?php echo($value->id);?>"
                                <?php if($bodycontent['mode']=="EDIT"){
                                                   if($bodycontent['patientregister']->nqpp_id==$value->id){echo('selected');} 
                                               
                                               } ?> 
                                
                                > <?php echo($value->name); ?></option>
                            
                        
                                <?php }
                                } ?>
                      </select>
                    </div>
                  </div>
                       </div>
                       
                       
                       
                   </div>
                   <hr>
                   <div class="row">
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="distcodembl">Alternate mobile</label>
                          <input type="text"  class="form-control forminputs removeerr numchk" id="patient_mobile_alternative"
                                 name="patient_mobile_alternative" placeholder="" autocomplete="off" 
                                 value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['patientregister']->patient_mobile_alternative; } ?>" maxlength="10" >
                        </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="distcodembl">Presumtive</label>
                          <select class="form-control" name="patient_pulmonary" id="patient_pulmonary">
                              <option value="EXTRAAPULMONARY">EXTRA PULMONARY</option>
                             <option value="PULMONARY">PULMONARYY</option>

                          </select>
                        </div>
                       </div>
                       <div class="col-md-4">
                        <div class="form-group">
                        <label for="blockList">Symptom</label> 
                        <div id="blockview">
                            <select id="patient_symptom" name="patient_symptom[]" class="form-control selectpicker" data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple">
                                <option value="0"></option>
                                <?php
                                if (!empty($bodycontent['symptom'])) {
                                    foreach ($bodycontent['symptom'] as $value) {
                                        ?>  
                                        <option value="<?php echo $value->id; ?>"  
                                        <?php
                                        if($bodycontent['mode']=="EDIT"){
                                        if (in_array($value->id, $bodycontent['selectedSymtp'])) {
                                            echo('selected');
                                        }
                                        }
                                        ?>
                                                ><?php echo($value->symptom); ?> </option>
                                            <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        </div>
                     </div>
                       
                   </div>
                       
                    <p id="ptcerrmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="ptcsavebtn">
                          <?php echo $bodycontent['btnText']; ?>
                      </button>
                  <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;">
                      <i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?>
                  </span>
                  </div>
                   
                   
                   
                   
                        
                    </div>
                 
						
			
						
			

                 
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="ptcregmsg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>
</section>
  
  <script>
  
  $(document).ready(function(){
       $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });
  });
  
  $(document).on("click","#ptcsavebtn",function(e){
      e.preventDefault();
      var formDataserialize = $("#patientregform" ).serialize();
      formDataserialize = decodeURI(formDataserialize);
      console.log(formDataserialize);
      var formData = {formDatas: formDataserialize};
      if(validatefrmptc()){
          $.ajax({
                
                type: 'POST' ,
                url: '<?php echo(base_url()) ?>patientregister/patientregAction',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function (result) {
                   
                  if (result.msg_status == 1) {
							
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl =   "<?php echo(base_url()); ?>patientregister/addpatient";
                        var listurl ="<?php echo(base_url()); ?>patient";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#ptcregmsg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#blcksavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });

				           

                
                   
                }, 
                error: function (jqXHR, exception) {
                      var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                       // alert(msg);  
                    }
                }); /*end ajax call*/
      }
      
  });
  
  function validatefrmptc()
{
    var patient_name = $("#patient_name").val();
    var patient_mobile_primary = $("#patient_mobile_primary").val();
    var patient_age = $("#patient_age").val();
    var patient_pin = $("#patient_pin").val();
    var patient_district =$("#patient_district").val();
    var patient_block = $("#patient_block").val();
    var coordinator = $("#coordinator").val();
    var sel_nqpp = $("#sel_nqpp").val();
    
    
    
    $("#ptcerrmsg").text("").css("dispaly", "none").removeClass("form_error");
    if(patient_name=="")
    {
        $("#patient_name").focus();
        $("#ptcerrmsg")
        .text("Enter patient name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
     if(patient_mobile_primary=="")
    {
        $("#patient_mobile_primary").focus();
        $("#ptcerrmsg")
        .text("Enter primary mobile no.")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    if(patient_age=="")
    {
        $("#patient_age").focus();
        $("#ptcerrmsg")
        .text("Enter patient age")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(patient_pin=="")
    {
        $("#patient_pin").focus();
        $("#ptcerrmsg")
        .text("Enter pin..")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

if(patient_district==0)
    {
        $("#patient_district").focus();
        $("#ptcerrmsg")
        .text("Select district name.")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
//patient_block
if(patient_block==0)
    {
        $("#patient_block").focus();
        $("#ptcerrmsg")
        .text("Select block name.")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    
//coordinator
if(coordinator=="0"){
     $("#coordinator").focus();
        $("#ptcerrmsg")
        .text("Select Group Co-ordinator name.")
        .addClass("form_error")
        .css("display", "block");
        return false;
}

if(sel_nqpp=="0"){
     $("#sel_nqpp").focus();
        $("#ptcerrmsg")
        .text("Select Group Co-ordinator name.")
        .addClass("form_error")
        .css("display", "block");
        return false;
}
    return true;
}
  
  
  
  
  
  
  $(document).on("change","#coordinator",function(){
      var cordntId = $(this).val();
      $.ajax({
	type: "POST",
	url: '<?php echo(base_url());?>patientregister/getNFHPByCoordinator/'+cordntId+'/1',
	data: '',
        dataType: 'html',
	
	success: function(data){
		$("#nqppview").html(data);
		$('.selectpicker').selectpicker({dropupAuto: false});
	},
	error: function (jqXHR, exception) {
				  var msg = '';
					if (jqXHR.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else {
						msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
				   // alert(msg);  
				}



	});/*end ajax call*/
  });
  
  $(document).on("change","#patient_district",function(event){
        //event.preventDefault();
        var dist_id = $(this).val();
        //alert(dist_id);
	$.ajax({
	type: "POST",
	url: '<?php echo(base_url());?>patientregister/getBlockByDistrictId/'+dist_id+'/1',
	data: '',
        dataType: 'html',
	
	success: function(data){
		$("#blockview").html(data);
		$('.selectpicker').selectpicker({dropupAuto: false});
	},
	error: function (jqXHR, exception) {
				  var msg = '';
					if (jqXHR.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else {
						msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
				   // alert(msg);  
				}



	});/*end ajax call*/

    });
  </script>