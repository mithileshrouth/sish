$(document).ready(function() {
    var basepath = $("#basepath").val();

    var mode;

    mode = $("#hubMode").val();
    if (mode == "EDIT") {
        var pinselectedval = $("#pinassignedval").val();
        var selected_attr = pinselectedval.split(',');
        $("#assignedpincode").dropdown("set selected", selected_attr);
    }


    $(document).on("keydown", ".pinsearch", function() {
        var path = basepath + 'pincode/getPincodeAutocomplet';
        getAutoComplete('hubpincode', path); // commonutilfunc.js
    });

    $(document).on("keyup", ".removeerr", function() {
        removeValidation();
    });

    $(document).on('submit', '#HubForm', function(e) {
        e.preventDefault();


        if (validateHub()) {
            //   $("#pincodemsg").css("display", "none")

            var formDataserialize = $("#HubForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'hub/hub_action';
            $("#hubsavebtn").css('display', 'none');
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
                        var addurl = basepath + "hub/addhub";
                        var listurl = basepath + "hub";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } else {
                        $("#hub_response_msg").text(result.msg_data);
                    }
                    $("#loaderbtn").css('display', 'none');
                    $("#hubsavebtn").css({
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
    $(document).on("click", ".hubstatus", function() {
        var uid = $(this).data("hubmid");
        var status = $(this).data("setstatus");
        var url = basepath + 'hub/setStatus';
        setActiveStatus(uid, status, url);

    });


    // Ajax response
    $(document).on("click", "#hubmasterid", function() {
        var masterid = $(this).data("hubmid");
        var data = {
            "hubid": masterid
        };
        var path = basepath + "hub/gethubassignedpindetail";
        $.post(
            path,
            data,
            function(response) {
                if (response) {

                    var pinlist = "";
                    pinlist += "<ul>";
                    for (var i = 0; i < response.hubdetail.length; i++) {
                        pinlist += "<li>" + response.hubdetail[i].pincode + "</li>";
                    }
                    pinlist += "</ul>";
                    $("#hubname").text(response.hubname.name);
                    $("#pinassigned_detail").html(pinlist);

                    $("#hubpinlistmodal").modal({
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
    $("#hubcodemsg").text("").removeClass("form_error");
    $(".removeerr").removeClass("form_input_err");
}

function validateHub() {
    var hubname = $("#hubname").val();
    var hubcontact = $("#hubcontact").val();
    var hubemail = $("#hubemail").val();
    var hubaddress = $("#hubaddress").val();

    var hubpincode = $("#hubpincode").val();
    var assignedpincode = $("#assignedpincode").val();
    var email_validate = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;


    $("#hubcodemsg").text("").css("dispaly", "none").removeClass("form_error");
    $(".removeerr").removeClass("form_input_err");

    if (hubname == "" || hubname.length <= 0) {
        $("#hubcodemsg")
            .text("Error : Enter hub name")
            .addClass("form_error")
            .css("display", "block");

        $("#hubname").addClass("form_input_err");

        return false;
    }

    if (hubcontact == "") {
        $("#hubcodemsg")
            .text("Error : Enter hub contact no")
            .addClass("form_error")
            .css("display", "block");
        $("#hubcontact").addClass("form_input_err");
        return false;
    }
    if (hubemail.length > 0) {
        if (email_validate.test(hubemail) == false) {
            $("#hubcodemsg")
                .text("Error : Invalid email.Please check...")
                .addClass("form_error")
                .css("display", "block");
            $("#hubemail").addClass("form_input_err");
            return false;
        }
    }
    if (hubaddress.length <= 0) {
        $("#hubcodemsg")
            .text("Error : Enter hub address")
            .addClass("form_error")
            .css("display", "block");
        $("#hubaddress").addClass("form_input_err");
        return false;
    }

    if (hubpincode == "") {
        $("#hubcodemsg")
            .text("Error : Enter hub pincode")
            .addClass("form_error")
            .css("display", "block");
        $("#hubpincode").addClass("form_input_err");
        return false;
    }

    if (assignedpincode.length <= 0) {
        $("#hubcodemsg")
            .text("Error : No pincode selected for hub")
            .addClass("form_error")
            .css("display", "block");

        return false;
    }
    return true;
}