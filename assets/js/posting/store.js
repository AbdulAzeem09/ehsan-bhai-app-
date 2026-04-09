
//POSTING SCRIPT

$(document).ready(function () {
var hostUrl = window.location.host; 
var hostSchema = window.location.protocol;

var MAINURL = hostSchema+'//'+hostUrl;

$(".shipdest").on("click", function(){
var shipdest = $(this).val();
if(shipdest == 1){
//console.log("%");
$(".showpercentage").css({"display": "block"});
$(".showdollar").css({"display": "none"});
}else{
//console.log("$");
$(".showpercentage").css({"display": "none"});
$(".showdollar").css({"display": "block"});
}
});

// ===PUT ONLY CHARACTERS
$(".chekspvhar").keyup(function(){
//this code executes when the keyup event occurs
//var regExpr = /[^a-zA-Z0-9-. ]/g;
//var regExpr = /[^a-zA-Z0-9 ]/g;
var regExpr = /[^a-zA-Z ]/g;
var userText = $(this).val();

$(this).val(userText.replace(regExpr, ""));
});
// ===PUT ONLY number
$(".chekspnum").keyup(function(){
//this code executes when the keyup event occurs
//var regExpr = /[^a-zA-Z0-9-. ]/g;
//var regExpr = /[^a-zA-Z0-9 ]/g;
var regExpr = /[^0-9-.]/g;
var userText = $(this).val();

$(this).val(userText.replace(regExpr, ""));
});
// THIS IS IMPORTANT SCRIPT FOR CUSTOM FIELDS
function readCustomFields($form, $postid) {
var allinputs = $form.find(".spPostField");

//console.log(allinputs);
var formfields = new Array();
var inputs = null;
allinputs.each(function (i, e) {
var l = $("label[for='" + e.id + "']").text();
var n = $(e).attr("name");
var v = $(e).val();

/*  if(n == "subcategory_[]"){*/
/*  s =  v.toString();*/

//alert(v);
/*  console.log(s.toString());*/
/*}*/

//var s = fruits.toString();

var f = $(e).data("filter");
inputs = {spPostFieldLabel: l, spPostFieldName: n, spPostFieldValue: v, spPostings_idspPostings: $postid, spCategories_idspCategory: $(".spCategories_idspCategory").val(), spPostFieldIsFilter: f, editing_: postedit};

formfields.push(inputs);

/*alert();*/
//console.log(formfields);

});
//alert(formfields);
return formfields;
}

function readCustomFieldsstore($form, $postid) {
var allinputs = $form.find(".spPostField");

//console.log(allinputs);
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
//alert(formfields);
return formfields;
}
// STORE
// ===FORM FIELD VALIDATE
function isfieldvalid(){


var sellType = document.getElementById("sellType_").value;  //my validatain
if(sellType == "Auction"){
var title = $("#spPostingTitle").val();
var quantity = $('#auctionQuantity_').val();


var filesauc = $('#filesaaa').val();
var price = $('#auctionPrice').val();
var specification = $('#specification').val();
var description = $('#description').val();
var barcode = $('#barcode').val();




var isvalid = true;


if((title=="")||(filesauc=="")||(quantity=="")||(price=="")||(specification=="")||(description=="")||(barcode=="")) {


if(price==""){

$(".auc").html("Required");
isvalid = false;

}
else{
$(".auc").html("");
}

if(specification==""){

    $(".lbl_55").html("Required");
    isvalid = false;
    
    }
    else{
    $(".lbl_55").html("");
    }

    if(description==""){

        $(".lbl_99").html("Required");
        isvalid = false;
        
        }
        else{
        $(".lbl_99").html("");
        }

        if(barcode==""){

            $(".lbl_77").html("Required");
            isvalid = false;
            
            }
            else{
            $(".lbl_77").html("");
            }
    
//


if(title==""){

$(".lbl_1").html("Required");
isvalid = false;

}
else{
$(".lbl_1").html("");
}



if(quantity==""){

$(".lbl_6").html("Required");
isvalid = false;

}
else{
$(".lbl_6").html("");
}




if(filesauc=="")
{
if($('.featurepic').prop('files').length == 0){
$(".lbl_15").html("Required");
isvalid = false;
}else{
$(".lbl_15").html("");
}
}
else{
$(".lbl_15").html("");
}


swal('Please Fill All Required Fields');

}


}

else if(sellType=="personal"){
var title = $("#spPostingTitle").val();
var quantity = $('#auctionQuantity_').val();

var price = $('#auctionPrice').val();

var isvalid = true;

if(price==""){

$(".auc").html("Required");
isvalid = false;

}
else{
$(".auc").html("");
}

//


if(title==""){

$(".lbl_1").html("Required");
isvalid = false;

}
else{
$(".lbl_1").html("");
}





if(quantity==""){

$(".lbl_6").html("Required");
isvalid = false;

}
else{
$(".lbl_6").html("");
}
}



if (sellType == "Wholesale") {

var title = $("#spPostingTitle").val();

var payment = $("#paymentterm_").val();
// lbl_1

//lbl_8

var fobprice = $('#fobprice').val();
var minorderqty = $('#minorderqty_').val();

var supplyability = $('#supplyability_').val();

var isvalid = true;



if(payment==""){

$(".lbl_8").html("Required");
isvalid = false;

}
else{
$(".lbl_8").html("");
}

//
if(title==""){

$(".lbl_1").html("Required");
isvalid = false;

}
else{
$(".lbl_1").html("");
}

if(fobprice==""){

$(".lbl_5").html("Required");
isvalid = false;

}
else{
$(".lbl_5").html("");
}

if(minorderqty==""){

$(".lbl_6").html("Required");
isvalid = false;

}
else{
$(".lbl_6").html("");
}


if(supplyability==""){

$(".lbl_7").html("Required");
isvalid = false;

}
else{
$(".lbl_7").html("");
}





}



if(sellType == "Personal"){
var quantity =  $('#retailQuantity_').val();
if(quantity==""){

$(".lbl_6").html("Required");
isvalid = false;

}
else{
$(".lbl_6").html("");
}


}

//  alert('llllll');
var title = $('#spPostingTitle').val();
var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();
var inudstryType = $('#industryType_ option:selected').val();
var subcategory = $('#subcategory_ option:selected').val();
// var postids = document.getElementById("idspPostings").value;

var postids = $('#idspPostings').val();
var quatity = $('#retailQuantity').val();
var retailprice = $('#retailPrice').val();

var specification = $('#specification').val();
var description = $('#description').val();
var barcode = $('#barcode').val();

// var quatity  = document.getElementById("retailQuantity_").value;
// var status = document.getElementById("retailStatus_").value;





var isvalid = true;

if((title=="")||(subcategory=="")||(quatity=="")||(retailprice=="")||(specification=="")||(description==""))
{
   
    
if(quatity==""){
// alert('xxxxxxxxxx');
$(".quantity").html("Required");
isvalid = false;

}
else{
$(".quantity").html("");
}



if(title.trim() == ""){
$(".lbl_1").html("Required");
isvalid = false;
}else{
$(".lbl_1").html("");
}

if(retailprice==""){
    $(".lbl_50").html("Required");
    isvalid = false;
    }else{
    $(".lbl_50").html("");
    }


if(specification.trim() == ""){

    $(".lbl_55").html("Required");
    isvalid = false;
    }
    else{   
    $(".lbl_55").html("");
    }


    if(description.trim() == ""){

        $(".lbl_99").html("Required");
        isvalid = false;
        }
        else{   
        $(".lbl_99").html("");
        }




        if(barcode.trim() == ""){

            $(".lbl_77").html("Required");
            isvalid = false;
            }
            else{   
            $(".lbl_55").html("");
            }
    




if(postids=="")
{
if($('.featurepic').prop('files').length == 0){
$(".lbl_15").html("Required");
isvalid = false;
}else{
$(".lbl_15").html("");
}
}
else{
$(".lbl_15").html("");
}

if(country == 0){
$(".lbl_2").html("Required");
isvalid = false;
}else{
$(".lbl_2").html("");
}
if(state == 0){
$(".lbl_3").html("Required");
isvalid = false;
}else{
$(".lbl_3").html("");
}
if(subcategory == 0){
$(".lbl_20").html("Required");
isvalid = false;
}else{
$(".lbl_20").html("");
}

swal('Please Fill All Required Fields');
   
}

    if (isvalid == false) { 
        return false;
    }
   
   
var type = 0;
//IS AUCTION OR BUY

var sellType = document.getElementById("sellType_").value;
// var sellType = $('input[name="sellType_"]:checked').val();

if(sellType == "Auction"){

var auctisvalid = true;
//HERE IS AUCTION
var auctionPrice = document.getElementById("auctionPrice").value;
var auctionQuantity = document.getElementById("auctionQuantity_").value;
var title = document.getElementById("spPostingTitle").value;
// alert(title);

if(auctionPrice.trim() == ""){
$(".lbl_5").html("Required");
$("#auctionPrice").prop('required',true);
//auctisvalid = false;       


return false;   
}else{
$(".lbl_5").html("");
}
if(auctionQuantity.trim() == ""){
$(".lbl_6").html("Required");
return false;   
//auctisvalid = false;
}else{
$(".lbl_6").html("");
//type = 1;
}
//alert(auctisvalid);
if(auctisvalid == true){
type = 1;
} 

}else if(sellType == "Retail"){
var industisvalid = true;
var protypes = $("#protype").val();
//alert(protypes);
//alert('===============');
if(protypes==0){
//alert('normal');


var retailPrice = document.getElementById("retailPrice").value;
var retailQuantity = document.getElementById("retailQuantity_").value;

//alert(protypes);

/*alert(retailPrice);
alert(retailQuantity);*/

if(retailPrice.trim() == ""){
$(".lbl_5").html("Required");
industisvalid = false;
}else{
$(".lbl_5").html("");
}
if(retailQuantity.trim() == ""){
$(".lbl_6").html("Required");
industisvalid = false;
}else{
$(".lbl_6").html(" ");
}

}
else{


// alert('varient');

$checkboxQtyq = $('.qtynew');
var chkArrayqq = [];
chkArrayqq = $.map($checkboxQtyq, function(elll){
return elll.value ;
});

if(chkArrayqq.length<1)
{
alert('Please add options first.');
industisvalid = false;
}


}
if(industisvalid == true){
type = 1;
}
$(".lbl_19").html("");
if(type == 1){
//===when every field is valid
    if (isvalid == true) {
        return true;
    } else { 
        return false;
    }
//===end
}
}
else if(sellType == "Wholesale"){
// alert("hello");
var industisvalid = true;
var fobprice = document.getElementById("fobprice").value;
var minorderqty = document.getElementById("minorderqty_").value;
var supplyability = document.getElementById("supplyability_").value;
var paymentterm = document.getElementById("paymentterm_").value;
var title = document.getElementById("spPostingTitle").value;





if(fobprice.trim() == ""){
$(".lbl_5").html("Required");
industisvalid = false;
}else{
$(".lbl_5").html("");
}
if(minorderqty.trim() == ""){
$(".lbl_6").html("Required");
industisvalid = false;
}else{
$(".lbl_6").html("");
}
if(supplyability.trim() == ""){
$(".lbl_7").html("Required");
industisvalid = false;
}else{
$(".lbl_7").html("");
}
if(paymentterm.trim() == ""){
$(".lbl_8").html("Required");
industisvalid = false;
}else{
$(".lbl_8").html("");                       
}
if(industisvalid == true){
type = 1;
}
$(".lbl_19").html("");
if(type == 1){
//===when every field is valid
if(isvalid == true){
return true;
}
//===end
}
}else{
var industisvalid = true;

if(inudstryType == "Manufacturer"){

var manufacturerprice = document.getElementById("manufacturerprice").value;
var minorderqty = document.getElementById("minorderqty_").value;
var supplyability = document.getElementById("supplyability_").value;
var paymentterm = document.getElementById("paymentterm_").value;

if(manufacturerprice.trim() == ""){
$(".lbl_5").html("Required");
industisvalid = false;
}else{
$(".lbl_5").html("");
}
if(minorderqty.trim() == ""){
$(".lbl_6").html("Required");
industisvalid = false;
}else{
$(".lbl_6").html("");

}
if(supplyability == ""){
$(".lbl_7").html("Required");
industisvalid = false;
}else{
$(".lbl_7").html("");
}
if(paymentterm.trim() == ""){
$(".lbl_8").html("Required");
industisvalid = false;
}else{
$(".lbl_8").html("");
}
if(industisvalid == true){
type = 1;
}
$(".lbl_19").html("");
}else if(inudstryType == "Distributors"){

var distributorsprice = document.getElementById("distributorsprice").value;
var minorderqty = document.getElementById("minorderqty_").value;
var supplyability = document.getElementById("supplyability_").value;
var paymentterm = document.getElementById("paymentterm_").value;

if(distributorsprice.trim() == ""){
$(".lbl_5").html("Required");
industisvalid = false;
}else{
$(".lbl_5").html("");
}
if(minorderqty.trim() == ""){
$(".lbl_6").html("Required");
industisvalid = false;
}else{
$(".lbl_6").html("");
}
if(supplyability.trim() == ""){
$(".lbl_7").html("Required");
industisvalid = false;
}else{
$(".lbl_7").html("");
}
if(paymentterm.trim() == ""){
$(".lbl_8").html("Required");
industisvalid = false;
}else{
$(".lbl_8").html("");
}
if(industisvalid == true){
type = 1;
}
$(".lbl_19").html("");
}else if(inudstryType == "PersonalSale"){

var personalSalePrice = document.getElementById("personalSalePrice").value;
var personalSaleQuantity = document.getElementById("personalSaleQuantity_").value;
var personalSaleDiscount = document.getElementById("personalSaleDiscount_").value;

if(personalSalePrice.trim() == ""){
$(".lbl_5").html("Required");
industisvalid = false;
}else{
$(".lbl_5").html("");
}
if(personalSaleQuantity.trim() == ""){
$(".lbl_6").html("Required");
industisvalid = false;
}else{
$(".lbl_6").html("");
}
if(personalSaleDiscount.trim() == ""){
$(".lbl_7").html("Required");
industisvalid = false;
}else{
$(".lbl_7").html("");
}
if(industisvalid == true){
type = 1;
}
$(".lbl_19").html("");
}else{
$(".lbl_19").html("Required");
industisvalid = false;
}
}

if(type == 1){

//alert(isvalid);
//===when every field is valid
if(isvalid == true){
return true;
}
//===end
}


}
// ===END
//=================POST A STORE FORM START=============
$("#spPostSaveStore").on("click", function () {


var spPostingExpDt_old =$("#spPostingExpDt_old").val();
$("#spPostingExpDt").val(spPostingExpDt_old);
    //$('input[name=spPostingVisibility]').val('0');
 


    var sendUrl = MAINURL;
    
    if ($(this).hasClass("editing"))
    postedit = true;
    else
    postedit = false;
    
    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var $form = $("#sp-form-post");
    
    if(idspprofile != ""){
    
    
    
    // alert('++++++');
    var subcategorytitle =$("#spPostingTitle").val();
    var description =$("#description").val();
    var subcategory =$("#subcategory_").val();
    var retailPrice =$("#retailPrice").val();
    var retailQuantity =$("#retailQuantity_").val();
    var filesaaa =$("#filesaaa").val();

    var idspPostings =$("#idspPostings").val();
    

    if(idspPostings==''){
        if(filesaaa==""){
        $(".lbl_15").addClass("label_error");
        swal('Please Fill the Required');
         return false;
        
        }else{
        $(".lbl_15").removeClass("label_error");
        
        }
        }
       
    if((subcategorytitle=="")||(subcategory==0)||(retailPrice==0)||(retailQuantity=="")||(description==" ")){
       
    if(subcategorytitle==""){
        
        
    $(".lbl_1").addClass("label_error");
    }else{
    $(".lbl_1").removeClass("label_error");
    }
    if(subcategory==0){
    $(".lbl_20").addClass("label_error");
    
    }else{
    $(".lbl_20").removeClass("label_error");
    }
    if(retailPrice==0){
    $(".lbl_50").addClass("label_error");
    
    }else{
    $(".lbl_50").removeClass("label_error");
    }
    if(retailQuantity==""){
    $(".lbl_6").addClass("label_error");
    
    }else{
    $(".lbl_6").removeClass("label_error");
    }
   
    if(description==""){
    $(".lbl_99").addClass("label_error");
    
    }else{
    $(".lbl_99").removeClass("label_error");
    }
   
    swal('Please Fill the Required');
    return false;
    }else{
    
    
    
    var country = $('#spUserCountry option:selected').val();
    var state = $('#spUserState option:selected').val();
    
    var inudstryType = $('#industryType_ option:selected').val();
    // ===NEW SCRIPT
    var isvalidfield = true;
    if(isvalidfield == true){
    
    //console.log("Success");
    // HERE WE WRITE A COMPLETE CODE
    $(".loadbox").css({ display: "block" });
    $(btn).button('loading...');
    term = $form.serializeArray();
    url = $form.attr("action");
    $.post(url, term, function (data, status) {
    //alert(data);
    }).fail(function () {
    $(btn).effect("shake");
    }).done(function (data) {
    //alert(data);
    var postid = data;
    var albumid = $(".album_id").val();
    
    // CUSTOM FIELDS 
    var inputs = readCustomFields($("#sp-form-post"), postid);
    
    //console.log(inputs);
    //alert(inputs);
    //console.log
    $.each(inputs, function (i, val) {
    
    //console.log(val);
    $.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
    //alert(response);
    });
    });
    
    var pageEvent = $("#leftmenu").attr("data-event");
    if(pageEvent == 1){
    //this is event page for add feature, sponsor or co-host
    //add feature people
    var Accessids = "";
    $(".multi_select .btn-group>ul>li input:checked").each(function(k,obj){
    Accessids=Accessids+$(obj).val()+",";
    });
    Accessids = Accessids.substring(0,Accessids.length - 1);
    //console.log(Accessids);
    //add feature profile
    $.post(sendUrl+"/post-ad/addpostcustomfieldsfeature.php",{Accessids:Accessids,postid:postid,postedit:postedit}, function (re) {
    
    });
    //======add soponsor in field start======
    var spon = "";
    $(".add_spon .btn-group>ul>li input:checked").each(function(k,obj){
    spon = spon+$(obj).val()+",";
    //alert("no");
    });
    spon = spon.substring(0,spon.length - 1);
    //console.log(spon);
    $.post(sendUrl+"/post-ad/addsponsor.php",{spon:spon,postid:postid,postedit:postedit}, function (re) {
    //alert(re);
    });
    //======add co-host========
    var cohost = "";
    $(".multi_select_cohost .btn-group>ul>li input:checked").each(function(k,obj){
    cohost = cohost+$(obj).val()+",";
    //alert("no");
    });
    cohost = cohost.substring(0,cohost.length - 1);
    //console.log(cohost);
    $.post(sendUrl+"/post-ad/addcohost.php",{cohost:cohost,postid:postid,postedit:postedit}, function (cohost) {
    alert(cohost);
    });
    }else{
    //alert(multi);
    var multi = $(".multiselect").attr("title");
    if(multi == 'None selected' || multi == ''){
    
    }else{
    $.post(sendUrl+"/post-ad/addpostcustomfieldssize.php",{multi:multi,postid:postid}, function (re) {
    //alert(re);
    });
    }
    }
    //for dell image
    // IMAGE
    
    var form_data = new FormData();
    form_data.append('spPostings_idspPostings', postid);
    //  form_data.append('spFeatureimg', spFeatureimg);
    //  form_data.append('postedit', postedit);
    
    var totalfiles = document.getElementById('filesaaa').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("files[]", document.getElementById('filesaaa').files[index]);
    } 
    
    
    
    $.ajax({
    url: sendUrl+"/post-ad/addstoreproductpic.php",
    type: 'post',
    data: form_data,
    contentType: false,
    processData: false,
    });
    
    
    
    var form_data = new FormData();
    form_data.append('spPostings_idspPostings', postid);
    
    var totalfiles = document.getElementById('filesaaa1').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("files[]", document.getElementById('filesaaa1').files[index]);
    } 
    
    
    $.ajax({
    url: sendUrl+"/post-ad/addstorefeaturepic.php",
    type: 'post',
    data: form_data,
    contentType: false,
    processData: false,
    });
    
    
    var imgCount = $(".postingimg").length;
    //alert(imgCount);
    //alert(postid);
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
    //$.post(sendUrl+"/post-ad/addstoreproductpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
    //alert(r);
    //Timeline prepending
    if (i == imgCount - 1) {
    $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
    $("#timeline-container").prepend(r);
    //$(btn).button('reset');
    });
    }
    //});
    });
    //=======Add video start=======
    
    //Video post finaly
    //ev.preventDefault();
    var form_data = new FormData($("#sp-form-post")[0]);
    //form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
    form_data.append('spPostings_idspPostings', postid);
    form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
    $.ajax({
    url: sendUrl+"/post-ad/addpostmedia.php",
    type: "POST",
    data:  form_data ,
    contentType: false,
    cache: false,
    processData:false,
    success: function(vi){
    //alert(vi);
    //window.location.reload();
    $("#dvPreview").html("");
    $("#spPreview").html("");
    $("#clearnow").val("");
    $(".grptimeline").val("");
    $("#postform .form-control").val("");
    //document.getElementById("sp-form-post").reset();
    if(postedit == true){
    //window.location.reload();
    }
    },
    error: function(error){
    //alert(error);
    }          
    });
    
    //=======Add video end=======
    //Testing
    if (imgCount == 0){
    $.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
    $("#timeline-container").prepend(r);
    //$(btn).button('reset');
    //alert(r);
    });
    }
    //Testing Complete
    //Media
    $(".media-file-data").each(function (i, e){
    var base64image = $(e).attr("data-media");
    var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
    var ext = arr[0].replace("data:", "");
    
    $.post("../addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
    //alert(r);
    });
    });
    //notification message from send box
    /*$.notify({
    title: '<strong>Posted Successfully</strong>',
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
    });*/
    //Message after form submited
    $("#dvPreview").html("");
    $("#spPreview").html("");
    $("#clearnow").val("");
    $(".grptimeline").val("");
    $("#postform .form-control").val("");
    
    swal({
    
    
    title: "Posted Successfully!",
    type: 'success',
    showConfirmButton: true
    
    },
    function() {
    
    window.location.href = "posting.php?postid="+postid.trim();
    
    });
    //document.getElementById("sp-form-post").reset();
    //this script for delay a redirect page for another page.
    /*  var seconds = 10;
    setInterval(function () {
    seconds--;
    if (seconds == 0) {
    window.location.href = "posting.php?postid="+postid.trim();
    //window.location.reload();
    }
    }, 1000);*/
    //====end=====
    }).always(function () {
    //$(btn).button('reset');
    });
    }
    //===END
    
    }}else{
    //$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
    });


