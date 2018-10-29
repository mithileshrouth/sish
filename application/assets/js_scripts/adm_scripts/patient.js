$(document).ready(function() {
var basepath = $("#basepath").val();
 $('.datepicker').datepicker({
                     format: 'dd/mm/yyyy',
                     todayHighlight: true,
                     uiLibrary: 'bootstrap'

                    });


 $('#patient_list').DataTable( {
    
    "fixedHeader": {
            header: true,
            footer: true
        },
      
     "orderCellsTop": true,
   
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        "aaSorting": [],
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [0,1,2] /* 1st one, start by the right */
            }],
        initComplete: function () {
            this.api().columns([3,4,5,6]).every( function () {
                var column = this;
                var select = $('<select class="form_input_text selectpicker" data-live-search="true"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                $('.selectpicker').selectpicker('refresh');
            } );
            
        }

/*********************************/


} );

 $('#patient_list tfoot tr').insertBefore($('#patient_list thead tr'));


 /* Patient Report methods*/

  /* On select district select block*/
    
   $(document).on("change","#sel_dist",function(event){
        event.preventDefault();

           var formDataserialize = $("#PatientReportListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
    $.ajax({
    type: "POST",
    url: basepath+'patient/getBlock',
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

/* On select block select Coordinator*/
    
   $(document).on("change","#sel_block",function(event){
        event.preventDefault();

           var formDataserialize = $("#PatientReportListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
    $.ajax({
    type: "POST",
    url: basepath+'patient/getCoordinator',
    data: formData,
    
    success: function(data){
        $("#cordinatorview").html(data);
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


  // For PTB Report by District or Block or group Coordinator 
    $(document).on("submit","#PatientReportListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#PatientReportListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            

            if (validationReport()) {
                  $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'patient/getPatientReportList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadpatientreport").html(result);
                    $('.dataTables').DataTable({
                        dom: 'Bfrtip', /* use lBfrtip for show entities*/
                        buttons: [ {
                            extend: 'excelHtml5',
                            customize: function ( xlsx ){
                                var sheet = xlsx.xl.worksheets['patient_report.xml'];
                 
                              
                            }
                        } ],
                        "scrollX": true,

                    });
                   
                    $(".dashboardloader").css("display","none");
                    
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


});//end of document ready


function validationReport(){

     var fromdate = $("#fromdate").val();
     var todt = $("#todt").val();
/*   
alert(fromdate);
    $("#reportmsg").text("").css("dispaly", "none").removeClass("form_error");

    if (fromdate!="") {

        if (todt=="") {
        $("#todt").focus();
        $("#reportmsg")
        .text("Error : Select To Date")
        .addClass("form_error")
        .css("display", "block");
        return false;

        }
    }

     if (fromdate=="") {

        if (todt=!"") {
        $("#todt").focus();
        $("#reportmsg")
        .text("Error : Select From Date")
        .addClass("form_error")
        .css("display", "block");
        return false;

        }
    }
*/

    return true;
}
