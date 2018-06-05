<div class="modal-header">
  <p class="addremove_heading" style="font-size: 1.5em;"><?php echo $centerData['centerMasterData']->center_name; ?></p>
  <p class="modal_pstyle">Address : <?php echo $centerData['centerMasterData']->center_full_add; ?></p>
  <p class="modal_pstyle">Contact : <?php echo $centerData['centerMasterData']->contact_no; ?></p>
</div>
<div class="modal-body" >
    <div id="wb_search_q_modal_container">
      
      
        <div class="table-responsive">
              <table class="table table-bordered table-striped wb-search-modal-tbl" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  
                  <th>Day</th>
                  <th>Opening Hr.</th>
                  <th>Closing Hr.</th>
                  <th style="text-align:right;">Close/Open</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      foreach ($centerData['centerTimingData'] as $key => $value) {
                        $close_label = "";
                        if($value->is_close=="Y")
                        {
                            $close_label = '<span class="label label-danger">Close</span>';
                        }
                        else
                        {
                           $close_label = '<span class="label label-success">Open</span>';
                        }

                      ?>
                      <tr>
                        
                        <td><?php echo $value->days_name; ?></td>
                        <td><?php if(isset($value->opening_time)){echo date("H:i A",strtotime($value->opening_time));}else{echo "";} ?></td>
                        <td><?php if(isset($value->close_time)){echo date("H:i A",strtotime($value->close_time));}else{echo "";} ?></td>
                        <td style="text-align:right;"><?php echo $close_label; ?></td>
                        
                      </tr>
                      <?php
                          }

                      ?>
                  </tbody>
                </table>
            </div>


    </div>
</div>