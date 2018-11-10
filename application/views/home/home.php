<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome to SHIS </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
  

  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <!-- iCheck for checkboxes and radio inputs
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/iCheck/all.css">
   -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
  
  
    <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/custominputradiocheck.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/adm_dashboard.css" />
  
  <link href="<?php echo base_url(); ?>application/assets/css/bootstrapselect.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>application/assets/css/searchable_dropdown.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>application/assets/css/transition.min.css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>application/assets/css/typeahead.css" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo base_url();?>application/assets/css/bootstrap-timepicker.min.css" />
 


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
	ul.typeahead 
	{
		margin: 0px;
		padding: 0px 0px;
		width: 91% !important;
		border-bottom: 1px solid #e4e4e4;
		border-left: 1px solid #e4e4e4;
		border-right: 1px solid #e4e4e4;
	}
  </style>
  
  	
	
	<!-- jQuery 3 -->
<!-- <script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- Icheck -
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/iCheck/icheck.min.js"></script>
-->
<!-- FastClick -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/fastclick/lib/fastclick.js"></script>


<!-- InputMask -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/plugins/input-mask/jquery.inputmask.extensions.js"></script>


<!-- AdminLTE App -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes 
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/dist/js/demo.js"></script>
-->
<!-- DataTables -->
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>application/assets/diagnostic_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/bootstrapselect.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/searchable_dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/transition.min.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/typehead.js"></script>
<script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/commonutilfunc.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>   

<style>
    .topheader_home a {
        
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 2px;
    }
    .topheader_home .callout {
       border-radius: 0px;
        margin: 0 0 20px 0;
        padding: 5px 20px 5px 15px;
        background-color: #f3f3f3  !important;
    }
    .topheader_home .callout.callout-info {
        border:0;
        border-color: #155f77;
    }
    .portalbtn{
        width: 17%;
        margin:0 auto;
        margin-right: 0;
    }
    
    .logo img{
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
    .box-body{
        padding:5px;
    }
    .search-container {
        padding: 5px;
    }
    .searchrow {
        margin-right: 0;
        margin-left: 0;
    }
    #rslt{
        margin-top: 25px;
    }
    #rslt .box{
         box-shadow: 0px px 0px px #939393 !important;
         border: 0px solid #c2d4de;
    }
    .logo_container{
        margin-top:-20px;
           background-color: #f3f3f3  !important;
           border-bottom: 1px solid #c2c2c2;
    }
    .btn-app > .badge {
        position: absolute;
        top: -8px;
        right: -5px;
        font-size: 15px;
        font-weight: 600;
    }
    .btn-app {
       
        color: #242424;
        border: 1px solid #ddd;
        background-color: #f4f4f4;
        font-size: 14px;
        letter-spacing: 1px;
    }

</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
    
    <section class="topheader_home">
        <div class="callout callout-info lead ">
           
            <a class="btn btn-block btn-social btn-bitbucket portalbtn" href="<?php echo(base_url()); ?>adminpanel">
                <i class="fa fa-unlock-alt"></i> Go to Admin Portal
            </a>
             
        </div>
    </section>
    
    <section class="logo_container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo">
                        <img src="<?php echo base_url(); ?>application/assets/shisimg/globalfundsmpng.png" style="width:140px;"/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="logo">
                       <img src="<?php echo base_url(); ?>application/assets/shisimg/shislogo.png" style="width:200px; margin-top:20px;"/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="logo">
                         <img src="<?php echo base_url(); ?>application/assets/shisimg/newdots.png" style="width:130px;"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    


    <!-- Main content -->
    <section class="content">
        
        <div class="box-body search-container">
		<div class="box-header with-border">
                    <h3 class="box-title">
                        Total number of NFHP :- <?php echo($NFHP); ?><br>
                    <!--                    Total number of Group form :- 456 -->
                    </h3>
                </div>
	 
            <div class="row searchrow">
                     <div class="col-md-3">
                     <label> As on date </label> 
                     <input type="text" readonly="" class="form-control custom_frm_input datepicker" id="asondate" name="asondate" placeholder="" value="<?php echo(date('d-m-Y')); ?>">
                   </div>

                   <div class="col-md-3">
                      <label> Name of district </label> 
                      <select class="form-control" id="disctrict">
                          <option value="">District</option>
                           <?php if($district){
                           foreach ($district as $value) { ?>
                                   <option value="<?php echo($value->id); ?>"><?php echo($value->name); ?></option>
                                   <?php } }?>
                       </select>
                   </div>

                   <div class="col-md-4">
                       <label> Name of block </label>
                       <div id="block">
                           <select class="form-control" id="block-srch" name="block-srch">
                               <option value="">Block</option>
                           </select>
                       </div>
                   </div>

                   <div class="col-md-2">
                       <label> &nbsp;</label>
                       <button type="button" class="btn btn-success btn-block btn-search">
                         <i class="fa fa-search"></i>    Search
                       </button>
                   </div>
            </div>
	 </div><!-- end of search -->
          

        <div id="rslt"></div>
    </section>

    <!--
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="#">Shis</a>.</strong> All rights
    reserved.
  </footer> -->
  
  
  
  
 

<script>
    $(document).on('click','.btn-search',function(){
        
    var asondate = $("#asondate").val()||"";
    var disctrict = $("#disctrict").val()||"";
    var blocksrch = $("#block-srch").val()||"";
    $.ajax({
    type: "POST",
    url: '<?php echo(base_url()); ?>home/getResultData',
    dataType: 'html',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
    data: {
        asondate:asondate,
        disctrict:disctrict,
        blocksrch:blocksrch
    },
    
    success: function(data){
        $("#rslt").html(data);
        //$('.selectpicker').selectpicker({dropupAuto: false});
         var table = $('#example1').DataTable(
            {
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    } );
    },
    error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }



    });/*end ajax call*/
    });
     

    
	$('.selectpicker').selectpicker();
         $('.datepicker').datepicker({
                     format: 'dd-mm-yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });
     $("#disctrict").change(function(){
         
         var districtId = $(this).val();
         $.ajax({
    type: "POST",
    url: '<?php echo(base_url()); ?>home/getBlock',
    data: {districtId:districtId},
    
    success: function(data){
        $("#block").html(data);
        //$('.selectpicker').selectpicker({dropupAuto: false});
    },
    error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }



    });/*end ajax call*/
     });
	
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    
    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
		//$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
		$(this).parent().find('.userfilesname').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });	


	function numericFilter(txb) 
	{
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
		//txb.value = txb.value.replace(/[^\0-9]/, "");
	}
	
	$(".numchk").on("keydown",function (event) {    
			if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            }
			else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();
    });
		

	
	
	  $('.timepickers').timepicker({
        //defaultTime: '08:00 AM',
        defaultTime: '',
        minuteStep: 1
        });
	
      $('.ui.dropdown').dropdown({
        allowAdditions: true,
        direction: 'upward'
      });

/* onclick menu selected*/
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.sidebar-menu a').filter(function() {
   return this.href == url;
}).parent().addClass('active');

// for treeview
$('ul.treeview-menu a').filter(function() {
   return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

</script>
</body>
</html>
