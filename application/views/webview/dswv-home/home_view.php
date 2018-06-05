 <style>

 </style>
 <!-- Section: home Find Test And Slider-->
  <section id="home" class="divider">
   <div class="home_banner" style="background:url('<?php echo base_url();?>application/assets/images/web_images/bg/bg11.jpg')">
		
		<div class="baneer_text_effct">
			<h1>
			  <p class="typewrite" data-period="2000" data-type='[ "We Provide Medical Service", "Medical Excellence Everyday", "We Have Qualified Doctors" ]'>
				<span class="wrap"></span>
			  </p>
			</h1>
		</div>
		


		
		
		<div id="home_form_container">
			<form id="searchInvestigation" name="searchInvestigation" action="<?php echo base_url();?>searchquery" novalidate>
				<div class="row">
					<div class="col-md-3" >
						<div class="col-3">
							 <input class="form-control effect-8 txt_input_shdw srch_pincode" type="text" placeholder="&#xf041; Enter your pincode" autocomplete="off" id="srch_pincode" name="srch_pincode" style="font-family:Arial, FontAwesome" />
							 <span class="focus-border"><i></i></span>
						</div>
						
					</div>
					<div class="col-md-7">
						<div class="col-3">
							

							<div id="drpdwn_investigation">
  							<select  class="form-control effect-8 selectpicker txt_input_shdw sel_investigation" data-show-subtext="true" data-live-search="true" id="sel_investigation" name="sel_investigation" data-dropup-auto="false"  title="Select Test Name" >

                  <?php 
                    if(sizeof($bodycontent['allTestList'])>0)
                    {
                        foreach ($bodycontent['allTestList'] as $testList) 
                          { ?>
                          <option value="<?php echo $testList->code ?>"><?php echo $testList->investigationName; ?></option> 
                          
                      <?php     
                        }
                    }
                  ?>

  							</select>
                 <span class="focus-border"><i></i></span>
							</div>
						  <!--  <i class="fa fa-plus-square add_btn_test" style="float: right;"></i> -->
						
						</div>
					</div>
          
          <div class="col-md-1">
            <div class="form-group">
            <i class="fa fa-plus-square add_btn_test" id="add_investigation"></i>
            </div>
          </div>
					<div class="col-md-1 srch_btn_col">
						<div class="form-group">
						     <!--  <i type="submit" class="fa fa-search search_btn font-32 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none "></i> -->
                 <button class="btn btn-primary search_btn_hm" type="submit" >Search <span class="glyphicon glyphicon-search"></span></button>
						</div>
					</div>
				</div>
				
				
				<div class="investigatin_prev_data">
          <ul id="selected_items_ul">
          </ul>
        </div>
				
			</form>


      

		</div>  
		
		
		
		
   </div>

  </section>



    <!-- Section: home-boxes -->
    <section>
      <div class="container pb-0">
        <div class="section-content">
          <div class="row equal-height-inner">
            <div class="col-sm-12 col-md-4 pr-0 pr-sm-15 sm-height-auto mt-sm-0" data-margin-top="-150px">
              <div class="sm-height-auto bg-theme-colored2-darker2">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0">Medical Hospital</h3>
                  <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas odit unde dolor inventore autem quod vero incidunt labore sunt reprehenderit consectetur inventore autem quod vero incidunt</p>
                  <a href="#" class="btn btn-flat btn-theme-colored">Read more</a>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0" data-margin-top="-150px">
              <div class="sm-height-auto bg-theme-colored2">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0 mb-0">Opening Hours</h3>
                  <div class="opening-hours">
                    <ul class="list-unstyled text-white">
                      <li class="clearfix"> <span>Monday</span>
                        <div class="value"> 8:00am - 7:00pm </div>
                      </li>
                      <li class="clearfix"> <span>Sunday</span>
                        <div class="value"> Close </div>
                      </li>
                      <li class="clearfix"> <span>Tues - Thur</span>
                        <div class="value">8:00am - 4:30pm</div>
                      </li>
                      <li class="clearfix"> <span>Friday</span>
                        <div class="value">8:00am - 3:00pm</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 pl-0 pl-sm-15 sm-height-auto mt-sm-0" data-margin-top="-150px">
              <div class="sm-height-auto bg-theme-colored2-darker2">
                <div class="p-30">
                  <h3 class="text-uppercase text-white mt-0">Emergency Case</h3>
                  <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas odit unde dolor inventore autem quodvero ipsum</p>
                  <h3 class="text-white">+(012) 345 6789</h3>
                  <a href="#" class="btn btn-flat btn-theme-colored">Read more</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: about 
    <section id="about">
      <div class="container pb-0">
        <div class="row">
          <div class="col-md-8 wow fadeInLeft animation-delay1">
            <h2 class="mt-0">In Search Of A Good And <span class="text-theme-colored2">Quality Medical</span> Hospital ?</h2>
            <h3 class="mt-0">World Famous Heart Transplant Hospital In World</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque commodi molestiae autem fugit consectetur dolor ullam illo ipsa numquam, quod iusto enim ipsum amet iusto amet consec utem fugit consllo ipsa numquam dolor ullam illo, quod iusto enim ipsum amet iusto amet consec.</p>
            <div class="row mt-20 mb-sm-30">
              <div class="col-sm-6">
                <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                  <div>
                    <h4 class="mt-0 mb-0">Emergency Care</h4>
                    <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                  <div>
                    <h4 class="mt-0 mb-0">Operation Theater</h4>
                    <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                  <div>
                    <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                    <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                  <div>
                    <h4 class="mt-0 mb-0">Cancer Service</h4>
                    <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 wow fadeInRight animation-delay4">
            <img src="<?php echo base_url();?>application/assets/images/web_images/about/dc2.png" alt="">
          </div>
        </div>
      </div>
    </section>
	-->

    <!-- Section: Services -->
    <section id="services" class="bg-silver-light">
      <div class="container pb-40">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="text-uppercase mt-0 line-height-1">Our <span class="text-theme-colored2">Services</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="<?php echo base_url();?>application/assets/images/web_images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="fa fa-user-md font-weight-600 text-theme-colored2 font-38"></i>
                <h3 class="mt-20">Qualified Doctors</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="fa fa-medkit font-weight-600 text-theme-colored font-38"></i>
                <h3 class="mt-20">Advanced Technology</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="flaticon-medical-hospital36 font-weight-600 text-theme-colored2 font-38"></i>
                <h3 class="mt-20">Emergency Care</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="flaticon-medical-hospital15 font-weight-600 text-theme-colored font-38"></i>
                <h3 class="mt-20">Daily Cheakups</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="flaticon-medical-hospital16 font-weight-600 text-theme-colored2 font-38"></i>
                <h3 class="mt-20">Online Service</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="icon-box text-center bg-white bg-hover-theme-colored2 mb-30 p-30">
                <i class="flaticon-medical-hospital37 font-weight-600 text-theme-colored font-38"></i>
                <h3 class="mt-20">General Medical</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quasiqui invent cumque nulla!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Funfact 
    <section class="divider parallax layer-overlay overlay-theme-colored2-9" data-bg-img="<?php echo base_url();?>application/assets/images/web_images/bg/bg5.jpg" data-parallax-ratio="0.7">
      <div class="container pt-60 pb-60">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-smile mt-5 text-white"></i>
              <h2 data-animation-duration="2000" data-value="1754" class="animate-number text-white font-42 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase font-weight-600">Happy Patients</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-rocket mt-5 text-white"></i>
              <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white font-42 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase font-weight-600">Our Services</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-add-user mt-5 text-white"></i>
              <h2 data-animation-duration="2000" data-value="248" class="animate-number text-white font-42 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase font-weight-600">Our Doctors</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-global mt-5 text-white"></i>
              <h2 data-animation-duration="2000" data-value="24" class="animate-number text-white font-42 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase font-weight-600">Service Points</h5>
            </div>
          </div>
        </div>
      </div>
    </section>
	-->

    <!-- Section: Departments 
    <section id="depertments" class="bg-silver-light">
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase">Clinic <span class="text-theme-colored2">Departments</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="<?php echo base_url();?>application/assets/images/web_images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-centent">
          <div class="row">
            <div class="col-md-12">
              <div class="horizontal-tab-centered">
                <div class="text-center">
                  <ul class="nav nav-pills mb-10">
                    <li class="active"> <a href="#tab11" class="" data-toggle="tab" aria-expanded="false"> Orthopaedics</a> </li>
                    <li class=""> <a href="#tab12" data-toggle="tab" aria-expanded="false"> Cardiology</a> </li>
                    <li class=""> <a href="#tab13" data-toggle="tab" aria-expanded="true"> Neurology</a> </li>
                    <li class=""> <a href="#tab14" data-toggle="tab" aria-expanded="false"> Dental</a> </li>
                    <li class=""> <a href="#tab15" data-toggle="tab" aria-expanded="false"> Haematology</a> </li>
                  </ul>
                </div>
                <div class="tab-content bg-white">
                  <div class="tab-pane fade in active" id="tab11">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="service-content ml-10 ml-sm-0">
                          <h2 class="">Orthopaedic</h2>
                          <p class="lead">One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid molestias.</p>
                          <p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.</p>
                          <div class="row mt-20 mb-sm-30">
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Emergency Care</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Operation Theater</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Cancer Service</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="thumb mt-20">
                          <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/services/1.jpg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab12">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="service-content ml-10 ml-sm-0">
                          <h2 class="">Cardiology</h2>
                          <p class="lead">One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid molestias.</p>
                          <p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.</p>
                          <div class="row mt-20 mb-sm-30">
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Emergency Care</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Operation Theater</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Cancer Service</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="thumb mt-20">
                          <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/services/2.jpg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab13">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="service-content ml-10 ml-sm-0">
                          <h2 class="">Neurology</h2>
                          <p class="lead">One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid molestias.</p>
                          <p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.</p>
                          <div class="row mt-20 mb-sm-30">
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Emergency Care</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Operation Theater</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Cancer Service</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="thumb mt-20">
                          <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/services/3.jpg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab14">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="service-content ml-10 ml-sm-0">
                          <h2 class="">Dental</h2>
                          <p class="lead">One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid molestias.</p>
                          <p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.</p>
                          <div class="row mt-20 mb-sm-30">
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Emergency Care</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Operation Theater</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Cancer Service</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="thumb mt-20">
                          <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/services/4.jpg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab15">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="service-content ml-10 ml-sm-0">
                          <h2 class="">Hemtology</h2>
                          <p class="lead">One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid molestias.</p>
                          <p>One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.</p>
                          <div class="row mt-20 mb-sm-30">
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-ambulance14"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Emergency Care</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-illness"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Operation Theater</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-stethoscope10"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Outdoor Checkup</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="service-icon-box"> <a href="#" class="icon pull-left mr-20"><i class="flaticon-medical-medical51"></i></a>
                                <div>
                                  <h4 class="mt-0 mb-0">Cancer Service</h4>
                                  <p class="">Lorem ipsum dolor sit amet consec tetur elit</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="thumb mt-20">
                          <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/services/5.jpg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </section>
	-->

    <!-- Section: Pricing
    <section id="pricing">
      <div class="container pb-30">
        <div class="section-title text-center mb-60">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase">Our <span class="text-theme-colored2">Pricing</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="<?php echo base_url();?>application/assets/images/web_images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content mt-20">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30 wow fadeInLeft animation-delay1">
              <div class="pricing-table style1 bg-white-light text-center">
                <div class="pricing-icon">
                  <i class="flaticon-medical-medical51"></i>
                </div>
                <div class="p-40 bg-white">
                  <h3 class="package-type mt-0 font-24 text-uppercase">Dental Care</h3>
                  <h1 class="price text-theme-colored mb-10 font-60">24<span class="font-24">%</span></h1>
                  <h4 class="discount">Discount</h4>
                  <p>Lorem ipsum dolor sit amet conse ctetur adipi sicing elit. Rem autem voluptatem obcaecati! </p>
                  <a class="btn btn-colored btn-theme-colored2 text-uppercase mt-30" href="#">Get Offer!</a>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30 wow fadeInUp animation-delay1">
              <div class="pricing-table style1 bg-white-light text-center">
                <div class="pricing-icon">
                  <i class="flaticon-medical-hospital35"></i>
                </div>
                <div class="p-40 bg-white">
                  <h3 class="package-type mt-0 font-24 text-uppercase">Blood Test</h3>
                  <h1 class="price text-theme-colored mb-10 font-60">15<span class="font-24">%</span></h1>
                  <h4 class="discount">Discount</h4>
                  <p>Lorem ipsum dolor sit amet conse ctetur adipi sicing elit. Rem autem voluptatem obcaecati! </p>
                  <a class="btn btn-colored btn-theme-colored2 text-uppercase mt-30" href="#">Get Offer!</a><br>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30 wow fadeInRight animation-delay1">
              <div class="pricing-table style1 bg-white-light text-center">
                <div class="pricing-icon">
                  <i class="flaticon-medical-stethoscope10"></i>
                </div>
                <div class="p-40 bg-white">
                  <h3 class="package-type mt-0 font-24 text-uppercase">Medical Checkup</h3>
                  <h1 class="price text-theme-colored mb-10 font-60">30<span class="font-24">%</span></h1>
                  <h4 class="discount">Discount</h4>
                  <p>Lorem ipsum dolor sit amet conse ctetur adipi sicing elit. Rem autem voluptatem obcaecati! </p>
                  <a class="btn btn-colored btn-theme-colored2 text-uppercase mt-30" href="#">Get Offer!</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	 -->
	 
    <!-- Section: Features 
    <section>
      <div class="container-fluid pt-0 pb-0">
        <div class="row equal-height">
          <div class="col-md-6 bg-theme-colored2 sm-height-auto">
            <div class="p-50 p-sm-0 p-sm-0 pt-sm-30 pb-sm-30">
              <h2 class="text-white">In Search Of A Good And Quality Medical Hospital supporting team aids in providing oral health services.</h2>
              <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque commodi molestiae autem fugit consectetur dolor ullam illo ipsa numquam, quod iusto enim ipsum amet iusto amet consec utem fugit consllo ipsa numquam dolor ullam illo, quod iusto enim ipsum amet iusto amet consec.</p>
              <a href="page-services-engine.html" class="btn btn-default btn-circled mt-10">view details</a>
            </div>
          </div>
          <div class="col-md-6 bg-img-cover sm-height-auto" data-bg-img="<?php echo base_url();?>application/assets/images/web_images/bg/bg29.jpg">
            <div class="p-50 p-sm-0 p-sm-0 pt-sm-30 pb-sm-30">
              <!-- Reservation Form Start--
              <form name="reservation_form" class="reservation-form" method="post" action="#"><h3 class="mt-0 line-bottom mb-30">Reservation <span class="text-theme-colored font-weight-600">Now!</span></h3>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group mb-30">
                      <input placeholder="Enter Name" type="text" id="reservation_name" name="reservation_name" required="" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-30">
                      <input placeholder="Email" type="text" id="reservation_email" name="reservation_email" class="form-control" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-30">
                      <input placeholder="Phone" type="text" name="reservation_phone" class="form-control" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-30">
                      <div class="styled-select">
                        <select name="car_select" class="form-control" required="">
                          <option value="">- Select Your Services -</option>
                          <option value="Orthopaedics">Orthopaedics</option>
                          <option value="Cardiology">Cardiology</option>
                          <option value="Neurology">Neurology</option>
                          <option value="Dental">Dental</option>
                          <option value="Haematology">Haematology</option>
                          <option value="Blood Test">Blood Test</option>
                          <option value="Emergency Care">Emergency Care</option>
                          <option value="Outdoor Checkup">Outdoor Checkup</option>
                          <option value="Cancer Service">Cancer Service</option>
                          <option value="Pharmacy">Pharmacy</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-30">
                      <input name="reservation_date" class="form-control required date-picker" type="text" placeholder="Reservation Date" aria-required="true">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group mb-0 mt-0">
                      <input name="form_botcheck" class="form-control" type="hidden" value="">
                      <button type="submit" class="btn btn-colored btn-theme-colored2 btn-lg btn-flat border-left-theme-color-2-4px" data-loading-text="Please wait...">Submit Now</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
	-->

    <!--start doctor Section
    <section id="team" class="bg-silver-light">
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase">Our <span class="text-theme-colored2">Speciliests</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="<?php echo base_url();?>application/assets/images/web_images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="row mtli-row-clearfix">
          <div class="col-md-12">
              <div class="owl-carousel-4col">
                <div class="item bg-white">
                  <div class="team-block maxwidth500 mb-sm-30">
                    <div class="team-upper-block">
                      <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/team/1.jpg" alt="">
                      <ul class="styled-icons icon-bordered icon-circled icon-theme-colored pt-5">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-lower-block text-center border-bottom-2px border-theme-colored2 mt-0 pt-0 p-20">
                      <h3><a href="#">Dr. Sakib Martin</a></h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                  </div>
                </div>
                <div class="item bg-white">
                  <div class="team-block maxwidth500 mb-sm-30">
                    <div class="team-upper-block">
                      <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/team/2.jpg" alt="">
                      <ul class="styled-icons icon-bordered icon-circled icon-theme-colored border-top-theme-colored-4px pt-5">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-lower-block text-center border-bottom-2px border-theme-colored2 mt-0 pt-0 p-20">
                      <h3><a href="#">Dr. Maria Martin</a></h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                  </div>
                </div>
                <div class="item bg-white">
                  <div class="team-block maxwidth500">
                    <div class="team-upper-block">
                      <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/team/3.jpg" alt="">
                      <ul class="styled-icons icon-bordered icon-circled icon-theme-colored border-top-theme-colored-4px pt-5">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-lower-block text-center border-bottom-2px border-theme-colored2 mt-0 pt-0 p-20">
                      <h3><a href="#">Dr. Sakib Martin</a></h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                  </div>
                </div>
                <div class="item bg-white">
                  <div class="team-block maxwidth500">
                    <div class="team-upper-block">
                      <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/team/4.jpg" alt="">
                      <ul class="styled-icons icon-bordered icon-circled icon-theme-colored border-top-theme-colored-4px pt-5">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                      </ul>
                    </div>
                    <div class="team-lower-block text-center border-bottom-2px border-theme-colored2 mt-0 pt-0 p-20">
                      <h3><a href="#">Dr. Maria Martin</a></h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
	-->
	
    <!--start gallary Section
    <section id="gallery">
      <div class="container">
        <div class="section-title text-center mt-0">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase">Our <span class="text-theme-colored2">Gallery</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Portfolio Filter --
              <div class="portfolio-filter text-center">
                <a href="#" class="active" data-filter="*">All</a>
                <a href="#branding" class="" data-filter=".branding">Branding</a>
                <a href="#design" class="" data-filter=".design">Design</a>
                <a href="#photography" class="" data-filter=".photography">Photography</a>
              </div>
              <!-- End Portfolio Filter --
              
              <!-- Portfolio Gallery Grid --
              <div class="gallery-isotope default-animation-effect grid-4 gutter-small clearfix" data-lightbox="gallery">
                <!-- Portfolio Item Start --
                <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/1.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/1.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item branding photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/2.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/3.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/3.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item branding">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/4.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/4.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item design photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/5.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/5.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/6.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/6.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item branding">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/7.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/7.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/8.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/8.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/9.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/1.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item branding photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/4.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/2.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/1.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/3.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
                <!-- Portfolio Item Start --
                <div class="gallery-item branding">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>application/assets/images/web_images/gallery/6.jpg" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="images/gallery/full/4.jpg" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Portfolio Item End --
              </div>
              <!-- End Portfolio Gallery Grid --
            </div>
          </div>
        </div>
      </div>
    </section>
	-->

    <!--start testimonial Section-->
    <section class="divider parallax layer-overlay overlay-theme-colored2-9" data-background-ratio="0.7" data-bg-img="<?php echo base_url();?>application/assets/images/web_images/bg/bg5.jpg">
      <div class="container">
        <div class="section-title text-center mt-0">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase text-white">Patients testimonial</h2>
              <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <div class="owl-carousel-3col" data-dots="true">
                <div class="item">
                  <div class="testimonial-wrapper text-center bg-white p-30">
                    <div class="thumb mb-30"><img class="img-circle img-thumbnail" alt="" src="<?php echo base_url();?>application/assets/images/web_images/testimonials/1.jpg"></div>
                    <div class="content">
                      <p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio</p>
                      <h4 class="author text-theme-colored2 mb-0">Demo</h4>
                      <h6 class="title mt-0 mb-15">Demo</h6>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial-wrapper text-center bg-white p-30">
                    <div class="thumb mb-30"><img class="img-circle img-thumbnail" alt="" src="<?php echo base_url();?>application/assets/images/web_images/testimonials/2.jpg"></div>
                    <div class="content">
                      <p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio</p>
                      <h4 class="author text-theme-colored2 mb-0">Demo</h4>
                      <h6 class="title mt-0 mb-15">Demo</h6>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial-wrapper text-center bg-white p-30">
                    <div class="thumb mb-30"><img class="img-circle img-thumbnail" alt="" src="<?php echo base_url();?>application/assets/images/web_images/testimonials/3.jpg"></div>
                    <div class="content">
                      <p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque est quasi, quas ipsam, expedita placeat facilis odio</p>
                      <h4 class="author text-theme-colored2 mb-0">Demo</h4>
                      <h6 class="title mt-0 mb-15">Demo</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
     
    <!--start blog Section
    <section id="blog" class="bg-lighter">
      <div class="container">
        <div class="section-title text-center mt-0">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1 text-uppercase">Lates <span class="text-theme-colored2">News</span></h2>
              <div class="title-icon">
                <img class="mb-10" src="<?php echo base_url();?>application/assets/images/web_images/title-icon.png" alt="">
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <article class="post clearfix maxwidth500 mb-sm-30">
                <div class="entry-header">
                  <div class="post-thumb">
                    <img src="<?php echo base_url();?>application/assets/images/web_images/blog/1.jpg" alt="" class="img-responsive img-fullwidth">
                  </div>                    
                  <div class="entry-date media-left text-center flip bg-theme-colored2 pt-5 pr-15 pb-5 pl-15">
                    <ul>
                      <li class="font-16 text-white font-weight-600">28</li>
                      <li class="font-12 text-white text-uppercase">Feb</li>
                    </ul>
                  </div>
                </div>
                <div class="entry-content bg-white p-30">
                  <h3 class="entry-title mt-0"><a href="#">Even light drinkers at risk of cancer</a></h3>
                  <p>Lorem ipsum dolor adipisicing amet, consectetur sit elit. Aspernatur incidihil quo officia.</p>
                  <div class="entry-meta pull-right flip mt-10">
                    <ul class="list-inline">
                      <li><i class="fa fa-thumbs-o-up text-theme-colored2 mr-5"></i> 13</li>
                      <li><i class="fa fa-comments-o text-theme-colored2 mr-5"></i> 43</li>
                    </ul>
                  </div>
                  <a class="btn btn-theme-colored2 mt-10 mb-0 pull-left flip" href="#">Read more <i class="fa fa-angle-double-right"></i></a>
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-md-4">
              <article class="post clearfix maxwidth500  mb-sm-30">
                <div class="entry-header">
                  <div class="post-thumb">
                    <img src="<?php echo base_url();?>application/assets/images/web_images/blog/3.jpg" alt="" class="img-responsive img-fullwidth">
                  </div>                    
                  <div class="entry-date media-left text-center flip bg-theme-colored2 pt-5 pr-15 pb-5 pl-15">
                    <ul>
                      <li class="font-16 text-white font-weight-600">27</li>
                      <li class="font-12 text-white text-uppercase">Feb</li>
                    </ul>
                  </div>
                </div>
                <div class="entry-content bg-white p-30">
                  <h3 class="entry-title mt-0"><a href="#">Six surprising health risks in your home</a></h3>
                  <p>Lorem ipsum dolor adipisicing amet, consectetur sit elit. Aspernatur incidihil quo officia.</p>
                  <div class="entry-meta pull-right flip mt-10">
                    <ul class="list-inline">
                      <li><i class="fa fa-thumbs-o-up text-theme-colored2 mr-5"></i> 13</li>
                      <li><i class="fa fa-comments-o text-theme-colored2 mr-5"></i> 43</li>
                    </ul>
                  </div>
                  <a class="btn btn-theme-colored2 mt-10 mb-0 pull-left flip" href="#">Read more <i class="fa fa-angle-double-right"></i></a>
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-md-4">
              <article class="post clearfix maxwidth500">
                <div class="entry-header">
                  <div class="post-thumb">
                    <img src="<?php echo base_url();?>application/assets/images/web_images/blog/2.jpg" alt="" class="img-responsive img-fullwidth">
                  </div>                    
                  <div class="entry-date media-left text-center flip bg-theme-colored2 pt-5 pr-15 pb-5 pl-15">
                    <ul>
                      <li class="font-16 text-white font-weight-600">26</li>
                      <li class="font-12 text-white text-uppercase">Feb</li>
                    </ul>
                  </div>
                </div>
                <div class="entry-content bg-white p-30">
                  <h3 class="entry-title mt-0"><a href="#">Financial worries may raise heart attack risk</a></h3>
                  <p>Lorem ipsum dolor adipisicing amet, consectetur sit elit. Aspernatur incidihil quo officia.</p>
                  <div class="entry-meta pull-right flip mt-10">
                    <ul class="list-inline">
                      <li><i class="fa fa-thumbs-o-up text-theme-colored2 mr-5"></i> 13</li>
                      <li><i class="fa fa-comments-o text-theme-colored2 mr-5"></i> 43</li>
                    </ul>
                  </div>
                  <a class="btn btn-theme-colored2 mt-10 mb-0 pull-left flip" href="#">Read more <i class="fa fa-angle-double-right"></i></a>
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>
	-->

    <!--start Clients Section
    <section class="clients bg-theme-colored2">
      <div class="container pt-10 pb-10">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Section: Clients --
              <div class="owl-carousel-6col transparent text-center owl-nav-top">
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w1.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w2.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w3.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w4.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w5.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w6.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w3.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w4.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w5.png" alt=""></a></div>
                <div class="item"> <a href="#"><img src="<?php echo base_url();?>application/assets/images/web_images/clients/w6.png" alt=""></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
-->