$(document).ready(function(){
	var basepath = $("#basepath").val();
$('.selectpicker').selectpicker({dropupAuto: false});
	/* On select Coordinator select NQPP tab 1*/
    
    $(document).on("change", "#coordinator", function() {
    	var val=$('select[name=coordinator]').val();

       
	$.ajax({
	type: "POST",
	url: basepath+'payment_generation/getNqpp',
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


	/* On select Coordinator select NQPP tab 2*/
    $(document).on("change", "#coordinatort2", function() {
    	var val=$('select[name=coordinatort2]').val();

       
	$.ajax({
	type: "POST",
	url: basepath+'payment_generation/getNqppt2',
	data: {coordinatorid:val},
	
	success: function(data){
		$("#nqppviewt2").html(data);
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

/* On select NQPP get Transaction List tab 2*/
    $(document).on("change", "#sel_nqppt2", function() {
    	var val=$('select[name=sel_nqppt2]').val();

       
	$.ajax({
	type: "POST",
	url: basepath+'payment_generation/getTransactionNo',
	data: {nqppid:val},
	
	success: function(data){
		$("#txnview").html(data);
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





 // For Listing New Payment Generation
    $(document).on("submit","#PaymentListFilterForm",function(event){
        event.preventDefault();

        if(validateView())
        {
            var formDataserialize = $("#PaymentListFilterForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'payment_generation/getPatientList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadPatientList").html(result);
                
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


// For Listing Existing Payment Generation
    $(document).on("submit","#PaymentListExistForm",function(event){
        event.preventDefault();

        if(validateViewtab2())
        {
        	
            var formDataserialize = $("#PaymentListExistForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'payment_generation/getPaymetGenPatientList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadPatientList").html(result);
                
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




   function calculateamount(){
   	 $("#paygenchk_manual_err_msg").css("display","none").text("");
   	 var amount=0;
     var i = 0;
   	var arr = [];
       $('.selCheckbox:checked').each(function () {
           arr[i++] = $(this).val();
           var idStr = $(this).attr('id');
           var idStrs = idStr.split('_');
          amount = amount + parseFloat($('#amt_'+idStrs[1]).val());
         
           
       });
      // alert(amount);
        $("#totalamount").val(amount);
       
   }

$(document).on("change", ".selCheckbox", function() {

    calculateamount();
});

$(document).on("click", ".firsttab,.secondtab", function() {

     $("#loadPatientList").html("");
});



 $(document).on("click","#paygenSave",function(event){
        event.preventDefault();

            var formDataserialize = $("#PaymentGenerateForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            if(chkvalidation()){
            $("#paygenSavediv").css("display","none");	
            $(".dashboardloader").css("display","block");
            
            $.ajax({
                type: "POST",
                url: basepath+'payment_generation/payment_action',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                $(".dashboardloader").css("display","none");
               // alert(result.msg_data); 
              
                 $("#paygenSavediv").css("display","none");	
                 $("#paygenUpdatediv").css("display","block");	
                $("#txndiv").css("display","block");	
                
                $('#txnval').text(result.txnid);
                $("#txnno").val(result.txnid);

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

/******* Update Payment Generation **********/	
 $(document).on("click","#paygenUpdatediv",function(event){
        event.preventDefault();

            var formDataserialize = $("#PaymentGenerateForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
        if(chkvalidation()){    
            $(".dashboardloader").css("display","block");
      
            $.ajax({
                type: "POST",
                url: basepath+'payment_generation/payment_action_update',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                $(".dashboardloader").css("display","none");
                //alert(result.msg_data); 
              
                 $("#paygenSavediv").css("display","none");	
                 $("#paygenUpdatediv").css("display","block");	
                $("#txndiv").css("display","block");	
                
                $('#txnval').text(result.txnid);
                $("#txnno").val(result.txnid);
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


/******* Update Generated Payment **********/	
 $(document).on("click","#generatedUpdate",function(event){
        event.preventDefault();

            var formDataserialize = $("#PaymentGenUpdt" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
        if(chkvalidation()){    
            $(".dashboardloader").css("display","block");
      
            $.ajax({
                type: "POST",
                url: basepath+'payment_generation/payment_action_update',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                $(".dashboardloader").css("display","none");
                //alert(result.msg_data); 
              
                 $("#paygenSavediv").css("display","none");	
                 $("#paygenUpdatediv").css("display","block");	
                $("#txndiv").css("display","block");	
                
                $('#txnval').text(result.txnid);
                $("#txnno").val(result.txnid);
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







});/*end of document ready*/


function validateView()
{
    var coordinator = $("#coordinator").val();
    var sel_nqpp = $("#sel_nqpp").val();
    if(coordinator=="0")
    {
        $("#paygen_manual_err_msg").css("display","block").text("Error : Select Coordinator");
        return false;
    }
    if(sel_nqpp=="0")
    {
        $("#paygen_manual_err_msg").css("display","block").text("Error : Select NQPP");
        return false;
    }
    $("#paygen_manual_err_msg").css("display","none").text("");
    return true;
}

function validateViewtab2()
{
    var coordinator = $("#coordinatort2").val();
    var sel_nqpp = $("#sel_nqppt2").val();
    var sel_txn = $("#sel_txn").val();
    if(coordinator=="0")
    {
        $("#paygen_manual_err_msgt2").css("display","block").text("Error : Select Coordinator");
        return false;
    }
    if(sel_nqpp=="0")
    {
        $("#paygen_manual_err_msgt2").css("display","block").text("Error : Select NQPP");
        return false;
    }
     if(sel_txn=="0")
    {
        $("#paygen_manual_err_msgt2").css("display","block").text("Error : Select Transaction No");
        return false;
    }
    $("#paygen_manual_err_msgt2").css("display","none").text("");
    return true;
}

function chkvalidation(){

	length=$('[name="chkpay[]"]:checked').length;
	
	if(length=="0")
    {
        $("#paygenchk_manual_err_msg").css("display","block").text("Error :Select Check Box");
        return false;
    }
    $("#paygenchk_manual_err_msg").css("display","none").text("");
    return true;
}