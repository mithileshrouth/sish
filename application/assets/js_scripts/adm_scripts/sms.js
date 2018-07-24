$(document).ready(function() {
	


              var mode=$("#mode").val();
            
              if (mode=='EDIT') {
	        var  selected_roles = $("#selected_role_dtl_id").val();

            var selected_attr = selected_roles.split(',');
            $("#sel_role").selectpicker("val", selected_attr);
           // $('#sel_role').selectpicker('refresh');

				}

var basepath = $("#basepath").val();
	$(document).on('submit','#SmsForm',function(e){
		e.preventDefault();

		if(validateSMS())
		{
            var formDataserialize = $("#SmsForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'smsconfig/sms_action';
            $("#smssavebtn").css('display', 'none');
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
                        var addurl = basepath + "smsconfig/addsms";
                        var listurl = basepath + "smsconfig";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#sms_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#smssavebtn").css({
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
});



function validateSMS()
{
    var smsphase = $("#smsphase").val();
    var sel_role = $("#sel_role").val();
  

    $("#smsmsg").text("").css("dispaly", "none").removeClass("form_error");
    if(smsphase=="0")
    {
        $("#smsphase").focus();
        $("#smsmsg")
        .text("Error : Select phase")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(sel_role=="")
    {
        $("#sel_role").focus();
        $("#smsmsg")
        .text("Error : Select role")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	

    
	return true;
}