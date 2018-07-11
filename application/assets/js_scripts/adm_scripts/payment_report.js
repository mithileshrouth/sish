$(document).ready(function(){
var basepath = $("#basepath").val();




/* On select Coordinator select NQPP */
    $(document).on("change", "#coordinator", function() {
    	var val=$('select[name=coordinator]').val();

       
	$.ajax({
	type: "POST",
	url: basepath+'payment/getNqpp',
	data: {coordinatorid:val},
	
	success: function(data){
		$("#nqppview").html(data);
		$('.selectpicker').selectpicker();
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
    $(document).on("submit","#PaymentReportForm",function(event){
        event.preventDefault();

        if(validateView()) {
        	
            var formDataserialize = $("#PaymentReportForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'payment_report/getPaymentList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadTransactionList").html(result);
                    $(".dashboardloader").css("display","none");
                     var groupColumn = 1;
                  // $('.dataTables').DataTable();
                   var table = $('.dataTables').DataTable({
				        "columnDefs": [
				            { "visible": false, "targets": groupColumn }
				        ],
				        "order": [[ groupColumn, 'asc' ]],
				        "displayLength": 25,
				        "drawCallback": function ( settings ) {
				            var api = this.api();
				            var rows = api.rows( {page:'current'} ).nodes();
				            var last=null;
				 
				            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
				                if ( last !== group ) {
				                    $(rows).eq( i ).before(
				                        '<tr class="group"><td colspan="6" >'+group+'</td></tr>'
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




}); // end od document ready

function validateView()
{

    var coordinator = $("#coordinator").val();
    var sel_nqpp = $("#sel_nqpp").val();
   

    if(coordinator=="0")
    {
        $("#payment_manual_err_msg").css("display","block").text("Error : Select Coordinator");
        return false;
    }
    if(sel_nqpp=="0")
    {
        $("#payment_manual_err_msg").css("display","block").text("Error : Select NQPP");
        return false;
    }

    
    $("#payment_manual_err_msg").css("display","none").text("");
    return true;
}