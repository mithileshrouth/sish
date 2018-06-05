        <div class="box-body" id="centerTestList">
              <table class="table table-bordered table-striped dataTables" id="centerTestDiscTbl" style="border-collapse: collapse !important;">
                <thead>
                <tr style="color: #4a356c;">
                  <th style="width:10%;">Sl</th>
                  <th>Code</th>
                  <th>Test</th>
                  <th>Valid From</th>
                  <th>valid To</th>
                  <th>Disc %</th>
                  <th style="text-align:right;width:5%;">Action
                    <input type="hidden" name="cid_disc" id="cid_disc" value="<?php echo $centerID; ?>">
                  </th>
                </tr>
                </thead>
                <tbody>
               
        <?php
      if(sizeof($testList)>0){
        $i=1;
        foreach ($testList as $test_data) {
         
        
      ?>      
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $test_data->code; ?></td>
             <td>
              <?php echo $test_data->name; ?>
                <input  name="cTestId" id="cTestId_<?php echo $i;?>" type="hidden" value="<?php echo $test_data->id; ?>" />
             </td>
             <td>
              
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar-check-o"></i>
                  </div>
                  <input class="form-control input-sm datemask" data-inputmask="'alias': 'dd/mm/yyyy'"  name="discValidfrm" id="discValidfrm_<?php echo $i;?>" type="text">
                </div>
               
             </td>
             <td>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar-check-o"></i>
                  </div>
                  <input class="form-control input-sm datemask" data-inputmask="'alias': 'dd/mm/yyyy'"  name="discValidUpto" id="discValidUpto_<?php echo $i;?>" type="text">
                </div>
             </td>
             <td>
              <input type="text" class="form-control input-sm" name="discrate" id="discrate_<?php echo $i;?>" onkeyup="return numericFilter(this);" style="width: 100px;text-align:right;" />
            </td>
            <td align="center"> 
              <button type="button" class="btn bg-purple btn-flat discsavebtn" id="discsavebtn_<?php echo $i;?>" style="padding: 2px 19px;display:block;">Save</button>

              <button type="button" class="btn bg-olive btn-flat " id="datadiscsavedbtn_<?php echo $i;?>" style="padding: 2px 19px;display:none;"><span class="glyphicon glyphicon-ok"> Saved</span></button>
            </td>
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
