

$(document).ready(function(){
	var basepath = $("#basepath").val();


	 $('#areaname').typeahead({

            source: function (query, result) {
                $.ajax({
                    url: basepath+"area/getAreaAutocomplet",
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



	$(document).on('submit','#AreaForm',function(e){
		e.preventDefault();
		

		if(validateArea())
		{
			$("#areamsg").css("display","none")

			var formDataserialize = $("#AreaForm" ).serialize();
			formDataserialize = decodeURI(formDataserialize);
			console.log(formDataserialize);

			var formData = {formDatas: formDataserialize};
			var type = "POST"; //for creating new resource
			var urlpath = basepath+'area/area_action';
			$("#savebtn").addClass('nonclick');
			$.ajax({
				type: type,
	            url: urlpath,
	            data: formData,
	            dataType: 'json',
	            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
				success: function (result) {
				$("#savebtn").removeClass('nonclick');		
				if(result.msg_status==1)
				{

					$("#area_response_msg").html('<span class="glyphicon glyphicon-ok"></span> '+result.msg_data);
					if(result.mode=="EDIT")
					{
						window.location.replace(basepath+"area");
					}
					else
					{
						$("#AreaForm")[0].reset();
					}
					
					
				}
				if(result.msg_status==0)
				{
					$("#area_response_msg").html('<span class="glyphicon glyphicon-remove"></span> There is some problem.Try again');
				}

				
				}, 
				error: function (jqXHR, exception) {
					var msg = '';
					}
				}); /*end ajax call*/
		}

	});


	$(document).on("click",".areastatus",function(){
		
		var uid = $(this).data("areaid");
		var status = $(this).data("setstatus");
		
		$.ajax({
				type: "POST",
	            url:  basepath+'area/areaStatus',
	            data: {areaid:uid,setstatus:status},
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

function validateArea()
{
	var city = $("#city").val();
	var area = $("#areaname").val();
	$("#areamsg").css("display","block").text("");
	if(city=="0")
	{
		$("#areamsg").text("Error : Select City Name");
		return false;
	}
	if(area=="")
	{
		$("#areamsg").text("Error : Enter area name");
		return false;
	}
	return true;
}