$(document).ready(function() {

    var basepath = $("#basepath").val();

    var remarksList = [];
    var basepath = $("#basepath").val();

    // Remarks List
    $.getJSON(basepath + "enquiry/getremarksList", function(data) {
        $.each(data, function(index, value) {
            remarksList.push(value); // PUSH THE VALUES INSIDE THE ARRAY.
        });
    });


    var oTable = $('#example').DataTable();
    $("#example tbody tr td:nth-child(1)").attr("class", "details-control");


    $('#example').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = oTable.row(tr);
        var rowdata = (oTable.row(tr).data());

        /* if (row.child.isShown()) {
             tr.removeClass('details');
             row.child.hide();

         }*/
        if (row.child.isShown()) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp(function() {
                tr.removeClass('details');
                row.child.hide();
            });
        } else {
            console.log(oTable.row(tr).data());
            tr.addClass('details');
            row.child(format(row.child, rowdata, basepath)).show();

            $('div.slider', row.child()).slideDown();
        }
    });




    $(document).on("change", ".order-status", function(e) {

        var id = $(this).data("rowid");

        var statusval = $("#orderstatus_" + id).find("option:selected").text();
        //e.stopImmediatePropagation();

        if (statusval == "PENDING") {

            var rmkmdlcntnt = "";
            rmkmdlcntnt += '<div class="modal-header text-center">';
            rmkmdlcntnt += '<h4 class="modal-title" style="float:left;font-family:verdana;font-size:12px;color: #9403AA;letter-spacing:2px;">Pending Detail</h4>';
            rmkmdlcntnt += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            rmkmdlcntnt += '<span aria-hidden="true">&times;</span>';
            rmkmdlcntnt += '</button>';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="modal-body">';

            rmkmdlcntnt += '<div class="form-group">';
            rmkmdlcntnt += '<label for="nextcallpendingdate">Next Call Date</label>';
            rmkmdlcntnt += '<input type="text" class="form-control forminputs datemask" id="nextcallpendingdate_' + id + '" placeholder="" name="nextcallpendingdate_' + id + '" >';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="form-group">';
            rmkmdlcntnt += '<label for="reason">Reason</label><br>';
            rmkmdlcntnt += '<div id="reason_block_' + id + '">';
            rmkmdlcntnt += '<select class="form-control selremarks" id="pendingreasonid_' + id + '" name="pendingreasonid_' + id + '"  onchange="checkAdditionalRemarks(' + id + ',' + basepath + ')" >';

            rmkmdlcntnt += '<option value="0">Select</option>';
            $.each(remarksList, function(i, val) {
                rmkmdlcntnt += '<option value="' + remarksList[i].id + '">' + remarksList[i].remarks_title + '</option>';
                //console.log(remarksList[i].remarks_title);
            });
            rmkmdlcntnt += '</select>';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '</div>';

            rmkmdlcntnt += '<div class="form-group" id="additionalremarksblck_' + id + '" style="display:none;">';
            rmkmdlcntnt += '<label for="additionalremarks">Remarks</label>';
            rmkmdlcntnt += '<textarea class="form-control" id="additionalremarks_' + id + '" placeholder="" style="resize:none;"> </textarea>';
            rmkmdlcntnt += '</div>';

            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="modal-footer d-flex justify-content-center">';
            rmkmdlcntnt += '<button class="btn color_theme pendingsavebtn "  data-rowpendingbtnid="' + id + '" style="color:#FFF;" id="pendingsavebtn_' + id + '" > <i class="fa fa-paper-plane-o "></i> OK </button>';
            rmkmdlcntnt += '</div>';


            $("#pending_details").html(rmkmdlcntnt);
            $("#pendingModal").modal({
                "backdrop": "static",
                "keyboard": true,
                "show": true
            });

            $('.selectpicker').selectpicker();
            $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });



        } else {
            $("#nextcalldate_" + id).val("");
            $("#reasonid_" + id).val("");
            $("#remarksval_" + id).val("");
            $("#reason_" + id).text("");
            $("#remark_" + id).text("");
            $("#browseedit_" + id).css({ "display": "none" });
        }




    });


    /*
        $(document).on("change", ".selremarks", function(e) {
            e.stopImmediatePropagation();
            var id = $(this).attr("id");


        });
    */

    $(document).on("click", ".browseedit", function(e) {

        var id = $(this).data("rowid");
        var statusval = $("#orderstatus_" + id).find("option:selected").text();
        if (statusval == "PENDING") {

            var nextcalldate = $("#nextcalldate_" + id).val();
            var remarksID = $("#reasonid_" + id).val();
            var additionalremark = $("#remarksval_" + id).val();




            var rmkmdlcntnt = "";
            rmkmdlcntnt += '<div class="modal-header text-center">';
            rmkmdlcntnt += '<h4 class="modal-title" style="float:left;font-family:verdana;font-size:12px;color: #9403AA;letter-spacing:2px;">Pending Detail</h4>';
            rmkmdlcntnt += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            rmkmdlcntnt += '<span aria-hidden="true">&times;</span>';
            rmkmdlcntnt += '</button>';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="modal-body">';

            rmkmdlcntnt += '<div class="form-group">';
            rmkmdlcntnt += '<label for="nextcallpendingdate">Next Call Date</label>';
            rmkmdlcntnt += '<input type="text" class="form-control forminputs datemask" id="nextcallpendingdateasdasd_' + id + '" placeholder="" name="nextcallpendingdate_' + id + '"  value="' + nextcalldate + '" >';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="form-group">';
            rmkmdlcntnt += '<label for="reason">Reason</label><br>';
            rmkmdlcntnt += '<div id="reason_block_' + id + '">';
            rmkmdlcntnt += '<select class="form-control selremarks" id="pendingreasonid_' + id + '" name="pendingreasonid_' + id + '"  onchange="checkAdditionalRemarks(' + id + ',' + basepath + ')" >';

            rmkmdlcntnt += '<option value="0">Select</option>';
            $.each(remarksList, function(i, val) {
                rmkmdlcntnt += '<option value="' + remarksList[i].id + '" >' + remarksList[i].remarks_title + '</option>';
                //console.log(remarksList[i].remarks_title);
            });
            rmkmdlcntnt += '</select>';
            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '</div>';

            rmkmdlcntnt += '<div class="form-group" id="additionalremarksblck_' + id + '" style="display:none;">';
            rmkmdlcntnt += '<label for="additionalremarks">Remarks</label>';
            rmkmdlcntnt += '<textarea class="form-control" id="additionalremarks_' + id + '" placeholder="" style="resize:none;"> </textarea>';
            rmkmdlcntnt += '</div>';

            rmkmdlcntnt += '</div>';
            rmkmdlcntnt += '<div class="modal-footer d-flex justify-content-center">';
            rmkmdlcntnt += '<button class="btn color_theme pendingsavebtn "  data-rowpendingbtnid="' + id + '" style="color:#FFF;" id="pendingsavebtn_' + id + '" > <i class="fa fa-paper-plane-o "></i> OK </button>';
            rmkmdlcntnt += '</div>';



            //  $("#nextcallpendingdate_1").val(nextcalldate);

            $("#pending_details").html(rmkmdlcntnt);

            $("#pendingreasonid_" + id).val(remarksID);
            $("#additionalremarks_" + id).val(additionalremark);
            checkAdditionalRemarks(id, basepath);
            $("#pendingModal").modal({
                "backdrop": "static",
                "keyboard": true,
                "show": true
            });

            //$('.selectpicker').selectpicker();
            $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });



        } else {
            $("#nextcalldate_" + id).val("");
            $("#reasonid_" + id).val("");
            $("#remarksval_" + id).val("");
            $("#reason_" + id).text("");
            $("#remark_" + id).text("");
            $("#browseedit_" + id).css({ "display": "none" });
        }




    });



    $(document).on("click", ".pendingsavebtn", function(e) {
        e.preventDefault();
        var id = $(this).data("rowpendingbtnid");



        var nextcalldt = $("#nextcallpendingdate_" + id).val();
        var remarksid = $("#pendingreasonid_" + id).val();
        var remarksmastertext = $("#pendingreasonid_" + id).find("option:selected").text();
        var otherreamrks = $("#additionalremarks_" + id).val();

        $("#nextcallpendingdate_" + id).removeClass("errborder");
        $("#reason_block_" + id).removeClass("errborder");

        if (nextcalldt == "") {
            $("#nextcallpendingdate_" + id).addClass("errborder");
            return false;
        }
        if (remarksid == "0") {
            $("#reason_block_" + id).addClass("errborder");
            return false;
        }


        $("#nextcalldate_" + id).val(nextcalldt);
        $("#reasonid_" + id).val(remarksid);
        $("#remarksval_" + id).val(otherreamrks);
        $("#reason_" + id).text(remarksmastertext);
        $("#remark_" + id).text(otherreamrks);



        $('#pendingModal').modal('hide');
        $("#browseedit_" + id).css({ "display": "block" });

    });


    // save enquiry --

    $(document).on("click", ".updateenqbtn", function() {
        var idStr = $(this).attr('id');
        var idStrs = idStr.split('_');

        var oid = $("#ordermid_" + idStrs[1]).val();
        var ord_status = $("#orderstatus_" + idStrs[1]).val();
        var nxtcaldt = $("#nextcalldate_" + idStrs[1]).val();
        var reason_id = $("#reasonid_" + idStrs[1]).val();
        var additionlremk = $("#remarksval_" + idStrs[1]).val();

        var formDatas = {
            "oid": oid,
            "ostatus": ord_status,
            "ncaldt": nxtcaldt,
            "remarksid": reason_id,
            "additionlremk": additionlremk
        };

        $("#updateenqbtn_" + idStrs[1]).css({ "display": "none" });
        $("#enqloader_" + idStrs[1]).css({ "display": "block" });
        $.ajax({
            type: "POST",
            url: basepath + 'enquiry/enquiry_action',
            data: formDatas,
            dataType: 'json',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(result) {
                //console.log(result.msg_status);
                if (result.msg_status == 1) {
                    $("#updateenqbtn_" + idStrs[1]).css({ "display": "block" });
                    $("#enqloader_" + idStrs[1]).css({ "display": "none" });
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


    });



});

function checkAdditionalRemarks(rowid, basepath) {
    console.log(rowid);
    console.log(basepath);
    var remarksid = $("#pendingreasonid_" + rowid).val();


    var isadditionalrem = isAdditionalRemarsk(basepath, remarksid);
    if (isadditionalrem == "Y") {
        $("#additionalremarksblck_" + rowid).slideDown();
    } else {
        $("#additionalremarksblck_" + rowid).slideUp();
    }
}

function isAdditionalRemarsk(basepath, rid) {
    var res;
    $.ajax({
        type: "POST",
        url: basepath + 'enquiry/checkAdditionalReq',
        data: { rid: rid },
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        async: false,
        complete: function(response) {

            var data = JSON.parse(response.responseText);
            res = data.isadditionl;
            console.log(res);
        },
        error: function() {
            console.log("Error Found");
        }
    });
    return res;
}


function format(callback, id, basepath) {
    var orderId = id[1];
    $.ajax({
        url: basepath + 'enquiry/getEnquiryDetailRow',
        data: { oid: orderId },
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        complete: function(response) {
            var data = JSON.parse(response.responseText);

            console.log(data);

            // console.log(response);
            var thead = '<tr><th>Code</th><th>Test</th><th>Amount</th></tr>';
            tbody = '';

            $.each(data, function(i, datas) {
                tbody += '<tr>';
                tbody += '<td>' + datas.testcode + '</td>';
                tbody += '<td>' + datas.testname + '</td>';
                tbody += '<td>' + datas.test_amount + '</td>';
                tbody += '</tr>';
            });

            callback($('<div class="slider"><table class="table table-striped">' + thead + tbody + '</table></div>')).show();
        },
        error: function() {
            console.log("Error Found");
        }
    });
}


/*
function format(callback, id, basepath) {
    alert(callback);
    $.ajax({
        url: basepath + 'enquiry/getrecordset',
        dataType: "json",
        complete: function(response) {
            var data = JSON.parse(response.responseText);

            console.log(data);

            var thead = '',
                tbody = '';

            tbody += '<tr><td style="width:290px">Hello</td><td style="width:210px">Test</td><td style="width:100px">fgdfsgdf</td><td style="width:100px">mithji</td></tr>';
            callback($('<table>' + thead + tbody + '</table>')).show();
        },
        error: function() {
            // $('#output').html('Bummer: there was an error!');
        }
    });
}
*/