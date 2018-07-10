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

          <div class="trnxdiv" id="txndiv">
            <span class="label label-success" style="font-size: 20px;" >Transaction No :
             <b id="txnval"></b>
            
            </span>

          </div>
         
          <div style="max-height:500px;overflow-y:scroll;">
              <table class="table table-bordered table-striped table-responsive" id="PatientlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                    <th style="text-align:left;width:30%;">NFHP</th>
                    <th style="text-align:left;width:5%;">Generation Date</th>
                    <th style="text-align:left;width:5%;">Transaction</th>
                    <th style="text-align:right;width:10%;">Amount</th>
                    <th style="text-align:center;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d/m/Y');
        $amount="0";
      

      if(sizeof($transactionlistData)>0){
        $i=0;
        $sl=1;
        
        foreach ($transactionlistData as $tran_list) {
         
        
      ?>      
          <tr>
            <td><?php echo $sl; ?></td>

            <input type="hidden" id="paygen_<?php echo $i;?>" name="paygen[]" value="<?php echo $tran_list->id;?>">
            <input type="hidden" name="nqpp" value="<?php echo $tran_list->nqpp_id;?>">
            <input type="hidden" id="amt_<?php echo $i;?>" name="amt[]" value="<?php echo $tran_list->payable_amt;?>">
             <input type="hidden" id="txn_<?php echo $i;?>" name="txn[]" value="<?php echo $tran_list->transaction_id;?>">
             <td align="left"><?php echo $tran_list->nqppname;  ?></td>
             <td align="left"><?php echo date('d-m-Y', strtotime($tran_list->generation_dt));;  ?></td>
             <td align="left"><?php echo $tran_list->transaction_id;  ?></td>
          
             <td align="right"><?php echo $tran_list->payable_amt;  ?></td>
             <td align="center"><input type="checkbox" class="selPayCheckbox" id="check_<?php echo $i;?>"  name="chkpay[]" style="position: inherit;" checked value="<?php echo $i;?>"></td>
            
          </tr>

          <?php 
            $i++;$sl++;
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
       if(sizeof($transactionlistData)>0){
?>
 <div class="container" style="margin-top:50px; ">
  <div class="form-group row">

    <label for="date" class=" col-sm-2 col-form-label">Payment Date</label>
      <div class="col-sm-2 col-xs-12">
              <input type="text" id="datepicker" class="form-control custom_frm_input"  name="payment_date"  placeholder="" value="<?php echo $curr_dt;?>" />
        </div>

         <label for="amount" class="col-sm-offset-3 col-sm-2 col-form-label">Total Amount</label>
      <div class="col-sm-2 col-xs-12">
              <input type="text" class="form-control custom_frm_input" id="totalamount" name="totalamount"  placeholder="" readonly />
     </div>

    </div>
    <div class="form-group row">
       <label for="date" class="col-sm-2 col-form-label">Remarks</label>
      <div class="col-sm-2 col-xs-12">
        <textarea class="form-control custom_frm_input" id="remarks" name="remarks"></textarea>
              
        </div>

    </div>

     <p id="paygenchk_manual_err_msg" class="form_error" style="width: 360px;"></p>
  

    <div class="form-group row" style="margin-top:20px;" id="paygenretedUpdate">
      <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="savePayment" style="display: inline-block;width:200px;">Save</button>
            </div>
    </div>

</div> 


 <?php 
}


 echo form_close(); ?>
    </div>


