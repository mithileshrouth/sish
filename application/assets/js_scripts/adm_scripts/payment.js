$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
 $('.selectpicker').selectpicker({dropupAuto: false});
  $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

  function calculateamount(){
   	 $("#paygenchk_manual_err_msg").css("display","none").text("");
   	 var amount=0;
     var i = 0;
   	var arr = [];
       $('.selPayCheckbox:checked').each(function () {
           arr[i++] = $(this).val();
           var idStr = $(this).attr('id');
           var idStrs = idStr.split('_');
          amount = amount + parseFloat($('#amt_'+idStrs[1]).val());
         
           
       });
      // alert(amount);
        $("#totalamount").val(amount);
       
   }

  $(document).on("change", ".selPayCheckbox", function() {

    calculateamount();
});

 /* On select Coordinator select NQPP */
    $(document).on("change", "#coordinator", function() {
    	var val=$('select[name=coordinator]').val();

       
	$.ajax({
	type: "POST",
	url: basepath+'payment/getNqpp',
	data: {coordinatorid:val},
	
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

// For Listing Existing Payment Generation
    $(document).on("submit","#PaymentForm",function(event){
        event.preventDefault();

        if(validateView()) {
        	
            var formDataserialize = $("#PaymentForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'payment/getTransactionList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadTransactionList").html(result);
                    $('#datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'

                    });
                
                    $(".dashboardloader").css("display","none");
                    calculateamount();
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


    /******* Update Payment Generation master **********/	
 $(document).on("click","#savePayment",function(event){
        event.preventDefault();

            var formDataserialize = $("#PaymentSaveForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
        if(chkvalidation()){    
        	  $("#savePayment").css("display","none");
            $(".dashboardloader").css("display","block");
     
            $.ajax({
                type: "POST",
                url: basepath+'payment/payment_action_update',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                $(".dashboardloader").css("display","none");
                //alert(result.msg_data); 
              
               
                $("#save-msg-data").text(result.msg_data);
						
						$("#saveMsgModal").modal({"backdrop"  : "static",
							  "keyboard"  : true,
							  "show"      : true                    
							});

                    
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

function chkvalidation(){

	length=$('[name="chkpay[]"]:checked').length;
     var payment_date = $("#datepicker").val();
	
	if(length=="0")
    {
        $("#paygenchk_manual_err_msg").css("display","block").text("Error : Select Check Box");
        return false;
    }
    if(payment_date=="")
    {
        $("#paygenchk_manual_err_msg").css("display","block").text("Error : Select Payment Date");
        return false;
    }
    $("#paygenchk_manual_err_msg").css("display","none").text("");
    return true;
}