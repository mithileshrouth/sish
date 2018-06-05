    <style>
    #hubassigned_detail ul{
      list-style:none;
    }
    #hubassigned_detail ul li{
      background: #c300ff;
      width: 220px;
      text-align: center;
      color: #FFF;
      border-radius: 33px;
      font-size: 14px;
      float: left;
      margin-left: 11px;
      margin-bottom: 9px;
      padding:1%;
    }
    #hubassigned_detail ul li:not(:first-child){
    
      margin-left:10px;
    }
    #collectorhubmodal .modal-content{
      width: 60%;
      margin: 0 auto;
      background:#fefefe;
    }
    #collectorhubmodal .modal-header {
      padding: 9px;
      border-bottom: 1px solid #e5e5e5;
    }
    #collectorhubmodal .modal-title{
      text-align:center;
      text-indent: 17px;
      font-size: 15px;
      font-family: verdana;
      letter-spacing: 2px;
      color: #a004d1;
    }
    #collectorhubmodal .modalbtn{
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
    
    .dataTblDetailCls tr td table{
      background:#e9f9ff;
      font-family:verdana;
      font-size:12px;
      width:50%;
      border: 1px solid #dbdbdb;
     
    }

    .dataTblDetailCls tr td table tr:first-child{
      background: #146ee3 !important;
      color: #FFF !important;
    }


/*
td:first-child:before,
.td:first-child:before{
  box-sizing: border-box;
  content:'';
  position:absolute;

  left:0;
  right:2px;
  display: block;
  box-shadow: 13px 5px 15px 1px rgba(71, 71, 71, 0.5);
  -webkit-box-shadow: 13px 5px 15px 1px rgba(71, 71, 71, 0.5);
  -moz-box-shadow: 13px 5px 15px 1px rgba(71, 71, 71, 0.5);
  
}
*/

.patieninfoname{
  font-size: 13px;
letter-spacing: 1px;
font-weight: 600;
color: #AA21C4;
font-family: verdana;
}

#order-status-blck .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: auto !important;
}


#reason_block .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: 100% !important;
}



#order-status-blck  .btn-default{
//background-color: #fff !important;
//color: #424c4e;
//border-color: #18877b;
font-family: verdana;
font-size: 11px;
width: auto !important;
}
#order-status-blck  .bootstrap-select.btn-group .dropdown-menu li {
    position: relative;
    font-size: 11px;
}

#order-status-blck .popover-title{
  font-size: 11px;
}

</style>




    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enquiry List</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Enquiry List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped dataTables display compact dataTblDetailCls datatbl_style" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th></th>
                 
                  <th style="width:10%;">Order No</th>
                  <th style="width:10%;">Order Dt</th>
                  <th>Patient Info</th>
                  <th>Address</th>
                  <th style="width:12%;">Status</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
              		$i = 1;
              		foreach ($bodycontent['enquirylist'] as $key => $value) { 
              		?>

                  <tr id="row_<?php echo $i;?>">
                    <td></td>
                    <td>
                      <?php echo $value['ordermasterData']->uniq_order_id; ?>
                      <input type="hidden" id="uniqorderid_<?php echo $i;?>" value="<?php echo $value['ordermasterData']->uniq_order_id; ?>" />
                      <input type="hidden" id="ordermid_<?php echo $i;?>" value="<?php echo $value['ordermasterData']->orderId; ?>" />
                    </td>
                    <td><?php echo date("d-m-Y",strtotime($value['ordermasterData']->orderd_on  )); ?></td>
                    <td>
                        <span class="badge badge-success color_theme"><i class="fa fa-phone"></i> <?php echo $value['ordermasterData']->patientContact; ?></span>
                        <p class="patieninfoname"><i class="fa fa-user"></i> <?php echo $value['ordermasterData']->patientName; ?></p>
                     
                    <td>
                      <strong><?php echo "PIN :".$value['ordermasterData']->patientPin; ?></strong><br>
                      <?php echo $value['ordermasterData']->address; ?>
                    </td>

                    <td style="width:12%;">
                      <div id="order-status-blck">
                        <select id="orderstatus_<?php echo $i;?>" class="selectpicker show-tick order-status" data-rowid=<?php echo $i; ?>>
                        
                          <?php 
                            foreach($bodycontent['statuslist'] as $statuslist){ ?>
                              <option data-icon="<?php echo $statuslist->icon; ?>" value="<?php echo $statuslist->id; ?>" style="color:<?php echo $statuslist->color_code; ?>;font-weight:700;"><?php echo $statuslist->status; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                        <input type="hidden" name="nextcalldate" id="nextcalldate_<?php echo $i;?>" /> 
                        <input type="hidden" name="reasonid" id="reasonid_<?php echo $i;?>" /> 
                        <input type="hidden" name="remarksval" id="remarksval_<?php echo $i;?>" /> 
                       

                      </div>
                      <button class="btn color_theme btn-flat browseedit" id="browseedit_<?php echo $i;?>" data-rowid=<?php echo $i; ?> style="clear:both;font-size:12px;color:#FFF;width:100%;margin-top:4px;display:none;" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Browse</button>

                    </td>
                    <td>
                      <p id="reason_<?php echo $i;?>"></p>
                      <p id="remark_<?php echo $i;?>"></p>
                    </td>
                    <td>
                      <button class="btn color_theme btn-flat updateenqbtn" style="font-size:12px;color:#FFF;display:block;" id="updateenqbtn_<?php echo $i;?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>

                   
                        <button class="btn color_theme btn-flat" style="font-size:10px;color:#FFF;border-radius: 30px;display:none;" id="enqloader_<?php echo $i;?>">
                        <i class="fa fa-spinner rotating" aria-hidden="true"></i> Wait...</button>
           

                    </td>
                    
                  </tr>
              			
                <?php
                  $i++;
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





<form name="pendingDetailsForms" action="#">
<div class="modal fade" id="pendingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:60%;margin:0 auto;">
              <div id="pending_details"></div>
        </div>
    </div>
</div>
</form>




   


