$(document).ready(function(){
	var basepath = $("#basepath").val();
	$('.selectpicker').selectpicker('deselectAll');
	
	$(document).on('submit','#cordForm',function(e){
		e.preventDefault();

		if(validateCORD())
		{
            var formDataserialize = $("#cordForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'coordinator/coordinator_action';
            $("#cordsavebtn").css('display', 'none');
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
                        var addurl = basepath + "coordinator/addcoordinator";
                        var listurl = basepath + "coordinator";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#cord_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#cordsavebtn").css({
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
    $(document).on("click", ".cordstatus", function() {
		var uid = $(this).data("cordid");
        var status = $(this).data("setstatus");
        var url = basepath + 'coordinator/setStatus';
        setActiveStatus(uid, status, url);

    });

  // check mobile no validity on keyup
    $(document).on("keyup", "#cordmobile", function() {

       var mobile = $("#cordmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#cordmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#cordsavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'coordinator/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                    // $("#cordmobile").focus();
                     $("#cordmsg").text(result.msg_data).addClass("form_error").css("display", "block");
                     return false;
      
                    } 
                    else {
                        $("#cordsavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });  


   // check mobile no validity on blur
    $(document).on("blur", "#cordmobile", function() {

       var mobile = $("#cordmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#cordmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#cordsavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'coordinator/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                    // $("#cordmobile").focus();
                     $("#cordmsg").text(result.msg_data).addClass("form_error").css("display", "block");
      
                    } 
                    else {
                        $("#cordsavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });


        /* On select district select block*/
    
   $(document).on("change","#sel_dist",function(event){
        event.preventDefault();

           var formDataserialize = $("#CoordinatorListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
    $.ajax({
    type: "POST",
    url: basepath+'coordinator/getBlock',
    data: formData,
    
    success: function(data){
        $("#blockview").html(data);
        $('.selectpicker').selectpicker({dropupAuto: false});
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



    });/*end ajax call*/

    });
  

     // For Listing Coordinator by Block
    $(document).on("submit","#CoordinatorListForm",function(event){
        event.preventDefault();

           var formDataserialize = $("#CoordinatorListForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'coordinator/getCoordinatorList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadCoordinatorList").html(result);
                    $('.dataTables').DataTable();
                   
                    $(".dashboardloader").css("display","none");
                    
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

function validateCORD()
{
    var cordname = $("#cordname").val();
    var cordmobile = $("#cordmobile").val();
    var cordadd = $("#cordadd").val();
    var cordblock = $("#cordblock").val();
    var cordpin = $("#cordpin").val();
    var cordpassword = $("#cordpassword").val();
    var cordgender = $("#cordgender").val();

    $("#cordmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(cordname=="")
	{
		$("#cordname").focus();
		$("#cordmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(cordgender=="")
    {
        $("#cordgender").focus();
        $("#cordmsg")
        .text("Error : Select Gender")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    if(cordmobile=="")
    {
        $("#cordmobile").focus();
        $("#cordmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
    if(cordblock=="0")
    {
        $("#cordblock").focus();
        $("#cordmsg")
        .text("Error : Select Block")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(cordpin=="")
    {
        $("#cordpin").focus();
        $("#cordmsg")
        .text("Error : Enter Pin Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(cordadd=="")
    {
        $("#cordadd").focus();
        $("#cordmsg")
        .text("Error : Enter Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(cordpassword=="")
    {
        $("#cordpassword").focus();
        $("#cordmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
