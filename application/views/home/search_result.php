<!--<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->

<style>

</style>


 <div class="" style="border: 1px solid #CCC;border-radius: 5px;width:96%;margin:0 auto;">
            <div class="box-header header" style="background:transparent;color: #6F6F6F;font-size: 16px;letter-spacing: 1px;">

              <!-- Changed-on : 10/12/18 , Changed-by : Sandipan Sarkar -->
              
                <h3 class="box-title">Periodical observation's (<?php echo ($fromDate.' To '.$toDate); ?>)</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl.no</th>
<!--                  <th>Date</th>-->
                  <th>District</th>
                  <th>Block</th>
                  <th>NFHP</th>
                  <th>Registration</th>
                  <th>Sputum collected <br>and transported</th>
                  <th>x-ray done</th>
                  <th>CBNAAT done</th>
                  <th>TB case found</th>
                </tr>
                </thead>
                   <tbody>
                <?php  if($searchdata){
                    $totalNFHP=0;
                    $totalRegistered=0;
                    $totalSptm=0;
                    $xrayDone=0;
                    $cbnaatDone=0;
                    $tbtotal=0;
                    foreach($searchdata as $value){
                    ?>
             
                <tr>
                    <td><?php echo($value['serial']); ?></td>
<!--                    <td><?php echo($value['patient_reg_date']); ?></td>-->
                    <td><?php echo($value['district']); ?></td>
                    <td><?php echo($value['block']); ?></td>
                    <td><?php echo($value['NFHP']); ?></td>
                    <td><?php echo($value['registered']); ?></td>
                    <td><?php echo($value['sputumClctDone']); ?></td>
                    <td><?php echo($value['xrayCount']); ?></td>
                    <td><?php echo($value['cbnaatCount']); ?></td>
                    <td><?php echo($value['tbCount']); ?></td>
                </tr>
                
                    <?php
                        $totalNFHP=$totalNFHP + $value['NFHP'];
                        $totalRegistered=$totalRegistered+$value['registered'];
                        $totalSptm = $totalSptm + $value['sputumClctDone'];
                        $xrayDone = $xrayDone + $value['xrayCount'];
                        $cbnaatDone = $cbnaatDone + $value['cbnaatCount'];
                        $tbtotal=$tbtotal+ $value['tbCount'];
                    }                    
                    }
                    ?>
                </tbody>
</table>
            </div>
          </div> <!-- end of ajax view -->
          
          <section style="width:60%;margin:2% auto;">
              <a class="btn btn-app">
                <span class="badge bg-red"><?php echo($totalNFHP); ?></span>
                <i class="fa fa-bullhorn"></i> NFHP
              </a>
               <a class="btn btn-app">
                <span class="badge bg-red"><?php echo($totalRegistered); ?></span>
                <i class="fa fa-bullhorn"></i> Registered
              </a>
               <a class="btn btn-app">
                <span class="badge bg-yellow"><?php echo($totalSptm); ?></span>
                <i class="fa fa-bullhorn"></i> Sputum collected & Transported
              </a>
              <a class="btn btn-app">
                <span class="badge bg-yellow"><?php echo($xrayDone); ?></span>
                <i class="fa fa-bullhorn"></i> Xray done
              </a>
               <a class="btn btn-app">
                <span class="badge bg-yellow"><?php echo($cbnaatDone); ?></span>
                <i class="fa fa-bullhorn"></i> CBNAAT done
              </a>
               <a class="btn btn-app">
                <span class="badge bg-yellow"><?php echo($tbtotal); ?></span>
                <i class="fa fa-bullhorn"></i> TB Case found
              </a>
          </section>  

<script>

//    $('#example1').DataTable(
//            {
//        dom: 'Bfrtip',
//        buttons: [
//            'copy', 'csv', 'excel', 'pdf', 'print'
//        ]
//    } );


</script>