

$(document).ready(function(){
	var basepath = $("#basepath").val();


	 $('#facilitytitle').typeahead({

            source: function (query, result) {
                $.ajax({
                    url: basepath+"facility/getFacilityAutocomplete",
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


	$(document).on('submit','#FacilityForm',function(e){
		e.preventDefault();
		

		if(validateFacility())
		{
			$("#facilitymsg").css("display","none")
			$("#facilty_response_msg").html("")
			var formDataserialize = $("#FacilityForm" ).serialize();
			formDataserialize = decodeURI(formDataserialize);
			console.log(formDataserialize);

			var formData = new FormData($(this)[0]);
			$("#facilitysavebtn").addClass('nonclick');
			$.ajax({
				type: "POST",
				url: basepath+'facility/facility_action',
				dataType: "json",
				processData: false,
				contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
				data: formData,
				success: function (result) {
				$("#facilitysavebtn").removeClass('nonclick');		
				if(result.msg_status==1)
				{

					$("#facilty_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
					if(result.mode=="EDIT")
					{
						window.location.replace(basepath+"facility");
					}
					else
					{
						$("#FacilityForm")[0].reset();
					}
					
					
				}
				if(result.msg_status==0)
				{
					$("#facilty_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}

				
				}, 
				error: function (jqXHR, exception) {
					var msg = '';
					}
				}); /*end ajax call*/
		}

	});

	$(document).on('change','#faciltyicon',function(){
		$("#isFileUpload").val('Y');
	});


	$(document).on("click",".facilitystatus",function(){
		
		var uid = $(this).data("facilityid");
		var status = $(this).data("setstatus");
		
		$.ajax({
				type: "POST",
	            url:  basepath+'facility/StatusUpdate',
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
					}
			}); /*end ajax call*/
	});

});

function validateFacility()
{
	var title = $("#facilitytitle").val();
	
	$("#facilitymsg").css("display","block").text("");
	if(title=="")
	{
		$("#facilitymsg").text("Error : Enter title");
		return false;
	}
	return true;
}