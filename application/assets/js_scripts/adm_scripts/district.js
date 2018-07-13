$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#DistrictForm',function(e){
		e.preventDefault();
		
		if(validateDistrict())
		{
			
			$("#district").removeAttr("disabled");
            var formDataserialize = $("#DistrictForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'district/district_action';
            $("#distsavebtn").css('display', 'none');
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
                        var addurl = basepath + "district/adddistrict";
                        var listurl = basepath + "district";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#dist_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#distsavebtn").css({
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
    $(document).on("click", ".districtstatus", function() {
		var uid = $(this).data("disrictid");
        var status = $(this).data("setstatus");
        var url = basepath + 'district/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateDistrict()
{
    var state = $("#state").val();
	var districtname = $("#districtname").val();
    var codelength = $('#districtcode').val().length;

	$("#districtmsg").text("").css("dispaly", "none").removeClass("form_error");

     if(state=="0")
    {
        $("#state").focus();
        $("#districtmsg")
        .text("Error : Select State")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(districtname=="")
	{
		$("#districtname").focus();
		$("#districtmsg")
		.text("Error : Enter District Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(codelength!="3")
    {
        $("#districtcode").focus();
        $("#districtmsg")
        .text("Error : Enter Three Characters District Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
