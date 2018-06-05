    <style>
    #pinassigned_detail ul{
      list-style:none;
    }
    #pinassigned_detail ul li{
      background: #c300ff;
      width: 75px;
      text-align: center;
      color: #FFF;
      border-radius: 33px;
      font-size: 18px;
      float: left;
      margin-left: 11px;
      margin-bottom: 9px;
    }
    #pinassigned_detail ul li:not(:first-child){
    
      margin-left:10px;
    }
    #hubpinlistmodal .modal-content{
      width: 60%;
      margin: 0 auto;
      background:#fefefe;
    }
    #hubpinlistmodal .modal-header {
      padding: 9px;
      border-bottom: 1px solid #e5e5e5;
    }
    #hubpinlistmodal .modal-title{
      text-align:center;
      text-indent: 17px;
      font-size: 15px;
      font-family: verdana;
      letter-spacing: 2px;
      color: #a004d1;
    }
    #hubpinlistmodal .modalbtn{
      background:none;
      color:#c300ff;
      border-color:#c300ff;
    }
    .modal.in .modal-dialog 
    {
        -webkit-transform: translate(0, calc(50vh - 50%));
        -ms-transform: translate(0, 50vh) translate(0, -50%);
        -o-transform: translate(0, calc(50vh - 50%));
        transform: translate(0, 50vh) translate(0, -50%);
    }

    </style>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hub List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hub List</h3>
              <a href="<?php echo base_url();?>hub/addhub" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataTable" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl
                  <input type="hidden" name="hubMode" id="hubMode" value="LIST" />
                  </th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th style="width:30%;">Address</th>
                  <th>Pin</th>
                  <th>Longitude</th>
                  <th>Latitude</th>
                  <th style="width:10%;">Status</th>
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['hubDataList'] as $key => $value) { 
              			$status = "";
              			if($value['hubMasterData']->is_active=="Y")
              			{
              				$status = '<div class="status_dv "><span class="label label-success status_tag hubstatus" data-setstatus="N" data-hubmid="'.$value['hubMasterData']->id.'"><span class="glyphicon glyphicon-ok"></span> Active</span></div>';
              			}
              			else
              			{
              				$status = '<div class="status_dv"><span class="label label-danger status_tag hubstatus" data-setstatus="Y" 
              				data-hubmid="'.$value['hubMasterData']->id.'"><span class="glyphicon glyphicon-remove"></span> Inactive</span></div>';
              			}
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value['hubMasterData']->name; ?></td>
            <td><?php echo $value['hubMasterData']->contact_no; ?></td>
            <td><?php echo $value['hubMasterData']->email; ?></td>
						<td style="width:30%;"><?php echo $value['hubMasterData']->address; ?></td>
						<td style="width:20%;">
            <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-hubmid="<?php echo $value['hubMasterData']->id; ?>" id="hubmasterid">Detail</button>
            </td>
						<td><?php echo $value['hubMasterData']->longitude; ?></td>
						<td><?php echo $value['hubMasterData']->latitude; ?></td>
						<td><?php echo $status; ?></td>
						<td align="center"> 
							<a href="<?php echo base_url(); ?>hub/addhub/<?php echo $value['hubMasterData']->id; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
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

    </section>
    <!-- /.content -->



<!-- Modal -->
<div class="modal fade" id="hubpinlistmodal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:0px;">
        <h5 class="modal-title" >Pin Assigned with <span id="hubname"></span></h5>
      </div>
      <div class="modal-body" id="pinassigned_detail"></div>
      <div class="modal-footer" style="border-top:0px;">
            <button class="btn btn-default modalbtn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


