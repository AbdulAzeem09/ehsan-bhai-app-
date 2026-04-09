
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
$(document).ready(function(){

var modal = document.getElementById("myModals");
var span = document.getElementById("spPostAdsProClose");

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$("#spPostAdsPro").on("click", function (){
  modal.style.display = "block";  
})


$("#spPostAds").on("click", function() {
//alert("pppppppppp"); 
//return false;
var sendUrl = MAINURL;



if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;

//alert("hello");
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
if(idspprofile != ""){
var postselection = $('#spPostSelection_ option:selected').val();
var country = $('#spPostCountry_ option:selected').val();
var state = $('#spPostState_ option:selected').val();
var postalcode = document.getElementById("spPostPostalCode_").value;
var title = document.getElementById("spPostingTitle").value;
// var title = $("#spPostingTitle").val();
var terms = $("#spPostingAgree_").prop('checked');
var skill = document.getElementById("skill1").value;
var proValid = $("#proValidation").val();
var pro_name = $('#pro_profilename').val();
var pro_highlight = $('#pro_highlights').val();
var pro_category = $('#pro_category').val();
var addPic      = $("#filesaaa1")[0].files; 
var uploadedPic = $("#fePreview").find("img:visible");
var postingNotes = $("#spPostingNotes").val().replace(/<[^>]+>/g, '');

if(((skill == '') || (postalcode == '') || (terms == '') || postselection == "" || title == "" || (addPic.length == 0 && uploadedPic.length == 0) || postingNotes == "") || (proValid == 1 && (pro_name == "" || pro_highlight == "" || pro_category == "")) ){
    swal.fire("Please Filled the Required");
}

if(skill == ""){
  //alert("please fill the required");
  $(".lbl_14").addClass("label_error");
  $(".lbl_14").text("please  enter any skill");
} else {
  $(".lbl_14").removeClass("label_error");
  $(".lbl_14").text("");
}
if(postalcode  == ""){
  //alert("please fill the required");
  $(".lbl_41").addClass("label_error");
  $(".lbl_41").text("* This field is required");
} else{
  $(".lbl_41").removeClass("label_error");
  $(".lbl_41").text("*");
}
if(title  == ""){
  $(".lbl_13").addClass("label_error");
  $(".lbl_13").text(" This field is required");
} else{
  $(".lbl_13").removeClass("label_error");
}
if(postselection  == ""){
  $(".postsection_error_msg").addClass("label_error");
  $(".postsection_error_msg").text("This field is required");
} else{
  $(".postsection_error_msg").text("");
}
if(postingNotes == ""){
  $("#errorDesc").addClass("label_error");
  $("#errorDesc").text("This field is required");
} else{
  $("#errorDesc").text("");
}
if(addPic.length == 0 && uploadedPic.length == 0){
  $(".lbl_pic_error_mcg").addClass("label_error");
  $(".lbl_pic_error_mcg").text("Photos are very important to attract others to your ads. Please add photos.");
} else {
  $(".lbl_pic_error_mcg").removeClass("label_error");
  $(".lbl_pic_error_mcg").text("");
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
if(country == 0){
  $(".lbl_1").addClass("label_error");
}else{
  $(".lbl_1").removeClass("label_error");
if(state == 0){
  $(".lbl_2").addClass("label_error");
}else{
  $(".lbl_2").removeClass("label_error");
if(postalcode == ""){ 
  $(".lbl_3").addClass("label_error");
}else{
  $(".lbl_3").removeClass("label_error");
if(postselection == ""){ 
  $(".lbl_41").addClass("label_error");
}else{
  $(".lbl_41").removeClass("label_error");
  if(postingNotes == ""){
    $("#errorDesc").addClass("label_error");
  } else {
    $("#errorDesc").removeClass("label_error");
if(addPic.length == 0 && uploadedPic.length == 0){
  $(".lbl_pic_error_mcg").addClass("label_error");
} else {
  $(".lbl_pic_error_mcg").removeClass("label_error");
if(title == ""){ 
  $(".lbl_13").addClass("label_error");
}else{
  $(".lbl_13").removeClass("label_error");
if (proValid == 1 && pro_name == "") {
  $(".proname").addClass("label_error");
  $(".proname").text("Please Enter Professional Profile Name");
} else {
  $(".proname").removeClass("label_error");
  $(".proname").text("Professional Profile Name");
if (proValid == 1 && pro_highlight == "") {
  $(".carrerhighlight").addClass("label_error");
  $(".carrerhighlight").text("Please Enter Career Highlights");
} else {
  $(".carrerhighlight").removeClass("label_error");
  $(".carrerhighlight").text("Career Highlights");
if (proValid == 1 && pro_category == "") {
  $(".careercat").addClass("label_error");
  $(".careercat").text("Please Select Career Category");
} else {
  $(".careercat").removeClass("label_error");
  $(".careercat").text("Career Category");
if (terms == false) {
//alert("i agree to all term and condition");
$(".spTerms").html("Please check terms and conditions.");
}else{
$(".spTerms").html("");




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
/*var inputs = readCustomFields($("#sp-form-post"), postid);
$.each(inputs, function (i, val) {
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});*/

//DESCRIPTION UPDATE OF THE TEXT BOX
/*	var postingNotes = $("#spPostingNotes").Editor("getText");
$.post(sendUrl+"/post-ad/services/updatenote.php", {postid: postid, postingNotes: postingNotes}, function (nte) {
//alert(nte);
});*/
//DESCRIPTION UPDATE TEXT EDITOR END

// IMAGE


var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);
//	form_data.append('spFeatureimg', spFeatureimg);
//	form_data.append('postedit', postedit);

var totalfiles = document.getElementById('filesaaa').files.length;
//alert(totalfiles);
for (var index = 0; index < totalfiles; index++) {
form_data.append("files[]", document.getElementById('filesaaa').files[index]);
} 

$.ajax({
url: sendUrl+"/post-ad/addclassifiedpic.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});

var form_data1 = new FormData();
form_data1.append('spPostings_idspPostings', postid);

var totalfiles = document.getElementById('filesaaa1').files.length;
for (var index = 0; index < totalfiles; index++) {
form_data1.append("files[]", document.getElementById('filesaaa1').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/addclassifiedfeaturepic.php",
type: 'post',
data: form_data1,
dataType: 'json',
contentType: false,
processData: false,
});





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
//	$.post(sendUrl+"/post-ad/addclassifiedpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {


/*        				var fimgCount = $(".featureimg").length;

$(".featureimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");

var spFeatureimg = 1;
//this is for featured image end
var base64imagef = $(e).attr("src");
var arr = base64imagef.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(sendUrl+"/post-ad/addclassifiedfeaturepic.php", {spPostings_idspPostings: postid, spPostingPic: base64imagef, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);

});
});*/


//alert(r);
//Timeline prepending
/*if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
///});
});


$(".featureimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");
/*var isCheckeed = $('#'+fichek+':checked').val()?true:false;
if(isCheckeed == true){
spFeatureimg = 1;
}else{
spFeatureimg = 0;
}*/


var spFeatureimg = 1;
//this is for featured image end

//$.post(sendUrl+"/post-ad/addclassifiedfeaturepic.php", {spPostings_idspPostings: postid, spPostingPic: base64imagef, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
/*if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
//window.location.href = "../../services/dashboard/active.php"
//});
});



//Testing
/*if (imgCount == 0){
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}*/
//notification message from send box

$.notify({
title: '<strong>Submitted Successfully </strong>',
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
//window.location.href = "posting.php?postid="+postid.trim();
window.location.href = "../../services/dashboard/active.php?msg1=access"

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
}
}
}
}
} 
}
}
}else{
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}

});   
});
//=================POST A STORE FORM END=============
//=================POST A STORE FORM DRAFT===========

$("#spSaveDraftServ").on("click", function () {

var terms = $("#spPostingAgree_").prop('checked');

if (terms == false) 
{
//alert("11");
$(".spTerms").html("Please check terms and conditions.");
//alert("plz check the all term and condition");
$(".loadbox").css({ display: "none" });
return false;
}else{
//alert("22");
$(".spTerms").html("");
$(".loadbox").css({ display: "block" });
}		
/*if ('#spPostingAgree_').is(":checked")) {   

$("#spTerms").html ("Thanks for subscribe the form");  
}
else  
{  


$("#spTerms").html ("please follow the terms and conditions.");  .
return false;

}
*/

//alert();
var sendUrl = MAINURL;
//var visibility = $("#spPostingVisibility").val();
$("#spPostingVisibility").val("0");
if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
if(idspprofile != ""){
var country = $('#spPostCountry_ option:selected').val();
var state = $('#spPostState_ option:selected').val();
var postalcode = document.getElementById("spPostPostalCode_").value;
var title = document.getElementById("spPostingTitle").value;

if(country == 0){
$(".lbl_1").addClass("label_error");
}else{
$(".lbl_1").removeClass("label_error");
if(state == 0){
$(".lbl_2").addClass("label_error");
}else{
$(".lbl_2").removeClass("label_error");
if(postalcode == ""){
$(".lbl_3").text(" Please Enter Event Address");

}else{
$(".lbl_3").text("");
}
if(postalcode == ""){

$(".lbl_3").addClass("label_error");
}else{
$(".lbl_3").removeClass("label_error");
if(title == ""){
$(".lbl_4").addClass("label_error");
}else{
$(".lbl_4").removeClass("label_error");



//=============END OF VALIDATION
//console.log("Success");
// HERE WE WRITE A COMPLETE CODE





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
/*var inputs = readCustomFields($("#sp-form-post"), postid);
$.each(inputs, function (i, val) {
$.post(sendUrl+"/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});*/

var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);
//	form_data.append('spFeatureimg', spFeatureimg);
//	form_data.append('postedit', postedit);

var totalfiles = document.getElementById('filesaaa').files.length;
for (var index = 0; index < totalfiles; index++) {
form_data.append("files[]", document.getElementById('filesaaa').files[index]);
} 



$.ajax({
url: sendUrl+"/post-ad/addclassifiedpic.php",
type: 'post',
data: form_data,
dataType: 'json',
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
url: sendUrl+"/post-ad/addclassifiedfeaturepic.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});






//DESCRIPTION UPDATE OF THE TEXT BOX
/*var postingNotes = $("#spPostingNotes").Editor("getText");
$.post(sendUrl+"/post-ad/services/updatenote.php", {postid: postid, postingNotes: postingNotes}, function (nte) {
//alert(nte);
});*/
//DESCRIPTION UPDATE TEXT EDITOR END

// IMAGE





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
//$.post(sendUrl+"/post-ad/addclassifiedpic.php", {spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {

/*	var fimgCount = $(".featureimg").length;
//alert(imgCount);
//alert(postid);
$(".featureimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");



var spFeatureimg = 1;
//this is for featured image end
var base64imagef = $(e).attr("src");
var arr = base64imagef.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(sendUrl+"/post-ad/addclassifiedfeaturepic.php", {spPostings_idspPostings: postid, spPostingPic: base64imagef, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending

});
});*/
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

var fimgCount = $(".featureimg").length;
//alert(imgCount);
//alert(postid);
$(".featureimg").each(function (i, e){
//this is for featured image strt
var fichek = $(e).attr("data-name");
/*var isCheckeed = $('#'+fichek+':checked').val()?true:false;
if(isCheckeed == true){
spFeatureimg = 1;
}else{
spFeatureimg = 0;
}*/


var spFeatureimg = 1;
//this is for featured image end

//$.post(sendUrl+"/post-ad/addclassifiedfeaturepic.php", {spPostings_idspPostings: postid, spPostingPic: base64imagef, ext: ext, spFeatureimg:spFeatureimg, postedit:postedit}, function (r) {
//alert(r);
//Timeline prepending
/*if (i == imgCount - 1) {
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}*/
// window.location.href = "../../services/dashboard/draft.php";
//});
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
title: '<strong>Submitted Successfully</strong>',
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
window.location.href = "../../services/dashboard/draft.php";
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

//=================POST A STORE FORM DRAFT END=======
//=================POST A STORE FORM DE-ACTIVATE===========

//=================POST A STORE FORM DEACTIVATE END=======

});
