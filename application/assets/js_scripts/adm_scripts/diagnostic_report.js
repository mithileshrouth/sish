$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
$('.selectpicker').selectpicker({dropupAuto: false});
 $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });



 /* On select District Coordinator select Block */
 $(document).on("change","#distcoordinator",function(event){
        event.preventDefault();

           var formDataserialize = $("#DiagnosticReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
 

	$.ajax({
	type: "POST",
	url: basepath+'diagnostic_report/getBlockList',
	data: formData,
	
	success: function(data){
		$("#blockview").html(data);
		$('.selectpicker').selectpicker({dropupAuto: false});
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

/* On select Block select group Coordinator*/
 $(document).on("change","#sel_block",function(event){
        event.preventDefault();

           var formDataserialize = $("#DiagnosticReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
 

	$.ajax({
	type: "POST",
	url: basepath+'diagnostic_report/getGroopCordinatorList',
	data: formData,
	
	success: function(data){
		$("#grpcoordinatorview").html(data);
		$('.selectpicker').selectpicker({dropupAuto: false});
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


/* On select group Coordinator select NFHP */
 $(document).on("change","#grpcoordinator",function(event){
        event.preventDefault();

           var formDataserialize = $("#DiagnosticReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
 

	$.ajax({
	type: "POST",
	url: basepath+'diagnostic_report/getNqppList',
	data: formData,
	
	success: function(data){
		$("#nqppview").html(data);
		$('.selectpicker').selectpicker({dropupAuto: false});
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

   // For Project Report Details
    $(document).on("submit","#DiagnosticReportForm",function(event){
        event.preventDefault();

      
        	
            var formDataserialize = $("#DiagnosticReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            if (validateForm()) {
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'diagnostic_report/getDiagnosticReportList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadProjectReportList").html(result);
                    $(".dashboardloader").css("display","none");
                     
                 //  $('.dataTables').DataTable();
                 var table = $('.dataTables').DataTable({
                          dom: 'Bfrtip', /* use lBfrtip for show entities*/
                        buttons: [ {
                            extend: 'excelHtml5',
                            customize: function ( xlsx ){
                                var sheet = xlsx.xl.worksheets['diagnostic_report.xml'];
                 
                              
                            }
                        } ],
                      //  "scrollX": true,
   

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
                }); /*end ajax call*/

     }//end of validation

    });



}); // end od document ready

function validateForm()
{
    var frndt = $("#frndt").val();
    var todt = $("#todt").val();
    var distcoordinator = $("#distcoordinator").val();
    

    $("#report_msg").text("").css("dispaly", "none").removeClass("form_error");
    if(frndt=="")
    {
        $("#frndt").focus();
        $("#report_msg")
        .text("Error : Select From Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
     if(todt=="")
    {
        $("#todt").focus();
        $("#report_msg")
        .text("Error : Select To Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    if(distcoordinator=="0")
    {
        $("#distcoordinator").focus();
        $("#report_msg")
        .text("Error : Select District")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }


	
	return true;
}