$(document).ready(function() {
    var basepath = $("#basepath").val();


    $(document).on("submit", "#investigationForm", function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        validateInvestigation(basepath, formData)
    });

    //
    $(document).on("submit", "#investigationManualForm", function(event) {
        event.preventDefault();

        if (validatemanualInvestigation()) {
            var formDataserialize = $("#investigationManualForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#investigationmanual_loader").css("display", "block");
            $("#investManualSave").addClass('nonclick');

            $.ajax({
                type: "POST",
                url: basepath + 'investigation/investigationmanual_action',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",

                success: function(result) {
                    $("#investigationmanual_loader").css("display", "none");
                    $("#investManualSave").removeClass('nonclick');

                    if (result.msg_status == 1) {

                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "investigation/addinvestigation";
                        var listurl = basepath + "investigation";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    }

                },
                error: function(jqXHR, exception) {
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

    // Set Status
    $(document).on("click", ".investigatestatus", function() {
        var uid = $(this).data("investigationid");
        var status = $(this).data("setstatus");
        var url = basepath + 'investigation/setStatus';
        setActiveStatus(uid, status, url);

    });

    $(document).on("change", "#sel_inv_department", function() {
        var id = $(this).val();
        var path = basepath + "subdepartment/getSubDepartment";
        populateDropdown(id, path, "subdepartment_dropdown");
    });

});

/*
 * User Defined Function ---------
 */

function validatemanualInvestigation() {
    var center = $("#investigation_center").val();
    var department = $("#sel_inv_department").val();
    var subdepart = $("#sel_subdepartment").val();
    var code = $("#investigation_code").val();
    var test = $("#investigation_name").val();
    var rate = $("#investigation_rate").val();

    if (center == "0") {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Select center");
        return false;
    }
    if (department == "0") {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Select department");
        return false;
    }
    if (subdepart == "0") {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Select subdepartment");
        return false;
    }
    if (code == "" || code.length == 0) {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Enter investigation code");
        $("#investigation_code").focus();
        return false;
    }
    if (test == "" || test.length == 0) {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Enter investigation name");
        $("#investigation_name").focus();
        return false;
    }
    if (rate == "" || rate.length == 0) {
        $("#invest_manual_err_msg").css("display", "block").text("Error : Enter investigation rate");
        $("#investigation_rate").focus();
        return false;
    }

    $("#invest_manual_err_msg").css("display", "none").text("");
    return true;

}




function validateInvestigation(basepath, formData) {
    var sel_center = $("#sel_center").val();
    var userfile = $("#investigationUploaduserFileName").val();
    $("#investigation_errmsg").text("").css("display", "none");
    if (sel_center == "0") {
        $("#investigation_errmsg").text("Select center name").css("display", "block");
        return false;
    }
    if (userfile == "" && userfile.length == 0) {
        $("#investigation_errmsg").text("Select investigation files for upload").css("display", "block");
        return false;
    }


    $("#investigation_loader").css("display", "block");


    //  var formData = new FormData($(this)[0]);
    $.ajax({
        type: "POST",
        url: basepath + 'investigation/validateinvestigation',
        dataType: "json",
        processData: false,
        contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
        success: function(result) {
            $("#investigation_loader").css("display", "none");


            if (result.msg_status == 1) {
                var count = result.depart.length;
                var dataDiv = '';
                dataDiv += '<div class="modal-header">';
                dataDiv += '<h4>' + result.center + '</h4>';
                dataDiv += '</div>';
                dataDiv += '<div class="modal-body" style="max-height:450px;overflow-y:scroll;">';
                dataDiv += '<table class="table table-bordered table-striped dataTables">';
                dataDiv += '<tr>';
                dataDiv += '<th>DEPT</th>';
                dataDiv += '<th>SUBDEPT</th>';
                dataDiv += '<th>CODE</th>';
                dataDiv += '<th>TEST</th>';
                dataDiv += '<th>RATE</th>';
                dataDiv += '<th>DELIVER (IN DAYS)</th>';
                dataDiv += '<th>PRE CONDITIONS</th>';
                dataDiv += '</tr>';
                var err_count = 0;
                for (var i = 0; i < count; i++) {
                    var err_cls1 = "";
                    var err_cls2 = "";

                    if (result.depart[i].error >= 1) {
                        err_cls1 = "err_xls_cell";
                        err_count += 1;
                    } else { err_cls1 = ""; }
                    if (result.subdepart[i].error >= 1) {
                        err_cls2 = "err_xls_cell";
                        err_count += 1;
                    } else {
                        err_cls2 = "";
                    }

                    dataDiv += '<tr>';
                    dataDiv += '<td class="' + err_cls1 + '" title="' + result.depart[i].cell + '">' + result.depart[i].value + '</td>';
                    dataDiv += '<td class="' + err_cls2 + '" title="' + result.subdepart[i].cell + '">' + result.subdepart[i].value + '</td>';
                    dataDiv += '<td title="' + result.code[i].cell + '">' + result.code[i].value + '</td>';
                    dataDiv += '<td title="' + result.test[i].cell + '">' + result.test[i].value + '</td>';
                    dataDiv += '<td title="' + result.rate[i].cell + '">' + result.rate[i].value + '</td>';
                    dataDiv += '<td style="text-align:center;" title="' + result.deliveryday[i].cell + '">' + result.deliveryday[i].value + '</td>';
                    dataDiv += '<td style="text-align:center;" title="' + result.preconditions[i].cell + '">' + result.preconditions[i].value + '</td>';
                    dataDiv += '</tr>';
                }


                dataDiv += '</table>';
                dataDiv += '</div>';
                dataDiv += '<div class="modal-footer">';

                if (err_count > 0) {

                    dataDiv += '<p class="xls_cell_err_msg">Please check error with red coloured box';
                    dataDiv += '<button type="button" class="btn bg-maroon btn-flat margin " style="background:#f64537 !important;" data-dismiss="modal">Close</button>';
                } else {
                    dataDiv += '<button type="button" class="btn bg-maroon btn-flat margin " style="background:#f64537 !important;" data-dismiss="modal">Close</button>';
                    dataDiv += '<button type="button" class="btn bg-olive btn-flat margin pull-right" onclick="submitInvestigation(' + "'" + basepath + "'" + ')">Continue</button>';
                }

                dataDiv += '</div>';

                $("#modal_investigation_content").html(dataDiv);
                $("#investigation_procee_modal").modal({
                    "backdrop": "static",
                    "keyboard": true,
                    "show": true
                });

            }

        },
        error: function(jqXHR, exception) {
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


function submitInvestigation(basepath) {
    $('#investigation_procee_modal').modal('hide');
    $("#investigatesavebtn").css("display", "none");
    $("#investigatesavebtn").addClass('nonclick');
    $("#investigation_loader").css("display", "block");

    var form = $('#investigationForm')[0];
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: basepath + 'investigation/investigation_action',
        dataType: "json",
        processData: false,
        contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
        success: function(result) {
            $("#investigation_loader").css("display", "none");
            $("#investigatesavebtn").removeClass('nonclick');

            if (result.msg_status == 1) {

                $("#suceessmodal").modal({
                    "backdrop": "static",
                    "keyboard": true,
                    "show": true
                });
                var addurl = basepath + "investigation/addinvestigation";
                var listurl = basepath + "investigation";
                $("#responsemsg").text(result.msg_data);
                $("#response_add_more").attr("href", addurl);
                $("#response_list_view").attr("href", listurl);

            }

        },
        error: function(jqXHR, exception) {
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