$("#spPostSubmitStore").on("click", function () {

//alert('22222222222');

var sendUrl = MAINURL;
    $("#spPostingVisibility").val(-1);
if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");

if(idspprofile != ""){


    
// alert('++++++');forfixedamountshipping,forfreeshipping
var subcategorytitle =$("#spPostingTitle").val();
var spPostingPrice =$("#spPostingPrice").val();
var auctionQuantity_ =$("#auctionQuantity_").val();
var paymentterm_ =$("#paymentterm_").val();
var supplyability_ =$("#supplyability_").val();
var minorderqty_ =$("#minorderqty_").val();
var wholesaleQuantity =$("#wholesaleQuantity").val();
var fobprice =$("#fobprice").val();
var subcategory =$("#subcategory_").val();
var retailPrice =$("#retailPrice").val();
var fixedamount = $("#forfixedamountshipping").val();
var freeamonut = $("#forfreeshipping").val();

var retailQuantity =$("#retailQuantity_").val();
var filesaaa =$("#filesaaa").val();
var idspPostings =$("#idspPostings").val();
var idspecification =$("#specification").val();
var iddescription =$("#description").val();
var idbarcode =$("#barcode").val();

//alert(idspecification);

isvalid = true;

if(idspPostings==''){
    if(filesaaa==""){
    $(".lbl_15").addClass("label_error");
    swal('Please Fill the Required');
     return false;
    
    }else{
    $(".lbl_15").removeClass("label_error");
    
    }
    }


if((subcategorytitle=="")||(retailPrice==0)||(subcategory==0)||(retailQuantity=="")||(idspecification=="")||(iddescription==" ")||(fobprice=="")||(minorderqty_=="")||(wholesaleQuantity=="")||(paymentterm_=="")||(auctionQuantity_=="")||(spPostingPrice=="")||(supplyability_=="")||(idbarcode=="")){

if(spPostingPrice==""){
    $(".lll74").html("Please Fill the Required"); 
    }else{
    $(".lll74").html("");
    } 


if(auctionQuantity_==""){
    $(".lbl_6").html("Please Fill the Required"); 
    }else{      
    $(".lbl_6").html("");
    } 
    
if(paymentterm_==""){
    $(".lbl_8").html("Please Fill the Required"); 
    }else{
    $(".lbl_8").html("");
    }    
if(supplyability_==""){
    $(".lbl_7").html("Please Fill the Required"); 
    }else{
    $(".lbl_7").html("");
    } 

   



if(minorderqty_==""){
    $(".lbl_6").html("Please Fill the Required");
 }else{
    $(".lbl_6").html("");
 } 

if(wholesaleQuantity==""){
    $(".lbl_60").html("Please Fill the Required"); 
 }else{
    $(".lbl_60").html("");
 }   

if(subcategorytitle==""){   
$(".lbl_1").html("Please Fill This Field");
isvalid = false;
}else{
$(".lbl_1").html("");
}

if(subcategory==0){
$(".lbl_20").addClass("label_error");
}else{
$(".lbl_20").removeClass("label_error");
}

if(retailPrice==0){
$(".lbl_50").html("Please Fill This Field");
isvalid = false;
}else{
$(".lbl_50").html("");
}

if(idspecification == ""){
    $(".lbl_55").html("Please Fill This Field");
    isvalid = false;
    }else{
    $(".lbl_55").html("");
    }

    if(iddescription==" "){
        $(".lbl_99").html("Please Fill This Field");
        isvalid = false;
        }else{
        $(".lbl_99").html("");
        }

    if(idbarcode==""){
         $(".lbl_77").html("Please Fill This Field");
         isvalid = false;
         }else{
          $(".lbl_77").html("");
          }

          




if(retailQuantity==""){
$(".lbl_6").html("Please Fill This Field");
isvalid = false;
}else{
$(".lbl_6").html("");
}

if(fobprice==""){
$(".lbl_5").html("Please Fill the Required"); 
}else{
$(".lbl_5").html("");
 }

swal('Please Fill All Required Fields');
return false;
}else{



var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();

var inudstryType = $('#industryType_ option:selected').val();
// ===NEW SCRIPT
var isvalidfield = true;
if(isvalidfield == true){

//console.log("Success");
// HERE WE WRITE A COMPLETE CODE
$(".loadbox").css({ display: "block" });
$(btn).button('loading...');
term = $form.serializeArray();
url = $form.attr("action");
$.post(url, term, function (data, status) {
//alert(data);
}).fail(function () {
$(btn).effect("shake");
}).done(function (data) {
//alert(data);
var postid = data;
var albumid = $(".album_id").val();

// CUSTOM FIELDS 
var inputs = readCustomFields($("#sp-form-post"), postid);

//console.log(inputs);
//alert(inputs);
//console.log
$.each(inputs, function (i, val) {

//console.log(val);
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});

var pageEvent = $("#leftmenu").attr("data-event");
if(pageEvent == 1){
//this is event page for add feature, sponsor or co-host
//add feature people
var Accessids = "";
$(".multi_select .btn-group>ul>li input:checked").each(function(k,obj){
Accessids=Accessids+$(obj).val()+",";
});
Accessids = Accessids.substring(0,Accessids.length - 1);
//console.log(Accessids);
//add feature profile
$.post(sendUrl+"/post-ad/addpostcustomfieldsfeature.php",{Accessids:Accessids,postid:postid,postedit:postedit}, function (re) {

});
//======add soponsor in field start======
var spon = "";
$(".add_spon .btn-group>ul>li input:checked").each(function(k,obj){
spon = spon+$(obj).val()+",";
//alert("no");
});
spon = spon.substring(0,spon.length - 1);
//console.log(spon);
$.post(sendUrl+"/post-ad/addsponsor.php",{spon:spon,postid:postid,postedit:postedit}, function (re) {
//alert(re);
});
//======add co-host========
var cohost = "";
$(".multi_select_cohost .btn-group>ul>li input:checked").each(function(k,obj){
cohost = cohost+$(obj).val()+",";
//alert("no");
});
cohost = cohost.substring(0,cohost.length - 1);
//console.log(cohost);
$.post(sendUrl+"/post-ad/addcohost.php",{cohost:cohost,postid:postid,postedit:postedit}, function (cohost) {
alert(cohost);
});
}else{
//alert(multi);
var multi = $(".multiselect").attr("title");
if(multi == 'None selected' || multi == ''){

}else{
$.post(sendUrl+"/post-ad/addpostcustomfieldssize.php",{multi:multi,postid:postid}, function (re) {
//alert(re);
});
}
}
//for dell image
// IMAGE

var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);
//  form_data.append('spFeatureimg', spFeatureimg);
//  form_data.append('postedit', postedit);

var totalfiles = document.getElementById('filesaaa').files.length;
for (var index = 0; index < totalfiles; index++) {
form_data.append("files[]", document.getElementById('filesaaa').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/addstoreproductpic.php",
type: 'post',
data: form_data,
contentType: false,
processData: false,
});



var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);

var totalfiles = document.getElementById('filesaaa1').files.length;
for (var index = 0; index < totalfiles; index++) {
form_data.append("files[]", document.getElementById('filesaaa1').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/addstorefeaturepic.php",
type: 'post',
data: form_data,
contentType: false,
processData: false,
});



var imgCount = $(".postingimg").length;
//alert(imgCount);
//alert(postid);
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
//$.post(sendUrl+"/post-ad/addstoreproductpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
//});
});
//=======Add video start=======

//Video post finaly
//ev.preventDefault();
var form_data = new FormData($("#sp-form-post")[0]);
//form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
form_data.append('spPostings_idspPostings', postid);
form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
$.ajax({
url: sendUrl+"/post-ad/addpostmedia.php",
type: "POST",
data:  form_data ,
contentType: false,
cache: false,
processData:false,
success: function(vi){
//alert(vi);
//window.location.reload();
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
if(postedit == true){
//window.location.reload();
}
},
error: function(error){
//alert(error);
}          
});

//=======Add video end=======
//Testing
if (imgCount == 0){
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}
//Testing Complete
//Media
$(".media-file-data").each(function (i, e){
var base64image = $(e).attr("data-media");
var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
var ext = arr[0].replace("data:", "");

$.post("../addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
//alert(r);
});
});
//notification message from send box
/*$.notify({
title: '<strong>Posted Successfully</strong>',
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
});*/
//Message after form submited
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");

swal({


title: "Posted Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.href = "posting.php?postid="+postid.trim();

});
//document.getElementById("sp-form-post").reset();
//this script for delay a redirect page for another page.
/*  var seconds = 10;
setInterval(function () {
seconds--;
if (seconds == 0) {
window.location.href = "posting.php?postid="+postid.trim();
//window.location.reload();
}
}, 1000);*/
//====end=====
}).always(function () {
//$(btn).button('reset');
});
}
//===END

}}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM END=============
//=================Preview and Draft Form Start=============
/*$("#spSaveDeactiveStore").on("click", function () {


alert();
});*/


