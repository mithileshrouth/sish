$(document).ready(function () {
    var basepath = $("#basepath").val();
    
    $(document).on("submit","#centerTestdiscForm",function(event){
        event.preventDefault();

        if(validatDiscCenter())
        {
            var formDataserialize = $("#centerTestdiscForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'testdiscount/getTest',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                   $("#loadcenterTest").html(result);
                    $('.dataTables').DataTable();
                    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
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

        }

    });

    // For Listing
    $(document).on("submit","#discListFilterForm",function(event){
        event.preventDefault();

        if(validatDiscCenter())
        {
            var formDataserialize = $("#discListFilterForm" ).serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);
            var formData = {formDatas: formDataserialize};
            
            $(".dashboardloader").css("display","block");

            $.ajax({
                type: "POST",
                url: basepath+'testdiscount/getDiscountList',
                data: formData,
                dataType: 'html',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                   
                    $("#loadcenterTestDiscList").html(result);
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

        }

    });


    /*
        // Set Status
        $(document).on("click",".testdiscstatus",function(){ 
            var uid = $(this).data("discuntid");
            var status = $(this).data("setstatus");
            var url = basepath+'testdiscount/setStatus';
            setActiveStatus(uid,status,url);

        });
    */


    $(document).on("click",".discsavebtn",function(){
        var idStr = $(this).attr('id');
        var idStrs = idStr.split('_');
        
        var centerId = $("#cid_disc").val();
        var testID = $("#cTestId_"+idStrs[1]).val();
        var vFrom = $("#discValidfrm_"+idStrs[1]).val();
        var vUpto = $("#discValidUpto_"+idStrs[1]).val();
        var discRate = $("#discrate_"+idStrs[1]).val();

        var formDatas = {
                    "centerId":centerId,
                    "testID":testID,
                    "vFrom":vFrom,
                    "vUpto":vUpto,
                    "discRate":discRate
                };
        var validDt = validateDiscountDtl(vFrom,vUpto,discRate,idStrs[1]);
        if(validDt)
        {
            $.ajax({
                type: "POST",
                url: basepath+'testdiscount/discount_action',
                data: formDatas,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                success: function (result) {
                  if(result.msg_status==1)
                  {
                      $("#datadiscsavedbtn_"+idStrs[1]).css("display","block");
                      $("#discsavebtn_"+idStrs[1]).css("display","none");
                    
                       
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

       /*console.log(centerId);
       console.log(testID);
       console.log(vFrom);
       console.log(vUpto);
       console.log(discRate);*/

    });


   
});

function validatDiscCenter()
{
    var center = $("#test_center").val();
    if(center=="0")
    {
        $("#centerdisc_manual_err_msg").css("display","block").text("Error : Select center");
        return false;
    }
    $("#centerdisc_manual_err_msg").css("display","none").text("");
    return true;
}


function validateDiscountDtl(vFrom,vUpto,discRate,id)
{
    var date1 = new Date(vFrom);
    var date2 = new Date(vUpto);
       
    $("#discValidfrm_"+id).css("border","").attr("title","");
    $("#discValidUpto_"+id).css("border","").attr("title","");
    $("#discrate_"+id).css("border","").attr("title","");

    if(vFrom=="" || vFrom.length<=0)
    {
       $("#discValidfrm_"+id).css("border","2px solid #f24242").attr("title","Enter Valid From Date");
       return false;
    }

    if(vUpto=="" || vUpto.length<=0)
    {
       $("#discValidUpto_"+id).css("border","2px solid #f24242").attr("title","Enter Valid To Date");
       return false;
    }
    if(discRate=="" || discRate.length<=0)
    {
       $("#discrate_"+id).css("border","2px solid #f24242").attr("title","Enter Discount Rate");
       return false;
    }
    if(Date.parse(date1)>Date.parse(date2))
    {
       $("#discValidfrm_"+id).css("border","2px solid #f24242").attr("title","Invalid Valid From Date.Please check..");
       return false;
    }
    return true;

}