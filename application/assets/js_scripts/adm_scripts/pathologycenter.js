var currentStep = 1;
$(document).ready(function () {
    var basepath = $("#basepath").val();
    var facilityRow = 0;
    var centerUploadRow = 0;

    $('.li-nav').click(function () {

        var $targetStep = $($(this).attr('step'));
        currentStep = parseInt($(this).attr('id').substr(7));
      //  alert(currentStep);

        if (!$(this).hasClass('disabled')) {
            $('.li-nav.active').removeClass('active');
            $(this).addClass('active');
            $('.setup-content').hide();
            $targetStep.show();
        }
    });

    $('#navStep1').click();

  
    // close days click
    $(document).on("click",".closedaysrdio",function(){
        $('.closedaysrdio').not(this).prop('checked', false);  
        resetAllDaysCheckbox();
    });


    // Add Facility Detail
    $(document).on('click','.addfacilitydtl',function(){
        facilityRow++;
        $.ajax({
            type: "POST",
            url: basepath+'pathologycenter/adddetailfacility',
            dataType: "html",
            data: {rowNo:facilityRow},
            success: function (result) {

                $("#facility_detail table").css("display","block"); 
                $("#facility_detail table tbody").append(result);  
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
    }); // End Document Detail

    $(document).on('click','.facilitydelRow',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        $("tr#rowfacilityRow_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
    });

   


    // Add center Uploads Detail
    $(document).on('click','.centeruploaddocs',function(){
        centerUploadRow++;
        $.ajax({
            type: "POST",
            url: basepath+'pathologycenter/addcenteruploaddocs',
            dataType: "html",
            data: {rowNo:centerUploadRow},
            success: function (result) {

                $("#upload_centerdocs_detail table").css("display","block"); 
                $("#upload_centerdocs_detail table tbody").append(result);   

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
    }); // End Document Detail


    $(document).on('click','.centerUploaddelDocType',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        $("tr#rowcenterUploadDoc_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
    });
    
    $(document).on('change','.centerUploadfileName',function(){
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var IDSNo = rowDtlNo[1]+"_"+rowDtlNo[2];
        //var inpID = "#isChangedFile_"+rowDtlNo[1]+"_"+rowDtlNo[2];
         
        var newfileName = $("#centerUploadfileName_"+IDSNo)[0].files[0].name;
        var prvVal = $("#centerUploadprvFilename_"+IDSNo).val();
        if(newfileName!=prvVal)
        {
            $("#centerUploadisChangedFile_"+IDSNo).val('Y');
        }

    });

    $(document).on("keydown","#centerpincode",function(){
        var path = basepath+'pathologycenter/getPincodeAutocomplet';
        getAutoComplete('centerpincode',path); // commonutilfunc.js
    });
    $(document).on("blur","#centerpincode",function(){
        var pincode = $(this).val();
        getLocationDetails(basepath,pincode);
    });

    // Submit Center Form

    $(document).on("submit","#pathologycenterForm",function(event){
        event.preventDefault();

        if(validateUploadDocs()){

            $("#centersavebtn").addClass('nonclick');
            $("#centerloader").css("display","block");

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: basepath+'pathologycenter/pathologycenter_action',
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function (result) {
                    $("#centerloader").css("display","none");
                    $("#centersavebtn").removeClass('nonclick');

                    if(result.msg_status==1)
                    {
                      
                        $("#suceessmodal").modal({"backdrop"  : "static",
                              "keyboard"  : true,
                              "show"      : true                    
                            });
                          var addurl = basepath+"pathologycenter/addpathologycenter";
                          var listurl = basepath+"pathologycenter";
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


        }); /*end center submit*/


        $(document).on("click",".centerDtl",function(){
            var id = $(this).data("centerid");
            var mode = $(this).data("centerdtlmode");
            var center = $(this).data("centername");
            var path = basepath+"pathologycenter/getDetailCenterModal";
            getDetailModalView(id,mode,center,path);
        });
   


    // Set Status
    $(document).on("click",".centerstatus",function(){
        var uid = $(this).data("pinid");
        var status = $(this).data("setstatus");
        var url = basepath+'pathologycenter/setStatus';
        setActiveStatus(uid,status,url);

    });

});


function getDetailModalView(id,mode,info,path)
{
     $.ajax({
            type: "POST",
            url: path,
            dataType: "html",
            data: {mid:id,mode:mode,info:info},
            success: function (result) {
               $("#detailListmodalView").html(result);
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

function getLocationDetails(basepath,pincode)
{
    $.ajax({
            type: "POST",
            url: basepath+'pathologycenter/getLocationDetails',
            dataType: "json",
            data: {pincode:pincode},
            success: function (result) {
                
                $("#centerpincode").val(result.pincode);
                $("#centerdist").val(result.districtname);
                $("#centerstate").val(result.statename);
                $("#centercountry").val(result.countryname);

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


function resetAllDaysCheckbox()
{
    $('.closedaysrdio').each(function() {
         var timDtlID = $(this).attr("id");
        var getTimId = timDtlID.split("_");

        if ($(this).is(":checked")) {
            $("#opHours_"+getTimId[1]).val("").attr("readonly",true);
            $("#closeHours_"+getTimId[1]).val("").attr("readonly",true);
            $("#timeOpIcon_"+getTimId[1]).css("pointer-events", "none");
            $("#timeCloseIcon_"+getTimId[1]).css("pointer-events", "none");
        }
        else
        {
            $("#opHours_"+getTimId[1]).attr("readonly",false);
            $("#closeHours_"+getTimId[1]).attr("readonly",false);
            $("#timeOpIcon_"+getTimId[1]).css("pointer-events", "");
            $("#timeCloseIcon_"+getTimId[1]).css("pointer-events", "");
        }

    });
}

    

function step1Next() {
    //You can make only one function for next, and inside you can check the current step
    if (validatePrimaryStep()) {//Insert here your validation of the first step
        currentStep += 1;
        $('#navStep' + currentStep).removeClass('disabled');
        $('#navStep' + currentStep).click();
    }
}

function prevStep() {
    //Notice that the btn prev not exist in the first step
    currentStep -= 1;
    $('#navStep' + currentStep).click();
}

function step2Next() {
    if (validateLocationStep()) 
    {
        $('#navStep3').removeClass('disabled');
        $('#navStep3').click();
    }
}

function step3Next() {
  // if (validateCenTimStep())
    if (true)
    {
        $('#navStep4').removeClass('disabled');
        $('#navStep4').click();
    }
}


function validatePrimaryStep()
{
    var centername = $("#centername").val();
    var centercontact = $("#centercontact").val();
    var alternateno = $("#alternateno").val();
    var centeremail = $("#centeremail").val();
    var email_validate = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var phone_valid = /^([0-9]{10})$/;

    $("#c_primarysteperr").css("display","block").text("");

    if(centername=="" || centername.length==0)
    {
       $("#c_primarysteperr").text("Error : Enter Center Name");
       $("#centername").focus();
        return false;
    }
    if(centercontact=="")
    {
       $("#c_primarysteperr").text("Error : Enter Center Contact No");
       $("#centercontact").focus();
       return false;
    }

    if(phone_valid.test(centercontact)==false){
       $("#c_primarysteperr").text("Error : Contact No is not valid ");
       $("#centercontact").focus();
       return false;
    }

    if(alternateno.length>0)
    {
        if(phone_valid.test(alternateno)==false){
            $("#c_primarysteperr").text("Error : Alternate No is not valid ");
            $("#alternateno").focus();
            return false;
        }
    }
    if(centeremail.length>0)
    {
        if(email_validate.test(centeremail)==false){
            $("#c_primarysteperr").text("Error : Email is not valid ");
            $("#centeremail").focus();
            return false;
        }
    }
     $("#c_primarysteperr").css("display","none").text("");
   /* if(!detailDocumentValidation('facilitydocType','facilityuserFileName'))
    {
        return false;
    }*/

    if(!detailFacilityValid())
    {
        return false;
    }

    
     return true;
}



function detailFacilityValid()
{
    var isValid = true;
    $('.facilityTitle').each(function() 
    {
        var title_id = $(this).attr('id');
        var titleTypeIDS = title_id.split("_");
        var titleVal = $(this).val();
        console.log(titleVal);

        var tdIDS = "#facilityTitle_"+titleTypeIDS[1]+"_"+titleTypeIDS[2];
        $(tdIDS).removeAttr("title");
        $(tdIDS).css("background","inherit");

        if(titleVal=="0")
        {
           
            $(tdIDS).attr("title","Select Facility");
            $(tdIDS).css("background","#FFD2D2");

            isValid = false;
        }

      
    });

    return isValid;
}


function validateLocationStep()
{
    var centeraddress = $("#centeraddress").val();
    var centerpincode = $("#centerpincode").val();
    var pin_test = /^([0-9]{6})$/;
    $("#c_locationerr").css("display","block").text("");

    if(centeraddress=="" || centeraddress.length==0)
    {
       $("#c_locationerr").text("Error : Enter Center Address");
       $("#centeraddress").focus();
        return false;
    }
    if(centerpincode=="")
    {
       $("#c_locationerr").text("Error : Enter Pincode No");
       $("#centerpincode").focus();
       return false;
    }

    if(pin_test.test(centerpincode)==false){
       $("#c_locationerr").text("Error : Pincode is not valid ");
       $("#centerpincode").focus();
       return false;
    }
    
    $("#c_locationerr").css("display","none").text("");
    return true;
}

function validateCenTimStep()
{
    var isvalid = true;
    $('.closedaysrdio').each(function() {
        var timDtlID = $(this).attr("id");
        var getTimId = timDtlID.split("_");
        $(".opHours").removeAttr("placeholder").css("border","");
        $(".closeHours").removeAttr("placeholder").css("border","");

        if ($(this).is(":checked")) {
            $("#opHours_"+getTimId[1]).val("").attr("readonly",true);
            $("#closeHours_"+getTimId[1]).val("").attr("readonly",true);
            $("#timeOpIcon_"+getTimId[1]).css("pointer-events", "none");
            $("#timeCloseIcon_"+getTimId[1]).css("pointer-events", "none");
        }
        else
        {
            if($("#opHours_"+getTimId[1]).val()=="")
            {
               $("#opHours_"+getTimId[1]).val("").attr("placeholder","Enter opening Time").css("border","1px solid #f66161");
                isvalid = false;
                return isvalid;
            }
            if($("#closeHours_"+getTimId[1]).val()=="")
            {
               $("#closeHours_"+getTimId[1]).val("").attr("placeholder","Enter closing Time").css("border","1px solid #f66161");
                isvalid = false;
                return isvalid;
            }
        }

        //alert(isvalid);
    });
    return isvalid;
}

function validateUploadDocs()
{
    var isValid = true;
    if(!detailDocumentValidation('centerUploaddocType','centerUploaduserFileName'))
    {
        isValid =  false;
    }

    return isValid;
}

