$(document).ready(function(){
	var basepath = $("#basepath").val();
	$("#outcome").focus();
	
	$(document).on('submit','#IncentiveForm',function(e){
		e.preventDefault();
		
		if(validateIncentive())
		{
			
		
            var formDataserialize = $("#IncentiveForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'incentive/incentive_action';
            $("#insavebtn").css('display', 'none');
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
                        var addurl = basepath + "incentive/addIncentive";
                        var listurl = basepath + "incentive";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#ins_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#insavebtn").css({
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
    $(document).on("click", ".incentivestatus", function() {
       
		var uid = $(this).data("insid");
        var status = $(this).data("setstatus");
        var url = basepath + 'incentive/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateIncentive()
{ 
	var amount = $("#amount").val();
	$("#insmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(amount=="")
	{
		$("#amount").focus();
		$("#insmsg")
		.text("Error : Enter Amount")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
