$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
$('.selectpicker').selectpicker({dropupAuto: false});
 $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });




/* On select Coordinator select NQPP */
 $(document).on("change","#coordinator",function(event){
        event.preventDefault();

           var formDataserialize = $("#PaymentGenReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
 

	$.ajax({
	type: "POST",
	url: basepath+'payment_generation_report/getNqppMultiple',
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


// For Listing of payment details
    $(document).on("submit","#PaymentGenReportForm",function(event){
        event.preventDefault();

        if(1) {
        	
            var formDataserialize = $("#PaymentGenReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'payment_generation_report/getPaymentGenerationList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadTransactionList").html(result);
                    $(".dashboardloader").css("display","none");
                     var groupColumn = 3;
                  // $('.dataTables').DataTable();
                   var table = $('.dataTables').DataTable({
                          dom: 'Bfrtip', /* use lBfrtip for show entities*/
                        buttons: [ {
                            extend: 'excelHtml5',
                            customize: function ( xlsx ){
                                var sheet = xlsx.xl.worksheets['payment_report.xml'];
                 
                              
                            }
                        } ],
                        "scrollX": true,


				        "columnDefs": [
				            { "visible": false, "targets": groupColumn }
				        ],
				        
				        "displayLength": 25,
				        "drawCallback": function ( settings ) {
				            var api = this.api();
				            var rows = api.rows( {page:'current'} ).nodes();
				            var last=null;
				 
				            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
				                if ( last !== group ) {
				                    $(rows).eq( i ).before(
				                        '<tr class="group"><td colspan="8" >'+group+'</td></tr>'
				                    );
				 
				                    last = group;
				                }
				            } );
				        }

				        

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

        }

    });



}); //end of document ready