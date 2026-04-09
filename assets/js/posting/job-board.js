
//POSTING SCRIPT
/*alert("sdsdf");*/
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
// STORE
//=================POST A STORE FORM START=============
$("#spPostSubmitjob").on("click", function () {
//alert("erwer");
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
// alert(state);
var jobDesc = document.getElementById("spPostingNotes").value;
var skill = $("#tokenfield-typeahead").val();


var idspPostings = $('#idspPostings').val();
var salFrom = $("#spPostingSlryRngFrm_").val();
var salTo = $("#spPostingSlryRngTo_").val();
var jobLevel = $('#spPostingJoblevel_ option:selected').val();
//alert(jobLevel);
var noOfPosition = $("#spPostingNoofposition_").val();
var jobLocatioin = $("#spPostingLocation_").val();
var jobPost = $('#spPostingJobAs_ option:selected').val();


var jobCurrency = $('#job_currency option:selected').val();

var jobType = $('#spPostingJobType_ option:selected').val();
//alert(jobLocatioin);
var jobExpernce = $("#spPostingExperience_").val();
var Status = $("#status_").val();
//alert(Status);
//var jobExpernce = $("#spPostingExperience_").val();

// alert(jobCurrency);
var bussVal = $("#businessValidation").val();
var businessProfileName = $("#businessprofilename").val();
var businessName = $("#businessname").val();
var businessCategory = $("#businesscategory").val();
var busCountry = $("#spCountry_default_address").val();
var busState = $("#spUserState11").val();
if((title == "")||(jobDesc == "")||(skill == "")||(jobType ==0)||(jobLocatioin ==0)||(jobLevel ==0)||(jobPost ==0) ||(jobCurrency ==0)||(noOfPosition == "")||(salTo == "")||(salFrom == "")||(jobExpernce == "")||(Status ==0)||(country=="")||(state=="Select State") || (bussVal == 1 && businessProfileName == "") || (bussVal == 1 && businessName == "") || (bussVal == 1 && businessCategory == "") || (bussVal == 1 && busCountry == "0") || (bussVal == 1 && busState == "0")){
  //alert(2222);
  if(title == ""){
    $(".lbl_1").addClass("label_error");
  }else{
    $(".lbl_1").removeClass("label_error");
  }

  if(jobDesc == ""){
    $(".lbl_4").addClass("label_error");
  }else{
    $(".lbl_4").removeClass("label_error");
  }
  if(skill == ""){
    $(".lbl_5").addClass("label_error");
  }else{
    $(".lbl_5").removeClass("label_error");
  }
  if(jobType ==0){
    $(".lbl_11").addClass("label_error");
  }else{
    $(".lbl_11").removeClass("label_error");
  }
  if(jobLocatioin ==0){
    $(".lbl_9").addClass("label_error");
  }else{
    $(".lbl_9").removeClass("label_error");
  }
  if(jobLevel ==0){
    $(".lbl_7").addClass("label_error");
  }else{
    $(".lbl_7").removeClass("label_error");
  }
  if(jobPost ==0){
    $(".lbl_10").addClass("label_error");
  }else{
    $(".lbl_10").removeClass("label_error");
  }

  if(jobCurrency ==0){
    $(".lbl_101").addClass("label_error");
  }else{
    $(".lbl_101").removeClass("label_error");
  }
  if(noOfPosition == ""){
    $(".lbl_8").addClass("label_error");
  }else{
    $(".lbl_8").removeClass("label_error");
  }
  if(salFrom == ""){
    $(".lbl_6").addClass("label_error");
  }else{
    $(".lbl_6").removeClass("label_error");
  }
  if(salTo == ""){
    $(".lbl_6").addClass("label_error");
  }else{
    $(".lbl_6").removeClass("label_error");
  }
  if(jobExpernce == ""){
    $(".lbl_12").addClass("label_error");
  }else{
    $(".lbl_12").removeClass("label_error");
  }
  if(Status ==0){
    $(".lbl_13").addClass("label_error");
  }else{
    $(".lbl_13").removeClass("label_error");
  }
  if(country == ""){
    $(".lbl_2").addClass("label_error");
  }else{
    $(".lbl_2").removeClass("label_error");
  }

  if(state == "Select State"){
    $(".lbl_3").addClass("label_error");
  }else{
    $(".lbl_3").removeClass("label_error");
  }

  if(bussVal == 1 && businessProfileName == ""){
    $(".bpname").addClass("label_error");
  }else{
    $(".bpname").removeClass("label_error");
  }

  if(bussVal == 1 && businessName == ""){
    $(".bname").addClass("label_error");
  }else{
    $(".bname").removeClass("label_error");
  }

  if(bussVal == 1 && businessCategory == ""){
    $(".catname").addClass("label_error");
  }else{
    $(".catname").removeClass("label_error");
  }

  if(bussVal == 1 && busCountry == "0"){
    $(".bcountry").addClass("label_error");
  }else{
    $(".bcountry").removeClass("label_error");
  }

  if(bussVal == 1 && busState == "0"){
    $(".bstate").addClass("label_error");
  }else{
    $(".bstate").removeClass("label_error");
  }


  return false;
}









//end of restricon
//HERE IS POSTING A JOBS=======================
$(".loadbox").css({ display: "block" });
$(btn).button('loading...');
term = $form.serializeArray();
url = $form.attr("action");
$.post(url, term, function (data, status) {
}).fail(function () {
$(btn).effect("shake");

}).done(function (data) {

//return false;

//alert(data);
var postid = data;
var albumid = $(".album_id").val();
//notification message from send box
/*	$.notify({
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
/* old version of send data
if ($("#catname").val() != ""){
swal({
title: $("#spPostingTitle").val() + " Posted!",
text: "View Your <a href='../post-details/?postid=" + postid + "' style='color:#F8BB86'>Post</a>",
html: true
});
}*/
// CUSTOM FIELDS
var inputs = readCustomFields($("#sp-form-post"), postid);
$.each(inputs, function (i, val) {
$.post(MAINURL+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});

//$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");

// IMAGE
var imgCount = $(".postingimg").length;
$(".postingimg").each(function (i, e){

var base64image = $(e).attr("src");
var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(MAINURL+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext}, function (r) {
//Timeline prepending
if (i == imgCount - 1) {
$.get(MAINURL+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}
//Timeline prepending complete
});
});

$(".postingvideo").each(function (i, e){

var base64image = $(e).attr("data-media");
//alert(base64image);
var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
var ext = arr[0].replace("data:", "");
$.post("../post-ad/addpostingvideo.php", {spPostings_idspPostings: postid, spPostingVids: base64image, ext: ext}, function (r) {
//alert(r);
});
});
//Testing
if (imgCount == 0)
{
$.get(MAINURL+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}
//Testing Complete
//Media
$(".media-file-data").each(function (i, e)
{

var base64image = $(e).attr("data-media");
var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
var ext = arr[0].replace("data:", "");

$.post("../post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
//alert(r);
});
});

$("#dvPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
/*	var seconds = 10;
setInterval(function () {
seconds--;
if (seconds == 0) {
window.location.href = "posting.php?postid="+postid.trim();
//window.location.reload();
}
}, 1000);*/

if(idspPostings){
var msg='uupdate';
}
else{
	var msg='post';
}

window.location.href = "../../job-board/dashboard/active-post.php?msg1="+msg;


}).always(function () {
//$(btn).button('reset');
});

}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});









//////====================post  expire me update ============///////
$("#spPostSubmitjobupdate").on("click", function () {

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

	var visibility = document.getElementById('sppostingvisibility').value;
	var expdate = document.getElementById('spPostingExpDtjob').value;
	document.getElementById('spPostingExpDt').value = expdate;
	

	var state = $('#spUserState option:selected').val();
	// alert(state);
	var jobDesc = document.getElementById("spPostingNotes").value;
	var skill = $("#tokenfield-typeahead").val();
	
	
	var idspPostings = $('#idspPostings').val();
	var salFrom = $("#spPostingSlryRngFrm_").val();
	var salTo = $("#spPostingSlryRngTo_").val();
	var jobLevel = $('#spPostingJoblevel_ option:selected').val();
	//alert(jobLevel);
	var noOfPosition = $("#spPostingNoofposition_").val();
	var jobLocatioin = $("#spPostingLocation_").val();
	var jobPost = $('#spPostingJobAs_ option:selected').val();
	
	
	var jobCurrency = $('#job_currency option:selected').val();
	
	var jobType = $('#spPostingJobType_ option:selected').val();
	//alert(jobLocatioin);
	var jobExpernce = $("#spPostingExperience_").val();
	var Status = $("#status_").val();
	//alert(Status);
	//var jobExpernce = $("#spPostingExperience_").val();
	
	// alert(jobCurrency);
	
	
	
	if((title == "")||(jobDesc == "")||(skill == "")||(jobType ==0)||(jobLocatioin ==0)||(jobLevel ==0)||(jobPost ==0) ||(jobCurrency ==0)||(noOfPosition == "")||(salTo == "")||(salFrom == "")||(jobExpernce == "")||(Status ==0)||(country=="")||(state=="Select State")){			
	//alert(2222);
	if(title == ""){
	$(".lbl_1").addClass("label_error");
	}else{
	$(".lbl_1").removeClass("label_error");
	}
	
	if(jobDesc == ""){
	$(".lbl_4").addClass("label_error");
	}else{
	$(".lbl_4").removeClass("label_error");
	}
	if(skill == ""){
	$(".lbl_5").addClass("label_error");
	}else{
	$(".lbl_5").removeClass("label_error");
	}
	if(jobType ==0){
	$(".lbl_11").addClass("label_error");
	}else{									
	$(".lbl_11").removeClass("label_error");
	}
	if(jobLocatioin ==0){
	$(".lbl_9").addClass("label_error");
	}else{
	$(".lbl_9").removeClass("label_error");
	}
	if(jobLevel ==0){
	$(".lbl_7").addClass("label_error");
	}else{
	$(".lbl_7").removeClass("label_error");
	}
	if(jobPost ==0){
	$(".lbl_10").addClass("label_error");
	}else{
	$(".lbl_10").removeClass("label_error");
	}
	
	if(jobCurrency ==0){
	$(".lbl_101").addClass("label_error");
	}else{
	$(".lbl_101").removeClass("label_error");
	}
	if(noOfPosition == ""){
	$(".lbl_8").addClass("label_error");
	}else{
	$(".lbl_8").removeClass("label_error");
	}
	if(salFrom == ""){
	$(".lbl_6").addClass("label_error");
	}else{
	$(".lbl_6").removeClass("label_error");
	}
	if(salTo == ""){
	$(".lbl_6").addClass("label_error");
	}else{
	$(".lbl_6").removeClass("label_error");
	}
	if(jobExpernce == ""){
	$(".lbl_12").addClass("label_error");
	}else{
	$(".lbl_12").removeClass("label_error");
	}
	if(Status ==0){
	$(".lbl_13").addClass("label_error");
	}else{
	$(".lbl_13").removeClass("label_error");
	}
	
	
		
	
	
	if(country == ""){
	$(".lbl_2").addClass("label_error");
	}else{
	$(".lbl_2").removeClass("label_error");
	}	
	
	if(state == "Select State"){
		
	$(".lbl_3").addClass("label_error");
	}else{
	$(".lbl_3").removeClass("label_error");
	}	 
	return false;	
	}
	
	
	
	
	
	
	
	
	
	
	//end of restricon
	//HERE IS POSTING A JOBS=======================
	$(".loadbox").css({ display: "block" });
	$(btn).button('loading...');
	term = $form.serializeArray();
	url = $form.attr("action");
	$.post(url, term, function (data, status) {
	}).fail(function () {
	$(btn).effect("shake");
	
	}).done(function (data) {
	
	//return false;
	
	//alert(data);
	var postid = data;
	var albumid = $(".album_id").val();
	//notification message from send box
	/*	$.notify({
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
	/* old version of send data
	if ($("#catname").val() != ""){
	swal({
	title: $("#spPostingTitle").val() + " Posted!",
	text: "View Your <a href='../post-details/?postid=" + postid + "' style='color:#F8BB86'>Post</a>",
	html: true
	});
	}*/
	// CUSTOM FIELDS
	var inputs = readCustomFields($("#sp-form-post"), postid);
	$.each(inputs, function (i, val) {
	$.post(MAINURL+"/post-ad/addpostcustomfields.php", val, function (response) {
	//alert(response);
	});
	});
	
	//$("#sp-form-post :input").not("#spProfiles_idspProfiles, #spPostingVisibility, #spCategories_idspCategory").val("");
	
	// IMAGE
	var imgCount = $(".postingimg").length;
	$(".postingimg").each(function (i, e){
	
	var base64image = $(e).attr("src");
	var arr = base64image.match(/data:image\/[a-z]+;/);
	var ext = arr[0].replace("data:image/", "");
	ext = ext.replace(";", "");
	$.post(MAINURL+"/post-ad/addpostingpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext}, function (r) {
	//Timeline prepending
	if (i == imgCount - 1) {
	$.get(MAINURL+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
	$("#timeline-container").prepend(r);
	//$(btn).button('reset');
	//alert(r);
	});
	}
	//Timeline prepending complete
	});
	});
	
	$(".postingvideo").each(function (i, e){
	
	var base64image = $(e).attr("data-media");
	//alert(base64image);
	var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
	var ext = arr[0].replace("data:", "");
	$.post("../post-ad/addpostingvideo.php", {spPostings_idspPostings: postid, spPostingVids: base64image, ext: ext}, function (r) {
	//alert(r);
	});
	});
	//Testing
	if (imgCount == 0)
	{
	$.get(MAINURL+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
	$("#timeline-container").prepend(r);
	//$(btn).button('reset');
	//alert(r);
	});
	}
	//Testing Complete
	//Media
	$(".media-file-data").each(function (i, e)
	{
	
	var base64image = $(e).attr("data-media");
	var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
	var ext = arr[0].replace("data:", "");
	
	$.post("../post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
	//alert(r);
	});
	});
	
	$("#dvPreview").html("");
	$("#clearnow").val("");
	$(".grptimeline").val("");
	$("#postform .form-control").val("");
	//document.getElementById("sp-form-post").reset();
	/*	var seconds = 10;
	setInterval(function () {
	seconds--;
	if (seconds == 0) {
	window.location.href = "posting.php?postid="+postid.trim();
	//window.location.reload();
	}
	}, 1000);*/
	
	if(idspPostings){
	var msg='uupdate';
	}
	else{
		var msg='post';
	}
	
	window.location.href = "../../job-board/dashboard/active-post.php?msg1="+msg;
	
	
	}).always(function () {
	//$(btn).button('reset');
	});
	
	}else{
	$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
	}
	});































