$(document).ready(function(){
	var basepath = $("#basepath").val();
	
	
	$(document).on('submit','#stsForm',function(e){
		e.preventDefault();

		if(validateSTS())
		{
            var formDataserialize = $("#stsForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'sts/sts_action';
            $("#stssavebtn").css('display', 'none');
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
                        var addurl = basepath + "sts/addsts";
                        var listurl = basepath + "sts";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
					else {
                        $("#sts_response_msg").text(result.msg_data);
                    }
					
                    $("#loaderbtn").css('display', 'none');
					
                    $("#stssavebtn").css({
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
    $(document).on("click", ".stsstatus", function() {
		var uid = $(this).data("stsid");
        var status = $(this).data("setstatus");
        var url = basepath + 'sts/setStatus';
        setActiveStatus(uid, status, url);

    });


      // check mobile no validity on keyup
    $(document).on("keyup", "#stsmobile", function() {

       var mobile = $("#stsmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#stsmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#stssavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'sts/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                     $("#stsmobile").focus();
                     $("#stsmsg").text(result.msg_data).addClass("form_error").css("display", "block");
      
                    } 
                    else {
                        $("#stssavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });  


 // check mobile no validity on blur
    $(document).on("blur", "#stsmobile", function() {

       var mobile = $("#stsmobile").val();
       var oldmobile = $("#oldmobile").val();
       var mode = $("#mode").val();
       $("#stsmsg").text("").css("dispaly", "none").removeClass("form_error");
       $("#stssavebtn").addClass('nonclick');


        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'sts/checkmobile';
          $.ajax({
                type: type,
                url: urlpath,
                data:{mobile:mobile,oldmobile:oldmobile,mode:mode},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                     $("#stsmobile").focus();
                     $("#stsmsg").text(result.msg_data).addClass("form_error").css("display", "block");
      
                    } 
                    else {
                        $("#stssavebtn").removeClass('nonclick');  
                       
                    }
                    
                 
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


    });

	

});

function validateSTS()
{
    var seltu = $("#seltu").val();
    var stlsname = $("#stsname").val();
	var stsmobile = $("#stsmobile").val();
    $("#stsmsg").text("").css("dispaly", "none").removeClass("form_error");

    if(seltu=="0")
    {
        $("#seltu").focus();
        $("#stsmsg")
        .text("Error : Select TU")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

	if(stlsname=="")
	{
		$("#stsname").focus();
		$("#stsmsg")
		.text("Error : Enter Name")
		.addClass("form_error")
        .css("display", "block");
		return false;
	}

    if(stsmobile=="")
    {
        $("#stsmobile").focus();
        $("#stsmsg")
        .text("Error : Enter Mobile No")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
	return true;
}
