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



     // For Listing Block by District
    $(document).on("submit","#BlockListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#BlockListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'block/getBlockList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadBlockList").html(result);
                    $('.dataTables').DataTable();
                
                    $(".dashboardloader").css("display","none");
                    calculateamount();
                }, 
                error: function (jqXHR, exception) {
                      var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                       // alert(msg);  
                    }
                }); /*end ajax call*/

       

    });

	

});

function validateBlock()
{
    var district = $("#district").val();
	var blockname = $("#blockname").val();
    var codelength = $('#blockcode').val().length;

	$("#blockmsg").text("").css("dispaly", "none").removeClass("form_error");

     if(district=="0")
    {
        $("#district").focus();
        $("#blockmsg")
        .text("Error : Select District")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(blockname=="")
	{
		$("#blockname").focus();
		$("#blockmsg")
		.text("Error : Enter Block Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(codelength!="2")
    {
        $("#blockcode").focus();
        $("#blockmsg")
        .text("Error : Enter Two Characters Block Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
