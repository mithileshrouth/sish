    <style type="text/css">
	.file {
		visibility: hidden;
		position: absolute;
	}

	</style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pathology Center ADD</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
	<div class="row">
      <div class="col-md-12">
	  
	<div id="pathologyCentreContainer">
		<div class="box box-primary formBlock">
            <div class="box-header with-border">
                <h3 class="box-title">Pathology Center </h3>
                <a href="<?php echo base_url();?>pathologycenter" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
            </div>
          
		<div class="">
			<div class="row form-group">
				<div class="col-xs-12">
					<ul class="nav nav-pills nav-justified thumbnail setup-panel" id="centerStepNav">
						<li id="navStep1" class="li-nav active" step="#step-1">
							<a>
								<!--<h4 class="list-group-item-heading"><i class="fa fa-star"></i> Step 1</h4> -->
								<p class="list-group-item-text"><i class="fa fa-star"></i> Primary Info</p>
							</a>
						</li>
						<li id="navStep2" class="li-nav disabled" step="#step-2">
							<a>
								  <!--<h4 class="list-group-item-heading"><i class="fa fa-map-marker"></i> Step 2</h4>-->
								<p class="list-group-item-text"><i class="fa fa-map-marker"></i> Locations & Directions</p>
							</a>
						</li>
						 <li id="navStep3" class="li-nav disabled" step="#step-3">
							<a>
								  <!--<h4 class="list-group-item-heading"><i class="fa fa-map-marker"></i> Step 2</h4>-->
								<p class="list-group-item-text"><i class="fa fa-clock-o"></i> Timing</p>
							</a>
						</li>
						<li id="navStep4" class="li-nav disabled" step="#step-4">
							<a>
								  <!--<h4 class="list-group-item-heading"><i class="fa fa-upload"></i> Step 3</h4>-->
								<p class="list-group-item-text"><i class="fa fa-upload"></i> Uploads</p>
							</a>
						</li>
					   
					</ul>
				</div>
			</div>
		</div>
    

    <form name="pathologycenterForm" id="pathologycenterForm" enctype="multipart/form-data" >
    <div class="" id="centerprimaryInfo">
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                  
                <div class="box-body">
                  

                  <div class="form-group">
					<input type="hidden" name="centerID" id="centerID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID;}else{echo "0";}?>" />
                    <input type="hidden" name="centerMode" id="centerMode" value="<?php echo $bodycontent['mode']; ?>" />
					
                    <label for="centername">Name</label>
                    <input type="text" class="form-control forminputs typeahead" id="centername" name="centername" placeholder="Enter Center Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->center_name;}?>" />
                  </div>

					<div class="form-group">
						<div class="row">
						  <div class="col-lg-6 col-md-6 col-sm-12">
							   <label for="centercontact">Contact No</label>
							   <input type="text" class="form-control forminputs numchk" id="centercontact" name="centercontact" placeholder="Enter Contact No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->contact_no;}?>" maxlength="10" />
						  </div>
						  <div class="col-lg-6 col-md-6 col-sm-12">
							  <label for="alternateno">Alternate No</label>
							  <input type="text" class="form-control forminputs numchk" id="alternateno" name="alternateno" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->alt_contact_no;}?>"  placeholder="Enter alternate no" />
						  </div>
						</div>
					</div>
					
				  <div class="form-group">
					<label for="centercontactperson">Contact Person</label>
                    <input type="text" class="form-control forminputs" id="centercontactperson" name="centercontactperson" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->contact_person;}?>"  />
				  </div>
					
				  <div class="form-group">
					<label for="centeremail">Email</label>
                    <input type="text" class="form-control forminputs" id="centeremail" name="centeremail" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->center_email;}?>" />
				  </div>
				
                  <div class="form-group">
                    <label for="centerdesc">Any Description</label>
                    <textarea class="form-control forminputs txtareastyle" id="centerdesc" name="centerdesc" ><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->description;}?></textarea>
                  </div>

                  <div class="form-group">
                    <button type="button" class="btn btn-danger addfacilitydtl"><i class="fa fa-plus"></i> Add Facility</button>
                  </div>

				<!-- facility tables -->
				<div id="facility_detail">
					<div class="table-responsive">
					
						<?php
							$facilitydetailCount = 0;
							if($bodycontent['mode']=="EDIT")
							{
								$facilitydetailCount = sizeof($bodycontent['PathologyCenterEditData']['centerFacilitiesData']);
							}

							// For Table style Purpose
							$style_facility_tbl_dtl = "";
							if($bodycontent['mode']=="EDIT" && $facilitydetailCount>0)
							{
								$style_facility_tbl_dtl = "display:block;width:100%;";
							}
							else
							{
								$style_facility_tbl_dtl = "display:none;width:100%;";
							}
						?>
					
						<table class="table table-striped table-bordered " style="<?php echo $style_facility_tbl_dtl; ?>">
							<thead>
								<tr>
									<th>Facility</th>
									<th style="text-align:right;" width="5%">Del</th>
								</tr>
							</thead>
							<tbody>
							<?php
								
								if($facilitydetailCount>0)
								{
									
									foreach ($bodycontent['PathologyCenterEditData']['centerFacilitiesData'] as $facility_dtl) 
									{
								?>
								<tr id="rowfacilityRow_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $facility_dtl->centerFacilityDtlID; ?>">
									<td>
										<select name="facilityTitle[]" id="facilityTitle_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $facility_dtl->centerFacilityDtlID; ?>" class="form-control forminputs facilityTitle" data-show-subtext="true" data-live-search="true">
											<option value="0">Select</option>
											<?php
												foreach ($bodycontent['facilityList'] as $key => $facility_list) { ?>
													<option value="<?php echo $facility_list->id; ?>" <?php if($facility_dtl->facilityID==$facility_list->id){echo "selected";}else{echo "";}?>><?php echo $facility_list->title; ?></option>
											<?php	}
											?>
										</select>
									</td>
									
									<td style="vertical-align: middle;">
										<a href="javascript:;" class="facilitydelRow" id="facilitydelRow_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $facility_dtl->centerFacilityDtlID; ?>" title="Delete">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
								
							<?php   }
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end facility tables -->
				  
				<input onclick="step1Next()" class="btn btn-md btn-info" value="Next" style="float: right;background: #0695ce;" readonly />
				
				 <p id="c_primarysteperr" class="form_error2" style="clear: both;margin-top: 7%;"></p>
                
                  
                </div>


                   

                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div><!-- end of centerprimaryInfo -->
	
	
    <!-- Timing,Locations and Direction  -->
    <div class="" id="locationDirection">
        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                   

                  <div class="box-body">

                  <div class="form-group">
                    <label for="centeraddress">Address</label>
                    <textarea class="form-control forminputs txtareastyle" id="centeraddress" name="centeraddress" placeholder="Enter address"><?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->center_full_add;}?></textarea>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <label for="centerpincode">Pincode</label>
                          <input type="text" class="form-control forminputs typeahead numchk" id="centerpincode" name="centerpincode" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->pincode;}?>" maxlength="6" />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <label for="centerdist">District</label>
                          <input type="text" class="form-control forminputs" id="centerdist" name="centerdist" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->districtName;}?>" readonly />
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                         <label for="centerstate">State</label>
                          <input type="text" class="form-control forminputs" id="centerstate" name="centerstate" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->stateName;}?>" readonly />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="centercountry">Country</label>
                        <input type="text" class="form-control forminputs" id="centercountry" name="centercountry" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->countryName;}?>" readonly />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nearestlandmark">Nearest Landmark</label>
                    <input type="text" class="form-control forminputs" id="nearestlandmark" name="nearestlandmark" placeholder="Enter Nearest Landmark" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->nearest_landmark;}?>" />
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <label for="centerlatitude">Latitude</label>
                          <input type="text" class="form-control forminputs" id="centerlatitude" name="centerlatitude" placeholder="Enter Latitude" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->latitude;}?>" onkeyup="return numericFilter(this);"/>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <label for="centerlongitude">Longitude</label>
                          <input type="text" class="form-control forminputs" id="centerlongitude" name="centerlongitude" placeholder="Enter Longitude" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['PathologyCenterEditData']['centerMasterData']->longitude;}?>" onkeyup="return numericFilter(this);" />
                      </div>
                    </div>
                  </div>
                 
                 
                 <input onclick="prevStep()" class="btn btn-md btn-info" value="Prev" style="float:left;background: #e7471b;border-color:#e7471b;" readonly />
                 <input onclick="step2Next()" class="btn btn-md btn-info" value="Next" style="float: right;background: #0695ce;" readonly />
				 
				 <p id="c_locationerr" class="form_error2" style="clear: both;margin-top: 10%;"></p>
                  
                </div> <!-- Second Box Body Closed -->
                

                    

                </div>
            </div>
        </div>
    </div> <!-- end of locationDirection-->
	
	
	
    <div class="" id="businessHours">
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <div class="box-body">
                      <table class="table table-bordered timingTable">
                          <tbody>
                          <tr>
                            <th width="20%">Days</th>
                            <th>Opening Hours</th>
                            <th>Closing Hours</th>
                            <th>Close</th>
                          </tr>
                          <?php
                            $days = 1;
							$i = 0;
                             foreach($bodycontent['weekList'] as $weeklist){
                              $str = 'closeDys_'.$days;
							  
							  if(isset($bodycontent['PathologyCenterEditData']['centerTimingData'][$i]->opening_time))
							  {
								 $opningHr = date("H:i A",strtotime($bodycontent['PathologyCenterEditData']['centerTimingData'][$i]->opening_time)); 
							  }
							  else
							  {
								 $opningHr = NULL;  
							  }
							  
							  if(isset($bodycontent['PathologyCenterEditData']['centerTimingData'][$i]->close_time))
							  {
								 $closingHr = date("H:i A",strtotime($bodycontent['PathologyCenterEditData']['centerTimingData'][$i]->close_time)); 
							  }
							  else
							  {
								 $closingHr = NULL;  
							  }
							 
							  
                              ?>
                                <tr>
                                  <td>
									<input type="hidden" name="centredays[]" value="<?php echo $weeklist->id; ?>" />
								  <?php echo $weeklist->short_name; ?>
								  </td>
                                  <td>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                      <input type="text" name="openingHours[]" id="opHours_<?php echo $days; ?>"  class="form-control forminputs timepickers opHours" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $opningHr;}?>"/>
                                       <span class="input-group-addon"  id="timeOpIcon_<?php echo $days; ?>"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="input-group bootstrap-timepicker timepicker">
                                      <input type="text" name="closingHours[]" id="closeHours_<?php echo $days; ?>" class="form-control forminputs timepickers closeHours" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $closingHr;}?>" />
                                      <span class="input-group-addon" id="timeCloseIcon_<?php echo $days; ?>"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                  </td>
                                  <td>
                                    <!--
                                     <div class="form-check">
                                        <label class="toggle">
                                            <input type="radio" name="closedays[]" class="closedaysrdio" id="closeDys_<?php echo $days; ?>"> <span class="label-text"></span>
                                        </label>
                                      </div>
                                    -->

                                    <div class="form-check">
                                      <label>
                                        <input type="checkbox" name="closedays[<?php echo $i; ?>]" class="closedaysrdio" id="closeDys_<?php echo $days; ?>" 
										<?php if($bodycontent['mode']=="EDIT"){if($bodycontent['PathologyCenterEditData']['centerTimingData'][$i]->is_close=="Y"){echo "checked";}else{echo "";}}?>
										/>
                                         <span class="label-text" ></span>
                                      </label>
                                    </div>


                                  </td>
                                </tr>
                                <?php 
                                $days++;
								$i++;
                              } ?>
                      
                         </tbody>
                        </table>

                    </div>
				    <input onclick="prevStep()" class="btn btn-md btn-info" value="Prev" style="float:left;background: #e7471b;border-color:#e7471b;" readonly />
                    <input onclick="step3Next()" class="btn btn-md btn-info" value="Next" style="float: right;background: #0695ce;" readonly />
                  

                </div>
            </div>
        </div>
    </div><!-- end of business hours -- Step 3 Close -->

    <div class="" id="uploadDocs">
        <div class="row setup-content" id="step-4">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    
                    
                    <div class="box-body">
                        <div class="uploadcenterdoc">
                          <p>
                            Upload Document's if any
                          </p>
                          <div class="pull-right">
                            <button type="button" class="btn btn-danger pull-right centeruploaddocs" style="margin-top: -34px;"><i class="fa fa-plus"></i> Add Documents</button>
                          </div>
                        </div>
						
						
						<!-- upload_centerdocs_detail tables -->
						<div id="upload_centerdocs_detail">
							<div class="table-responsive">
							
							<?php
							$docsdetailCount = 0;
							if($bodycontent['mode']=="EDIT")
							{
								$docsdetailCount = sizeof($bodycontent['PathologyCenterEditData']['centerUploadedDocsData']);
							}

							// For Table style Purpose
							$style_facility_tbl_dtl = "";
							if($bodycontent['mode']=="EDIT" && $docsdetailCount>0)
							{
								$style_docs_tbl_dtl = "display:block;width:100%;";
							}
							else
							{
								$style_docs_tbl_dtl = "display:none;width:100%;";
							}
							?>
							
								<table class="table table-striped table-bordered " style="<?php echo $style_docs_tbl_dtl;?>">
									<thead>
										<tr>
											<th style="width:25%;">Doc Type</th>
											<th>Browse</th>
											<th>Description</th>
											<th style="text-align:right;" width="5%">Del</th>
										</tr>
									</thead>
									<tbody>
									<?php
								
								if($docsdetailCount>0)
								{
									//print_r($bodycontent['PathologyCenterEditData']['centerUploadedDocsData']);
									foreach ($bodycontent['PathologyCenterEditData']['centerUploadedDocsData'] as  $documents_dtl) 
									{
								?>
								
								<tr id="rowcenterUploadDoc_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>">
									<td>
										<select name="centerUploaddocType[]" id="centerUploaddocType_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control forminputs centerUploaddocType">
											<option value="0">Select</option>
											<?php
												foreach ($bodycontent['documentTypeList'] as $key => $doctypelist) { ?>
													<option value="<?php echo $doctypelist->id; ?>" <?php if($documents_dtl->document_type_id==$doctypelist->id){echo "selected";}else{echo "";} ?>><?php echo $doctypelist->document_type; ?></option>
											<?php	}
											?>
										</select>
											<input type="hidden" name="centerUploadprvFilename[]" id="centerUploadprvFilename_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control forminputs centerUploadprvFilename" value="<?php if($bodycontent['mode']=="EDIT"){echo $documents_dtl->user_file_name;}?>" readonly >

											<input type="hidden" name="centerUploadrandomFileName[]" id="centerUploadrandomFileName_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control forminputs centerUploadrandomFileName" value="<?php if($bodycontent['mode']=="EDIT"){echo $documents_dtl->random_file_name;}?>" readonly >

											<input type="hidden" name="centerUploaddocDetailIDs[]" id="centerUploaddocDetailIDs_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control forminputs centerUploaddocDetailIDs" value="<?php if($bodycontent['mode']=="EDIT"){echo $documents_dtl->id;}?>" readonly >
									</td>
									<td>
										<input type="file" name="centerUploadfileName[]" class="file forminputs centerUploadfileName" id="centerUploadfileName_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>">
										<div class="input-group col-xs-12">
											 <!--  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span> -->
											<input type="text" name="centerUploaduserFileName[]" id="centerUploaduserFileName_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control input-xs userfilesname" readonly placeholder="Upload Document" value="<?php if($bodycontent['mode']=="EDIT"){echo $documents_dtl->user_file_name;}?>" />

												<input type="hidden" name="centerUploadisChangedFile[]" id="centerUploadisChangedFile_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" value="N" >
												<span class="input-group-btn">
												<button class="browse btn btn-primary input-xs" type="button" id="centerUploaduploadBtn_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>">
													<i class="fa fa-folder-open" aria-hidden="true"></i>
												</button>
												</span>
										</div>
									</td>
									<td>
										<textarea name="centerUploadfileDesc[]" id="centerUploadfileDesc_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" class="form-control forminputs centerUploadfileDesc"><?php if($bodycontent['mode']=="EDIT"){echo $documents_dtl->uploaded_file_desc;}?></textarea>
									</td>
									<td style="vertical-align: middle;">
										<a href="javascript:;" class="centerUploaddelDocType" id="centerUploaddelDocRow_<?php echo $bodycontent['PathologyCenterEditData']['centerMasterData']->centerID; ?>_<?php echo $documents_dtl->id; ?>" title="Delete">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
								
								<?php 
									}
								}
								?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- end upload_centerdocs_detail tables -->
						
                    </div>
					
					
					
					
					

                    <div class="btnDiv">
                      <input onclick="prevStep()" class="btn btn-md btn-info formBtn" value="Prev" style="background: #e7471b;border-color:#e7471b;" readonly>
                      <button type="submit" class="btn btn-primary formBtn" id="centersavebtn">Save</button>
                      <!--<button type="button" class="btn btn-danger formBtn" onclick="window.location.href='/diagnostic/district'">Go to List</button> -->
                   </div>
				   
					<div class="custom_loader" style="display:none;" id="centerloader">
						<div class="loader_spinner"></div>
						<p class="loading-text">Please wait ...</p>
					</div>

                </div>
            </div>
        </div>
		
	</div> <!-- end of uploadDocs Step 4 Close -->

   
	</div> <!-- end FormBlock-->
   </div><!-- end of pathologyCentreContainer-->
 </div>
</div>
</section>

	


