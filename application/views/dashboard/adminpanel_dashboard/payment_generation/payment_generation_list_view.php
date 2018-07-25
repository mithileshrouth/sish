  <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/payment_generation.js"></script>


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



  </style>   
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> List of Payment Generation(s)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">List of Payment Generation(s)</h3>
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
 <!-- ********************************************************************************** -->  

 <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" class="firsttab" data-toggle="tab" aria-expanded="true">New</a></li>
              <li class=""><a href="#tab_2" class="secondtab" data-toggle="tab" aria-expanded="false">Existing</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                      <?php /*New list*/
              $attr = array("id"=>"PaymentListFilterForm","name"=>"PaymentListFilterForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                     <label for="coordinatorList">Group Coordinator</label> 
                        <select id="coordinator" name="coordinator" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['coordinatorList'])
                            {
                              foreach($bodycontent['coordinatorList'] as $coordinator_list)
                              { ?>
                                  <option value="<?php echo $coordinator_list->id; ?>"><?php echo $coordinator_list->name; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>
                       <div class="form-group">
                     <label for="nqppList">NQPP</label> 
                     <div id="nqppview">
                        <select id="sel_nqpp" name="sel_nqpp" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                      <option value="0">Select</option>
                         
                        </select>
                        </div>
                  </div>
                  <p id="paygen_manual_err_msg" class="form_error"></p>

            <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="paygenListView" style="display: inline-block;">View</button>
            </div>
                  
          </div>
               
              <?php echo form_close(); 
                /*End of New list*/

              ?>


              </div>
              <!-- /.tab-pane, end of tab 1 -->
              <div class="tab-pane" id="tab_2">
                    <?php /*Existing list*/
              $attr = array("id"=>"PaymentListExistForm","name"=>"PaymentListExistForm");
              echo form_open('',$attr); ?>
                <div class="box-body">

                  <div class="form-group">
                     <label for="coordinatorList">Group Coordinator</label> 
                        <select id="coordinatort2" name="coordinatort2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="0">Select</option>
                          <?php 
                            if($bodycontent['coordinatorList'])
                            {
                              foreach($bodycontent['coordinatorList'] as $coordinator_list)
                              { ?>
                                  <option value="<?php echo $coordinator_list->id; ?>"><?php echo $coordinator_list->name ; ?></option>
                            <?php 
                              }
                            }
                          ?>
                        </select>
                  </div>
                       <div class="form-group">
                     <label for="nqppList">NQPP</label> 
                     <div id="nqppviewt2">
                        <select id="sel_nqppt2" name="sel_nqppt2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                      <option value="0">Select</option>
                         
                        </select>
                        </div>
                  </div>
                      <div class="form-group">
                     <label for="nqppList">Transaction Details</label> 
                     <div id="txnview">
                        <select id="sel_txn" name="sel_txn" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                      <option value="0">Select</option>
                         
                        </select>
                        </div>
                  </div>
                  <p id="paygen_manual_err_msgt2" class="form_error"></p>

            <div class="btnDiv">
               <button type="submit" class="btn btn-primary formBtn" id="paygenListViewExisting" style="display: inline-block;">View</button> 
            </div>
                  
          </div>
               
              <?php echo form_close(); 
                /*End of Existing list*/

              ?>





              
              </div>
              <!-- /.tab-pane ,end of tab2 -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->





 <!-- ********************************************************************************** -->            

              


    
            








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

    <section id="loadPatientList">
         
    </section>




    <!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" style="margin-top: 165px;margin-left: 715px;">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body" style="padding: 30px;">
        <p id="save-msg-data" style="color: #1f9e1f;text-align: center;font-size: 18px;"></p>
      </div>
      <div class="modal-footer" style="padding:5px;">

   
    <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
  
      </div>
    </div>

  </div>
</div>


