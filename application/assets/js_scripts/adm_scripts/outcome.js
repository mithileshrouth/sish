$(document).ready(function(){
	var basepath = $("#basepath").val();
	$("#outcome").focus();
	
	$(document).on('submit','#OTForm',function(e){
		e.preventDefault();
		
		if(validateOT())
		{
			
		
            var formDataserialize = $("#OTForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'outcome/outcome_action';
            $("#otsavebtn").css('display', 'none');
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
                        var addurl = basepath + "outcome/addoutcome";
                        var listurl = basepath + "outcome";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#ot_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#otsavebtn").css({
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
    $(document).on("click", ".outcomestatus", function() {
       
		var uid = $(this).data("otid");
        var status = $(this).data("setstatus");
        var url = basepath + 'outcome/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateOT()
{
	var outcome = $("#outcome").val();
	$("#symsg").text("").css("dispaly", "none").removeClass("form_error");
	if(outcome=="")
	{
		$("#outcome").focus();
		$("#otmsg")
		.text("Error : Enter Outcome")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
