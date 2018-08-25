$(document).ready(function(){
var basepath = $("#basepath").val();
$('.selectpicker').selectpicker('deselectAll');
$('.selectpicker').selectpicker({dropupAuto: false});
 $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'
                     
                    });


// For Report Details
    $(document).on("submit","#EyeRecordForm",function(event){
        event.preventDefault();

      
        	
            var formDataserialize = $("#EyeRecordForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            if (validateForm()) {
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'eye_record/getEyeRecordList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadEyeRecordList").html(result);
                    $(".dashboardloader").css("display","none");
                     
                 //  $('.dataTables').DataTable();
                 var table = $('.dataTables').DataTable({
                          dom: 'Bfrtip', /* use lBfrtip for show entities*/
                        buttons: [ {
                            extend: 'excelHtml5',
                            customize: function ( xlsx ){
                                var sheet = xlsx.xl.worksheets['eye_record.xml'];
                 
                              
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

	return true;
}