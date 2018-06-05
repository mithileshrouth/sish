<link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/bootstrap-timepicker.min.css" />
<style>
  .bootstrap-timepicker-widget a.btn, .bootstrap-timepicker-widget input {
    border-radius: 5px;
    font-family: verdana;
    font-size: 11px;
    border: 1px solid #12664e;
    color: #115332;
}
.bootstrap-timepicker-widget table td a {
    border: 0px transparent solid;
    width: 100%;
    display: inline-block;
    margin: 0;
    padding: 0px 0;
    outline: 0;
    color: #06683b;
}
.separator {
    color: #0e8361;
    line-height: 1.2em;
    margin: 30px auto;
    overflow: hidden;
    text-align: center;
    width: 100%;
    font-weight: 600;
}
.bootstrap-timepicker-widget.dropdown-menu {
    padding: 4px;
    min-width:120px !important;
}

/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 14px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>

  <div class="loading" id="placeorder_loading" style="display:none;">Please Wait ... &#8230;</div>

  <div class="mainBodycontainer">
    <div class="mainInnerContainer" style="padding-bottom: 10%;">
        
        <div class="checkout_center_info">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-3"><?php echo $bodycontent['centerData']['centerMasterData']->center_name; ?></h1>
              <p class="lead">Address : <?php echo $bodycontent['centerData']['centerMasterData']->center_full_add; ?></p>
              <p class="lead">Contact : <?php echo $bodycontent['centerData']['centerMasterData']->contact_no; ?></p>
            </div>
          </div>
        </div>


        

    <form id="checkoutForm" name="checkoutForm" action="#">
      <div class="row checkoutdetailrow">
        <div class="col-lg-4 col-md-5  testlistleftContainer">
          
          <input type="hidden" name="hdncenterid" value="<?php echo $bodycontent['centerData']['centerMasterData']->centerID; ?>">
         
          <h3 class="chekout_testlist_head" >You have ordered for these test(s)</h3>
          <ul class="list-group checkout_testlists">

            <li class="list-group-item d-flex justify-content-between align-items-center">
              <table style="width:100%;">
                <tr>
                  <td width="30%"> Date of Test</td>
                  <td>
                    <input type="text" name="dateofTest" id="dateofTest" placeholder="" class="chkout_inp datemask" > 
                    <span id="dateoftesterr" style="font-weight: 700;color:red;display:none;">Enter Date of Test</span>
                  </td>
                </tr>
              </table>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center" >
              <table style="width:100%;">
                <tr>
                  <td width="30%"> Time of Test<br>(Optional)</td>
                  <td>
                      <input type="text" name="timeofTest" id="timeofTest" class="chkout_inp timepickers">
                  </td>
                </tr>
              </table>
            </li>
            
           
            
            <?php 
            $i=1;
            $index = 0;
            $total_amt = 0;
            foreach($bodycontent['getcheckoutTestsList'] as $checkout_lists)
            { 

              $disc_amt  = 0;
              $disc_amt = $checkout_lists['checkoutTestNames']->rate*$checkout_lists['discountRate']/100;
              $after_disc_amt = $checkout_lists['checkoutTestNames']->rate-$disc_amt;
            ?>

            
        

            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $i.". ".$checkout_lists['checkoutTestNames']->name; ?>
              <span id="deliverDt_<?php echo $index; ?>" class="delivery_date" ></span>
              <span class="badge badge-primary badge-pill">&#8377; <?php echo $after_disc_amt; ?></span>
              <input type="hidden" name="investigationtestIDS[]" value="<?php echo $checkout_lists['checkoutTestNames']->id; ?>" readonly />
              <input type="hidden" name="iCode[]" value="<?php echo $checkout_lists['checkoutTestNames']->code; ?>" readonly />
            </li>
          <?php 

            $total_amt+=$after_disc_amt;
            $i++;
            $index++;
            }  ?>

            <li class="list-group-item d-flex justify-content-between align-items-center" >
              <table style="width:100%;">
                <tr>
                  <td width="30%"> Delivery Mode</td>
                  <td>
                      
                      <div class="radio radio-info radio-inline">
                          <input type="radio" id="deliver_online" value="ONLINE" name="deliveryMode" checked>
                          <label for="deliver_online"> Online </label>
                      </div>
                      
                      <div class="radio radio-danger radio-inline">
                          <input type="radio" id="delivery_hardcopy" value="HARD COPY" name="deliveryMode">
                          <label for="delivery_hardcopy"> Hard Copy</label>
                      </div>
                  </td>
                </tr>
              </table>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div class="checkbox checkbox-success">
                  <input id="agreeTermsChk" type="checkbox" name="agreeTermsChk">
                  <label for="agreeTermsChk">I agree to the <a href="javascript:;" style="text-decoration:underline;">terms & conditions</a> </label>
              </div>

            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center subtotal_blck">Order Total
              <input type="hidden" name="orderd_total_amt" value="<?php echo $total_amt; ?>" />
              <span class="badge badge-primary badge-pill">&#8377; <?php echo $total_amt; ?></span>
            </li>
          </ul> 
        </div><!-- end of testlistleftContainer-->

        <div class="col-lg-8 col-md-7 userInfoContainer">
          
            <div class="chkout_user_information">
             
             <!-- MultiStep Form -->
              
                    <div class="">
                        <div id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active">Verify Phone</li>
                                <li>Patient  Info</li>
                                <li>Patient Address Info</li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <h2 class="fs-title">Verify Phone</h2>
                                <h3 class="fs-subtitle"></h3>
                                <div class="row">
                                    <div class="form-group col-xs-4 col-md-4">
                                        <label for="name" class="control-label">Name</label>
                                        <span id="errcus_name" style="display: none;">Enter Name</span>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-xs-4 col-md-4">
                                        <label for="master_phone" class="control-label">Phone</label>
                                        <span id="errcus_mphone" style="display: none;">Enter Phone</span>
                                        <input type="text" name="master_phone" class="form-control numchk" id="master_phone" placeholder="Phone" autocomplete="off" maxlength="10" />
                                    </div>
                                    <div class="form-group col-xs-4 col-md-4">
                                        <label for="self" class="control-label">&nbsp;</label><br>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="selfmode" value="SELF" name="testForMode" checked>
                                            <label for="self"> Self </label>
                                        </div>
                                        <label for="othermode" class="control-label">&nbsp;</label>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="othermode" value="OTHER" name="testForMode">
                                            <label for="othermode"> Other </label>
                                        </div>
                                    </div>
                                </div>

                              <div class="row">
                                <div class="form-group col-xs-4 col-md-4">
                                    <label for="otp" class="control-label">OTP</label>
                                    <input type="text" class="form-control" id="otp_verify" name="otp_verify" placeholder="Enter OTP" autocomplete="off" />
                                </div>
                               
                                <div class="form-group col-xs-4 col-md-8 ">
                                  <label for="name" class="control-label"></label><br>
                                    <button type="button" class="form-control btn btn-checkouts" style="width: 23%;display:none;" id="verifyphone">
                                      <i class="fa fa-cog" aria-hidden="true"></i> Verify
                                    </button>
                                </div>
                             </div>
                             <input type="button" data-stepverify="step1" name="next" class="next action-button form-control btn btn-checkouts" id="verifyphBlckBtn" value="Next" style="display: none;" />
                            </fieldset><!-- end of verify Phone -->

                            <fieldset>
                                <h2 class="fs-title">Patient Information</h2>
                                <h3 class="fs-subtitle"></h3>
                                
                                <div class="row">
                                  <div class="form-group col-xs-4 col-md-6">
                                      <label for="cusname" class="control-label">Name</label>
                                      <span id="errcustmr_name" style="display: none;">Enter Name</span>
                                      <input type="text" class="form-control" id="cusname" name="cusname" placeholder="" autocomplete="off" />
                                  </div>
                                  <div class="form-group col-xs-4 col-md-3">
                                      <label for="cusdob" class="control-label">DOB</label>
                                      <span id="errcustmr_dob" style="display: none;">Enter DOB</span>
                                      <input type="text" id="cusdob" name="cusdob" class="form-control datemask" autocomplete="off" />
                                  </div>
                                  <div class="col-xs-2 col-md-1"><span class="dob_or_age" >OR</span></div>
                                  
                                  <div class="form-group col-xs-4 col-md-2">
                                      <label for="cusage" class="control-label">Age</label>
                                      <input type="number" class="form-control numchk" id="cusage" name="cusage" placeholder="Age" style="padding: 10px;" autocomplete="off" maxlength="3" />
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="form-group col-xs-4 col-md-6">
                                      <label for="cusname" class="control-label">Phone No</label>
                                      <span id="errcustmr_pphone" style="display: none;">Enter Phone No</span>
                                      <input type="text" class="form-control numchk" id="patientphone" name="patientphone" placeholder="" autocomplete="off" maxlength="10" />
                                  </div>
                                  
                                  <div class="form-group col-xs-4 col-md-6">
                                      <label for="cusemail" class="control-label">Email</label>
                                      <span id="errcustmr_email" style="display: none;">Enter valid email</span>
                                      <input type="text" class="form-control" id="cusemail" name="cusemail" autocomplete="off" />
                                  </div>

                                </div>


                                <div class="row">
                                  
                                  <div class="form-group col-xs-4 col-md-6">
                                      <label for="cusgender_male" class="control-label">&nbsp;</label><br>
                                      <div class="radio radio-info radio-inline">
                                          <input type="radio" id="cusgender_male" value="M" name="cusgender" checked>
                                          <label for="cusgender_male"> Male </label>
                                      </div>
                                      <label for="name" class="control-label">&nbsp;</label>
                                      <div class="radio radio-danger radio-inline">
                                          <input type="radio" id="cusgender_female" value="F" name="cusgender">
                                          <label for="cusgender_female"> Female </label>
                                      </div>
                                  </div>

                                </div>
                       

                             
                              <input type="button" name="next" class="next action-button form-control btn btn-checkouts" value="Next" data-stepverify="step2"/> 
                              <input type="button" name="previous" class="previous action-button-previous form-control btn btn-checkouts" value="Previous" style="background: #0cb8b6;"/>

                            </fieldset>


                            <fieldset>
                                <h2 class="fs-title">Patient Address Information</h2>
                                <h3 class="fs-subtitle"></h3>
                                

                                <div class="row">
                                    <div class="form-group col-xs-4 col-md-12">
                                        <label for="full_address" class="control-label">Address</label>
                                        <span id="erraddr_fulladd" style="display: none;">Enter Address</span>
                                        <textarea name="full_address" id="full_address" class="form-control" style="height:70px;padding:4px;"></textarea>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <!--
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="address_info_name" class="control-label">Name</label>
                                        <span id="erraddr_cust" style="display: none;">Enter Name</span>
                                        <input type="text" class="form-control" id="address_info_name" name="address_info_name" placeholder="" autocomplete="off"/>
                                    </div>
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="address_info_phone" class="control-label">Phone</label>
                                        <span id="erraddr_phone" style="display: none;">Enter Phone</span>
                                        <input type="text" class="form-control numchk" id="address_info_phone" name="address_info_phone" placeholder="" autocomplete="off" maxlength="10"  />
                                    </div>
                                    -->
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="chkout_user_pin" class="control-label">Pincode</label>
                                         <span id="pinvalid_err" style="display:none;"></span>
                                        <input type="text" class="form-control pinsearch numchk" id="chkout_user_pin" name="chkout_user_pin" placeholder="" autocomplete="off" />

                                    </div>
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="address_locality" class="control-label">Locality</label>
                                        <input type="text" class="form-control" id="address_locality" name="address_locality" placeholder="" autocomplete="off" />
                                    </div>
                                    
                                </div>

                                

                                <div class="row">
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="address_city" class="control-label">City</label>
                                        <input type="text" class="form-control" id="address_city" name="address_city" placeholder="" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="chkout_user_state" class="control-label">State</label>
                                        <input type="text" class="form-control statesearch" id="chkout_user_state" name="chkout_user_state" placeholder="" autocomplete="off" readonly />
                                        
                                    </div>
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="address_landmark" class="control-label">Landmark (Optional)</label>
                                        <input type="text" class="form-control" id="address_landmark" name="address_landmark" placeholder="" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-xs-4 col-md-6">
                                        <label for="add_alternate_phone" class="control-label">Alternate Phone (Optional)</label>
                                        <input type="text" class="form-control" id="add_alternate_phone" name="add_alternate_phone" placeholder="" autocomplete="off" maxlength="10" />
                                    </div>
                                </div>
                               
                                <input type="submit" name="submit" class="submit action-button form-control btn btn-checkouts" id="placetestorder" value="Place Order" data-stepverify="step3"/>
                                <input type="button" name="previous" class="previous action-button-previous form-control btn btn-checkouts" value="Previous" style="background: #0cb8b6;"/>
                            </fieldset>
                        </div>
                       
                    </div>
             
              <!-- /.MultiStep Form -->




              <!-- end of Multi Form -->



              </div> <!-- user info-->
          </div><!-- end of userInfoContainer-->

      </div> <!-- end of row-->

    </form>

    </div><!-- end of mainInnerContainer -->
  </div><!-- end of mainBodycontainer -->



