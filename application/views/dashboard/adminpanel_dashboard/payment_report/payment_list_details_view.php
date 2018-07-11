       <style type="text/css">
     .infohead{
      width:500px;width: 556px;color: #45b045;font-size: 16px;
     } 
.trnxdiv{
text-align:center;padding:10px;padding: 10px;margin-bottom: 50px;display:none;
}
    </style>  
        
        <div class="box-body" id="PatientList">
          <?php
          $attr = array("id"=>"PaymentSaveForm","name"=>"PaymentSaveForm");
              echo form_open('',$attr); ?>

         
         
          <div >
              <table class="table table-bordered table-striped table-responsive dataTables" id="PatientlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                  
                  <th style="text-align:left;width:20%;">Transaction No</th>
                  <th style="text-align:left;width:20%;">Patient Name</th>
                  <th style="text-align:left;width:20%;">Patient ID</th>
                  <th style="text-align:left;width:20%;">Mobile</th>
                  <th style="text-align:left;width:20%;">Village</th>
                  <th style="text-align:left;width:20%;">Amount</th>
                  
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d/m/Y');
        $amount="0";
//pre($paymentlistData);
      if(sizeof($paymentlistData)>0){
        $i=0;
        $sl=1;
        
        foreach ($paymentlistData as $payment_list) {
         
            foreach ($payment_list['paymentDetailsData'] as $paymentdetails) {
            
      ?>      
          <tr>
            <td><?php echo $sl; ?></td>

             <td align="left">
             <b style="color:#7d3c98;">Transaction ID : <?php echo $payment_list['paymentmstData']->transaction_id;?><b>&nbsp;&nbsp; <b style="color:#d35400;float: right;">Payment Date : <?php echo date('d-m-Y', strtotime($payment_list['paymentmstData']->payment_dt));?></b>
           


             <!--  <?php echo "Transaction ID : ".$payment_list['paymentmstData']->transaction_id."&nbsp;<br>Payment Date : ".date('d-m-Y', strtotime($payment_list['paymentmstData']->payment_dt));  ?> -->

            </td>
             <td align="left"><?php echo $paymentdetails->patient_name;?></td>
             <td align="left"><?php echo $paymentdetails->patient_uniq_id;?></td>
             <td align="left"><?php echo $paymentdetails->patient_mobile_primary;?></td>
             <td align="left"><?php echo $paymentdetails->patient_village;?></td>
             <td align="left"><?php echo $paymentdetails->amount;?></td>
          </tr>
       
          <?php 
            $i++;$sl++;
          }
            }

          }
          else{ ?>
            <tr>
                <td colspan="7">No Records Found</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
    </div>
<?php
       if(sizeof($paymentlistData)>0){
?>
<!--  <div class="container" style="margin-top:50px; ">

 

   <div class="form-group row" style="margin-top:20px;" id="paygenretedUpdate">
     <div class="btnDiv">
             <button type="submit" class="btn btn-primary formBtn" id="Print" style="display: inline-block;width:200px;">Save</button>
           </div>
   </div>

</div>  -->


 <?php 
}


 echo form_close(); ?>
    </div>


