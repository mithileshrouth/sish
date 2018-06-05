<div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Center Timing</h4>
    </div>
    <div class="modal-body">
    <?php 
      if($centerTimingData)
      {
        /*echo "<pre>";
        print_r($centerTimingData);
        echo "<pre>";*/
        ?>
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $centername; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Day</th>
                  <th>Opening Hr.</th>
                  <th>Closing Hr.</th>
                  <th>Close/Open</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      foreach ($centerTimingData as $key => $value) {
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
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value->days_name; ?></td>
                        <td><?php if(isset($value->opening_time)){echo date("H:i A",strtotime($value->opening_time));}else{echo "";} ?></td>
                        <td><?php if(isset($value->close_time)){echo date("H:i A",strtotime($value->close_time));}else{echo "";} ?></td>
                       <td><?php echo $close_label; ?></td>
                        
                      </tr>
                      <?php
                          }

                      ?>
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
  
      <?php
        }
     
    ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
     
    </div>
</div>