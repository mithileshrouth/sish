<style type="text/css">

</style>
<!-- Search Container -->
<div class="mainBodycontainer" style="padding-bottom:3%">
  <div id="orderresponsePage">
  
    <div class="jumbotron text-xs-center">
      <h1 class="display-3">Thank You!</h1>
      <p class="response-tag">Your order has been received.You will receive an order confirmation email with details of your order. </p>
 
    </div>

    <div id="printblck">
      <a href="<?php echo base_url();?>checkout/invoicenvoicePrint/<?php echo $bodycontent['orderdetailData']['order_master']->uniq_order_id;?>" class="btn btn-default" id="order_print_slip" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
    Download</a>
    </div>

    <div id="orderprintscreen">
      <div id="companyinfo">

      <div class="">
        <div class="row">
            <div class="col-md-12">
              <h2 class="comptitle" style="text-align:center;font-size:1.1em;">ACKNOWLEDGEMENT SLIP</h2>
            </div>
        </div><!-- end of row-->

          <div class="row">
            <div class="col-md-6">
              <h2 class="comptitle">Testmatch.com</h2>
            </div>
            
          </div><!-- end of row-->
      </div>

      </div>
      
      <div id="billinginfo">
      <div class="">
          <div class="row">
            <div class="col-md-6">
              <h4 class="blsmldtxt">By</h4>
              <p><?php echo $bodycontent['orderdetailData']['order_master']->center_name;?></p>
              <p><?php echo $bodycontent['orderdetailData']['order_master']->center_full_add; ?></p>
              <p><?php echo $bodycontent['orderdetailData']['order_master']->pincode;?></p>
              <p><?php echo "Phone : ".$bodycontent['orderdetailData']['order_master']->contact_no;?></p>
              <p><?php echo "Email : ".$bodycontent['orderdetailData']['order_master']->center_email;?></p>
            </div> 
            <div class="col-md-6 directiortl">
              <h4 class="blsmldtxt">Billing Address</h4>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->customerName;?></p>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->fullAddress;?></p>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->cusCity.",".$bodycontent['orderdetailData']['delivery_info']->stateName.",".$bodycontent['orderdetailData']['delivery_info']->cusPincode.",".$bodycontent['orderdetailData']['delivery_info']->countryShortName ;?></p>
            </div>
          </div><!-- end of row-->
        </div>

         <div class="">
          <div class="row">
            <div class="col-md-6">
              <h4 class="blsmldtxt">Order Detail</h4>
              <table width="60%">
                <tr>
                  <td>Order Date </td>
                  <td><?php echo date("d/m/Y",strtotime($bodycontent['orderdetailData']['order_master']->orderd_on));?> </td>
                </tr>
                <tr>
                  <td>Order No. </td>
                  <td>
                    <?php echo $bodycontent['orderdetailData']['order_master']->uniq_order_id;?>
                    <input type="hidden" name="uoid" id="uoid" value="<?php echo $bodycontent['orderdetailData']['order_master']->uniq_order_id;?>" />
                  </td>
                </tr>
                <!--
                <tr>
                  <td>Payment Mode </td>
                  <td>Cash </td>
                </tr>-->
              </table>
            </div>
            <div class="col-md-6 directiortl">
              <h4 class="blsmldtxt">Shipping Address</h4>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->customerName;?></p>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->fullAddress;?></p>
              <p><?php echo $bodycontent['orderdetailData']['delivery_info']->cusCity.",".$bodycontent['orderdetailData']['delivery_info']->stateName.",".$bodycontent['orderdetailData']['delivery_info']->cusPincode.",".$bodycontent['orderdetailData']['delivery_info']->countryShortName ;?></p>
            </div>
          </div><!-- end of row-->
        </div>
      </div>
      <div id="ordermasterinfo"></div>
      <div id="orderiteminfo">
        <table class="table table-condensed" style="width:100%;border:1px solid #CCC;">
          <tr>
            <th>Sl.</th>
            <th>Description</th>
            <th style="text-align:center; ">Test Dt</th>
            <th style="text-align:center; ">Rep Dt.</th>
            <th style="text-align:right; ">Total</th>
           
          </tr>

          <?php 
            if(sizeof($bodycontent['orderdetailData']['order_detail_data'])>0){
              $srl=1;
              
              foreach($bodycontent['orderdetailData']['order_detail_data'] as $test_detaisl){ ?>
                 <tr>
                  <td><?php echo $srl; ?></td>
                  <td><?php echo $test_detaisl['order_detail_row']->investigationName; ?></td>
                  <td align="center"><?php echo date("d/m/Y",strtotime($test_detaisl['testdate'])); ?></td>
                  <td align="center"><?php echo $test_detaisl['deliveryDate']; ?></td>
                  <td align="right"><?php echo $test_detaisl['order_detail_row']->test_amount; ?></td>
                </tr>
          <?php
              $srl++;
              }
            }
          ?>

         
          <tr>
            <td colspan="4">Total</td>
            <td align="right"><?php echo $bodycontent['orderdetailData']['order_master']->order_total_amt;?></td>
          </tr>
        </table>

       
      </div>

      <div id="authorization">
        <div class="row">
          <div class="col-md-6 col-offset-6"></div>
          <div class="col-md-6 directiortl">
            <h4 class="blsmldtxt">For Testmatch</h4>
            <br>
            <h4 class="blsmldtxt">Authorized Signatory</h4>
          </div>
        </div>
      </div>



    </div>

  </div><!--searchContainer-->
</div>



