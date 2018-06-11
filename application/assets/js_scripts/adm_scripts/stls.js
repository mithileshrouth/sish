$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#stlsForm',function(e){
		e.preventDefault();
		
		if(validateSTLS())
		{
            var formDataserialize = $("#stlsForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'stls/stls_action';
            $("#stlssavebtn").css('display', 'none');
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
                        var addurl = basepath + "stls/addsts";
                        var listurl = basepath + "stls";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#stls_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#stlssavebtn").css({
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
    $(document).on("click", ".stlsstatus", function() {
		var uid = $(this).data("stlsid");
        var status = $(this).data("setstatus");
        var url = basepath + 'stls/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateSTLS()
{
    var stlsname = $("#stlsname").val();
	var stlsmobile = $("#stlsmobile").val();
    $("#stlsmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(stlsname=="")
	{
		$("#stlsname").focus();
		$("#stlsmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(stlsmobile=="")
    {
        $("#stsmobile").focus();
        $("#stlsmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
