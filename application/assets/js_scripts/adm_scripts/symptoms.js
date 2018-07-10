$(document).ready(function(){
	var basepath = $("#basepath").val();
	$("#symptom").focus();
	
	$(document).on('submit','#SYForm',function(e){
		e.preventDefault();
		
		if(validateSY())
		{
			
		
            var formDataserialize = $("#SYForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'symptoms/symptoms_action';
            $("#sysavebtn").css('display', 'none');
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
                        var addurl = basepath + "symptoms/addsymptoms";
                        var listurl = basepath + "symptoms";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#sy_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#sysavebtn").css({
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
    $(document).on("click", ".symtomstatus", function() {
       
		var uid = $(this).data("syid");
        var status = $(this).data("setstatus");
        var url = basepath + 'symptoms/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateSY()
{
	var symptom = $("#symptom").val();
	$("#symsg").text("").css("dispaly", "none").removeClass("form_error");
	if(symptom=="")
	{
		$("#symptom").focus();
		$("#symsg")
		.text("Error : Enter Symptom")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
