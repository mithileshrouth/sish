$(document).ready(function () {
    var basepath = $("#basepath").val();
 


    $(document).on("keydown","#departmentname",function(){
        var path = basepath+'department/getDepartAutocomplet';
        getAutoComplete('departmentname',path); // commonutilfunc.js
    });
    

    // Submit Center Form

    $(document).on("submit","#departmentForm",function(event){
        event.preventDefault();

        if(validateDepartment()){
            var checkurl = basepath+'department/checkDepartmentExist';
            var isexist = checkExistance('departmentname',checkurl,"department_err_msg");
            if(isexist)
            {
                return false;
            }
            else{
            $("#departmntsavebtn").addClass('nonclick');
            $("#department_loader").css("display","block");

            var formDataserialize = $("#departmentForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $.ajax({
                type: "POST",
                url: basepath+'department/department_action',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                    $("#department_loader").css("display","none");
                    $("#departmntsavebtn").removeClass('nonclick');

                    if(result.msg_status==1)
                    {
                        $("#suceessmodal").modal({"backdrop"  : "static",
                              "keyboard"  : true,
                              "show"      : true                    
                            });
                          var addurl = basepath+"department/adddepartment";
                          var listurl = basepath+"department";
                          $("#responsemsg").text(result.msg_data);
                          $("#response_add_more").attr("href", addurl);
                          $("#response_list_view").attr("href", listurl);

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
                       // alert(msg);  
                    }
                }); /*end ajax call*/
              }

            }


        }); /*end center submit*/




    // Set Status
    $(document).on("click",".departstatus",function(){
        var uid = $(this).data("departid");
        var status = $(this).data("setstatus");
        var url = basepath+'department/setStatus';
        setActiveStatus(uid,status,url);

    });

});




function validateDepartment()
{
    var departmentname = $("#departmentname").val();
    $("#department_err_msg").css("display","block").text("");
    if(departmentname=="" || departmentname.length==0)
    {
       $("#department_err_msg").text("Error : Enter Department Name");
       $("#departmentname").focus();
        return false;
    }
     $("#department_err_msg").css("display","none").text("");
    return true;
}

