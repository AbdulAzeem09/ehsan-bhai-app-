
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



// STORE
//=================POST A STORE FORM START=============
$("#spPostTraining").on("click", function () {
var sendUrl = MAINURL;

if ($(this).hasClass("editing")){
// alert('1111');
postedit = true;
}
else{
// alert('22222');
postedit = false;
}

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
if(idspprofile != ""){
var title = document.getElementById("spPostingTitle").value;
var category = $('#trainingcategory_ option:selected').val();
//var company = document.getElementById("spPostingCompany_").value;
var totalhour = document.getElementById("totalhour_").value;
var bio = document.getElementById("spPostingTraimnerBio_").value;
var spRequiremnt = document.getElementById("spRequiremnt_").value;

var sp = document.getElementById("postingpic_training").value;
var video = document.getElementById("prevideo").value;
var desvideo = document.getElementById("addvideo").value;

var post_id = document.getElementById("post_id").value;







if(title == ""){
swal('Please Fill the Required');
$(".lbl_1").addClass("label_error");
}else{
$(".lbl_1").removeClass("label_error");
if(category == ""){
swal('Please Fill the Required');;
$(".lbl_2").addClass("label_error");
}else{
$(".lbl_2").removeClass("label_error");
//if(company == ""){
//$(".lbl_3").addClass("label_error");
//}else{
//$(".lbl_3").removeClass("label_error");
if(totalhour == ""){
swal('Please Fill the Required');
$(".lbl_4").addClass("label_error");
}else{
$(".lbl_4").removeClass("label_error");
if(bio == ""){
swal('Please Fill the Required');
$(".lbl_5").addClass("label_error");
}else{
$(".lbl_5").removeClass("label_error");
if(spRequiremnt == ""){
swal('Please Fill the Required');
$(".lbl_6").addClass("label_error");
}else{
$(".lbl_6").removeClass("label_error");

if(post_id==""){
if(sp==""){
 $("label[for='postingpic']").css("color","red");
swal('Please Fill the Required');
return false;
}
}
if(post_id==""){
if(video == ""){
	$("label[for='postingvideo']").css("color","red");
swal('Please Fill the Required');
return false;
}
}

if(post_id==""){
if(desvideo==""){
$("label[for='postingvideo']").css("color","red");
swal('Please Fill the Required');
return false;
}
}

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
//alert(postid);
var albumid = $(".album_id").val();
let res=postid.trim();
//alert(res);
//return false;

var form_data = new FormData();
//if(res!='' && postedit==true){
//alert(res);
if (postedit==true){
//alert('333');
var post=document.getElementById("post_id").value;
//alert(post);
form_data.append('spPostings_idspPostings', post);

}
if(postedit==false){
//alert('22222');
form_data.append('spPostings_idspPostings', postid);

}

//}
var totalfiles = document.getElementById('postingpic_training').files.length;
// alert(totalfiles);
for (var index = 0; index < totalfiles; index++) {
form_data.append("spPostingPic[]", document.getElementById('postingpic_training').files[index]);
} 

if(totalfiles!=''){

$.ajax({
url: sendUrl+"/post-ad/trainings/cover_image.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});
}


/*var form_data1 = new FormData();
form_data.append('spPostings_idspPostings', postid);*/

var totalfiles1 = document.getElementById('prevideo').files.length;
// alert(totalfiles1);
if(totalfiles1!=''){
for (var index = 0; index < totalfiles1; index++) {
form_data.append("spmediaTrainPrev", document.getElementById('prevideo').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/trainings/prev_video.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});

}




var totalfiles2 = document.getElementById('addattachment').files.length;
// alert(totalfiles1);
if(totalfiles2!=''){
for (var index = 0; index < totalfiles2; index++) {
form_data.append("spmediAttach", document.getElementById('addattachment').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/trainings/add_attachment.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});

}



var totalfiles3 = document.getElementById('addvideo').files.length;
//alert(totalfiles3);
if(totalfiles3!=''){

for (var index = 0; index < totalfiles3; index++) {
//	alert(index);
//var spPostingMedia = [];
form_data.append("spPostingMedia[]", document.getElementById('addvideo').files[index]);
}  

// console.log(spPostingMedia);    
//alert('hello');	


$.ajax({
url: sendUrl+"/post-ad/trainings/add_video.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});

}

// CUSTOM FIELDS 
var inputs = readCustomFields($("#sp-form-post"), postid);
$.each(inputs, function (i, val) {
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});
//DESCRIPTION UPDATE OF THE TEXT BOX
/*	var postingNotes = $("#spPostingNotes").Editor("getText");
var postOutline = $("#outline_").Editor("getText");
$.post(sendUrl+"/post-ad/trainings/updatenote.php", {postid: postid, postingNotes: postingNotes, postOutline:postOutline}, function (nte) {
//alert(nte);
});*/
//DESCRIPTION UPDATE TEXT EDITOR END
//VIDEOS UPDATE OF THE FORM START
var pid = $("#spProfiles_idspProfiles").val();
var featuredVdo = $('.featuredVdo:checked').attr("data-musicid");
if(featuredVdo > 0){
featvdo = featuredVdo;
}else{
featvdo = 0;
}
$.post(sendUrl+"/post-ad/trainings/updatevdo.php", {postid: postid, pid: pid, featvdo:featvdo }, function (vdo) {
//alert(vdo);
});
//VIDEOS UPDATE OF THE FORM END

// IMAGE
var imgCount = $(".postingimg0").length;
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
/*	if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
});
});

//Testing
/*	if (imgCount == 0){
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}*/
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
//}).always(function () {
//$(btn).button('reset');
})


}
}
}
//}
}
}
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM END=============
//=================POST A STORE FORM DRAFT===========



$("#spSaveDraft_").on("click", function () {


	
	var sendUrl = MAINURL;
	
	if ($(this).hasClass("hidden")){
	 //alert('1111');
	postedit = true;
	}
	else{
	 //alert('22222');
	postedit = false;
	}
	
	var btn = this;
	var idspprofile = $("#spProfiles_idspProfiles").val();
	var $form = $("#sp-form-post");
	if(idspprofile != ""){
	var title = document.getElementById("spPostingTitle").value;
	var category = $('#trainingcategory_ option:selected').val();
	//var company = document.getElementById("spPostingCompany_").value;
	var totalhour = document.getElementById("totalhour_").value;
	var bio = document.getElementById("spPostingTraimnerBio_").value;
	var spRequiremnt = document.getElementById("spRequiremnt_").value;
	
	var sp = document.getElementById("postingpic_training").value;
	var video = document.getElementById("prevideo").value;
	var desvideo = document.getElementById("addvideo").value;
	
	var post_id = document.getElementById("post_id").value;
	
	
	
	
	
	
	
	if(title == ""){
	swal('Please Fill the Required');
	$(".lbl_1").addClass("label_error");
	}else{
	$(".lbl_1").removeClass("label_error");
	if(category == ""){
	swal('Please Fill the Required');;
	$(".lbl_2").addClass("label_error");
	}else{
	$(".lbl_2").removeClass("label_error");
	//if(company == ""){
	//$(".lbl_3").addClass("label_error");
	//}else{
	//$(".lbl_3").removeClass("label_error");
	if(totalhour == ""){
	swal('Please Fill the Required');
	$(".lbl_4").addClass("label_error");
	}else{
	$(".lbl_4").removeClass("label_error");
	if(bio == ""){
	swal('Please Fill the Required');
	$(".lbl_5").addClass("label_error");
	}else{
	$(".lbl_5").removeClass("label_error");
	if(spRequiremnt == ""){
	swal('Please Fill the Required');
	$(".lbl_6").addClass("label_error");
	}else{
	$(".lbl_6").removeClass("label_error");
	
	if(post_id==""){
	if(sp==""){
	 $("label[for='postingpic']").css("color","red");
	swal('Please Fill the Required');
	return false;
	}
	}
	if(post_id==""){
	if(video == ""){
		$("label[for='postingvideo']").css("color","red");
	swal('Please Fill the Required');
	return false;
	}
	}
	
	if(post_id==""){
	if(desvideo==""){
	$("label[for='postingvideo']").css("color","red");
	swal('Please Fill the Required');
	return false;
	}
	}
	
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
	//alert(postid);
	var albumid = $(".album_id").val();
	let res=postid.trim();
	//alert(res);
	//return false;
	
	var form_data = new FormData();
	//if(res!='' && postedit==true){
	//alert(res);
	if (postedit==true){
	//alert('333');
	var post=document.getElementById("post_id").value;
	//alert(post);
	form_data.append('spPostings_idspPostings', post);
	
	}
	if(postedit==false){
	//alert('22222');
	form_data.append('spPostings_idspPostings', postid);
	
	}
	
	//}
	var totalfiles = document.getElementById('postingpic_training').files.length;
	// alert(totalfiles);
	for (var index = 0; index < totalfiles; index++) {
	form_data.append("spPostingPic[]", document.getElementById('postingpic_training').files[index]);
	} 
	
	if(totalfiles!=''){
	
	$.ajax({
	url: sendUrl+"/post-ad/trainings/cover_image.php",
	type: 'post',
	data: form_data,
	dataType: 'json',
	contentType: false,
	processData: false,
	});
	}
	
	var totalfiles1 = document.getElementById('prevideo').files.length;
	// alert(totalfiles1);
	if(totalfiles1!=''){
	for (var index = 0; index < totalfiles1; index++) {
	form_data.append("spmediaTrainPrev", document.getElementById('prevideo').files[index]);
	} 
	
	
	
	$.ajax({
	url: sendUrl+"/post-ad/trainings/prev_video.php",
	type: 'post',
	data: form_data,
	dataType: 'json',
	contentType: false,
	processData: false,
	});
	
	}
	
	
	
	
	var totalfiles2 = document.getElementById('addattachment').files.length;
	// alert(totalfiles1);
	if(totalfiles2!=''){
	for (var index = 0; index < totalfiles2; index++) {
	form_data.append("spmediAttach", document.getElementById('addattachment').files[index]);
	} 
	
	
	
	$.ajax({
	url: sendUrl+"/post-ad/trainings/add_attachment.php",
	type: 'post',
	data: form_data,
	dataType: 'json',
	contentType: false,
	processData: false,
	});
	
	}
	
	
	
	var totalfiles3 = document.getElementById('addvideo').files.length;
	//alert(totalfiles3);
	if(totalfiles3!=''){
	
	for (var index = 0; index < totalfiles3; index++) {
	//	alert(index);
	//var spPostingMedia = [];
	form_data.append("spPostingMedia[]", document.getElementById('addvideo').files[index]);
	}  
	
	// console.log(spPostingMedia);    
	//alert('hello');	
	
	
	$.ajax({
	url: sendUrl+"/post-ad/trainings/add_video.php",
	type: 'post',
	data: form_data,
	dataType: 'json',
	contentType: false,
	processData: false,
	});
	
	}
	
	// CUSTOM FIELDS 
	var inputs = readCustomFields($("#sp-form-post"), postid);
	$.each(inputs, function (i, val) {
	$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
	//alert(response);
	});
	});
	
	var pid = $("#spProfiles_idspProfiles").val();
	var featuredVdo = $('.featuredVdo:checked').attr("data-musicid");
	if(featuredVdo > 0){
	featvdo = featuredVdo;
	}else{
	featvdo = 0;
	}
	$.post(sendUrl+"/post-ad/trainings/updatevdo.php", {postid: postid, pid: pid, featvdo:featvdo }, function (vdo) {
	//alert(vdo);
	});
	//VIDEOS UPDATE OF THE FORM END
	
	// IMAGE
	var imgCount = $(".postingimg0").length;
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
	
	})
	
	
	}
	}
	}
	//}
	}
	}
	}else{
	$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
	}
	});
//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========

//=================POST A STORE FORM DEACTIVATE END=======

});