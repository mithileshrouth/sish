
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
<style type="text/css">
.contact{
  width: 169px;
width: 169px;
height: 60px;
padding: 0px;
box-shadow: 0px 2px 2px 2px #d7d5d5;
margin-top: 10px;
font-size: 12px;
}
.testbox{
  font-size: 14px;
  color: #21a592;
}  


element {

}
.timeline-inverse > li > .timeline-item {

    background: #f7f7f7;
    border: 1px solid #ddd;
    box-shadow: none;

}
.vill{
  height:60px;
}
 .gpco{
  height:60px;
} 
</style>
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Patient Details</li>
      </ol>
    </section>
     


    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
            <?php foreach ($bodycontent['patientInfo'] as $value) {
                if ($value->patient_sex=="M") {
                   $profilepic="male.jpg";
                  }else{
                   $profilepic="female.jpg"; 
                  }
                  $trtmnt_start_date=$value->trtmnt_start_date;
                  $trtmnt_duration=$value->trtmnt_duration;
             ?>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>application/assets/images/admdashboard/<?php echo $profilepic;?>" alt="User profile picture" style="width: 70px;" >

              <h3 class="profile-username text-center" style="text-align:center;"><?php echo $value->patient_name;?></h3>

              <p class="text-muted text-center" style="text-align:center;"><?php echo $value->patient_mobile_primary."<br>Age : ".$value->patient_age;?></p>
              

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item gpco">
                  <b>Group Cordinator</b> <a class="pull-right"><?php echo $value->coordinator_name;?></a>
                </li>
                <li class="list-group-item">
                  <b>NFHP</b> <a class="pull-right"><?php echo $value->nqpp_name;?></a>
                </li>
                 <li class="list-group-item">
                  <b>Reg. Date</b> <a class="pull-right"><?php echo ($value->patient_reg_date == NULL ? "" : date("d-m-Y", strtotime($value->patient_reg_date)));?></a>


                </li>
               
              </ul>

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Patient</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Address</strong>

              <p class="text-muted">
               <?php echo $value->patient_full_address; ?>
              </p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Guardian</b> <a class="pull-right"><?php echo $value->patient_gurdian;?></a>
                </li>
                <li class="list-group-item vill">
                  <b>Village</b> <a class="pull-right"><?php echo $value->patient_village;?></a>
                </li>
                <li class="list-group-item">
                  <b>Postoffice</b> <a class="pull-right"><?php echo $value->patient_postoffice;?></a>
                </li>
                <li class="list-group-item">
                  <b>Pin</b> <a class="pull-right"><?php echo $value->patient_pin;?></a>
                </li>
                <li class="list-group-item">
                  <b>Block</b> <a class="pull-right"><?php echo $value->blockname;?></a>
                </li>
                <li class="list-group-item">
                  <b>District</b> <a class="pull-right"><?php echo $value->districtname;?></a>
                </li>
                <li class="list-group-item">
                  <b>State</b> <a class="pull-right"><?php echo $value->statename;?></a>
                </li>
                 <li class="list-group-item">
                  <b>Country</b> <a class="pull-right"><?php echo $value->countryname;?></a>
                </li>
                <li class="list-group-item">
                  <b>Ration</b> <a class="pull-right"><?php echo $value->patient_ration;?></a>
                </li>
                <li class="list-group-item">
                  <b>Voter</b> <a class="pull-right"><?php echo $value->patient_voter;?></a>
                </li>
                 <li class="list-group-item">
                  <b>Aadhaar</b> <a class="pull-right"><?php echo $value->patient_adhar;?></a>
                </li> 
                
                
               
              </ul>

            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-7 col-md-offset-1">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#timeline" data-toggle="tab">Patient Observation</a></li>
             
            </ul>
            <div class="tab-content">
             

             


              <!-- /.tab-pane -->
              <div  id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          &nbsp;&nbsp;&nbsp;DMC&nbsp;&nbsp;&nbsp;
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-flask bg-blue"></i>

                    <div class="timeline-item">
                     

                      <h3 class="timeline-header"><a href="#">Sputum Collection</a> </h3>

                      <div class="timeline-body">
                     
                    <div class="container testbox" >
                      <div class="row">
                        <div class="col-sm-3">Sputum Collection :<?php echo ($value->dmc_sputum_date == NULL ? "" : date("d-m-Y", strtotime($value->dmc_sputum_test_date)));?></div>
                        <div class="col-sm-4">DMC :<?php echo $value->dmcname;?></div>
                        
                      </div>
                       <div class="row">
                        <div class="col-sm-3">Sputum Test Date  :<?php echo ($value->dmc_sputum_test_date == NULL ? "" : date("d-m-Y", strtotime($value->dmc_sputum_date)));?></div>
                        <div class="col-sm-2  " style="font-size: 12px;">
                          <div class="box box-primary contact" style="">
                 <div class="box-body box-profile" style="padding:8px;">
                           <strong><i class="fa fa-phone margin-r-5"></i>Contact</strong>
                    
                       <p class="text-muted">
                        <?php echo $value->dmclt_name."<br>".$value->dmcmobile_no;?>
                       </p>
                     </div></div>
                        </div>
                        
                      </div>
                      </div>

                    
                     
  
                   

                      </div>
                     
                    </div>
                  </li>
                   <li>
                    <i class="fa fa-address-card bg-blue"></i>

                    <div class="timeline-item">
                     

                      <h3 class="timeline-header"><a href="#">Sputum Result</a> </h3>

                      <div class="timeline-body">
                       

                       <?php if($value->dmc_result_done=='Y'){

                          if ($value->dmc_spt_is_positive=='Y') {  ?>
                  <h5 style="color: #21a592; font-weight: bold">Result : <button class="label label-danger" style="font-size: 5px;border-radius: 50% !important;border: 0;height: 20px;width: 20px;"><b style="font-size:20px;">+</b> </button> &nbsp;Positive</h5> 
                      <?php }else if($value->dmc_spt_is_positive=='N'){?>
                       <h4 style="color: #21a592;">Result : 
                        <button class="label label-success" style="border-radius: 50% !important;border: 0;padding: 0;height: 20px;width: 20px;"><b style="font-size:20px;">-</b> </button> &nbsp;Negative</h4>
                      <p></p>
                      <?php }
                    }?>
                      </div>
                     
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->






                    <li class="time-label">
                        <span class="bg-yellow">
                          &nbsp;&nbsp;&nbsp;X-RAY&nbsp;&nbsp;&nbsp;
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-hospital-o bg-blue"></i>

                    <div class="timeline-item">
                     

                      <h3 class="timeline-header"><a href="#">X-RAY </a> </h3>

                      <div class="timeline-body">
                       
                  


                    <div class="container testbox" >
                      <div class="row">
                        <div class="col-sm-3">X-Ray Date :<?php echo ($value->xray_date == NULL ? "" : date("d-m-Y", strtotime($value->xray_date)));?></div>
                        <div class="col-sm-4">Center :<?php echo $value->xraycntname;?></div>
                        
                      </div>
                       <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-2" style="font-size: 12px;">
                       <!--    <div class="box box-primary contact" style="">
                                        <div class="box-body box-profile" style="padding:8px;">
                        <strong><i class="fa fa-phone margin-r-5"></i>Contact</strong>
                                           
                                              <p class="text-muted">
                                               <?php echo $value->xraylt_name."<br>".$value->xraymobile_no;?>
                                              </p>
                                            </div>
                                          </div> -->
                        </div>
                        
                      </div>
                      </div>


                      </div>


                     
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                 <li>
                    <i class="fa fa-address-card bg-blue"></i>

                    <div class="timeline-item">
                     

                      <h3 class="timeline-header"><a href="#">X-RAY Result</a> </h3>

                      <div class="timeline-body">
                       <?php if($value->xray_result_done=='Y'){
                        if($value->xray_is_postive=='Y'){?>
                      <h5 style="color: #21a592;">Result :  Suggestive</h5> 
                      <?php }else if($value->xray_is_postive=='N'){?>
                       <h5 style="color: #21a592;">Result : Non Suggestive</h5>

                      <p></p>
                      <?php }
                    }?>
                      </div>
                     
                    </div>
                  </li>
                  



               
                  <li class="time-label">
                        <span class="bg-purple">
                          CBNAAT
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-h-square bg-blue"></i>

                    <div class="timeline-item">
                       
                     

                      <h3 class="timeline-header"><a href="#">CBNAAT </a> </h3>

                      <div class="timeline-body">
                       
                    <div class="container testbox" >
                      <div class="row">
                        <div class="col-sm-3">CBNAAT Date :<?php echo ($value->cbnaat_date == NULL ? "" : date("d-m-Y", strtotime($value->cbnaat_date)));?></div>
                        <div class="col-sm-4">Center :<?php echo $value->cbnaatname;?></div>
                        
                      </div>
                       <div class="row">
                        <div class="col-sm-3">CBNAAT Test Date :<?php echo ($value->cbnaat_test_date == NULL ? "" : date("d-m-Y", strtotime($value->cbnaat_test_date)));?></div>
                        <div class="col-sm-2" style="font-size: 12px;">
                          <!-- <div class="box box-primary contact" style="">
                                           <div class="box-body box-profile" style="padding:8px;">
                           <strong><i class="fa fa-phone margin-r-5"></i>Contact</strong>
                                              
                                                 <p class="text-muted">
                                                  <?php echo $value->cbnaatlt_name."<br>".$value->cbnaatmobile_no;?>
                                                 </p>
                                               </div></div> -->
                        </div>
                        
                      </div>
                      </div>




                      </div>
                     
                   



                    </div>
                  </li>
                
                  <li>
                    <i class="fa fa-address-card bg-blue"></i>

                    <div class="timeline-item">
                     

                      <h3 class="timeline-header"><a href="#">CBNAAT Result</a> </h3>

                      <div class="timeline-body">
                       <?php if($value->cbnaat_result_done=='Y'){
                        if($value->cbnaat_pstv=='Y'){?>
                      <h5 style="color: #21a592;">Result : <button class="label label-danger" style="font-size: 5px;border-radius: 50% !important;border: 0;height: 20px;width: 20px;"><b style="font-size:20px;">+</b> </button> &nbsp;Detected
                        <br> 
 <!-- Changed-on : 10/12/18 , Changed-by : Sandipan Sarkar -->
                         <?php 
                         if ($value->cbnaat_rslt=='Y') {
                           echo "RIF : ".$value->rif_value; 
                         }
                         
                         ?>
                      </h5>
                      <?php }else if($value->cbnaat_pstv=='N'){?>
                       <h5 style="color: #21a592;">Result : <button class="label label-success" style="font-size: 10px;border-radius: 50% !important;border: 0;padding: 0;height: 20px;width: 20px;"><b style="font-size:20px;">-</b> </button> &nbsp;Not Detected</h5>
                        
                         <p></p>
                      <?php }
                    }?>
                      </div>
                     
                    </div>
                  </li>
 <!-- Changed-on : 10/12/18 , Changed-by : Sandipan Sarkar -->

                <?php  if ($value->is_tb_diagnosed=='Y') { ?>
                       <li class="time-label">
                        <span class="bg-red">
                          TB Diagnosed
                        </span>
                      </li>
                   <?php }elseif ($value->is_tb_diagnosed=='N') { ?>
                          <li class="time-label">
                        <span class="bg-green">
                          Patient is Okay 
                        </span>
                  </li>
                   <?php } ?>

                    <?php
                    // if($value->cbnaat_pstv=='Y'){

                      // if ($value->is_ptb_trtmnt_done=='Y') {

                        ?>

                 <!--  <li class="time-label">
                        <span class="bg-red">
                          TREATMENT
                        </span>
                  </li> -->
                  <!-- /.timeline-label -->
                  <!-- timeline item -->


                  <?php 

                        // if (!empty($bodycontent['patientTreatmentInfo'])) {
                       
                       
                        // foreach ($bodycontent['patientTreatmentInfo'] as $value) {
                        
                        ?>
                   <!--  <li>
                    <i class="fa fa-medkit bg-blue"></i>
                    
                    <div class="timeline-item"> -->
                       


                     <!--  <h3 class="timeline-header"><a href="#"><?php //echo $value->category_name;?></a> </h3>

                      <div class="timeline-body">

                       <div class="container testbox" >
                      <div class="row">
                        <div class="col-sm-3">Start Date : <?php // echo ($trtmnt_start_date == NULL ? "" : date("d-m-Y", strtotime($trtmnt_start_date)));?></div>
                        <div class="col-sm-3">Duration :<?php //echo " ".$trtmnt_duration."  Days";?></div>
                      
                      </div>
                      <div class="row">
                        <div class="col-sm-3">First Follow Up: <?php //echo ($value->first_followup_dt == NULL ? "" : date("d-m-Y", strtotime($value->first_followup_dt)));?></div>
                        <div class="col-sm-3">Second Follow Up : <?php //echo ($value->second_followup_dt == NULL ? "" : date("d-m-Y", strtotime($value->second_followup_dt)));?></div>
                      
                      </div>
                      </div>
                    
                    </div>
                  </li> -->
              <?php 
            // }
                 //}

                // } //end of treatment start check


              // }
              // else if($value->cbnaat_pstv=='N') { 

              ?>
              <!-- <li class="time-label">
                        <span class="bg-green">
                          Patient is Okay 
                        </span>
                  </li> -->

            <?php
              // }

              ?>


<?php } //end of mail for loop?>


                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-rectangle-wide"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

            
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

   


  </section>