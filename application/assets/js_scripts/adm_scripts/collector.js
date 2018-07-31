$(document).ready(function() {
    var basepath = $("#basepath").val();

    var mode;
    mode = $("#collectorMode").val();
    if (mode == "EDIT") {
        var hubselectedval = $("#hubassignedval").val();
        var selected_attr = hubselectedval.split(',');
        $("#assignedhub").dropdown("set selected", selected_attr);
    }


    $(document).on("keydown", ".pinsearch", function() {
        var path = basepath + 'pincode/getPincodeAutocomplet';
        getAutoComplete('collectorspin', path); // commonutilfunc.js
    });

    $(document).on("keyup", ".removeerr", function() {
        removeValidation();
    });

    $(document).on('submit', '#CollectorForm', function(e) {
        e.preventDefault();


        if (validateCollector()) {

            //   $("#pincodemsg").css("display", "none")

            var formDataserialize = $("#CollectorForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'collector/collector_action';
            $("#collectorsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "collector/addcollector";
                        var listurl = basepath + "collector";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } else {
                        $("#collector_response_msg").text(result.msg_data);
                    }
                    $("#loaderbtn").css('display', 'none');
                    $("#collectorsavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
        }



    });

    // Set Status
    $(document).on("click", ".collectorstatus", function() {
        var uid = $(this).data("colctrid");
        var status = $(this).data("setstatus");
        var url = basepath + 'collector/setStatus';
        setActiveStatus(uid, status, url);

    });


    // Ajax response
    $(document).on("click", "#collectorid", function() {
        var masterid = $(this).data("collectorid");
        var data = {
            "collectorid": masterid
        };
        var path = basepath + "collector/gethubassigneddetail";
        $.post(
            path,
            data,
            function(response) {
                if (response) {

                    var hublist = "";
                    hublist += "<ul>";
                    for (var i = 0; i < response.collectordetail.length; i++) {
                        hublist += "<li>" + response.collectordetail[i].name + "</li>";
                    }
                    hublist += "</ul>";
                    $("#collectorname").text(response.collectorname.name);
                    $("#hubassigned_detail").html(hublist);

                    $("#collectorhubmodal").modal({
                        "backdrop": "static",
                        "keyboard": true,
                        "show": true
                    });

                }
            }
        );
    });







});


function removeValidation() {
    $("#collectorcodemsg").text("").removeClass("form_error");
    $(".removeerr").removeClass("form_input_err");
}

function validateCollector() {
    var collectorname = $("#collectorname").val();
    var collectorcontact = $("#collectorcontact").val();
    var collectoremail = $("#collectoremail").val();
    var collectoraddress = $("#collectoraddress").val();

    var collectorspin = $("#collectorspin").val();
    var assignedhub = $("#assignedhub").val();
    var email_validate = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;


    $("#collectorcodemsg").text("").css("dispaly", "none").removeClass("form_error");
    $(".removeerr").removeClass("form_input_err");

    if (collectorname == "" || collectorname.length <= 0) {
        $("#collectorcodemsg")
            .text("Error : Enter collector name")
            .addClass("form_error")
            .css("display", "block");

        $("#collectorname").addClass("form_input_err");

        return false;
    }

    if (collectorcontact == "") {
        $("#collectorcodemsg")
            .text("Error : Enter collector contact no")
            .addClass("form_error")
            .css("display", "block");
        $("#collectorcontact").addClass("form_input_err");
        return false;
    }
    if (collectoremail.length > 0) {
        if (email_validate.test(collectoremail) == false) {
            $("#collectorcodemsg")
                .text("Error : Invalid email.Please check...")
                .addClass("form_error")
                .css("display", "block");
            $("#collectoremail").addClass("form_input_err");
            return false;
        }
    }
    if (collectoraddress.length <= 0) {
        $("#collectorcodemsg")
            .text("Error : Enter collector address")
            .addClass("form_error")
            .css("display", "block");
        $("#collectoraddress").addClass("form_input_err");
        return false;
    }

    if (collectorspin == "") {
        $("#collectorcodemsg")
            .text("Error : Enter collector pincode")
            .addClass("form_error")
            .css("display", "block");
        $("#collectorspin").addClass("form_input_err");
        return false;
    }

    if (assignedhub.length <= 0) {
        $("#collectorcodemsg")
            .text("Error : No hub selected for collector.Please select atleast one")
            .addClass("form_error")
            .css("display", "block");

        return false;
    }
    return true;
}