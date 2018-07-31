       <style type="text/css">
     .infohead{
      width:500px;width: 556px;color: #45b045;font-size: 16px;
     } 
.trnxdiv{
text-align:center;padding:10px;padding: 10px;margin-bottom: 50px;display:none;
}
    </style>  
        
        <div class="box-body" id="PatientList">
       

         
         
          <div >
              <table class="table table-bordered table-striped table-responsive nowrap dataTables" id="PatientlistTbl" style="border-collapse: collapse !important;" >
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                  <th style="width:10%;">Group Coordinator</th>
                  <th style="width:10%;">NFHP</th>
                  
                  <th style="text-align:right;width:20%;">Payment Date</th>
                  <th style="text-align:left;width:20%;">Patient Name</th>
                  <th style="text-align:left;width:20%;">Patient ID</th>
                  <th style="text-align:left;width:10%;">Mobile</th>
                  <th style="text-align:left;width:20%;">Village</th>
                  <th style="text-align:left;width:10%;">Amount</th>
                  
                    
                </tr>
                </thead>
                <tbody>
               
        <?php
        $curr_dt = date('d/m/Y');
        $amount="0";
//pre($paymentlistData);
      if(sizeof($paymentgenerationlistData)>0){
        $i=0;
        $sl=1;
        
       
         
            foreach ($paymentgenerationlistData as $value) {
            
      ?>      
          <tr>
            <td><?php echo $sl; ?></td>
            <td><?php echo $value->coordinator_name;?></td>
            <td><?php echo $value->nqppname;?></td>

             <td align="right">
             <b style="color:#7d3c98;float: left;">Payment Generation Date : <?php echo date('d-m-Y', strtotime($value->generation_dt));?></b>
           


            

            </td>
             <td align="left"><?php echo $value->patient_name;?></td>
             <td align="left"><?php echo $value->patient_uniq_id;?></td>
             <td align="left"><?php echo $value->patient_mobile_primary;?></td>
             <td align="left"><?php echo $value->patient_village;?></td>
             <td align="left"><?php echo $value->amount;?></td>
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

    </div>


