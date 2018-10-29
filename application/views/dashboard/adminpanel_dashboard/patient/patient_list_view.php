<!--<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css">-->
<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/patient.js"></script>   



<style type="text/css">
/*
table.DTFC_Cloned thead,
table.DTFC_Cloned tfoot{
  background-color:white;
  }
  div.DTFC_Blocker{
    background-color:white;
    }
    div.DTFC_LeftWrapper table.dataTable,
    div.DTFC_RightWrapper table.dataTable{
      margin-bottom:20px;
      //z-index:2;
      }
      div.DTFC_LeftWrapper table.dataTable.no-footer,
      div.DTFC_RightWrapper table.dataTable.no-footer
      {
        border-bottom:none
      }


      .DTFC_LeftBodyWrapper,.DTFC_LeftBodyLiner{
  //height:50px !important;
  background: red;
  //padding: 50px;
}

.DTFC_RightBodyWrapper{
  margin-top:-15px;
  overflow: hidden;
}
.DTFC_RightBodyLiner{
  overflow: hidden;
}
.DTFC_RightBodyLiner table.dataTable.cell-border tbody tr th:first-child, table.dataTable.cell-border tbody tr td:first-child {

    border-left: 0px solid #ddd;

}
*/


  tfoot {
  
   display: none;
}
tfoot input {
        width: 90px;
        padding: 2px;
        box-sizing: border-box;
}





 
 #patient_list_wrapper{
 max-width: 100%;
 overflow-x: scroll;
 }  


/*
.dataTables_scrollBody table.dataTable tbody td {
    padding: 15px 4px;
}

.DTFC_LeftBodyLiner table tbody .odd td{
  padding: 9px 10px;
}
.DTFC_LeftBodyLiner table tbody .even td{
  padding: 15px 10px;
}
*/



</style>   
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Patient(s)</li>
      </ol>
    </section>






    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Patient(s)</h3>
              <?php
              $session = $this->session->userdata('user_data');
              //pre($session); 
              $accessable = getAccess($session["roleid"]);
              if($accessable=='Y'){
              ?>
              <a href="<?php echo base_url();?>patientregister/addpatient" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
              <?php }?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped nowrap" id="patient_list" >
                <thead>
                <tr>
                   <th style="width:5%;">&nbsp;</th> 
                 <!--  <th style="text-align:right;width:5%;">Action</th> -->
                   <th style="width:10%;">view</th>
                   <th style="width:10%;">Edit</th>
                  <th style="width:20%;">Patient</th>
                  <th style="width:5%;">Mobile</th>
                  <th>Group Coordinator</th>
                  <th>NFHP</th>
                  <th>Reg.Date</th>
                  <th>Village</th>

                 
                  
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['patientList'] as $value) { 
                      $process_state="";
                      if($value->dmc_sputum_done=='Y'){
                        $process_state='<span class="bg-green"> &nbsp;&nbsp;&nbsp;DMC&nbsp;&nbsp;&nbsp;</span>';
                      }else{
                        $process_state='<span class="bg-green" style="background-color: #98a74c!important;">&nbsp;&nbsp;&nbsp;REG.&nbsp;&nbsp;&nbsp;</span>';
                      }
                     
                      if ($value->xray_is_done=="Y") {
                      $process_state='<span class="bg-yellow">&nbsp;&nbsp;X-RAY&nbsp;&nbsp;</span>';
                      }
                     
              		    if ($value->is_cbnaat_done=="Y") {
                        $process_state='<span class="bg-purple">&nbsp;CBNAAT&nbsp;</span>';
                      }

                      if($value->cbnaat_pstv=='Y'){
                        if ($value->is_ptb_trtmnt_done=='Y') {
                          $process_state='<span class="bg-red">&nbsp;TREAT.&nbsp;</span>';
                        }

                      }else if ($value->cbnaat_pstv=='N') {
                        $process_state=' <span class="bg-green">&nbsp;&nbsp;Okay&nbsp;&nbsp;</span>';
                      }
              		?>

					<tr>
						 <td align="center"><?php echo $process_state;?></td> 
          <!--   <td align="center"> 
           <a href="<?php echo base_url(); ?>patient<?php //echo $value->patient_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
             <span class="glyphicon glyphicon-pencil"></span>
           </a>
          
          </td> -->
              <td align="center"><a href="<?php echo base_url(); ?>patient/viewpatient/<?php echo $value->patient_id; ?>" class="btn btn-danger btn-xs" data-title="View">View
               
              </a></td>
              
               <td align="center">
                   <a href="<?php echo base_url(); ?>patientregister/addpatient/<?php echo $value->patient_id; ?>" class="btn btn-danger btn-xs" data-title="Edit">Edit
               
              </a>
               </td>
              
              
						<td><?php echo $value->patient_name; ?>
              
            </td>
            <td><?php echo $value->patient_mobile_primary; ?></td>
            <td><?php echo $value->coordinator_name; ?></td>
            <td><?php echo $value->nqpp_name; ?></td>
            <td><?php echo ($value->patient_reg_date == NULL ? "" : date("d-m-Y", strtotime($value->patient_reg_date))); ?></td>
             <td><?php echo $value->patient_village; ?></td>
					

						
					</tr>
              			
              	<?php
              		}

              	?>
               <tfoot>
                <tr>
                <th></th>
               <!--  <th></th> -->
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                
               </tr>
                </tfoot>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->