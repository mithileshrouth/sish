$(document).ready(function(){
	var basepath = $("#basepath").val();
	$('.selectpicker').selectpicker('deselectAll');
	
	$(document).on('submit','#TUForm',function(e){
		e.preventDefault();
		
		if(validateTU())
		{
			
		
            var formDataserialize = $("#TUForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'tuberculosisunit/tuunit_action';
            $("#tusavebtn").css('display', 'none');
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
                        var addurl = basepath + "tuberculosisunit/addtuunit";
                        var listurl = basepath + "tuberculosisunit";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#tu_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#tusavebtn").css({
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
    $(document).on("click", ".tustatus", function() {
		var uid = $(this).data("tuid");
        var status = $(this).data("setstatus");
        var url = basepath + 'tuberculosisunit/setStatus';
        setActiveStatus(uid, status, url);

    });

  // For Listing Tu Unit By block
    $(document).on("submit","#TuunitListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#TuunitListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'tuberculosisunit/getTuList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadTuList").html(result);
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

function validateTU()
{
    var block = $("#block").val();
	var tuunitname = $("#tuunitname").val();
	$("#tumsg").text("").css("dispaly", "none").removeClass("form_error");

    if(block=="0")
    {
        $("#block").focus();
        $("#tumsg")
        .text("Error : Select Block")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

	if(tuunitname=="")
	{
		$("#tuunitname").focus();
		$("#tumsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}
	return true;
}
