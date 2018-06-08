$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#BlockForm',function(e){
		e.preventDefault();
		
		if(validateBlock())
		{
			
			$("#district").removeAttr("disabled");
            var formDataserialize = $("#BlockForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'block/block_action';
            $("#blcksavebtn").css('display', 'none');
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
                        var addurl = basepath + "block/addblock";
                        var listurl = basepath + "block";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#blck_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#blcksavebtn").css({
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
    $(document).on("click", ".blockstatus", function() {
		var uid = $(this).data("blockid");
        var status = $(this).data("setstatus");
        var url = basepath + 'block/setStatus';
        setActiveStatus(uid, status, url);

    });

	

});

function validateBlock()
{
	var blockname = $("#blockname").val();
	$("#blockmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(blockname=="")
	{
		$("#blockname").focus();
		$("#blockmsg")
		.text("Error : Enter Block Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
