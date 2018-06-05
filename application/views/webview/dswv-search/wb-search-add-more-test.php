        <form id="searchInvestigation" name="searchInvestigation" action="<?php echo base_url();?>searchquery" novalidate>
          <input class="srch_pincode" type="hidden" name="srch_pincode"  value="<?php echo $pincode; ?>" />
                <div class="row">
                    <div class="col-md-12">
                        <div id="drpdwn_investigation" class="addmore_testfrmmodal">
                          <select  class="form-control  selectpicker txt_input_shdw sel_investigation" data-show-subtext="true" data-live-search="true" id="sel_investigation" name="sel_investigation" data-dropup-auto="false"  title="Select Test Name" >

                           <?php 
                                if(sizeof($allTestList)>0)
                                {
                                    foreach ($allTestList as $testList) 
                                      { ?>
                                      <option value="<?php echo $testList->code ?>"><?php echo $testList->investigationName; ?></option> 
                                      
                                  <?php     
                                    }
                                }
                              ?>

                          </select>
                       
                        </div>
                    </div>
                </div>

                <div class="investigatin_prev_data addmoretes_ul_blck">
                  <ul id="selected_items_ul">
                    
                     <?php 
                        if(sizeof($searchedTests['searchdtestnames'])>0)
                        {
                          foreach ($searchedTests['searchdtestnames'] as $value)
                          {
                            echo "<li><input type='hidden' name='name[]' value='".$value."' /> ".$value."<a href='javascript:;' data-mode='More' class='clear_selected_test'> <i class='fa fa-times' style='color:#FFF;''></i></a></li>";
                          } 
                        }
                        else
                        {
                           echo "<li>Nothing Found</li>";
                        }
                      ?>
                 </ul>
                </div>
      </form>
