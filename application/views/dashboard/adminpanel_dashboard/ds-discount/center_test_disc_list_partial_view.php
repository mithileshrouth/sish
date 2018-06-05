        <div class="box-body" id="centerTestList">
              <table class="table table-bordered table-striped dataTables" id="centerTestDiscTbl" style="border-collapse: collapse !important;">
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                    <th style="text-align:right;width:5%;">Status
                    <input type="hidden" name="cid_disc" id="cid_disc" value="<?php echo $centerID; ?>">
                  </th>
                  <th>Code</th>
                  <th>Test</th>
                  <th>Valid From</th>
                  <th>valid To</th>
                  <th>Disc %</th>
                
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
        <?php
      if(sizeof($testdisclistData)>0){
        $i=1;
        $curr_dt = date('Y-m-d');
        foreach ($testdisclistData as $disc_list) {
         
          $status = "";
          if($disc_list->valid_from > $curr_dt)
          {
            $status = '<div class="status_dv"><span class="label label-info status_tag">Upcoming</span></div>';
          }
          if($disc_list->valid_upto < $curr_dt)
          {
            $status = '<div class="status_dv"><span class="label label-danger status_tag">Expired</span></div>';
          }
          if($disc_list->valid_from <= $curr_dt && $disc_list->valid_upto >= $curr_dt)
          {
              $status = '<div class="status_dv"><span class="label label-success status_tag">Current</span></div>';
          }


          $active_status = "";
          if($disc_list->is_active=="Y")
          {
          $active_status = '<div class="status_dv "><span class="label label-success status_tag testdiscstatus" data-setstatus="N" data-discuntid="'.$disc_list->id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
          }
          else
          {
          $active_status = '<div class="status_dv"><span class="label label-danger status_tag testdiscstatus" data-setstatus="Y" 
                      data-discuntid="'.$disc_list->id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
          }
         
               
        
      ?>      
          <tr>
            <td><?php echo $i; ?></td>
             <td align="center"><?php echo $status; ?></td>
            <td><?php echo $disc_list->code; ?></td>
             <td>
              <?php echo $disc_list->name; ?>
                <input  name="cTestId" id="cTestId_<?php echo $i;?>" type="hidden" value="<?php echo $disc_list->test_id; ?>" />
             </td>
             <td><?php echo date('d-m-Y',strtotime($disc_list->valid_from)); ?></td>
             <td><?php echo date('d-m-Y',strtotime($disc_list->valid_upto)); ?></td>
             <td><?php echo $disc_list->discount_rate; ?></td>
            
             <td align="center"><?php echo $active_status; ?></td>
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
