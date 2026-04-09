
//POSTING SCRIPT

$(document).ready(function () {
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

var span = document.getElementById("spPostSubmitPhotoProClose");

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$("#spPostSubmitPhotoPro").on("click", function (){
  modal.style.display = "block";  
})

// STORE
//=================POST A STORE FORM START=============
$("#spPostSubmitPhoto").on("click", function () {
$("#saveasdraft").val('0');
var sendUrl = MAINURL;

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
var category = $('#photos_ option:selected').val();
if(category==0){	
var category = $('#photoscraft_ option:selected').val();
}
var proValid = $("#proValidation").val();
var pro_name = $('#pro_profilename').val();
var pro_highlight = $('#pro_highlights').val();
var pro_category = $('#pro_category').val();

var	re_error=0;


//-----------Shipping Charge validation---------\\



if ($("#forfixedamountshipping").prop("checked")) {
var fixd_amount = document.getElementById("fixd_amount").value;
if (fixd_amount == "") {
$(".error_fixedamount").addClass("label_error");
var	re_error=1;

return false;
} else {
$(".error_fixedamount").removeClass("label_error");	
}
}
//-----------Shipping Charge validation end---------\\


var medium = $('#medium_ option:selected').val();
//var orgId = document.getElementById("spPostingEventOrgName").value;
//var mediaprint = document.getElementById("mediaprinted_").value;
var quantity = document.getElementById("quantity_").value;




var ppostingpicimage = document.getElementById("ppostingpicimage").value;
var ad_type = $('input[name="ad_type"]:checked').val();
// if(ppostingpicimage==''){
// $(".error_fix").addClass("label_error");
// var	re_error=1;
// swal("Required Fields should not be Empty!  1111");  
// }else{

// 	$(".error_fix").removeClass("label_error");		
// }

if(((ppostingpicimage=='') ||(title == "") ||(category == 0) || (quantity < 1) || (ad_type == undefined) ||(sppostcost == "") || (delvery_type=='1')) || (proValid == 1 && (pro_name == "" || pro_highlight == "" || pro_category == ""))){

  var delvery_type = $('input[type="radio"][name="return_if_applicable"]:checked').val();
	if(delvery_type=='1'){
	  $(".err_refund").addClass("label_error");
	} else {
	  $(".err_refund").removeClass("label_error");	
	}
	
	if(ppostingpicimage==''){
	  $(".error_fix").addClass("label_error");
		//var	re_error=1;
		//swal("Required Fields should not be Empty!  1111");  
	}else  {
	  $(".error_fix").removeClass("label_error");		
	}
	if(title == ""){
	  $(".lbl_1").addClass("label_error");
		//var	re_error=1;
		//swal("Required Fields should not be Empty! 33333");
	}else{
	  $(".lbl_1").removeClass("label_error");
	}
	if(category == 0){
	  //var	re_error=1;
		//swal("Required Fields should not be Empty! 4444");
		$(".lbl_4").addClass("label_error");
	}else{
	  $(".lbl_4").removeClass("label_error");
	}
	if(quantity < 1){
	  $(".lbl_8").addClass("label_error");
	}else{
	  $(".lbl_8").removeClass("label_error");
	}
	if(ad_type == undefined){
	  $(".lbl_7a").addClass("label_error");
	}else{
	  $(".lbl_7a").removeClass("label_error");
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
                    
	swal("Please fill Required Fields");
	return false;
}



if($('#imagecost_').is(':checked')) {   
		
 
	var sppostcost = $('#sppostcost').val(); 
	
	if(sppostcost == "") {
		$(".error_f").addClass("label_error");
		var	re_error=1;
	
	}
	else{
		$(".error_f").removeClass("label_error");	
	}}





// if($('#imagecost_').is(':checked')) {    

// var sppostcost = $('#sppostcost').val(); 

// if(sppostcost == "") {
// 	$(".error_f").addClass("label_error");
// 	var	re_error=1;

// 	swal("Required Fields should not be Empty!   2222");   

// return false;  

// }
// else{
// 	$(".error_f").removeClass("label_error");	
// }

// }       

// if(ad_type == undefined){
// swal("Type Is Required!");
// $(".lbl_7a").addClass("label_error");
// }else{
// 	$(".lbl_7a").removeClass("label_error");
//  }
// if(title == ""){
// 	$(".lbl_1").addClass("label_error");
// 	var	re_error=1;

// swal("Required Fields should not be Empty! 33333");

// }else{
// $(".lbl_1").removeClass("label_error");
// }
// if(category == 0){
// 	var	re_error=1;

// swal("Required Fields should not be Empty! 4444");
// $(".lbl_4").addClass("label_error");
// }else{
// $(".lbl_4").removeClass("label_error");
// }
// //if(mediaprint == ""){
// //$(".lbl_7").addClass("label_error");
// //}else{
// //$(".lbl_7").removeClass("label_error");
// if(quantity < 1){
// 	var	re_error=1;

// swal("Required Fields should not be Empty! 55555");
// $(".lbl_8").addClass("label_error");
// }else{
// $(".lbl_8").removeClass("label_error");
// }

//-----------Shipping Charge validation---------\\









// if ($("#refund_yes").prop("checked")) {
// var return_within = document.getElementById("return_within_iid").value;

// if (return_within == "") {
// $(".err_refund").addClass("label_error");
// var	re_error=1;

// return false;
// } else {
// $(".err_refund").removeClass("label_error");	
// }
// }





if(re_error==1){
	return false;
}
//-----------Shipping Charge validation end---------\\

//=============END OF VALIDATION
//console.log("Success");
// HERE WE WRITE A COMPLETE CODE
modal.style.display = "none";
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
$.each(inputs, function (i, val) {
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
//if(multi == 'None selected' || multi == ''){

//}else{
$.post(sendUrl+"/post-ad/addpostcustomfieldssize.php",{multi:multi,postid:postid}, function (re) {
//alert(re);
});
//}
}
//for dell image
// IMAGE
var imgCount = $(".postingimg").length;
$(".postingimg").each(function (i, e){
//alert(i);
//this is for featured image strt
var fichek = $(e).attr("data-name");
var isCheckeed = $('#'+fichek+':checked').val()?true:false;
if(isCheckeed == true){
spFeatureimg = 1;
}else{
spFeatureimg = 0;
}
//this is for featured image end
var formData = new FormData();
formData.append('spPostings_idspPostings', postid);
formData.append('spFeatureimg', spFeatureimg);
formData.append('postedit', postedit);
// Attach file 
formData.append('spPostingPic', $('input[type=file]')[0].files[i]); 

$.ajax({
url: sendUrl+"/post-ad/addpostingpicartcraft.php",
data: formData,
type: 'POST',
contentType: false, 
processData: false, 
});

//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
//	});
});
//=======Add video start=======

//Video post finaly
//ev.preventDefault();
/*var form_data = new FormData($("#sp-form-post")[0]);
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
});*/

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
$.notify({
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
});
//Message after form submited
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
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
//$(btn).button('reset');
});
//}
//}


//}
//}
//}
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM END=============
$("#spPostSavedraftPhoto").on("click", function () {
$("#saveasdraft").val('1');
var sendUrl = MAINURL;

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
var category = $('#photos_ option:selected').val();
if(category==0){	
var category = $('#photoscraft_ option:selected').val();
}

var medium = $('#medium_ option:selected').val();
//var orgId = document.getElementById("spPostingEventOrgName").value;
//var mediaprint = document.getElementById("mediaprinted_").value;
var quantity = document.getElementById("quantity_").value;

var ad_type = $('input[name="ad_type"]:checked').val();

if(ad_type == undefined){
swal("Type Is Required!");
$(".lbl_7a").addClass("label_error");
}else{
$(".lbl_7a").removeClass("label_error");
if(title == ""){
swal("Title Is Required!");
$(".lbl_1").addClass("label_error");
}else{

$(".lbl_1").removeClass("label_error");

if(category == 0){
swal("Category Is Required!");
$(".lbl_4").addClass("label_error");
}else{
$(".lbl_4").removeClass("label_error");

//if(mediaprint == ""){
//$(".lbl_7").addClass("label_error");
//}else{
//$(".lbl_7").removeClass("label_error");
if(quantity < 1){
swal("Quantity Is Required!");
$(".lbl_8").addClass("label_error");
}else{
$(".lbl_8").removeClass("label_error");
//=============END OF VALIDATION
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
$.each(inputs, function (i, val) {
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
// if(multi == 'None selected' || multi == ''){

// }else{
$.post(sendUrl+"/post-ad/addpostcustomfieldssize.php",{multi:multi,postid:postid}, function (re) {
//alert(re);
});
//}
}
//for dell image
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
$.post(sendUrl+"/post-ad/addpostingpicartcraft.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
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
$.notify({
title: '<strong>Save As Draft Successfully</strong>',
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
//Message after form submited
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
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
//$(btn).button('reset');
});
}
}


}

}
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});	
//=================POST A STORE FORM DRAFT===========

//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========

//=================POST A STORE FORM DEACTIVATE END=======

});
