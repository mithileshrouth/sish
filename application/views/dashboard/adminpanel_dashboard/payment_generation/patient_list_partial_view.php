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
          $attr = array("id"=>"PaymentGenerateForm","name"=>"PaymentGenerateForm");
              echo form_open('',$attr); ?>

          <div class="trnxdiv" id="txndiv">
            <span class="label label-success" style="font-size: 20px;" >Transaction No :
             <b id="txnval"></b>
            <input type="hidden" name="txnno" id="txnno">
            </span>

          </div>
          <div class="well well-sm infohead">
        The list of Patients Those who have been <strong>diagnosed with TB.</strong> 
        </div>
          <div style="max-height:500px;overflow-y:scroll;">
              <table class="table table-bordered table-striped table-responsive" id="PatientlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                    <th style="text-align:left;width:30%;">Patient</th>
                    <th style="text-align:left;width:5%;">Mobile</th>
                    <th style="text-align:left;width:5%;">Block</th>
                    <th style="text-align:left;width:10%;">Village</th>
                    <th style="text-align:left;width:10%;">Panchayat</th>
                    <th style="text-align:right;width:10%;">Amount</th>
                    <th style="text-align:center;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d-m-Y');
        $amount="0";
        if (sizeof($incentive)) {

          foreach ($incentive as $value) {
            $amount=$value->amount;
          }
         
        }

      if(sizeof($patientlistData)>0){
        $i=0;
        $sl=1;
        
        foreach ($patientlistData as $patient_list) {
         
        
      ?>      
          <tr>
            <td><?php echo $sl; ?></td>
            <input type="hidden" id="patient_<?php echo $i;?>" name="patient[]" value="<?php echo $patient_list->patient_id;?>">
            <input type="hidden" name="nqpp" value="<?php echo $nqpp;?>">
            <input type="hidden" id="amt_<?php echo $i;?>" name="amt[]" value="<?php echo $amount?>">
             <td align="left"><?php echo $patient_list->patient_name;  ?></td>
             <td align="left"><?php echo $patient_list->patient_mobile_primary;  ?></td>
             <td align="left"><?php echo $patient_list->blockname;  ?></td>
             <td align="left"><?php echo $patient_list->patient_village;  ?></td>
             <td align="left"><?php   ?></td>
             <td align="right"><?php echo $amount;  ?></td>
             <td align="center"><input type="checkbox" class="selCheckbox" id="check_<?php echo $i;?>"  name="chkpay[]" style="position: inherit;" checked value="<?php echo $i;?>"></td>
            
          </tr>

          <?php 
            $i++;
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
       if(sizeof($patientlistData)>0){
?>
 <div class="container" style="margin-top:50px; ">
  <div class="form-group row">
    <label for="date" class=" col-sm-2 col-form-label">Generation Date</label>
      <div class="col-sm-2 col-xs-12">
              <input type="text" class="form-control custom_frm_input" id="generation_date" name="generation_date"  placeholder="" value="<?php echo $curr_dt;?>" readonly/>
        </div>

         <label for="amount" class="col-sm-offset-4 col-sm-2 col-form-label">Total Amount</label>
      <div class="col-sm-2 col-xs-12">
              <input type="text" class="form-control custom_frm_input" id="totalamount" name="totalamount"  placeholder="" readonly />
        </div>
    </div>
     <p id="paygenchk_manual_err_msg" class="form_error"></p>
    <div class="form-group row" style="margin-top:20px;" id="paygenSavediv">
      <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="paygenSave" style="display: inline-block;width:200px;">Save</button>
            </div>
    </div>

    <div class="form-group row" style="margin-top:20px; display:none;" id="paygenUpdatediv">
      <div class="btnDiv">
              <button type="submit" class="btn btn-primary formBtn" id="paygenUpdate" style="display: inline-block;width:200px;">Update</button>
            </div>
    </div>

</div> 


 <?php 
}


 echo form_close(); ?>
    </div>


