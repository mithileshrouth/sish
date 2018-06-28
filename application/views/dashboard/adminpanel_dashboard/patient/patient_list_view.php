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
   // display: table-header-group;
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Patient List</li>
      </ol>
    </section>






    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patient List</h3>
              <a href="<?php echo base_url();?>patient" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="patient_list" >
                <thead>
                <tr>
                  <!-- <th style="width:5%;">Sl</th> -->
                  <th style="text-align:right;width:5%;">Action</th>
                   <th style="width:10%;">view</th>
                  <th style="width:20%;">Patient</th>
                  <th style="width:5%;">Mobile</th>
                  <th>Coordinator</th>
                  <th>NQPP</th>
                  <th>Reg.Date</th>
                  <th>Village</th>

                 
                  
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				
              		$i = 1;
              		foreach ($bodycontent['patientList'] as $value) { 
              		
              		?>

					<tr>
						<!-- <td><?php echo $i++; ?></td> -->
            <td align="center"> 
              <a href="<?php echo base_url(); ?>patient<?php //echo $value->patient_id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
                <span class="glyphicon glyphicon-pencil"></span>
              </a>
            
            </td>
              <td align="center"><a href="<?php echo base_url(); ?>patient/viewpatient/<?php echo $value->patient_id; ?>" class="btn btn-danger btn-xs" data-title="View">View
               
              </a></td>
						<td><?php echo $value->patient_name; ?></td>
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
                <th></th>
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