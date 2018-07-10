$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#nqppForm',function(e){
		e.preventDefault();

		if(validateNQPP())
		{
            var formDataserialize = $("#nqppForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'nqpp/nqpp_action';
            $("#nqppsavebtn").css('display', 'none');
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
                        var addurl = basepath + "nqpp/addnqpp";
                        var listurl = basepath + "nqpp";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#nqpp_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#nqppsavebtn").css({
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
	
	//import
   
$(document).on('click','#nqppimpsavebtn',function(e){
        e.preventDefault();

    $("#nqppimpsavebtn").addClass('nonclick');
    $("#nqpp_loader").css("display", "block");  
       
 var form = $('#nqppimportForm')[0];
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: basepath + 'nqpp/nqppimport_action',
        dataType: "json",
        processData: false,
        contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
        success: function(result) {
            $("#nqpp_loader").css("display", "none");
            $("#nqppimpsavebtn").removeClass('nonclick');

            if (result.msg_status == 1) {

                $("#suceessmodal").modal({
                    "backdrop": "static",
                    "keyboard": true,
                    "show": true
                });
                var addurl = basepath + "nqpp/importnqpp";
                var listurl = basepath + "nqpp";
                $("#responsemsg").text(result.msg_data);
                $("#response_add_more").attr("href", addurl);
                $("#response_list_view").attr("href", listurl);

            }

        },
        error: function(jqXHR, exception) {
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


	// Set Status
    $(document).on("click", ".cordstatus", function() {
		var uid = $(this).data("cordid");
        var status = $(this).data("setstatus");
        var url = basepath + 'coordinator/setStatus';
        setActiveStatus(uid, status, url);

    });

      // check mobile no validity on keyup
    $(document).on("keyup", "#nqppmobile", function() {

       var mobile = $("#nqppmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#nqppmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#nqppsavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'nqpp/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                     //$("#nqppmobile").focus();
                     $("#nqppmsg").text(result.msg_data).addClass("form_error").css("display", "block");
      
                    } 
                    else {
                        $("#nqppsavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });  

  // check mobile no validity on blur
    $(document).on("blur", "#nqppmobile", function() {

       var mobile = $("#nqppmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#nqppmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#nqppsavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'nqpp/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                     $("#nqppmobile").focus();
                     $("#nqppmsg").text(result.msg_data).addClass("form_error").css("display", "block");
      
                    } 
                    else {
                        $("#nqppsavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });   





	

}); //end of document ready

function validateNQPP()
{
    var nqppname = $("#nqppname").val();
    var nqppmobile = $("#nqppmobile").val();
    var nqppadd = $("#nqppadd").val();
    var nqppblock = $("#nqppblock").val();
    var nqpppin = $("#nqpppin").val();
    var nqpppassword = $("#nqpppassword").val();
    var nqppgender = $("#nqppgender").val();

    $("#nqppmsg").text("").css("dispaly", "none").removeClass("form_error");
	if(nqppname=="")
	{
		$("#nqppname").focus();
		$("#nqppmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(nqppmobile=="")
    {
        $("#nqppmobile").focus();
        $("#nqppmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	 if(nqppgender=="")
    {
        $("#nqppgender").focus();
        $("#nqppmsg")
        .text("Error : Select Gender")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
    if(nqppblock=="0")
    {
        $("#nqppblock").focus();
        $("#nqppmsg")
        .text("Error : Select Block")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(nqpppin=="")
    {
        $("#nqpppin").focus();
        $("#nqppmsg")
        .text("Error : Enter Pin Code")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	if(nqppadd=="")
    {
        $("#nqppadd").focus();
        $("#nqppmsg")
        .text("Error : Enter Address")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	
	
	if(nqpppassword=="")
    {
        $("#nqpppassword").focus();
        $("#nqppmsg")
        .text("Error : Enter Password")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
