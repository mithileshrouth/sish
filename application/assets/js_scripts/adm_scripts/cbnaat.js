$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#cbnatForm',function(e){
		e.preventDefault();

		if(validateCbnaat())
		{
           
            var formDataserialize = $("#cbnatForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'cbnaat/cbnaat_action';
            $("#cbnaatsavebtn").css('display', 'none');
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
                        var addurl = basepath + "cbnaat/addcbnaat";
                        var listurl = basepath + "cbnaat";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#cbnaat_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#cbnaatsavebtn").css({
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
    $(document).on("click", ".cbnaatstatus", function() {
		var uid = $(this).data("cbnaatid");
        var status = $(this).data("setstatus");
        var url = basepath + 'cbnaat/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateCbnaat()
{
    var seltu = $("#seltu").val();
    var cbnatcntrname = $("#cbnatcntrname").val();
    var cbnatcntradd = $("#cbnatcntradd").val();
    var ltname = $("#ltname").val();
    var mobile = $("#mobile").val();
    var ltpass = $("#ltpass").val();

    $("#cbnatmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(seltu=="0")
	{
		$("#seltu").focus();
		$("#cbnatmsg")
		.text("Error : Select TU")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(cbnatcntrname=="")
    {
        $("#cbnatcntrname").focus();
        $("#cbnatmsg")
        .text("Error : Enter Name Organization Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
     if(cbnatcntradd=="")
    {
        $("#cbnatcntradd").focus();
        $("#cbnatmsg")
        .text("Error : Enter Organization Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
    /*if(ltname=="")
    {
        $("#ltname").focus();
        $("#cbnatmsg")
        .text("Error : Enter LT Name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(mobile=="")
    {
        $("#mobile").focus();
        $("#cbnatmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(ltpass=="")
    {
        $("#ltpass").focus();
        $("#cbnatmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }*/
	
	
	return true;
}
