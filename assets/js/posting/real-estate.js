//POSTING SCRIPT

$(document).ready(function () {

    $("#sp-form-post").on("keypress", function (event) {
      if (event.which === 13) {
        event.preventDefault();
        //$("#spPostSubmitReal").click();
      }
    });

    var hostUrl = window.location.host; 
    var hostSchema = window.location.protocol;
    var MAINURL = hostSchema+'//'+hostUrl;
// THIS IS IMPORTANT SCRIPT FOR CUSTOM FIELDS
    function readCustomFields($form, $postid) {   
        var allinputs = $form.find(".spPostField");
        var formfields = new Array();


        var inputs = null;
        allinputs.each(function (i, e) {
            var l = $("label[for='" + e.id + "']").text();
            var n = $(e).attr("name");  
            var v = $(e).val();
            var f = $(e).data("filter");
            inputs = {spPostFieldLabel: l, spPostFieldName: n, spPostFieldValue: v, spPostings_idspPostings: $postid, spCategories_idspCategory: $(".spCategories_idspCategory").val(), spPostFieldIsFilter: f, editing_: postedit};
            formfields.push(inputs);
        });
        return formfields;
}

var modal = document.getElementById("myModals");

var span = document.getElementById("spPostSubmitProclose");

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$("#spPostSubmitRealPro").on("click", function (){
  modal.style.display = "block";  
})

$("#spSaveDraft, #spPostSubmitReal").on("click", function () {

    
    var isDraft = 0;
    if($(this).data("is-draft") !== undefined){
      isDraft = $(this).data("is-draft");
    }
    if ($(this).hasClass("editing"))
        postedit = true;
    else

        postedit = false;

    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var hiddenidforimg  = document.getElementById("hiddenidforimg").value;
    var filtertype = ($(".realDataFrmType1:checked").attr("data-filter") != undefined) ? $(".realDataFrmType1:checked").attr("data-filter") : 0;
    var $form = $("#sp-form-post"); 
    
    if(hiddenidforimg != "" && document.getElementById("spPostingPropStatus_") !== undefined 
      &&  (document.getElementById("spPostingPropStatus_").value == "Sold" || document.getElementById("spPostingPropStatus_").value == "Expired")
    ){
      callRealestateAjax($form, filtertype, isDraft);
      return false;
    }
    
    
    if(idspprofile != ""){
        var title = $("#spPostingTitle").val();
        var country = $('#spUserCountry option:selected').val();
        var state = $('#spUserState option:selected').val();  

        var lotsize = $('#Lot_Size_Formate option:selected').val();
        var proptype = $('#spPostingPropertyType option:selected').val();
        var rentDura = $('#spPostDurstion_ option:selected').val();
        var address = document.getElementById("spPostingAddress_").value;

        if(filtertype == 1){

            var bedRoom     = document.getElementById("spPostingBedroom_").value;

            var bathRoom    = document.getElementById("spPostingBathroom_").value;

//var bedRoomsgsk   = document.getElementById("spPostingPropertyType").value;

            var bedRoomsgsk = "Land/lot";
            if(bedRoomsgsk=="Land/lot"){ 
                var bedRoom     = 1;

                var bathRoom    = 1;
            }

            var price   = 1;
            var squareFoot  = document.getElementById("spPostingSqurefoot_").value;

            var listId  = 1;


            var taxYear     = document.getElementById("spPostTaxYear_").value;    
            var taxAmt  = document.getElementById("spPostTaxAmt_").value;    
            var unitNum     = document.getElementById("spPostUnitNum_").value;    
            var squareFoot  = document.getElementById("spPostingSqurefoot_").value;    
            var price   = document.getElementById("spPostingPrice").value;    
            var bathRoom    = document.getElementById("spPostingBathroom_").value;    
            var bedRoom     = document.getElementById("spPostingBedroom_").value;    
            var postalCode  = document.getElementById("spPostingPostalcode_").value;
            var yearBuilt   = document.getElementById("spPostingYearBuilt_").value; 
            var Descrip = document.getElementById("spPostingNotes").value;
            var addPic      = document.getElementById("postingpic_realestate").files.length; 
            var uploadedPic = $("#dvPreview").find("span").length;
            var sellerNum = document.getElementById("seller_mnumber_").value;
            if( (isDraft == 0) && ((title == "") || (address == "") || (proptype == "Select property type") || (postalCode == "") || (yearBuilt == "") || (bedRoom == "") || (bathRoom == "") || (price == "") || (squareFoot == "")  || (addPic == 0 && uploadedPic == 0)||(Descrip ==" ") || (sellerNum =="")))
            {

                if(title == ""){
                    $(".lbl_1").addClass("label_error");
                    $(".lbl_1").text("Please Enter Title");

                }else{ 
                    $(".lbl_1").removeClass("label_error");
                    $(".lbl_1").text("Title");
                }


                if (address == ""){

                    $(".lbl_16").addClass("label_error");
                    $(".lbl_16").text("Please Enter Address");
                }else{
                    $(".lbl_16").removeClass("label_error");
                    $(".lbl_16").text("Address");
                }

                if (proptype == "Select property type"){
                    $(".spPostingPropertyType_").addClass("label_error");
                    $(".spPostingPropertyType_").text("Please Select property type");
                }else{
                    $(".spPostingPropertyType_").removeClass("label_error");
                    $(".spPostingPropertyType_").text(" property type");
                } 
                if(postalCode == ""){ 

                    $(".lbl_4").addClass("label_error");
// $(".lbl_4").text("Please Enter Postalcode");
                }else{  
                    $(".lbl_4").removeClass("label_error");
                }

                if(yearBuilt == ""){
                    $(".lbl_5").addClass("label_error");
                }else{
                    $(".lbl_5").removeClass("label_error");
                }
                if(bedRoom == ""){
                    $(".lbl_6").addClass("label_error");
                }else{
                    $(".lbl_6").removeClass("label_error");
                }

                if(sellerNum == ""){
                    $(".sellerMob").addClass("label_error");
                }else{
                    $(".sellerMob").removeClass("label_error");
                }

                if(bathRoom == ""){

                    $(".lbl_7").addClass("label_error");
                }else{
                    $(".lbl_7").removeClass("label_error"); 
                }

                if(price == ""){
//alert('Please Fill Required Field .');

                    $(".lbl_9").addClass("label_error");
                }else{
                    $(".lbl_9").removeClass("label_error");
                }
                if(squareFoot == ""){
//alert('Please Fill Required Field .'); 

                    $(".lbl_10").addClass("label_error");
                }else{
                    $(".lbl_10").removeClass("label_error");
                }

                if (Descrip ==" ") {

                    $(".lbl_17").addClass("label_error");
                    $("#error_1").text("Enter Description");

                } else{
                    $(".lbl_17").removeClass("label_error");
                    $("#error_1").text("");
                }



                if(addPic == 0 && uploadedPic == 0){

                    $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos1.");
                }else{
                    $(".lbl_pic_error_mcg").text("");
                }             

                swal("Please fill the required fields");


                return false;

            } else if(isDraft == 1 && title == "") {
              $(".lbl_1").addClass("label_error");
              $(".lbl_1").text("Please Enter Title");
              swal("Please fill the required fields");
              return false;
            }
            
            var errorExists = false;
            if((isDraft == 0) || (isDraft == 1 && yearBuilt !== "")){
              if(yearBuilt >= 1800 && yearBuilt <= new Date().getFullYear()){
                $(".lbl_5").removeClass("label_error");
              }
              else{
                errorExists = true;
                $(".lbl_5").addClass("label_error");
              }
            }
            if(taxYear !== ""){
              if(taxYear >= 1800 && taxYear <= 9999){
                $(".lbl_13").removeClass("label_error");              
              }
              else{
                errorExists = true;
                $(".lbl_13").addClass("label_error");
              }            
            }
            if((isDraft == 0) || (isDraft == 1 && squareFoot !== "")){
              if(squareFoot >= 1 && squareFoot <= 99999){
                $(".lbl_10").removeClass("label_error");
              }
              else{
                errorExists = true;
                $(".lbl_10").addClass("label_error");
              }
            }
        }else{

//console.log("RENT");
            var roomRent = $('#spRoomRent_ option:selected').val();
            var proValid = $("#proValidation").val();
            var pro_name = $("#pro_profilename").val();
            var pro_highlight = $("#pro_highlights").val();
            var pro_category = $("#pro_category").val();
            var squreFoot   = document.getElementById("spPostingSqurefoot_").value;
            var bedRoom     = document.getElementById("spPostingBedroom_").value;
            var bathRoom    = document.getElementById("spPostingBathroom_").value;
            var servicChrg  = document.getElementById("spPostingServicChrg_").value;
            var cleanCharg  = document.getElementById("spPostingCleaningChrg_").value;
            var rentMnth    = document.getElementById("spPostRentalMonth_").value;
            var rentWeak    = document.getElementById("spPostRentalWeek_").value;
            var Descrip = document.getElementById("spPostingNotes").value;
            var availFrom   = document.getElementById("spPostAvailFrom_").value;
            var availTo     = document.getElementById("spPostAvailTo_").value;
            var uploadedPic = $("#dvPreview").find("span").length; 
            var addPic      = document.getElementById("postingpic_realestate").files.length;
            var postDiscnt   = document.getElementById("spPostDepositAmt_").value;
            
            if((isDraft == 0) && ( (title == "") || (address == "") || (rentDura == "Select rent duration") || (proptype == "Select property type") || (squreFoot == "") || (bedRoom == "")  || (bathRoom == "")  || (postDiscnt == "") || (rentMnth == "") || (rentWeak == "") || (servicChrg == "") || (cleanCharg =="") || (Descrip =="") || (addPic == 0 && uploadedPic == 0) || availFrom == "" || availTo == "" ) || (proValid == 1 && (pro_name == "" || pro_highlight == "" || pro_category == "")))
                {
                    if(title == ""){
                        $(".lbl_1").addClass("label_error");
                        $(".lbl_1").text("Please Enter Title");

                    }else{ 
                        $(".lbl_1").removeClass("label_error");
                        $(".lbl_1").text("Title");
                    }


                    if (address == ""){

                        $(".lbl_16").addClass("label_error");
                        $(".lbl_16").text("Please Enter Address");
                    }else{
                        $(".lbl_16").removeClass("label_error");
                        $(".lbl_16").text("Address");
                    }


                    if (rentDura == "Select rent duration"){
                        $(".spPostDurstion_").addClass("label_error");
                        $(".spPostDurstion_").text("Please Select rent duration");
                    }else{
                        $(".spPostDurstion_").removeClass("label_error");
                        $(".spPostDurstion_").text("Rent duration");
                    }



                    if (proptype == "Select property type"){
                        $(".spPostingPropertyType_").addClass("label_error");
                        $(".spPostingPropertyType_").text("Please Select property type");
                    }else{
                        $(".spPostingPropertyType_").removeClass("label_error");
                        $(".spPostingPropertyType_").text(" property type");
                    }

                    if(squreFoot == ""){
                        $(".lbl_4").addClass("label_error");
                    }else{
                        $(".lbl_4").removeClass("label_error");
                    }

                    if(bedRoom == ""){
                        $(".lbl_5").addClass("label_error");
                    }else{
                        $(".lbl_5").removeClass("label_error");
                    }

                    if(bathRoom == ""){
                        $(".lbl_6").addClass("label_error");
                    }else{
                        $(".lbl_6").removeClass("label_error");
                    }

                    if(postDiscnt == ""){
                        $(".lbl_9").addClass("label_error");
                    }else{
                        $(".lbl_9").removeClass("label_error");
                    }

                    if(rentMnth == ""){
                        $(".lbl_10").addClass("label_error");
                    }else{
                        $(".lbl_10").removeClass("label_error");
                    }

                    if(rentWeak == ""){
                        $(".lbl_11").addClass("label_error");
                    }else{
                        $(".lbl_11").removeClass("label_error");
                    }


                    if(servicChrg == ""){
                        $(".lbl_12").addClass("label_error");
                    }else{
                        $(".lbl_12").removeClass("label_error");
                    }


                    if(cleanCharg == ""){
                        $(".lbl_13").addClass("label_error");
                    }else{
                        $(".lbl_13").removeClass("label_error");
                    }
                    if(addPic == 0 && uploadedPic == 0){

                        $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos2.");
                    }else{
                        $(".lbl_pic_error_mcg").text("");
                    }  

                    if (Descrip ==" ") {

                        $(".lbl_17").addClass("label_error");
                        $("#error_1").text("Enter Description");

                    } else{
                        $(".lbl_17").removeClass("label_error");
                        $("#error_1").text("");
                    }

                    if (availFrom == "") {
                        $(".lbl_7").addClass("label_error");
                    } else{
                        $(".lbl_7").removeClass("label_error");
                    }

                    if (availTo == "") {
                        $(".lbl_8").addClass("label_error");

                    } else{
                        $(".lbl_8").removeClass("label_error");
                    }

                    if (proValid == 1 && pro_name == "") {
                        $(".proname").addClass("label_error");
                        $(".proname").text("Please Enter Professional Profile Name");

                    } else{
                        $(".proname").removeClass("label_error");
                        $(".proname").text("Professional Profile Name");
                    }
                    
                    if (proValid == 1 && pro_highlight == "") {
                        $(".carrerhighlight").addClass("label_error");
                        $(".carrerhighlight").text("Please Enter Career Highlights");

                    } else{
                        $(".carrerhighlight").removeClass("label_error");
                        $(".carrerhighlight").text("Career Highlights");
                    }
                    
                    if (proValid == 1 && pro_category == "") {
                        $(".careercat").addClass("label_error");
                        $(".careercat").text("Please Select Career Category");

                    } else{
                        $(".careercat").removeClass("label_error");
                        $(".careercat").text("Career Category");
                    }
                    
                    swal("Please fill the required fields");
                    return false;

                } else if((isDraft == 1) && (title == "")){
                  $(".lbl_1").addClass("label_error");
                  $(".lbl_1").text("Please Enter Title");
                  swal("Please fill the required fields");
                  return false;
                }
            
            if(roomRent == "Rent Entire Place"){
// var postDiscnt   = document.getElementById("spPostDepositAmt_").value;


            }else{
            //
// rent a room
                var agencyFee   = $('#spPostAgencyFee_ option:selected').val();
// var agencyFee    = document.getElementById("spPostAgencyFee_").value;

            }
        }
        
        if(errorExists === true){
          swal("Please correct the invalid inputs");
          return false;
        }
        
        var houseStyle  = 1;
        var postAddres  = document.getElementById("spPostingAddress_").value;
//alert(postAddres);

        if(houseStyle == ""){
//alert('Please Fill Required Field .');
            swal('Please Fill the Required');
            $(".lbl_15").addClass("label_error");
        }else{
            $(".lbl_15").removeClass("label_error");
            if(postAddres == "" && isDraft == 0){
//alert('Please Fill Required Field .'); 
                swal('Please Fill the Required');

                $(".lbl_16").addClass("label_error");
            }else{

                $(".lbl_16").removeClass("label_error");
                
                callRealestateAjax($form, filtertype, isDraft);
            }
        
        }
        
        return false;

    }else{ 
      $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
});

function callRealestateAjax($form, filtertype, isDraft = 0){
  //ADD HERE ALL INFORMATION
  modal.style.display = "none";
  $(".loadbox").css({ display: "block" });
  var allData = new FormData();
  
  $.each($form.serializeArray(), function(k, v){
    allData.append("basic["+v.name+"]", v.value);                    
  });

  var Highlights = "";
  $(".highlit .btn-group>ul>li input:checked").each(function(k,obj){
      Highlights=Highlights+$(obj).val()+",";
  });
  Highlights = Highlights.substring(0,Highlights.length - 1);
  allData.append("Highlights", Highlights)
  
  $(".postingimg").each(function(i , e) {
    var isCheckeed = $('#'+$(e).attr("data-name")+':checked').val()?true:false;
    if(isCheckeed == true){
      spFeatureimg = 1;
    }else{
      spFeatureimg = 0;
    }

    allData.append('spFeatureimg[]', spFeatureimg);
    allData.append('spPostingPic[]', $('input[type=file]')[0].files[i]); 

  });
  
  if($("#seller_picture").length > 0) {
    allData.append('seller_picture', $('input[type=file]')[1].files[0]);  
  }
  allData.append('isDraft', isDraft);
  $.ajax({url: MAINURL+"/post-ad/dopostrealstate.php", data: allData, type: 'POST', contentType: false, processData: false})
  .fail(function () {
      $(btn).effect("shake");
  }).done(function (data) {
    data = afterAjax(data);
    if(data !== false){
      var title = "Posted Successfully";
      if(isDraft == 1){
        title = "Draft saved Successfully";
      }
      swal({"title": title}, function(){
        var postType = "Rent";
        if(filtertype == 1){
          postType = "Sell";
        }
        window.location.href = "posting.php?postid="+data.postid+"&postType="+postType;
      });
    }
  }).always(function () {

  });
}

function afterAjax(data){
  $(".loadbox").css({ display: "none" });
  try{
    data = JSON.parse(data);
  }
  catch(err){
    swal(data.error);
    return false;
  }
  if(data.error !== undefined){
    swal(data.error);
    return false;
  }
  return data;
}

/*$("#spSaveDraft").on("click", function () {
    var visibility = $("#spPostingVisibility").val();
    $("#spPostingVisibility").val("0");

    var sendUrl = MAINURL;

//alert();

    if ($(this).hasClass("editing"))
        postedit = true;
    else
        postedit = false;

    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var $form = $("#sp-form-post");
    if(idspprofile != ""){
        var title = document.getElementById("spPostingTitle").value;
        var country = $('#spUserCountry option:selected').val();
        var state = $('#spUserState option:selected').val();

        if(title == ""){
            $(".lbl_1").addClass("label_error");
        }else{
            $(".lbl_1").removeClass("label_error");
            if(country == 0){
                $(".lbl_2").addClass("label_error");
            }else{
                $(".lbl_2").removeClass("label_error");
                if(state == 0){
                    $(".lbl_3").addClass("label_error");
                }else{
                    $(".lbl_3").removeClass("label_error");
                    var type = 0;
                    var filtertype = $(".realDataFrmType1").attr("data-filter");
                    if(filtertype == 1){
//console.log("SELL"); // this is sell section
                        var postalCode  = document.getElementById("spPostingPostalcode_").value;
                        var yearBuilt   = document.getElementById("spPostingYearBuilt_").value;
                        var bedRoom     = document.getElementById("spPostingBedroom_").value;
                        var bathRoom    = document.getElementById("spPostingBathroom_").value;

// var basement    = document.getElementById("spPostBasement_").value;

                        var price       = document.getElementById("spPostingPrice").value;
                        var squareFoot  = document.getElementById("spPostingSqurefoot_").value;
                        var unitNum     = 1;
                        var taxAmt      = document.getElementById("spPostTaxAmt_").value;
                        var taxYear     = document.getElementById("spPostTaxYear_").value;
// var listId      = document.getElementById("spPostListId_").value;

                        var hiddenidforimg  = document.getElementById("hiddenidforimg").value;
                        if(hiddenidforimg==''){ 
                            var addPic      = document.getElementById("postingpic_realestate").files.length;
                        }else{
                            var addPic      = 1;
                        }

                        if(postalCode == ""){
                            $(".lbl_4").addClass("label_error");
                        }else{
                            $(".lbl_4").removeClass("label_error");
                            if(yearBuilt == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(bedRoom == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(bathRoom == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");


// if(basement == ""){
// $(".lbl_8").addClass("label_error");
// }else{
// $(".lbl_8").removeClass("label_error");

                                        if(price == ""){
                                            $(".lbl_9").addClass("label_error");
                                        }else{
                                            $(".lbl_9").removeClass("label_error");
                                            if(squareFoot == ""){
                                                $(".lbl_10").addClass("label_error");
                                            }else{
                                                $(".lbl_10").removeClass("label_error");
                                                if(unitNum == ""){
                                                    $(".lbl_11").addClass("label_error");
                                                }else{
                                                    $(".lbl_11").removeClass("label_error");
                                                    if(taxAmt == ""){
                                                        $(".lbl_12").addClass("label_error");
                                                    }else{
                                                        $(".lbl_12").removeClass("label_error");
                                                        if(taxYear == ""){
                                                            $(".lbl_13").addClass("label_error");
                                                        }else{
                                                            $(".lbl_13").removeClass("label_error");
                                                            if(addPic == 0){
                                                                $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos3.");
                                                            }else{
                                                                $(".lbl_pic_error_mcg").text("");
                                                                type = 1;

                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        var roomRent = $('#spRoomRent_ option:selected').val();
                        if(roomRent == "Rent Entire Place"){
                            var squreFoot   = document.getElementById("spPostingSqurefoot_").value;
                            var bedRoom     = document.getElementById("spPostingBedroom_").value;
                            var bathRoom    = document.getElementById("spPostingBathroom_").value;
                            var availFrom   = document.getElementById("spPostAvailFrom_").value;
                            var availTo     = document.getElementById("spPostAvailTo_").value;
                            var postDiscnt  = document.getElementById("spPostDepositAmt_").value;
                            var rentPerMonth    = document.getElementById("spPostRentalMonth_").value;
                            var rentPerWek  = document.getElementById("spPostRentalWeek_").value;
                            var servCharg   = document.getElementById("spPostingServicChrg_").value;
                            var cleanCharg  = document.getElementById("spPostingCleaningChrg_").value;
                            var addPic      = document.getElementById("postingpic_realestate").files.length;

                            if(squreFoot == ""){
                                $(".lbl_4").addClass("label_error");
                            }else{
                                $(".lbl_4").removeClass("label_error");
                                if(bedRoom == ""){
                                    $(".lbl_5").addClass("label_error");
                                }else{
                                    $(".lbl_5").removeClass("label_error");
                                    if(bathRoom == ""){
                                        $(".lbl_6").addClass("label_error");
                                    }else{
                                        $(".lbl_6").removeClass("label_error");
                                        if(availFrom == ""){
                                            $(".lbl_7").addClass("label_error");
                                        }else{
                                            $(".lbl_7").removeClass("label_error");
                                            if(availTo == ""){
                                                $(".lbl_8").addClass("label_error");
                                            }else{
                                                $(".lbl_8").removeClass("label_error");
                                                if(postDiscnt == ""){
                                                    $(".lbl_9").addClass("label_error");
                                                }else{
                                                    $(".lbl_9").removeClass("label_error");
                                                    if(rentPerMonth == ""){
                                                        $(".lbl_10").addClass("label_error");
                                                    }else{
                                                        $(".lbl_10").removeClass("label_error");
                                                        if(rentPerWek == ""){
                                                            $(".lbl_11").addClass("label_error");
                                                        }else{
                                                            $(".lbl_11").removeClass("label_error");
                                                            if(servCharg == ""){
                                                                $(".lbl_12").addClass("label_error");
                                                            }else{
                                                                $(".lbl_12").removeClass("label_error");
                                                                if(cleanCharg == ""){
                                                                    $(".lbl_13").addClass("label_error");
                                                                }else{
                                                                    $(".lbl_13").removeClass("label_error");
                                                                    if(addPic == 0){
//$(".lbl_pic_error").addClass("label_error");
                                                                        $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos4.");
                                                                    }else{
                                                                        $(".lbl_pic_error_mcg").text("");
//$(".lbl_pic_error").removeClass("label_error");
                                                                        type = 1;

                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }else{
// rent a room
                            var squreFoot   = document.getElementById("spPostingSqurefoot_").value;
                            var bedRoom     = document.getElementById("spPostingBedroom_").value;
//alert(bedRoom);
                            var bathRoom    = document.getElementById("spPostingBathroom_").value;
                            var availFrom   = document.getElementById("spPostAvailFrom_").value;
                            var availTo     = document.getElementById("spPostAvailTo_").value;
                            var agencyFee   = document.getElementById("spPostAgencyFee_").value;
                            var servicChrg  = document.getElementById("spPostingServicChrg_").value;
                            var cleanCharg  = document.getElementById("spPostingCleaningChrg_").value;
                            var rentMnth    = document.getElementById("spPostRentalMonth_").value;
                            var rentWeak    = document.getElementById("spPostRentalWeek_").value;
                            var rentNight   = document.getElementById("spPostRentalNight_").value;
                            var addPic      = document.getElementById("postingpic_realestate").files.length;

                            if(squreFoot == ""){
                                $(".lbl_4").addClass("label_error");
                            }else{
                                $(".lbl_4").removeClass("label_error");
                                if(bedRoom == ""){
                                    $(".lbl_5").addClass("label_error"); 
                                }else{
                                    $(".lbl_5").removeClass("label_error");
                                    if(bathRoom == ""){
                                        $(".lbl_6").addClass("label_error");
                                    }else{
                                        $(".lbl_6").removeClass("label_error");
                                        if(availFrom == ""){
                                            $(".lbl_7").addClass("label_error");
                                        }else{
                                            $(".lbl_7").removeClass("label_error");
                                            if(availTo == ""){
                                                $(".lbl_8").addClass("label_error");
                                            }else{
                                                $(".lbl_8").removeClass("label_error");
                                                if(agencyFee == ""){
                                                    $(".lbl_9").addClass("label_error");
                                                }else{
                                                    $(".lbl_9").removeClass("label_error");
                                                    if(servicChrg == ""){
                                                        $(".lbl_10").addClass("label_error");
                                                    }else{
                                                        $(".lbl_10").removeClass("label_error");
                                                        if(cleanCharg == ""){
                                                            $(".lbl_11").addClass("label_error");
                                                        }else{
                                                            $(".lbl_11").removeClass("label_error");
                                                            if(rentMnth == ""){
                                                                $(".lbl_12").addClass("label_error");
                                                            }else{
                                                                $(".lbl_12").removeClass("label_error");
                                                                if(rentWeak == ""){
                                                                    $(".lbl_13").addClass("label_error");
                                                                }else{
                                                                    $(".lbl_13").removeClass("label_error");
                                                                    if(rentNight == ""){
                                                                        $(".lbl_14").addClass("label_error");
                                                                    }else{
                                                                        $(".lbl_14").removeClass("label_error");
                                                                        if(addPic == 0){
//$(".lbl_pic_error").addClass("label_error");
                                                                            $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos5.");
                                                                        }else{
                                                                            $(".lbl_pic_error_mcg").text("");
//$(".lbl_pic_error").removeClass("label_error");
                                                                            type = 1;

                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
//console.log(type);
                    if(type == 1){
                        var houseStyle = "";
                        if(document.getElementById("spPostingHouseStyle_") !== null){
                          houseStyle  = document.getElementById("spPostingHouseStyle_").value;
                        }
                        var postAddres  = document.getElementById("spPostingAddress_").value;
                        /*if(houseStyle == ""){
                            $(".lbl_15").addClass("label_error");
                        }else{*/
                            //$(".lbl_15").removeClass("label_error");
                            /*if(postAddres == ""){
                                $(".lbl_16").addClass("label_error");
                            }else{
                                $(".lbl_16").removeClass("label_error");
                                //ADD HERE ALL INFORMATION
                                $(".loadbox").css({ display: "block" });
                                term = $form.serializeArray();
                                var allData = new FormData();
                                //url = $form.attr("action");
                                $.each($form.serializeArray(), function(k, v){
                                  allData.append("basic["+v.name+"]", v.value);
                                });
                                allData.append("isDraft", '1');
                                $.ajax({url: MAINURL+"/post-ad/dopostrealstate.php", data: allData, type: 'POST', contentType: false, processData: false}, function (data, status) {
                                }).fail(function () {
                                    $(btn).effect("shake");
                                }).done(function (data) {
                                    var result = JSON.parse(data);
                                    var postid = result.postid;
                                    var albumid = $(".album_id").val();
                                    
                                    // CUSTOM FIELDS 
                                    var inputs = readCustomFields($("#sp-form-post"), postid);
                                    $.each(inputs, function (i, val) {
                                        $.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
                                        });
                                    });
                                    
                                    //add Highlights
                                    var Highlights = "";
                                    $(".highlit .btn-group>ul>li input:checked").each(function(k,obj){
                                        Highlights=Highlights+$(obj).val()+",";
                                    });
                                    Highlights = Highlights.substring(0,Highlights.length - 1);
                                    $.post(sendUrl+"/post-ad/addpostHightlight.php",{Highlights:Highlights,postid:postid,postedit:postedit}, function (re) {

                                    });
                                    
                                    // IMAGE
                                    var imgCount = $(".postingimg").length;
                                    $(".postingimg").each(function (i, e){
                                        var totalfiles = document.getElementById('postingpic_realestate').files.length;     
                                        
                                        //this is for featured image strt
                                        var fichek = $(e).attr("data-name");
                                        var isCheckeed = $('#'+fichek+':checked').val()?true:false;
                                        if(isCheckeed == true){
                                            spFeatureimg = 1;
                                        }else{
                                            spFeatureimg = 0;
                                        }
//this is for featured image end
                                        var base64image = $(e).attr("src");
                                        var arr = base64image.match(/data:image\/[a-z]+;/);
                                        var ext = arr[0].replace("data:image/", "");
                                        ext = ext.replace(";", "");

                                        var formData = new FormData();
                                        formData.append('spPostings_idspPostings', postid);
                                        formData.append('spFeatureimg', spFeatureimg);
                                        formData.append('postedit', postedit);
                                        // Attach file 
                                        formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

                                        $.ajax({
                                            url: sendUrl+"/post-ad/addrealstatepic.php",
                                            data: formData,
                                            type: 'POST',
                                            contentType: false, 
                                            processData: false, 
                                        });

//Timeline prepending
                                        if (i == imgCount - 1) {
                                            $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
                                                $("#timeline-container").prepend(r);
                                            });
                                        }
                                    });
                                    if (imgCount == 0){
                                        $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
                                            $("#timeline-container").prepend(r);
                                        });
                                    }

                                    $(".media-file-data").each(function (i, e){

                                        var base64image = $(e).attr("data-media");
                                        var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
                                        var ext = arr[0].replace("data:", "");

                                        var formData = new FormData();
                                        formData.append('spPostings_idspPostings', postid);
                                        formData.append('spFeatureimg', spFeatureimg);
                                        formData.append('postedit', postedit);
// Attach file 
                                        formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

                                        $.ajax({
                                            url: sendUrl+"/post-ad/addrealstatepic.php",
                                            data: formData,
                                            type: 'POST',
                                            contentType: false, 
                                            processData: false, 
                                        });
                                    });

                                    $("#dvPreview").html("");
                                    $("#spPreview").html("");
                                    $("#clearnow").val("");
                                    $(".grptimeline").val("");
                                    $("#postform .form-control").val("");


                                    if(postedit == true){
//window.location.reload();
//no page refresh because form is too large
                                        if(previewPost == true){
                                            document.getElementById("sp-form-post").reset();
//this script for delay a redirect page for another page.
                                            var seconds = 10;
                                            setInterval(function () {
                                                seconds--;
                                                if (seconds == 0) {
                                                    if(typepage == 0){
                                                        window.location = "../../real-estate/property-detail.php?postid="+(postid);
                                                    }else{
                                                        window.location = "../../real-estate/room-detail.php?postid="+(postid);
                                                    }

                                                }
                                            }, 1000);
//====end=====
                                        }
                                    }else{
                                        document.getElementById("sp-form-post").reset();
//this script for delay a redirect page for another page.

                                        var seconds = 8;
                                        setInterval(function () {

                                            seconds--;
                                            if (seconds == 4) {
                                                $.notify({
                                                    title: '<strong>Posted Draft Successfully</strong>',
                                                    icon: '',
                                                    message: ""
                                                },{
                                                    type: 'success',
                                                    animate: {
                                                        enter: 'animated fadeInUp',
                                                        exit: 'animated fadeOutRight'
                                                    },
                                                    placement: {
                                                        from: "top",
                                                        align: "right"
                                                    },
                                                    offset: 20,
                                                    spacing: 10,
                                                    z_index: 1031,
                                                });
                                            }
//window.location.reload();
                                            if(seconds == 0){
                                                window.location.href = "posting.php?postid="+postid+"&postType="+term[0].value;
                                            }


                                        }, 1000);
//====end=====
                                    }
                                }).always(function () {
//$(btn).button('reset');
                                });
                            }
                        //}
                    }
                }
            }
        }

    }else{
        $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
});*/

//=================POST A STORE FORM END=============
//=================POST A STORE FORM DRAFT===========
//Save in Draft
var postedit = false;
$("#-spSaveDraftStore").on("click", function () {
    var sendUrl = MAINURL;

    var visibility = $("#spPostingVisibility").val();
    $("#spPostingVisibility").val("0");

    if ($(this).hasClass("editing"))
        postedit = true;
    else
        postedit = false;

    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var $form = $("#sp-form-post");
    if(idspprofile != ""){
        var title = document.getElementById("spPostingTitle").value;
        var country = $('#spUserCountry option:selected').val();
        var state = $('#spUserState option:selected').val();
        var shipping = document.getElementById("sppostingShippingCharge").value;
        var inudstryType = $('#industryType_ option:selected').val();

        if(title == ""){
            $(".lbl_1").addClass("label_error");
        }else{
            $(".lbl_1").removeClass("label_error");
            if(country == 0){
                $(".lbl_2").addClass("label_error");
            }else{
                $(".lbl_2").removeClass("label_error");
                if(state == 0){
                    $(".lbl_3").addClass("label_error");
                }else{
                    $(".lbl_3").removeClass("label_error");
                    if(shipping == ""){
                        $(".lbl_4").addClass("label_error");
                    }else{
                        $(".lbl_4").removeClass("label_error");
//here is industry type
                        var type = 0;
                        if(inudstryType == "Retail"){
                            var retailPrice = document.getElementById("retailPrice").value;
                            var retailQuantity = document.getElementById("retailQuantity_").value;


                            if(retailPrice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(retailQuantity == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    type = 1;
                                }
                            }
                        }else if(inudstryType == "Wholesaler"){
                            var fobprice = document.getElementById("fobprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(fobprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "Manufacturer"){
                            var manufacturerprice = document.getElementById("manufacturerprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(manufacturerprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "Distributors"){
                            var distributorsprice = document.getElementById("distributorsprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(distributorsprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "PersonalSale"){
                            var personalSalePrice = document.getElementById("personalSalePrice").value;
                            var personalSaleQuantity = document.getElementById("personalSaleQuantity_").value;

                            if(personalSalePrice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(personalSaleQuantity == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    type = 1;
                                }
                            }
                        }
                        if(type == 1){
// HERE WE WRITE A COMPLETE CODE
                            $(".loadbox").css({ display: "block" });
                            $(btn).button('loading...');
                            term = $form.serializeArray();
                            url = $form.attr("action");

                            $.post(url, term, function (data, status) {

                            }).fail(function () {
                                $(btn).effect("shake");
                                $(btn).button('reset');
                            }).done(function (data) {
                                var postid = data;
                                var albumid = $(".album_id").val();
// CUSTOM FIELDS 
                                var inputs = readCustomFields($("#sp-form-post"), postid);
                                $.each(inputs, function (i, val) {
                                    $.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
                                    });
                                });

                                $("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

// IMAGE
                                var imgCount = $(".postingimg").length;
                                $(".postingimg").each(function (i, e){
//this is for featured image strt
                                    var fichek = $(e).attr("data-name");
                                    var isCheckeed = $('#'+fichek+':checked').val()?true:false;
                                    if(isCheckeed == true){
                                        spFeatureimg = 1;
                                    }else{
                                        spFeatureimg = 0;
                                    }
//this is for featured image end
                                    var base64image = $(e).attr("src");
                                    var arr = base64image.match(/data:image\/[a-z]+;/);
                                    var ext = arr[0].replace("data:image/", "");
                                    ext = ext.replace(";", "");
                                    var formData = new FormData();
                                    formData.append('spPostings_idspPostings', postid);
                                    formData.append('spFeatureimg', spFeatureimg);
                                    formData.append('postedit', postedit);
// Attach file 
                                    formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

                                    $.ajax({
                                        url: sendUrl+"/post-ad/addrealstatepic.php",
                                        data: formData, 
                                        type: 'POST',
                                        contentType: false, 
                                        processData: false, 
                                    });
//Timeline prepending
                                    if (i == imgCount - 1) {
                                        $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
                                            $("#timeline-container").prepend(r);
//$(btn).button('reset');
                                        });
                                    }
//});
                                });
//Media
                                $(".media-file-data").each(function (i, e)
                                {
                                    var base64image = $(e).attr("data-media");
                                    var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
                                    var ext = arr[0].replace("data:", "");
                                    var formData = new FormData();
                                    formData.append('spPostings_idspPostings', postid);
                                    formData.append('spFeatureimg', spFeatureimg);
                                    formData.append('postedit', postedit);
// Attach file 
                                    formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

                                    $.ajax({
                                        url: sendUrl+"/post-ad/addrealstatepic.php",
                                        data: formData,
                                        type: 'POST',
                                        contentType: false, 
                                        processData: false, 
                                    });
                                });

                                $("#dvPreview").html("");

//notification message from send box
                                $.notify({
                                    title: '<strong>Saved in the draft!</strong>',
                                    icon: '',
                                    message: ""
                                },{
                                    type: 'success',
                                    animate: {
                                        enter: 'animated fadeInUp',
                                        exit: 'animated fadeOutRight'
                                    },
                                    placement: {
                                        from: "top",
                                        align: "right"
                                    },
                                    offset: 20,
                                    spacing: 10,
                                    z_index: 1031,
                                });
//this script for delay a redirect page for another page.
                                var seconds = 10;
                                setInterval(function () {
                                    seconds--;
                                    if (seconds == 0) {
                                        window.location.href = "posting.php?postid="+postid.trim();
//window.location.reload();
                                    }
                                }, 1000);
//====end=====
                            }).always(function () {
                                $(btn).button('reset');
                            });
                        }
                    }
                }
            }
        }
    }else{
        $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
});
//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========
//Save in Draft
var postedit = false;
$("#-spSaveDeactiveStore").on("click", function () {
    var sendUrl = MAINURL;

    var visibility = $("#spPostingVisibility").val();
    $("#spPostingVisibility").val("-2");

    if ($(this).hasClass("editing"))
        postedit = true;
    else
        postedit = false;

    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var $form = $("#sp-form-post");
    if(idspprofile != ""){
        var title = document.getElementById("spPostingTitle").value;
        var country = $('#spUserCountry option:selected').val();
        var state = $('#spUserState option:selected').val();
        var shipping = document.getElementById("sppostingShippingCharge").value;
        var inudstryType = $('#industryType_ option:selected').val();

        if(title == ""){
            $(".lbl_1").addClass("label_error");
        }else{
            $(".lbl_1").removeClass("label_error");
            if(country == 0){
                $(".lbl_2").addClass("label_error");
            }else{
                $(".lbl_2").removeClass("label_error");
                if(state == 0){
                    $(".lbl_3").addClass("label_error");
                }else{
                    $(".lbl_3").removeClass("label_error");
                    if(shipping == ""){
                        $(".lbl_4").addClass("label_error");
                    }else{
                        $(".lbl_4").removeClass("label_error");
//here is industry type
                        var type = 0;
                        if(inudstryType == "Retail"){
                            var retailPrice = document.getElementById("retailPrice").value;
                            var retailQuantity = document.getElementById("retailQuantity_").value;

                            if(retailPrice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(retailQuantity == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    type = 1;
                                }
                            }
                        }else if(inudstryType == "Wholesaler"){
                            var fobprice = document.getElementById("fobprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(fobprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "Manufacturer"){
                            var manufacturerprice = document.getElementById("manufacturerprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(manufacturerprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "Distributors"){
                            var distributorsprice = document.getElementById("distributorsprice").value;
                            var minorderqty = document.getElementById("minorderqty_").value;
                            var supplyability = document.getElementById("supplyability_").value;
                            var paymentterm = document.getElementById("paymentterm_").value;
                            if(distributorsprice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(minorderqty == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(supplyability == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        if(paymentterm == ""){
                                            $(".lbl_8").addClass("label_error");
                                        }else{
                                            $(".lbl_8").removeClass("label_error");
                                            type = 1;

                                        }
                                    }
                                }
                            }
                        }else if(inudstryType == "PersonalSale"){
                            var personalSalePrice = document.getElementById("personalSalePrice").value;
                            var personalSaleQuantity = document.getElementById("personalSaleQuantity_").value;
                            var personalSaleDiscount = document.getElementById("personalSaleDiscount_").value;
                            if(personalSalePrice == ""){
                                $(".lbl_5").addClass("label_error");
                            }else{
                                $(".lbl_5").removeClass("label_error");
                                if(personalSaleQuantity == ""){
                                    $(".lbl_6").addClass("label_error");
                                }else{
                                    $(".lbl_6").removeClass("label_error");
                                    if(personalSaleDiscount == ""){
                                        $(".lbl_7").addClass("label_error");
                                    }else{
                                        $(".lbl_7").removeClass("label_error");
                                        type = 1;

                                    }
                                }
                            }
                        }
                        if(type == 1){
// HERE WE WRITE A COMPLETE CODE
                            $(".loadbox").css({ display: "block" });
                            $(btn).button('loading...');
                            term = $form.serializeArray();
                            url = $form.attr("action");

                            $.post(url, term, function (data, status) {

                            }).fail(function () {
                                $(btn).effect("shake");
                                $(btn).button('reset');
                            }).done(function (data) {
                                var postid = data;
                                var albumid = $(".album_id").val();
// CUSTOM FIELDS 
                                var inputs = readCustomFields($("#sp-form-post"), postid);
                                $.each(inputs, function (i, val) {
                                    $.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
                                    });
                                });

                                $("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

// IMAGE
                                var imgCount = $(".postingimg").length;
                                $(".postingimg").each(function (i, e){
//this is for featured image strt
                                    var fichek = $(e).attr("data-name");
                                    var isCheckeed = $('#'+fichek+':checked').val()?true:false;
                                    if(isCheckeed == true){
                                        spFeatureimg = 1;
                                    }else{
                                        spFeatureimg = 0;
                                    }
//this is for featured image end
                                    var base64image = $(e).attr("src");
                                    var arr = base64image.match(/data:image\/[a-z]+;/);
                                    var ext = arr[0].replace("data:image/", "");
                                    ext = ext.replace(";", "");
                                    var formData = new FormData();
                                    formData.append('spPostings_idspPostings', postid);
                                    formData.append('spFeatureimg', spFeatureimg);
                                    formData.append('postedit', postedit);
// Attach file 
                                    formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

                                    $.ajax({
                                        url: sendUrl+"/post-ad/addrealstatepic.php",
                                        data: formData,
                                        type: 'POST',
                                        contentType: false, 
                                        processData: false, 
                                    });
//Timeline prepending
                                    if (i == imgCount - 1) {
                                        $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
                                            $("#timeline-container").prepend(r);
//$(btn).button('reset');
                                        });
                                    }
//});
                                });
//Media
                                $(".media-file-data").each(function (i, e)
                                {
                                    var base64image = $(e).attr("data-media");
                                    var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
                                    var ext = arr[0].replace("data:", "");
                                    $.post(sendUrl+"/post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
//alert(r);
                                    });
                                });
                                $("#dvPreview").html("");

//notification message from send box
                                $.notify({
                                    title: '<strong>Post is deactivated.</strong>',
                                    icon: '',
                                    message: ""
                                },{
                                    type: 'success',
                                    animate: {
                                        enter: 'animated fadeInUp',
                                        exit: 'animated fadeOutRight'
                                    },
                                    placement: {
                                        from: "top",
                                        align: "right"
                                    },
                                    offset: 20,
                                    spacing: 10,
                                    z_index: 1031,
                                });
//this script for delay a redirect page for another page.
                                var seconds = 10;
                                setInterval(function () {
                                    seconds--;
                                    if (seconds == 0) {
                                        window.location.href = "posting.php?postid="+postid.trim();
//window.location.reload();
                                    }
                                }, 1000);
//====end=====
                            }).always(function () {
                                $(btn).button('reset');
                            });
                        }
                    }
                }
            }
        }
    }else{
        $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
});
//=================POST A STORE FORM DEACTIVATE END=======

});
