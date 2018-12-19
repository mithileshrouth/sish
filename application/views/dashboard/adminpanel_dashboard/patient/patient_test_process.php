<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Patient Observation- Step</li>
    </ol>
</section>
<section class="content">
    
       <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Patient's Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <input type="hidden" name="hdpatient" id="hdpatient" value="<?php echo $bodycontent["patientStaticHeader"]->patient_id;?>"/>
                           
                    <div class="col-md-2"><strong>Patient : </strong> <?php echo $bodycontent["patientStaticHeader"]->patient_name;?></div>
                    <div class="col-md-1"><strong>Age : </strong> <?php echo $bodycontent["patientStaticHeader"]->patient_age;?></div>
                    <div class="col-md-2"><strong>Mobile : </strong><?php echo $bodycontent["patientStaticHeader"]->patient_mobile_primary;?></div>
                    <div class="col-md-2"><strong>Reg. Dt : </strong><?php echo ($bodycontent["patientStaticHeader"]->patient_reg_date == NULL ? "" : date("d-m-Y", strtotime($bodycontent["patientStaticHeader"]->patient_reg_date)));?>  </div>
                    <div class="col-md-2"><strong>Pin : </strong><?php echo ($bodycontent["patientStaticHeader"]->patient_pin);?>  </div>
                    <div class="col-md-3"><strong>District : </strong><?php echo ($bodycontent["patientStaticHeader"]->district_name);?>  </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Co-ordinator : </strong> <?php echo $bodycontent["patientStaticHeader"]->cordintr_name;?></div>
                    <div class="col-md-2"><strong>NFHP : </strong><?php echo $bodycontent["patientStaticHeader"]->nfhp;?></div>
                    <div class="col-md-2"><strong>Block : </strong><?php echo ($bodycontent["patientStaticHeader"]->block_name);?>  </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3"></div>
                </div>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       </div>
    
        <!--dmc block-->
        <div class="row">
        <div class="col-md-12">
          <div class="box box-solid box-danger">
            <div class="box-header with-border">
              <i class="fa fa-medkit"></i>

              <h3 class="box-title">DMC Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                   
                       <div class="row">
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="sputum_test_date">Test Date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker" 
                                           id="sputum_test_date" name="sputum_test_date" placeholder="" autocomplete="off" 
                                           value="<?php 
                                           if($bodycontent["patientStaticHeader"]->dmc_sputum_test_date!=""){
                                               $dmc_sputum_test_date = date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->dmc_sputum_test_date));
                                           }else{
                                               $dmc_sputum_test_date="";
                                           }
                                           echo ($dmc_sputum_test_date); 
                                           ?>">
                                    </div>
                               </div>
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="sputum_collc_date">Collection Date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker " 
                                           id="sputum_collc_date" name="sputum_collc_date" placeholder="" autocomplete="off" 
                                           value="<?php 
                                           if($bodycontent["patientStaticHeader"]->dmc_sputum_date!=""){
                                               $dmc_sputum_date=date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->dmc_sputum_date));
                                           }else{
                                               $dmc_sputum_date="";
                                           }
                                           
                                           echo ($dmc_sputum_date); ?>">
                                    </div>
                               </div>
                               <div class="col-xs-2">
                                     <div class="form-group">
                                    <label>Sputum result</label>
                                    <select class="form-control" id="sputum_result" name="sputum_result">
                                      <option value="">--Select--</option>
                                      <option value="Y" <?php if($bodycontent["patientStaticHeader"]->dmc_spt_is_positive=="Y"){echo("selected");}?> >Positive</option>
                                      <option value="N" <?php if($bodycontent["patientStaticHeader"]->dmc_spt_is_positive=="N"){echo("selected");}?>>Negative</option>
                                     
                                    </select>
                                    </div>
                               </div>
                           <div class="col-xs-2">
                                    <span class="badge badge-warning">DMC Unit</span>
                                    <p class="text-green"><?php echo($bodycontent["patientStaticHeader"]->dmcname);?></p>
                           </div>
                           <div class="col-xs-2">
                               <span class="badge badge-warning">Tuberculosis Unit</span>
                               <p class="text-green"><?php echo($bodycontent["patientStaticHeader"]->tuname);?></p>
                           </div>
                           
                  </div>
                <div class="row">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary btn-sm sbmt-btn" id="dmc-btn">Update</button>
                    </div>
                    <div class="col-sm-6">
                       
                    </div>
                </div>
                   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       </div>
    <!--dmc block-->
    <!--xray-->
    <div class="row">
        <div class="col-md-12">
          <div class="box box-solid box-warning">
            <div class="box-header with-border">
              <i class="fa fa-xing-square"></i>

              <h3 class="box-title">X-Ray Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                   
                       <div class="row">
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="sputum_test_date">X-ray date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker" 
                                           id="xray_date" name="xray_date" placeholder="" autocomplete="off" 
                                           value="<?php 
                                           if($bodycontent["patientStaticHeader"]->xray_date!=""){
                                           echo (date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->xray_date))); 
                                           }else{
                                               echo("");
                                           }
                                           ?>">
                                    </div>
                               </div>
                               <div class="col-xs-3">
                                   <div class="form-group">
                                    <label>X-ray center
                                    
                                    </label>
                                    <select class="form-control" name="xray-center" id="xray-center">
                                      <option value="">Select</option>
                                       <?php
                                       if ($bodycontent['xray']) {
                                           foreach ($bodycontent['xray'] as $value) {
                                               ?>
                                               <option value="<?php echo $value->xraycenter_id; ?>"
                                               <?php if($bodycontent['patientStaticHeader']->xray_cntr_id==$value->xraycenter_id){echo('selected');} ?>>
                                                   <?php echo trim($value->xray_center_name);
                                                   
                                                   ?>
                                                </option>
                                           <?php
                                           }
                                       }
                                       ?>
                                     
                                    </select>
                                    </div>
                               </div>
                               <div class="col-xs-2">
                                     <div class="form-group">
                                    <label>X-ray result</label>
                                    <select class="form-control" id="xray-result" name="xray-result">
                                      <option  value="">--Select--</option>
                                      <option value="Y" <?php if($bodycontent['patientStaticHeader']->xray_is_postive=="Y"){echo('selected');} ?> >Suggestive</option>
                                      <option value="N" <?php if($bodycontent['patientStaticHeader']->xray_is_postive=="N"){echo('selected');} ?>>Non Suggestive</option>
                                     
                                    </select>
                                    </div>
                               </div>
                           <div class="col-xs-2">
                                    
                           </div>
                           <div class="col-xs-2">
                               
                           </div>
                           
                  </div>
                <div class="row">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary btn-sm sbmt-btn" id="xray-btn">Update</button>
                    </div>
                    <div class="col-sm-6">
                       
                    </div>
                </div>
                   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       </div>
    <!--CBNAAT-->
    
    <div class="row">
        <div class="col-md-12">
          <div class="box box-solid box-info">
            <div class="box-header with-border">
              <i class="fa fa-xing-square"></i>

              <h3 class="box-title">CBNAAT Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                   
                       <div class="row">
                               <div class="col-xs-2">
                                    <div class="form-group">
                                    <label for="sputum_test_date">Test date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker" 
                                           id="cbnaat_test_date" name="cbnaat_test_date" placeholder="" autocomplete="off" 
                                           value="<?php 
                                           if($bodycontent["patientStaticHeader"]->cbnaat_test_date!=""){
                                           $cbnaat_test_date=date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->cbnaat_test_date));
                                           }else{
                                           $cbnaat_test_date="";    
                                           }
                                            echo ($cbnaat_test_date); 
                                           
                                           ?>">
                                    </div>
                               </div>
                           
                               <div class="col-xs-2">
                                    <div class="form-group">
                                    <label for="sputum_test_date">Collection Date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker" 
                                           id="cbnaat_date" name="cbnaat_date" placeholder="" autocomplete="off" 
                                           value="<?php
                                          // 
                                           if($bodycontent["patientStaticHeader"]->cbnaat_date!=""){
                                            $cbnaatdate=date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->cbnaat_date));
                                           }else{
                                               $cbnaatdate="";
                                           }
                                           echo ($cbnaatdate); ?>">
                                    </div>
                               </div>
                           
                           
                           
                               <div class="col-xs-2">
                                   <div class="form-group">
                                    <label>CBNAAT center </label>
                                    <select class="form-control" id="cbnaat_center" name="cbnaat_center">
                                      <option value="">Select</option>
                                       <?php
                                       if ($bodycontent['cbnaat']) {
                                           foreach ($bodycontent['cbnaat'] as $value) {
                                               ?>
                                               <option value="<?php echo $value->cbnat_id; ?>"
                                               <?php if($bodycontent['patientStaticHeader']->cbnaat_id==$value->cbnat_id){echo('selected');} ?>>
                                                   <?php echo trim($value->cbnat_name);
                                                   
                                                   ?>
                                                </option>
                                           <?php
                                           }
                                       }
                                       ?>
                                     
                                    </select>
                                    </div>
                               </div>
                               <div class="col-xs-2">
                                    <div class="form-group">
                                    <label>CBNAAT Result</label>
                                    <select class="form-control" id="cbnaat_rslt" name="cbnaat_rslt">
                                        <option value="">--Select--</option>
                                        <option value="Y" <?php if($bodycontent['patientStaticHeader']->cbnaat_pstv=='Y'){echo('selected');} ?>>Detected</option>
                                      <option value="N" <?php if($bodycontent['patientStaticHeader']->cbnaat_pstv=='N'){echo('selected');} ?>>Not Detected</option>
                                     
                                    </select>
                                    </div>
                               </div>
                           <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>RIF</label>
                                        <select class="form-control" id="rif" name="rif">
                                            <option value="">--Select--</option>
                                            <option value="Sensitive" <?php if($bodycontent['patientStaticHeader']->rif_value=='Sensitive'){echo('selected');} ?>>Sensitive</option>
                                          <option value="Resistant"<?php if($bodycontent['patientStaticHeader']->rif_value=='Resistant'){echo('selected');} ?>>Resistant</option>
                                        </select>
                                    </div>
                           </div>
                           
                           <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>TB Diagnosed</label>
                                        <select class="form-control" id="tbdignosed" name="tbdignosed">
                                            <option value="">Not yet diagnosed</option>
                                            <option value="Y" <?php if($bodycontent['patientStaticHeader']->is_tb_diagnosed=='Y'){echo('selected');} ?>>Diagnosed</option>
                                          <option value="N"<?php if($bodycontent['patientStaticHeader']->is_tb_diagnosed=='N'){echo('selected');} ?>>Not Diagnosed</option>
                                        </select>
                                    </div>
                           </div>
                           
                  </div>
                <div class="row">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary btn-sm sbmt-btn" id="cbnaat-btn">Update</button>
                    </div>
                    <div class="col-sm-6">
                       
                    </div>
                </div>
                   
            </div>
            <!-- /.box-body -->
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
  
    $(document).on("click",".sbmt-btn",function(){
        var btn= $(this).attr("id");
        update(btn);
    });
    
});
function update(btn){
    var update_data = "";
    if(btn=="dmc-btn"){
        update_data ={
                        "patient_id":$("#hdpatient").val(),
                        "dmc_sputum_test_date":$("#sputum_test_date").val()||"",
                        "dmc_sputum_date":$("#sputum_collc_date").val()||"",
                        "dmc_spt_is_positive":$("#sputum_result").val(),
                        "from":"dmc"
                    }; 
    }else if(btn=="xray-btn"){
        update_data ={
                        "patient_id":$("#hdpatient").val(),
                        "xray_date":$("#xray_date").val()||"",
                        "xray_cntr_id":$("#xray-center").val(),
                        "xray_is_postive":$("#xray-result").val(),
                        "from":"xray"
                    }; 
    }else if(btn=="cbnaat-btn")
    {
         update_data ={
                        "patient_id":$("#hdpatient").val(),
                        "cbnaat_test_date":$("#cbnaat_test_date").val()||"",
                        "cbnaat_date":$("#cbnaat_date").val()||"",
                        "cbnaat_id":$("#cbnaat_center").val(),
                        "cbnaat_pstv":$("#cbnaat_rslt").val(),
                        "rif_value":$("#rif").val(),
                        "tbdignosed":$("#tbdignosed").val()||"",
                        "from":"cbnaat"
                    }; 
    }
    console.log(JSON.stringify(update_data) );
    $("#"+btn).prop('disabled', true);
    $.ajax({
        type: 'POST' ,
          url: "<?php echo(base_url()); ?>patient/investigationUpdate",
          data: JSON.stringify(update_data),
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
          success: function(result) {
 	     //Write your code here
             if(result.msg_status="1"){
                $("#"+btn).prop('disabled', false);
             }
          }
      });
    
}

</script>