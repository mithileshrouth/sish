<div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Center Facilities</h4>
    </div>
    <div class="modal-body">
    <?php 
      if($centerfacilityData)
      {
       /*echo "<pre>";
        print_r($centerfacilityData);
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
                  <th>Title</th>
                  <th>Icon</th>
                </tr>
                </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      foreach ($centerfacilityData as $key => $value) {
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value->facilityname; ?></td>
                        <td>
                          <?php 
                          if(isset($value->icon_random_name))
                          { ?>

                             <img src="<?php echo base_url()?>application/assets/ds-documents/facility_icons/<?php echo $value->icon_random_name; ?>" class="facility_icon" />    
                          <?php  
                          }
                          else{echo "";}
                          ?>
                        </td>
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