//=================POST A STORE FORM END=============
//=================POST A STORE FORM DRAFT===========
//Save in Draft
var postedit = false;
$("#spSaveDraftJob").on("click", function () {
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
var country = $('#spPostingsCountry option:selected').val();
var state = $('#spUserState option:selected').val();
var jobDesc = document.getElementById("spPostingNotes").value;
var skill = $("#tokenfield-typeahead").val();
var salFrom = $("#spPostingSlryRngFrm_").val();
var salTo = $("#spPostingSlryRngTo_").val();
var jobLevel = $('#spPostingJoblevel_ option:selected').val();
var noOfPosition = $("#spPostingNoofposition_").val();
var jobLocatioin = $("#spPostingLocation_").val();
var jobPost = $('#spPostingJobAs_ option:selected').val();
var jobType = $('#spPostingJobType_ option:selected').val();
var jobExpernce = $("#spPostingExperience_").val();

if(title == ""){
$(".lbl_1").addClass("label_error");
//alert("aaaaaaaaaaa");
 return false;
}else{
$(".lbl_1").removeClass("label_error");
//alert("ddddddddddd");
}

if(country == 0){
$(".lbl_2").addClass("label_error");
return false;
}else{
$(".lbl_2").removeClass("label_error");
}

if(state == 0){
$(".lbl_3").addClass("label_error");
return false;
}else{
$(".lbl_3").removeClass("label_error");
}

if(jobDesc == ""){
$(".lbl_4").addClass("label_error");
return false;
}else{
$(".lbl_4").removeClass("label_error");
}

if(skill == ""){
$(".lbl_5").addClass("label_error");
return false;
}else{
$(".lbl_5").removeClass("label_error");
}

if(salFrom == ""){
$(".lbl_6").addClass("label_error");
return false;
}else{
$(".lbl_6").removeClass("label_error");
}

if(salTo == ""){
$(".lbl_6").addClass("label_error");
return false;
}else{
$(".lbl_6").removeClass("label_error");
}

if(jobLevel == ""){
$(".lbl_7").addClass("label_error");
return false;
}else{
$(".lbl_7").removeClass("label_error");
}

if(noOfPosition == ""){ 
$(".lbl_8").addClass("label_error");
return false;
}else{
$(".lbl_8").removeClass("label_error");
}

if(jobLocatioin == ""){
$(".lbl_9").addClass("label_error");
return false;
}else{
$(".lbl_9").removeClass("label_error");
}

if(jobPost == ""){
$(".lbl_10").addClass("label_error");
return false;
}else{
$(".lbl_10").removeClass("label_error");
}

if(jobType == ""){
$(".lbl_11").addClass("label_error");
return false;
}else{
$(".lbl_11").removeClass("label_error");
}

if(jobExpernce == ""){
$(".lbl_12").addClass("label_error");
return false;
}else{
$(".lbl_12").removeClass("label_error");
}

//end of restricon
//HERE IS POSTING A JOBS=======================
$(".loadbox").css({ display: "block" });
//e.preventDefault();
$(btn).button('loading');
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
//only for event module
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

});
}
//====end===
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
$.post("../../post-ad/addmedia.php", {spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid}, function (r) {
//alert(r);
});
});
$("#dvPreview").html("");
//notification message from send box
/*$.notify({
title: '<strong>Saved in the draft!</strong>',
icon: 'fa fa-info',
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
//this script for delay a redirect page for another page.
/*		var seconds = 10;
setInterval(function () {
seconds--;
if (seconds == 0) {
window.location.href = "posting.php?postid="+postid.trim();
//window.location.reload();
}
}, 1000);*/


window.location.href = "../../job-board/dashboard/draft-post.php";
//====end=====
}).always(function () {
$(btn).button('reset');
});
/*}
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
}*/
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========
//Save in Draft
var postedit = false;
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
