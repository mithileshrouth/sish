$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#nqppForm',function(e){
		e.preventDefault();

		if(validateNQPP())
		{
            var formDataserialize = $("#nqppForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'nqpp/nqpp_action';
            $("#nqppsavebtn").css('display', 'none');
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
                        var addurl = basepath + "nqpp/addnqpp";
                        var listurl = basepath + "nqpp";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#nqpp_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#nqppsavebtn").css({
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

function validateNQPP()
{
    var nqppname = $("#nqppname").val();
    var nqppmobile = $("#nqppmobile").val();
    var nqppadd = $("#nqppadd").val();
    var nqpppin = $("#nqpppin").val();
    var nqpppassword = $("#nqpppassword").val();

    $("#nqppmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(nqppname=="")
	{
		$("#nqppname").focus();
		$("#nqppmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(nqppmobile=="")
    {
        $("#nqppmobile").focus();
        $("#nqppmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	if(nqpppin=="")
    {
        $("#nqpppin").focus();
        $("#nqppmsg")
        .text("Error : Enter Pin Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(nqppadd=="")
    {
        $("#nqppadd").focus();
        $("#nqppmsg")
        .text("Error : Enter Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	
	if(nqpppassword=="")
    {
        $("#nqpppassword").focus();
        $("#nqppmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
