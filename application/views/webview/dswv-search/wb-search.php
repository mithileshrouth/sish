<style type="text/css">

</style>
<!-- Search Container -->
<div class="mainBodycontainer" >
  <div id="searchContainer">
    <div class="searchLeftContainer">

      <div class="searchedTestContainer">
        <div class="serached_test_names">
          <p>You serached for</p>
          <form name="usearched_form" id="usearched_form">
            <input type="hidden" name="serched_pin" value="<?php echo $bodycontent['searched_pin']; ?>" />
          <ul class="searched-tests-list">
            <?php 
              if(sizeof($bodycontent['searched_for_names'])>0)
              {
                for($k=0;$k<sizeof($bodycontent['searched_for_names']);$k++)
                {
                  echo "<li><input type='hidden' name='searchdtestnames[]' id='searchdtestnames' value='".$bodycontent['searched_for_names'][$k]."'/>".$bodycontent['searched_for_names'][$k]."</li>";
                }
              }
              else
              {
                 echo "<li>Nothing Found</li>";
              }
            ?>
          </ul>
        </form>
        </div>
        <div class="add_remove_action_test">
             <button class="btn btn-default btn-add-remove btn-add" id="add_more_test"><i class="fa fa-plus"></i> Add / Remove Test</button>
             <!--<button class="btn btn-default btn-add-remove btn-remove" id="remove_tests"><i class="fa fa-times"></i> Remove Test</button>-->
        </div>
      </div>

      <div style="clear:both;"></div>

      <div class="sorting_divcontainer">
        <div class="pricerangeinfo">
          <p><?php echo count($bodycontent['centerFoundForTest']); ?> Center From  <span style="font-weight: 700;"> &#8377; 1600 -  &#8377; 2400</span></p>
        </div>
        <div class="sorting-tags">
            <ul>
              <li class="sorthighlight" data-sfrom="Nearest" id="sortnearest" data-sortorder="ASC"><i class="fa fa-sort" aria-hidden="true"></i> Nearest</li><li class="sorthighlight" data-sfrom="Price" id="sortprice" data-sortorder="ASC"><i class="fa fa-sort" aria-hidden="true"></i> Price</li><li class="sorthighlight" data-sfrom="Rate" id="sortrated" ><i class="fa fa-sort" aria-hidden="true"></i> Highest Rated</li>
            </ul>  
        </div>
        
      </div>

   <div style="clear:both;"></div>

    

    <div id="sortedresult">
      <?php 
      /*----------- Center Row Loop-----*/
        if(sizeof($bodycontent['centerFoundForTest'])>0)
        {
          $center_no=1;
          foreach($bodycontent['centerFoundForTest'] as $center_data) 
          {
          
         
       ?>
      <div class="row testlistSearch">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-4 center-gallery-container">
                  <!-- <img src="<?php echo base_url(); ?>application/assets/images/web_images/gallery/9.jpg" /> -->
                  <div class="carousel slide" class="myCarousel" id="centreSlider_<?php echo $center_no; ?>">
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <?php 
                          if(sizeof($center_data['centerUploadedDocsData'])>0)
                          {
                          $n1=0;
                          foreach($center_data['centerUploadedDocsData'] as $center_gallery)
                          { 
                            if($n1==0)
                            {
                              $active_cls = "active";
                            }
                            else
                            {
                              $active_cls = "";
                            }
                          ?>

                        <div class="item <?php echo $active_cls;?>" data-slide-number="<?php echo $n1;?>">
                            <a href="<?php echo base_url(); ?>application/assets/ds-documents/center_upload/<?php echo $center_gallery->random_file_name;?>" data-fancybox="centerGallery<?php echo $n1;?>">
                                <img src="<?php echo base_url(); ?>application/assets/ds-documents/center_upload/<?php echo $center_gallery->random_file_name;?>">
                            </a>
                        </div>

                        <?php
                          $n1++;
                          }
                        }else{
                        ?>
                          <div class="item active" data-slide-number="0">
                              <img src="<?php echo base_url(); ?>application/assets/ds-documents/center_upload/center-no-image.jpg" />
                          </div>
                        <?php } ?>
   
                      </div>
                      <!-- Carousel nav -->
                      <a class="left carousel-control" href="#centreSlider_<?php echo $center_no; ?>" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#centreSlider_<?php echo $center_no; ?>" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                  </div>
              </div>
              <div class="col-md-8 center-info-container">
                <div class="center_name">
                  <a href="" class="wb-center-name" ><?php echo $center_data['centerMasterData']->center_name ;?> </a>
                  <span class="center_distance">(<?php echo number_format((float)$center_data['centerdistance'], 2, '.', '') ;?> km away)</span>
                  <input type="hidden" name="center_distance_km" class="center_distance_km" value="<?php echo  $center_data['centerdistance']; ?>" />
                </div> 
                
                <p class="wb-center-loc"><?php echo $center_data['centerMasterData']->districtName." , ".$center_data['centerMasterData']->centerPincode ; ?></p>
                <p class="wb-center-rating">Rating 
                    <span class="fa fa-star checkedstar"></span>
                    <span class="fa fa-star checkedstar"></span>
                    <span class="fa fa-star checkedstar"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
                <div class="facility_container">
                  <i class="fa fa-credit-card" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Credit Card"></i>
                  <i class="fa fa-certificate" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Certificate"></i>
                  <i class="fa fa-ambulance" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ambulance"></i>
                  <i class="fa fa-hospital-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hospital"></i>
                  <i class="fa fa-user-md" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Doctor"></i>
                </div>
                <div class="center-timing-review">
                  <a href="javascript:;" class="timng centertiming" data-centerid=<?php echo $center_data['centerMasterData']->centerID; ?>><input type="hidden" name="" >Timing</a>
                  <a href="javascript:;" class="review">Review</a>
                </div>
              </div>
            </div>
          </div><!--end center area-->

         <div class="col-md-3 centertest-price-info">
            <?php if($center_data['testPriceInfo']['saved_percentg']>0){
                $extra_cls = "";
              ?>
           <h3 style="text-decoration:line-through;" class="actual-price">&#8377;<?php echo  $center_data['testPriceInfo']['total_actual_price']; ?></h3>
           <p class="you-save-txt">You Save <?php echo  $center_data['testPriceInfo']['saved_percentg']; ?>%</p>
           <?php }else{ $extra_cls = "nodisc_flprice";} ?>
           <h3 class="final-price <?php echo $extra_cls; ?>">&#8377;<?php echo  $center_data['testPriceInfo']['aftre_disc_price_total']; ?>
            <input type="hidden" name="finalprice_tst" class="finalprice_tst" value="<?php echo  $center_data['testPriceInfo']['aftre_disc_price_total']; ?>" />
           </h3>
          
        <form name="checkoutForms" method="get" action="checkout">
          <?php 
            $ids = "";
            foreach ($center_data['testInfoForCheckout'] as $checkout_tests) 
            {
                $ids.=$checkout_tests->id.",";
            }
            $ids = rtrim($ids,',')
          ?>
           <input type="hidden" name="test_ids" id="chekoutDataRow_<?php echo $center_no; ?>" value="<?php echo $ids; ?>" />
           <input type="hidden" name="test_center_id" id="test_center_id" value="<?php echo $center_data['centerMasterData']->centerID; ?>" />
           <button type="submit" class="btn checkout-btn checkout_tests" id="checkout_<?php echo $center_no; ?>" >Checkout</button>
        </form>

         </div><!-- end checkout area-->
      </div><!-- repeat Block-->


      <?php
        $center_no++;
         }

        }
        else{echo "No Result Found";}
      ?>
      </div>
     

    </div><!-- end of searchLeftContainer-->

    <div class="searchRightContainer">
      
      <div class="centerFilter">
          <p>Filter By Center</p>
          <div class="centerchk_container">
          <div class="checkbox checkbox-info">
              <input id="checkbox4" type="checkbox">
              <label for="checkbox4">Santosh Diagnostic and Scan Center - RT Nagar </label>
          </div>
           <div class="checkbox checkbox-danger center-fltr-list-row">
              <input id="checkbox5" type="checkbox">
              <label for="checkbox5">Asian Diagnostics  </label>
          </div>

           <div class="checkbox checkbox-success center-fltr-list-row">
              <input id="checkbox6" type="checkbox">
              <label for="checkbox6">Radocs Diagnostics and Imaging   </label>
          </div>

           <div class="checkbox checkbox-warning center-fltr-list-row">
              <input id="checkbox7" type="checkbox">
              <label for="checkbox7">Magnus Diagnostic Centre    </label>
          </div>
        </div>
      </div><!-- end of centerFilter-->

      <div class="centerFilter">
          <p>Filter By Center</p>
          <div class="centerchk_container">
          <div class="checkbox checkbox-info">
              <input id="checkbox4" type="checkbox">
              <label for="checkbox4">Santosh Diagnostic and Scan Center - RT Nagar </label>
          </div>
           <div class="checkbox checkbox-danger center-fltr-list-row">
              <input id="checkbox5" type="checkbox">
              <label for="checkbox5">Asian Diagnostics  </label>
          </div>

           <div class="checkbox checkbox-success center-fltr-list-row">
              <input id="checkbox6" type="checkbox">
              <label for="checkbox6">Radocs Diagnostics and Imaging   </label>
          </div>

           <div class="checkbox checkbox-warning center-fltr-list-row">
              <input id="checkbox7" type="checkbox">
              <label for="checkbox7">Magnus Diagnostic Centre    </label>
          </div>
        </div>
      </div><!-- end of centerFilter-->

      <div class="centerFilter">
          <p>Filter By Center</p>
          <div class="centerchk_container">
          <div class="checkbox checkbox-info">
              <input id="checkbox4" type="checkbox">
              <label for="checkbox4">Santosh Diagnostic and Scan Center - RT Nagar </label>
          </div>
           <div class="checkbox checkbox-danger center-fltr-list-row">
              <input id="checkbox5" type="checkbox">
              <label for="checkbox5">Asian Diagnostics  </label>
          </div>

           <div class="checkbox checkbox-success center-fltr-list-row">
              <input id="checkbox6" type="checkbox">
              <label for="checkbox6">Radocs Diagnostics and Imaging   </label>
          </div>

           <div class="checkbox checkbox-warning center-fltr-list-row">
              <input id="checkbox7" type="checkbox">
              <label for="checkbox7">Magnus Diagnostic Centre    </label>
          </div>
        </div>
      </div><!-- end of centerFilter-->

    </div><!-- end of searchRightContainer-->

  </div><!--searchContainer-->
