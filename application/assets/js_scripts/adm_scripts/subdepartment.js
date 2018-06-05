$(document).ready(function () {
    var basepath = $("#basepath").val();
 


    $(document).on("keydown","#subdepartname",function(){
        var path = basepath+'subdepartment/getSubDepartAutocomplet';
        getAutoComplete('subdepartname',path); // commonutilfunc.js
    });
    

    // Submit Center Form

    $(document).on("submit","#subDepartForm",function(event){
        event.preventDefault();

        if(validateSubDepartment()){
            //var checkurl = basepath+'department/checkDepartmentExist';
           // var isexist = checkExistance('departmentname',checkurl,"department_err_msg");
            var isexist = false;
            if(isexist)
            {
                return false;
            }
            else{
            $("#subdepartsavebtn").addClass('nonclick');
            $("#sub_depart_loader").css("display","block");

            var formDataserialize = $("#subDepartForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $.ajax({
                type: "POST",
                url: basepath+'subdepartment/subdepartment_action',
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                    $("#sub_depart_loader").css("display","none");
                    $("#subdepartsavebtn").removeClass('nonclick');

                    if(result.msg_status==1)
                    {
                        $("#suceessmodal").modal({"backdrop"  : "static",
                              "keyboard"  : true,
                              "show"      : true                    
                            });
                          var addurl = basepath+"subdepartment/addsubdepartment";
                          var listurl = basepath+"subdepartment";
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
    $(document).on("click",".subdepartstatus",function(){
        var uid = $(this).data("subdepartid");
        var status = $(this).data("setstatus");
        var url = basepath+'subdepartment/setStatus';
        setActiveStatus(uid,status,url);

    });

});




function validateSubDepartment()
{
    var department = $("#sel_department").val();
    var subdepartment= $("#subdepartname").val();
    $("#sub_depart_errmsg").css("display","block").text("");

    if(department=="0")
    {
       $("#sub_depart_errmsg").text("Error : Select Department");
       $("#sel_department").focus();
        return false;
    }
    if(subdepartment=="" || subdepartment.length==0)
    {
       $("#sub_depart_errmsg").text("Error : Enter Sub Department Name");
       $("#departmentname").focus();
        return false;
    }
     $("#sub_depart_errmsg").css("display","none").text("");
    return true;
}

/*
function checkExistanceSubDepart(path)
{
    var depart = $("#sel_department").val();
    var subdepart = $("#subdepartname").val();
    var isexist = false;
    $.ajax({
        url : path,
        type: "POST",
        dataType:'json',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
        data : {depart:depart,subdepart:subdepart},
        success: function(result) {
            if(result.msg_status==1)
            {
                $("#"+res).css("display","block").text(result.msg_data);
                isexist = true;
            }
            else
            {
                 $("#"+res).css("display","none").text("");
                isexist = false;
            }
              
            },
            async:false
            
        });
    
    return isexist; 

}
*/