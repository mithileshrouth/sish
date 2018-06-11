$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#dmcForm',function(e){
		e.preventDefault();

		if(validateDMC())
		{
            var formDataserialize = $("#dmcForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'dmc/dmc_action';
            $("#dmcsavebtn").css('display', 'none');
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
                        var addurl = basepath + "dmc/adddmc";
                        var listurl = basepath + "dmc";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#dmc_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#dmcsavebtn").css({
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
    $(document).on("click", ".dmcstatus", function() {
		var uid = $(this).data("dmcid");
        var status = $(this).data("setstatus");
        var url = basepath + 'dmc/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateDMC()
{
    var dmcname = $("#dmcname").val();
    var ltname = $("#ltname").val();
    var mobile = $("#mobile").val();
    var ltpass = $("#ltpass").val();

    $("#dmcmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(dmcname=="")
	{
		$("#dmcname").focus();
		$("#dmcmsg")
		.text("Error : Enter Organization Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(ltname=="")
    {
        $("#ltname").focus();
        $("#dmcmsg")
        .text("Error : Enter Name of LT")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	if(mobile=="")
    {
        $("#mobile").focus();
        $("#dmcmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	if(ltpass=="")
    {
        $("#ltpass").focus();
        $("#dmcmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