var postedit = false;
$("#spSaveDeactiveStore").on("click", function () {


var sendUrl = MAINURL;

var visibility = $("#spPostingVisibility").val();
$("#spPostingVisibility").val("-2");


var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");

if(idspprofile != ""){
var title = document.getElementById("spPostingTitle").value;
/*var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();*/

/*var inudstryType = $('#industryType_ option:selected').val();*/
var sellType = $('#sellType_ option:selected').val();

/*var type == 1;
if(type == 1){*/
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


$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");


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
var seconds = 5;
setInterval(function () {
seconds--;
if (seconds == 0) {
/*window.location.href = "posting.php?postid="+postid.trim();*/
window.location.href = "../../store/dashboard/deactive.php";


//window.location.reload();
}
}, 1000);
//====end=====
}).always(function () {
$(btn).button('reset');
});
/*  }*/


}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM DEACTIVATE END=======
/*publish project*/


var postedit = false;
$("#spprevieweditSaveDraftStore").on("click", function () {

//alert();
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
var isvalidfield = isfieldvalid();

//alert(isvalidfield);
if(isvalidfield != ""){
var title = document.getElementById("spPostingTitle").value;
var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();

var inudstryType = $('#industryType_ option:selected').val();
var sellType = $('#sellType_').val();

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

$(".lbl_4").removeClass("label_error");
//here is industry type
var type = 0;
if(sellType == "Auction"){

type = 1;
// alert('y')

}else if(sellType == "Retail"){


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
}else if(sellType == "Wholesale"){
// alert('wello');
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
}else if(sellType == "Manufacturer"){
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

// console.log(term);
$.post(url, term, function (data, status) {

}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');
}).done(function (data) {
var postid = data;
var albumid = $(".album_id").val();
// CUSTOM FIELDS 
/*  var inputs = readCustomFieldsstore($("#sp-form-post"), postid);


console.log(inputs);*/
/*  $.each(inputs, function (i, val) {
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});
*/
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


$.post(sendUrl+"/post-ad/addstoreproductpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
});
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

//window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid.trim();
//this script for delay a redirect page for another page.
var seconds = 5;
setInterval(function () {
seconds--;
if (seconds == 0) {

window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid.trim();

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
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});



/*new draft product*/

var postedit = false;
$("#sppreviewSaveDraftStore").on("click", function () {
// alert('okkkkkkkkkk');


var sendUrl = MAINURL;


//alert('aaaaaa');


var visibility = $("#spPostingVisibility").val();
$("#spPostingVisibility").val("0");

if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
var isvalidfield = isfieldvalid();

//alert(isvalidfield);
if(isvalidfield != ""){
var title = document.getElementById("spPostingTitle").value;
var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();
var postids1 = document.getElementById("idspPostings").value;
var inudstryType = $('#industryType_ option:selected').val();
var sellType = $('#sellType_ option:selected').val();
if(title == ""){
$(".lbl_1").addClass("label_error");

} else if ($('.featurepic').prop('files').length == 0) {
if(postids1=="")
{
$(".lbl_1").removeClass("label_error");
$(".lbl_15").addClass("label_error");
}
}
else{

$(".lbl_15").removeClass("label_error");
if(country == 0) {
$(".lbl_2").addClass("label_error");

} else {

$(".lbl_2").removeClass("label_error");
if(state == 0){
$(".lbl_3").addClass("label_error");

}else{

$(".lbl_3").removeClass("label_error");

$(".lbl_4").removeClass("label_error");
//here is industry type
var type = 0;
if(sellType == "Auction"){

type = 1;
// alert('z')

}else if(sellType == "Retail"){

var retailPrice = document.getElementById("retailPrice").value;
var retailQuantity = document.getElementById("retailQuantity_").value;
var protypes2 = document.getElementById("protype").value;
//alert(protypes2);
if(protypes2==0)
{   
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
} else if(protypes2==1)
{

$checkboxQtyq2 = $('.qtynew');
var chkArrayqq2 = [];
chkArrayqq2 = $.map($checkboxQtyq2, function(elll2){
return elll2.value ;
});

if(chkArrayqq2.length<1)
{
alert('Please add options first.');

}
else
{
type = 1;
}    

}
}else if(sellType == "Personal"){
//   alert('alllll');
var retailPrice = document.getElementById("retailPrice").value;
// alert(retailPrice);
var retailQuantity = document.getElementById("retailQuantity_").value;
var protypes2 = document.getElementById("protype").value;
//alert(protypes2);
if(protypes2==0)
{   
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
} else if(protypes2==1)
{

$checkboxQtyq2 = $('.qtynew');
var chkArrayqq2 = [];
chkArrayqq2 = $.map($checkboxQtyq2, function(elll2){
return elll2.value ;
});

if(chkArrayqq2.length<1)
{
alert('Please add options first.');

}
else
{
type = 1;
}

}
}   else if (sellType == "Wholesale") {
// alert('whole');
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
}else if(sellType == "Manufacturer"){
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
// alert('jjjjjjjj');
// HERE WE WRITE A COMPLETE CODE
//$(".loadbox").css({ display: "block" });
//$(btn).button('loading...');
term = $form.serializeArray();
url = $form.attr("action");

// console.log(term);
$.post(url, term, function (data, status) {
//alert('term');

}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');  
}).done(function (data) {
//alert('done');
var postid = data;
var albumid = $(".album_id").val();

var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);

var totalfiles = document.getElementById('filesaaa').files.length;
for (var index = 0; index < totalfiles; index++) {
//alert('for');
form_data.append("files[]", document.getElementById('filesaaa').files[index]);
} 


//alert('pic');
$.ajax({
url: sendUrl+"/post-ad/addstoreproductpic.php",
type: 'post',
data: form_data,
contentType: false,
processData: false,
});

// CUSTOM FIELDS 
/*  var inputs = readCustomFieldsstore($("#sp-form-post"), postid);*/
//alert('pic2');

var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);

var totalfiles = document.getElementById('filesaaa1').files.length;
for (var index = 0; index < totalfiles; index++) {
//alert('for2');
form_data.append("files[]", document.getElementById('filesaaa1').files[index]);
} 
// alert('99999'); 



$.ajax({
url: sendUrl+"/post-ad/addstorefeaturepic.php",
type: 'post',
data: form_data,
contentType: false,
processData: false,
});

/*console.log(inputs);*/
/*  $.each(inputs, function (i, val) {
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});
*/
$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");


// Feature IMAGE
var fimgCount = $(".featureimg").length;
$(".featureimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");
/*var isCheckeed = $('#'+fichek+':checked').val()?true:false;
if(isCheckeed == true){
spFeatureimg = 1;
}else{
spFeatureimg = 0;
}*/

/*var spFeatureimg = 1;
//this is for featured image end
var base64image = $(e).attr("src");
var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");*/


//$.post(sendUrl+"/post-ad/addstorefeaturepic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {


$(".postingimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");
/*var isCheckeed = $('#'+fichek+':checked').val()?true:false;
if(isCheckeed == true){
spFeatureimg = 1;
}else{
spFeatureimg = 0;
}*/

spFeatureimg = 0;
//this is for featured image end
var base64image = $(e).attr("src");
var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");


//  $.post(sendUrl+"/post-ad/addstoreproductpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
/*if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
//});
});




var seconds = 3; 
setInterval(function () {
//alert(seconds);
seconds--;
if (seconds == 0) {

window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid.trim();

}
}, 1000);


//alert(r);
//Timeline prepending
/*if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
//  });
});


// IMAGE
/*var imgCount = $(".postingimg").length;
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


$.post(sendUrl+"/post-ad/addstoreproductpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
});
});*/
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

//window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid.trim();
//this script for delay a redirect page for another page.

//====end=====
}).always(function () {
$(btn).button('reset');
});

}

}
}
}

var retailPrice = $('#retailPrice').val();

var subcategory_ = $('#subcategory_').val();
if(retailPrice == 0) {
//alert(retailPrice);
$(".lbl_50").text("Required");
//$(".label_error").text("Required");
}else{

$(".lbl_50").text(" ");
}
//alert(subcategory_);  
if(subcategory_ == "") {
//alert(retailPrice);   
$(".lbl_20").text("Required");
//$(".label_error").text("Required");
}

}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});


//save



$("#spdraft").on("click", function () {
 //alert('ddddd');


var sendUrl = MAINURL;


//alert('aaaaaa');


var visibility = $("#spPostingVisibility").val();
$("#spPostingVisibility").val("0");

if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
var isvalidfield = isfieldvalid();

//alert(isvalidfield);
if(isvalidfield != ""){
var title = document.getElementById("spPostingTitle").value;
var country = $('#spUserCountry option:selected').val();
var state = $('#spUserState option:selected').val();
var postids1 = document.getElementById("idspPostings").value;
var inudstryType = $('#industryType_ option:selected').val();
var sellType = $('#sellType_ option:selected').val();
if(title == ""){
$(".lbl_1").addClass("label_error");

} else if ($('.featurepic').prop('files').length == 0) {
if(postids1=="")
{
$(".lbl_1").removeClass("label_error");
$(".lbl_15").addClass("label_error");
}
}
else{

$(".lbl_15").removeClass("label_error");
if(country == 0) {
$(".lbl_2").addClass("label_error");

} else {

$(".lbl_2").removeClass("label_error");
if(state == 0){
$(".lbl_3").addClass("label_error");

}else{

$(".lbl_3").removeClass("label_error");

$(".lbl_4").removeClass("label_error");
//here is industry type
var type = 0;
if(sellType == "Auction"){

type = 1;
// alert('z')

}else if(sellType == "Retail"){

var retailPrice = document.getElementById("retailPrice").value;
var retailQuantity = document.getElementById("retailQuantity_").value;
var protypes2 = document.getElementById("protype").value;
//alert(protypes2);
if(protypes2==0)
{   
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
} else if(protypes2==1)
{

$checkboxQtyq2 = $('.qtynew');
var chkArrayqq2 = [];
chkArrayqq2 = $.map($checkboxQtyq2, function(elll2){
return elll2.value ;
});

if(chkArrayqq2.length<1)
{
alert('Please add options first.');

}
else
{
type = 1;
}    

}
}else if(sellType == "Personal"){
//   alert('alllll');
var retailPrice = document.getElementById("retailPrice").value;
// alert(retailPrice);
var retailQuantity = document.getElementById("retailQuantity_").value;
var protypes2 = document.getElementById("protype").value;
//alert(protypes2);
if(protypes2==0)
{   
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
} else if(protypes2==1)
{

$checkboxQtyq2 = $('.qtynew');
var chkArrayqq2 = [];
chkArrayqq2 = $.map($checkboxQtyq2, function(elll2){
return elll2.value ;
});

if(chkArrayqq2.length<1)
{
alert('Please add options first.');

}
else
{
type = 1;
}

}
}   else if (sellType == "Wholesale") {
// alert('whole');
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
}else if(sellType == "Manufacturer"){
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
$(".loadbox").css({ display: "block" });
$(btn).button('loading...');
term = $form.serializeArray();
url = $form.attr("action");

// console.log(term);
$.post(url, term, function (data, status) {
//alert('term');

}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');  
}).done(function (data) {
  var postid = data;
  var albumid = $(".album_id").val();

  var form_data = new FormData();
  form_data.append('spPostings_idspPostings', postid);

  var totalfiles = document.getElementById('filesaaa').files.length;
  for (var index = 0; index < totalfiles; index++) {
    form_data.append("files[]", document.getElementById('filesaaa').files[index]);
  } 

  var form_data2 = new FormData();
  form_data2.append('spPostings_idspPostings', postid);

  var totalfiles = document.getElementById('filesaaa1').files.length;
  for (var index = 0; index < totalfiles; index++) {
    form_data2.append("files[]", document.getElementById('filesaaa1').files[index]);
  } 

  $.ajax({
    url: sendUrl+"/post-ad/addstoreproductpic.php",
    type: 'post',
    data: form_data,
    contentType: false,
    processData: false,
  }).done(function (data) {
  
    $.ajax({
      url: sendUrl+"/post-ad/addstorefeaturepic.php",
      type: 'post',
      data: form_data2,
      contentType: false,
      processData: false,
    }).done(function (data) {
      window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid;  
    });
  
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

//window.location.href = sendUrl+"/store/previewdetail.php?catid=1&postid="+postid.trim();
//this script for delay a redirect page for another page.

//====end=====
}).always(function () {
$(btn).button('reset');
});

}

}
}
}

var retailPrice = $('#retailPrice').val();

var subcategory_ = $('#subcategory_').val();
if(retailPrice == 0) {
//alert(retailPrice);
$(".lbl_50").text("Required");
//$(".label_error").text("Required");
}else{

$(".lbl_50").text(" ");
}
//alert(subcategory_);  
if(subcategory_ == "") {
//alert(retailPrice);   
$(".lbl_20").text("Required");
//$(".label_error").text("Required");
}

}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});


//=================Preview product and Draft===========


//=================POST A STORE FORM DRAFT===========
//Save in Draft
var postedit = false;
$("#spSaveDraftStore").on("click", function () {
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

var inudstryType = $('#industryType_ option:selected').val();
var sellType = $('#sellType_ option:selected').val();


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

$(".lbl_4").removeClass("label_error");
//here is industry type
var type = 0;
if(sellType == "Auction"){

type = 1;
// alert('c');
/*var retailPrice = document.getElementById("retailPrice").value;
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
}*/
}else if(sellType == "Retail"){
var protypes2 = document.getElementById("protype").value;

if(protypes2==0)
{   
// alert('testing');
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
}
}else if(sellType == "Wholesale"){
// alert('xxxx');
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
}else if(sellType == "Manufacturer"){
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
$.post(sendUrl+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
});
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
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========
//Save in Draft
/*var postedit = false;
$("#spSaveDeactiveStore").on("click", function () {


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

var inudstryType = $('#industryType_ option:selected').val();
var sellType = $('#sellType_ option:selected').val();


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

$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");


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

window.location.href = "store/dashboard/deactive.php";


//window.location.reload();
}
}, 1000);
//====end=====
}).always(function () {
$(btn).button('reset');
});
}


}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});*/
//=================POST A STORE FORM DEACTIVATE END=======

});

