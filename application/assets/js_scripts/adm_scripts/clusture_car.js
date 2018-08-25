$(document).ready(function(){
	var basepath = $("#basepath").val();
	$("#carclusture").focus();
	
	$(document).on('submit','#CarClsForm',function(e){
		e.preventDefault();
		
		if(validate())
		{
			
		
            var formDataserialize = $("#CarClsForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'clusture_car/clusturecar_action';
            $("#ccsavebtn").css('display', 'none');
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
                        var addurl = basepath + "clusture_car/addclusturecar";
                        var listurl = basepath + "clusture_car";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#cc_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#ccsavebtn").css({
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
    $(document).on("click", ".ccstatus", function() {
       
		var uid = $(this).data("ccid");
        var status = $(this).data("setstatus");
        var url = basepath + 'clusture_car/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validate()
{
	var carclusture = $("#carclusture").val();
	$("#ccmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(carclusture=="")
	{
		$("#carclusture").focus();
		$("#ccmsg")
		.text("Error : Enter Clusture/Car")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
