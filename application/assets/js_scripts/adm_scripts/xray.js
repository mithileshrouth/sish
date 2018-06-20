$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#xraycenterForm',function(e){
		e.preventDefault();

		if(validateXRAY())
		{
           
            var formDataserialize = $("#xraycenterForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'xraycenter/xray_action';
            $("#xraysavebtn").css('display', 'none');
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
                        var addurl = basepath + "xraycenter/addxray";
                        var listurl = basepath + "xraycenter";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#xray_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#xraysavebtn").css({
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
    $(document).on("click", ".xraystatus", function() {
		var uid = $(this).data("xraycntid");
        var status = $(this).data("setstatus");
        var url = basepath + 'xraycenter/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateXRAY()
{
    var seltu = $("#seltu").val();
    var xraycntrname = $("#xraycntrname").val();
    var xraycntradd = $("#xraycntradd").val();
    var ltname = $("#ltname").val();
    var mobile = $("#mobile").val();
    var ltpass = $("#ltpass").val();

    $("#xraymsg").text("").css("dispaly", "none").removeClass("form_error");
	if(seltu=="")
	{
		$("#seltu").focus();
		$("#xraymsg")
		.text("Error : Select TU")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(xraycntrname=="")
    {
        $("#xraycntrname").focus();
        $("#xraymsg")
        .text("Error : Enter Name Organization Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
     if(xraycntradd=="")
    {
        $("#xraycntradd").focus();
        $("#xraymsg")
        .text("Error : Enter Organization Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
    if(ltname=="")
    {
        $("#ltname").focus();
        $("#xraymsg")
        .text("Error : Enter LT Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(mobile=="")
    {
        $("#mobile").focus();
        $("#xraymsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(ltpass=="")
    {
        $("#ltpass").focus();
        $("#xraymsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	
	return true;
}