</div>


<div style="clear:both;"></div>

<style type="text/css">
    .modal.in .modal-dialog 
    {
        -webkit-transform: translate(0, calc(50vh - 50%));
        -ms-transform: translate(0, 50vh) translate(0, -50%);
        -o-transform: translate(0, calc(50vh - 50%));
        transform: translate(0, 50vh) translate(0, -50%);
    }
</style>
<!-- Add More Test-->
<div class="modal fade addorremovetestmodal" id="addorremovetestmodal">
         <div class="modal-dialog" >
           <div class="modal-content">
              <div class="modal-header">
               <p id="add-remove-head" class="addremove_heading">Add More Test</p>
              </div>
             <div class="modal-body" >
                <div id="addorremoveContainer"></div>
             </div>
             <div class="modal-footer">
               
                <button type="submit" class="btn btn-success btn-flat" id="search_more_btn_sbm" style="background: #00a56b;border:0;font-size: 13px;"><i class="fa fa-search"></i> Search</button> 

                <a href="javascript:;" class="btn btn-success btn-flat" data-dismiss="modal" style="background: #ff6533;border:0;font-size: 13px;"><i class="fa fa-close"></i> Close</a>
                
             </div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<!-- end success modal-->


<!-- Add More Test-->
    <div class="modal fade wb_search_q_modal" id="wb_search_q_modal">
         <div class="modal-dialog" >
            <div class="modal-content">
              <div id="wb_search_q_modal_container"></div>
              <div class="modal-footer">
               <a href="javascript:;" class="btn btn-success btn-flat" data-dismiss="modal" style="background: #ff6533;border:0;font-size: 13px;"><i class="fa fa-close"></i> Close</a>
              </div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<!-- end success modal-->
