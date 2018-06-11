$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#cordForm',function(e){
		e.preventDefault();

		if(validateCORD())
		{
            var formDataserialize = $("#cordForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'coordinator/coordinator_action';
            $("#cordsavebtn").css('display', 'none');
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
                        var addurl = basepath + "coordinator/addcoordinator";
                        var listurl = basepath + "coordinator";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#cord_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#cordsavebtn").css({
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
    $(document).on("click", ".cordstatus", function() {
		var uid = $(this).data("cordid");
        var status = $(this).data("setstatus");
        var url = basepath + 'coordinator/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateCORD()
{
    var cordname = $("#cordname").val();
    var cordmobile = $("#cordmobile").val();
    var cordadd = $("#cordadd").val();
    var cordpin = $("#cordpin").val();
    var cordpassword = $("#cordpassword").val();

    $("#cordmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(cordname=="")
	{
		$("#cordname").focus();
		$("#cordmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(cordmobile=="")
    {
        $("#cordmobile").focus();
        $("#cordmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	if(cordpin=="")
    {
        $("#cordpin").focus();
        $("#cordmsg")
        .text("Error : Enter Pin Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(cordadd=="")
    {
        $("#cordadd").focus();
        $("#cordmsg")
        .text("Error : Enter Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(cordpassword=="")
    {
        $("#cordpassword").focus();
        $("#cordmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}