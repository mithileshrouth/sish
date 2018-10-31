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
                                           value="<?php echo (date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->dmc_sputum_test_date))); ?>">
                                    </div>
                               </div>
                               <div class="col-xs-3">
                                    <div class="form-group">
                                    <label for="sputum_collc_date">Collection Date</label>
                                    <input type="text" class="form-control custom_frm_input datepicker " 
                                           id="sputum_collc_date" name="sputum_collc_date" placeholder="" autocomplete="off" 
                                           value="<?php echo (date('d/m/Y', strtotime($bodycontent["patientStaticHeader"]->dmc_sputum_date))); ?>">
                                    </div>
                               </div>
                               <div class="col-xs-4">
                                   <div class="form-group">
                                    <label>DMC Center</label>
                                   
                                    <select class="form-control">
                                        <option>Select</option>
                                        <?php 
                                        
                                        if($bodycontent['dmc']){ 
    
                                            foreach ($bodycontent['dmc'] as $value) {
                                         ?>
                                        <option value="<?php echo($value->dmcid); ?>"><?php echo($value->dmcname); ?></option>
                                            <?php }}?>
                                      
                                      <option>option 3</option>
                                      <option>option 4</option>
                                      <option>option 5</option>
                                    </select>
                                    </div>
                               </div>
                      
                               <div class="col-xs-2">
                                     <div class="form-group">
                                    <label>Sputum result</label>
                                    <select class="form-control">
                                      <option>--Select--</option>
                                      <option>Positive</option>
                                      <option>Negative</option>
                                     
                                    </select>
                                    </div>
                               </div>
                  </div>
                <div class="row">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-primary btn-sm">Update</button>
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
    
</section>
<script>
  $(document).ready(function(){
       $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });
  });

</script>