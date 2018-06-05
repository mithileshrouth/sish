

$(document).ready(function(){
	var basepath = $("#basepath").val();


	 $('#pincode').typeahead({

            source: function (query, result) {
                $.ajax({
                    url: basepath+"pincode/getPincodeAutocomplet",
					data: {query:query},            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });


	 $(document).on("change","#state",function(){
	 	var stateid = $(this).val();
	 	populateDistrict(stateid,basepath);
	 });


	$(document).on('submit','#PincodeForm',function(e){
		e.preventDefault();
		

		if(validatePin())
		{
			$("#pincodemsg").css("display","none")

			var formDataserialize = $("#PincodeForm" ).serialize();
			formDataserialize = decodeURI(formDataserialize);
			console.log(formDataserialize);

			var formData = {formDatas: formDataserialize};
			var type = "POST"; //for creating new resource
			var urlpath = basepath+'pincode/pincode_action';
			$("#pincodesavebtn").addClass('nonclick');
			$.ajax({
				type: type,
	            url: urlpath,
	            data: formData,
	            dataType: 'json',
	            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
				success: function (result) {
				$("#pincodesavebtn").removeClass('nonclick');		
				if(result.msg_status==1)
				{

					$("#pincode_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
					if(result.mode=="EDIT")
					{
						window.location.replace(basepath+"pincode");
					}
					else
					{
						$("#PincodeForm")[0].reset();
					}
					
					
				}
				if(result.msg_status==0)
				{
					$("#pincode_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}

				
				}, 
				error: function (jqXHR, exception) {
					var msg = '';
					}
				}); /*end ajax call*/
		}

	});


	$(document).on("click",".pinstatus",function(){
		
		var uid = $(this).data("pinid");
		var status = $(this).data("setstatus");
		
		$.ajax({
				type: "POST",
	            url:  basepath+'pincode/setStatus',
	            data: {uid:uid,setstatus:status},
	            dataType: 'json',
	            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
				success: function (result) {
					if(result.msg_status=1)
					{
						location.reload();
					}
					
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
					   alert(msg);  
					}
			}); /*end ajax call*/
	});

});

function validatePin()
{
	var state = $("#state").val();
	var district = $("#district").val();
	var pin = $("#pincode").val();
	$("#pincodemsg").css("display","block").text("");
	if(state=="0")
	{
		$("#pincodemsg").text("Error : Select State");
		return false;
	}
	if(district=="0")
	{
		$("#pincodemsg").text("Error : Select District");
		return false;
	}
	if(pin=="")
	{
		$("#pincodemsg").text("Error : Enter Pin Code");
		return false;
	}
	return true;
}

function populateDistrict(stateid,base)
{
	$.ajax({
		type: "POST",
	    url: base+"pincode/getDistrict",
	    data: {stateid:stateid},
	    dataType: 'html',
	  	success: function (result) {
			$("#district_dropdown").html(result);
			$('.selectpicker').selectpicker();
		}, 
		error: function (jqXHR, exception) 
		{
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
				   alert(msg);  
		}
	}); /*end ajax call*/
}