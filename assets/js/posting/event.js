
//POSTING SCRIPT


$(document).ready(function () {



$('.closed').click(function(){
//alert("fsjh");    //Some code
});

var hostUrl = window.location.host;
var hostSchema = window.location.protocol;
var MAINURL = hostSchema + '//' + hostUrl;
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
inputs = { spPostFieldLabel: l, spPostFieldName: n, spPostFieldValue: v, spPostings_idspPostings: $postid, spCategories_idspCategory: $(".spCategories_idspCategory").val(), spPostFieldIsFilter: f, editing_: postedit };
formfields.push(inputs);
});
return formfields;
}
// STORE
//=================POST A STORE FORM START=============
$("#spPostgroupSubmit").on("click", function () {
var sendUrl = MAINURL;
if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
if (idspprofile != "") {
//alert(title);
var spgroupid = $('#spgroupid').val();
var spgroupname = $('#spgroupname').val();
//alert(spgroupid);
//alert(spgroupname);

var title = document.getElementById("spPostingTitle").value;
var country = $('#spUserCountry-1 option:selected').val();
var state = $('#spUserState option:selected').val();
var city = $('#spPostingsCity option:selected').val();
var category = $('#eventcategory_ option:selected').val();

//var postPrice = document.getElementById("spPostingPrice").value;
var postPrice = 'a';
var postVenu = document.getElementById("spPostingEventVenue_").value;
var halCap = 0;
var tktCap = 0;
var strDate = document.getElementById("spPostingStartDate_").value;
var endDate = document.getElementById("spPostingEndDate_").value;
var strTime = document.getElementById("spPostingStartTime").value;
// var strTime = 'yes';
//alert(strTime);
var endTime = document.getElementById("spPostingEndTime_").value;
// var endTime = 'yes';
var organiser = document.getElementById("spPostingEventOrgId_").value;
organiser = 'yes';
var eventaddress = document.getElementById("eventaddress").value;

var eventstartdate = new Date($("#spPostingStartDate_").val());
var eventenddate = new Date($("#spPostingExpDt").val());

// alert(eventstartdate);
//  alert(eventenddate);
if (tktCap > halCap) {

$("#tic_cap").text("Ticket Capacity cannot be greater than Hall Capacity");

} else {
$("#tic_cap").text(" ");
}


if (eventstartdate > eventenddate) {


$("#end_date").text(" End must be greater");
} else {

$("#end_date").text("");
}

if (endTime != "") {
if (strTime >= endTime) {
$("#end_time").text(" End time must be greater");
return false;
} else {
$("#end_time").text(" ");
}
}




/*alert(category);*/
/*if(title == ""  ){*/
if (title == "" && country == 0 && state == 0 && city == 0 && category == 0 && postPrice == "" && postVenu == "" && halCap == "" && tktCap == "" && eventaddress == "" && strDate == "" && endDate == "") {
$("#lbl_4").text(" Select Category");
$("#lbl_1").text(" Enter Event Title");
$("#lbl_2").text(" Select Country");
$("#lbl_3").text(" Select State"); 
$("#lbl_city").text(" Select city");

//$("#org_err").text(" Please Select Organiser");
$("#evadd_err").text(" Please Enter About Evnet");


$("#lbl_5").text(" Enter Ticket Price");
$("#lbl_6").text(" Enter Venue");
$("#lbl_7").text("Fill Capacity");
$("#lbl_8").text("Fill Capacity");
$("#lbl_9").text(" Select Start Date");
$("#lbl_10").text(" Select End Date");
$("#lbl_11").text(" Enter Start Time");
$("#lbl_12").text(" Enter End Time");

$("#spPostingTitle").focus();

} else {

if (title == "") {
$(".lbl_1").addClass("label_error");
$("#lbl_1").text(" Enter Event Title");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
} else {
$(".lbl_1").removeClass("label_error");
if (country == 0) {

$("#lbl_1").text("");
$("#lbl_2").text(" Select Country");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
} else {

if (state == 0) {
$(".lbl_3").addClass("label_error");
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" Select State");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
if (city == 0) {
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" Select city");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {

if (category == "") {
$(".lbl_4").addClass("label_error");
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" Select Category");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {

$(".lbl_4").removeClass("label_error");
if (postPrice == "") {
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" Enter Ticket Price");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
$(".lbl_5").removeClass("label_error");
if (postVenu == "") {
$(".lbl_6").addClass("label_error");
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text("");
$("#lbl_4").text(" ");
$("#lbl_5").text("");
$("#lbl_6").text(" Enter Venue");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
// $(".lbl_6").removeClass("label_error");
// if (halCap == "") {

// } else {
// $(".lbl_6").removeClass("label_error");
// if (tktCap == "") {
// 	$("#lbl_1").text("");
// 	$("#lbl_2").text(" ");
// 	$("#lbl_3").text(" ");
// 	$("#lbl_city").text(" ");
// 	$("#lbl_4").text(" ");
// 	$("#lbl_5").text(" ");
// 	$("#lbl_6").text(" ");
// 	$("#lbl_7").text(" ");
// 	$("#lbl_8").text(" Enter  Capacity");
// 	$("#lbl_9").text(" ");
// 	$("#lbl_10").text(" ");
// 	$("#lbl_11").text(" ");
// 	$("#lbl_12").text(" ");
// 	$("#org_err").text(" ");
// 	$("#evadd_err").text(" ");
// } else {
$(".lbl_6").removeClass("label_error");
if (eventaddress == "") {
$("#lbl_1").text("");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#evadd_err").text(" Please Enter About Evnet");

$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
} else {
$(".lbl_8").removeClass("label_error");
if (strDate == "") {
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" Select Start Date");
$("#lbl_10").text(" ");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
$(".lbl_9").removeClass("label_error");
if (endDate == "") {
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" Select End Date");
$("#lbl_11").text(" ");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
$(".lbl_10").removeClass("label_error");
if (strTime == "") {
$("#lbl_1").text(" ");
$("#lbl_2").text(" ");
$("#lbl_3").text(" ");
$("#lbl_city").text(" ");
$("#lbl_4").text(" ");
$("#lbl_5").text(" ");
$("#lbl_6").text(" ");
$("#lbl_7").text(" ");
$("#lbl_8").text(" ");
$("#lbl_9").text(" ");
$("#lbl_10").text(" ");
$("#lbl_11").text(" Enter Start Time");
$("#lbl_12").text(" ");
$("#org_err").text(" ");
$("#evadd_err").text(" ");
} else {
// $(".lbl_11").removeClass("label_error");
// if (endTime == "") {
// 	$("#lbl_1").text(" ");
// 	$("#lbl_2").text(" ");
// 	$("#lbl_3").text(" ");
// 	$("#lbl_city").text(" ");
// 	$("#lbl_4").text(" ");
// 	$("#lbl_5").text(" ");
// 	$("#lbl_6").text(" ");
// 	$("#lbl_7").text(" ");
// 	$("#lbl_8").text(" ");
// 	$("#lbl_9").text(" ");
// 	$("#lbl_10").text(" ");
// 	$("#lbl_11").text(" ");
// 	$("#lbl_12").text(" Enter End Time");
// 	$("#org_err").text(" ");
// 	$("#evadd_err").text(" ");
// } else {
$(".lbl_11").removeClass("label_error");

//console.log("Success");
// HERE WE WRITE A COMPLETE CODE
$(".loadbox").css({ display: "block" });
$(btn).button('loading...');
term = $form.serializeArray();

url = sendUrl+'post-ad/dopostevent.php';
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
$.post(sendUrl + "/post-ad/addpostcustomfields.php", val, function (response) {
//alert(response);
});
});
var pageEvent = $("#leftmenu").attr("data-event");
if (pageEvent == 1) {
//this is event page for add feature, sponsor or co-host
//add feature people
var Accessids = "";
$(".multi_select .btn-group>ul>li input:checked").each(function (k, obj) {
Accessids = Accessids + $(obj).val() + ",";
});
Accessids = Accessids.substring(0, Accessids.length - 1);
//console.log(Accessids);
//add feature profile
$.post(sendUrl + "/post-ad/addpostcustomfieldsfeature.php", { Accessids: Accessids, postid: postid, postedit: postedit }, function (re) {

});
//======add soponsor in field start======
var spon = "";
$(".add_spon .btn-group>ul>li input:checked").each(function (k, obj) {
spon = spon + $(obj).val() + ",";
//alert("no");
});
spon = spon.substring(0, spon.length - 1);
//console.log(spon);
$.post(sendUrl + "/post-ad/addsponsor.php", { spon: spon, postid: postid, postedit: postedit }, function (re) {
//alert(re);
});
//======add co-host========
var cohost = "";
$(".multi_select_cohost .btn-group>ul>li input:checked").each(function (k, obj) {
cohost = cohost + $(obj).val() + ",";
//alert("no");
});
cohost = cohost.substring(0, cohost.length - 1);
//console.log(cohost);
$.post(sendUrl + "/post-ad/addcohost.php", { cohost: cohost, postid: postid, postedit: postedit }, function (cohost) {
//alert(cohost);
});
} else {
//alert(multi);
var multi = $(".multiselect").attr("title");
if (multi == 'None selected' || multi == '') {

} else {
$.post(sendUrl + "/post-ad/addpostcustomfieldssize.php", { multi: multi, postid: postid }, function (re) {
//alert(re);
});
}
}
//for dell image
// IMAGE
var imgCount = $(".postingimg").length;

//alert(imgCount);
$(".postingimg").each(function (i, e) {
//this is for featured image strt
var fichek = $(e).attr("data-name");
var isCheckeed = $('#' + fichek + ':checked').val() ? true : false;
if (isCheckeed == true) {
spFeatureimg = 1;
} else {
spFeatureimg = 0;
}
//this is for featured image end
var base64image = $(e).attr("src");

//alert(base64image);

var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(sendUrl + "/post-ad/addgroupeventspic.php", { spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg: spFeatureimg, postedit: postedit }, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
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
url: sendUrl + "/post-ad/addpostmedia.php",
type: "POST",
data: form_data,
contentType: false,
cache: false,
processData: false,
success: function (vi) {
//alert(vi);
//window.location.reload();
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
if (postedit == true) {
//window.location.reload();
}
},
error: function (error) {
//alert(error);
}
});

//=======Add video end=======
//Testing
if (imgCount == 0) {
$.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}
//Testing Complete
//Media
$(".media-file-data").each(function (i, e) {
var base64image = $(e).attr("data-media");
var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
var ext = arr[0].replace("data:", "");

$.post("../addmedia.php", { spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid }, function (r) {
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
//document.getElementById("sp-form-post").reset();
//this script for delay a redirect page for another page.
var seconds = 10;
setInterval(function () {
seconds--;
if (seconds == 0) {
//	window.location.href = "posting.php?postid="+postid.trim();
window.location.href = "../../grouptimelines/group-event.php?groupid=" + spgroupid + "&groupname=" + spgroupname + "&event";
//window.location.reload();

}
}, 1000);
//====end=====
}).always(function () {
//$(btn).button('reset');
});
}
//}
}
}
}
// }
// }
}
}
//}
}
}
}
}
}
}

} else {
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});
//=================POST A STORE FORM END=============
/*var form_data = new FormData();
form_data.append('spPostings_idspPostings', postid);
//	form_data.append('spFeatureimg', spFeatureimg);
//	form_data.append('postedit', postedit);
var totalfiles = document.getElementById('filesaaa').files.length;
for (var index = 0; index < totalfiles; index++) {
form_data.append("files[]", document.getElementById('filesaaa').files[index]);
} 
$.ajax({
url: sendUrl+"/post-ad/addeventpic.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
});*/
//=============================================Group Post Event================================//



//=================POST A STORE FORM START=============
$("#spSaveDraftevent").on("click", function () {
    $("input[name=spPostingVisibility]").val(0);
    //alert('submit12');
    var sendUrl = MAINURL;
    if ($(this).hasClass("editing"))
    postedit = true;
    else
    postedit = false;
    
    var btn = this;
    var idspprofile = $("#spProfiles_idspProfiles").val();
    var $form = $("#sp-form-post");
    if (idspprofile != "") {
    var title = document.getElementById("spPostingTitle").value;
    var country = $('#spUserCountry option:selected').val();
    var state = $('#spUserState option:selected').val();
    var city = $('#spPostingsCity option:selected').val(); 
    var category = $('#eventcategory_ option:selected').val();
    //var postPrice = document.getElementById("spPostingPrice").value;
    var postPrice = 'a';
    var postVenu = document.getElementById("spPostingEventVenue_").value;
    var halCap = 'b';
    var tktCap = 'c';
    //var postid_edit = document.getElementById("idspPostings").value;
    
    var strDate = document.getElementById("spPostingStartDate_").value;
    var endDate = document.getElementById("spPostingExpDt").value;
    var strTime = document.getElementById("spPostingStartTime_").value;
    var endTime = document.getElementById("spPostingEndTime_").value;
    var organiser = document.getElementById("spPostingEventOrgId_").value;
    var eventaddress = document.getElementById("eventaddress").value;
    var rightmenu = document.getElementById("rightmenu").value;
    var capacity = document.getElementById("hallcapacity").value;
    
    var eventstartdate = new Date($("#spPostingStartDate_").val());
    var eventenddate = new Date($("#spPostingExpDt").val());
    
    if($('#paid_ticked_chs').is(':checked')) { 
    
    var ticket_type_id = $('#Ticket_Typeadd').val();
    var Capacity_add_id = $('#Capacityadd').val();   
    var Price_add_id = $('#Priceadd').val(); 
    
    
    if((ticket_type_id == "") && (Capacity_add_id == "") && (Price_add_id == "")){
    alert('Please Fill At least One Ticket Type'); 
    
    return false;  
    
    }
    
    
    }  
    
    
    if (tktCap > halCap) {
    
    $("#tic_cap").text("Ticket Capacity cannot be greater than Hall Capacity");
    
    } else {
    $("#tic_cap").text(" ");
    }
    if (eventstartdate > eventenddate) {
    $("#end_date").text(" End Date should be Greater");
    } else {
    
    $("#end_date").text("");
    }
    
    if (endTime != "") {
    //alert('abcs');
    
    
    if(strDate==endDate){
    //alert('sammmmmm');
    
    if (strTime >= endTime) {
    
    $("#end_time").text(" End Time should be Greater");
    return false;
    } else {
    $("#end_time").text(" ");
    }
    }
    else {
    // alert('elsessd');
    $("#end_time").text(" ");
    }
    }
    
    $('.classnameticket').each(function(){
    if(($(this).val())==''){
    swal("Please check Ticket details !");
    exit;
    }
    });
    
    var check = true;
    $("input:radio").each(function(){
      var name = $(this).attr("name");
      if($("input:radio[name=event_payment_type]:checked").length == 0){
        check = false;
      }
      if($("input:radio[name=registration_req]:checked").length == 0){
        check = false;
      }
    });

    if (title == "" || category == 0 || country==0 || state==0 || city==0  || eventaddress == "" || postVenu == "" || strDate == "" || endDate == "" || strTime=="" || endTime=="" ||capacity=="" || (check==false)) {
    
    if(category == 0){
    $("#lbl_4").text(" Select Category");
    
    }else{
    $("#lbl_4").text("");
    }
    if(title == ""){
    $("#lbl_1").text(" Enter Event Title ");
    
    }else{
    $("#lbl_1").text("");
    }
    
    
    
    if(country==0){
    $("#lbl_2").text(" Select Country");
    
    }else{
    $("#lbl_2").text("");
    }
    if(state==0){
    $("#lbl_3").text(" Select State");
    
    }else{
    $("#lbl_3").text("");
    }
    if(city==0){
    $("#lbl_city").text(" Select city");
    
    }else{
    $("#lbl_city").text("");
    }
    if(eventaddress == ""){
    $("#evadd_err").text(" Please Enter Event Address");
    
    }else{
    $("#evadd_err").text("");
    }
    if(postVenu == ""){
    $("#lbl_6").text(" Enter Venue");
    
    }else{
    $("#lbl_6").text("");
    }
    if(strDate == ""){
    $("#lbl_9").text(" Select Start Date");
    
    }else{
    $("#lbl_9").text("");
    }
    if(endDate == ""){
    $("#lbl_10").text(" Select End Date");
    
    }else{
    $("#lbl_10").text("");
    }if(strTime == ""){
    $("#lbl_11").text(" Enter Start Time");
    
    }else{
    $("#lbl_11").text("");
    }
    if(endTime == ""){
    $("#lbl_12").text(" Enter End Time");
    
    }else{
    $("#lbl_12").text("");
    }
    if(capacity==""){
    $("#event_cap").text(" Enter Hall Capacity");
    
    }else{
    $("#event_cap").text("");
    }
    if(check==false){
    $("#type_err").text("Please select event type");
    
    }else{
    $("#type_err").text("");
    }
    swal('Please Fill the Required Filleds');
    return false;
    
    }
    
    //console.log("Success");
    // HERE WE WRITE A COMPLETE CODE
    $(".loadbox").css({ display: "block" });
    $(btn).button('loading...');
    term = $form.serializeArray();
    url = sendUrl+'/post-ad/dopostevent.php';
    $.post(url, term, function (data, status) {
    //alert(data);
    }).fail(function () {
    $(btn).effect("shake");
    }).done(function (data) {
    //alert(data);
    var postid = data;  
    
    //	alert(postid_edit);  
    var albumid = $(".album_id").val();
    
    
    var form_data = new FormData();
    form_data.append('spPostings_idspPostings', postid);
    //	form_data.append('spFeatureimg', spFeatureimg);
    //	form_data.append('postedit', postedit);
    
    var totalfiles = document.getElementById('filesaaa').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("files[]", document.getElementById('filesaaa').files[index]);
    } 
    // alert("dsdsjdjs");
    // if ($(this).hasClass("editing")){
    var totalGallery = document.getElementById('Gallery').files.length;
    // alert(totalGallery);
    
    for (var ind = 0; ind < totalGallery; ind++) {
    form_data.append("Gallery[]", document.getElementById('Gallery').files[ind]);
    } 
    // }
    
    
    
    $.ajax({
    url: sendUrl+"/post-ad/addeventpic.php",
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    });
    
    
    var form_data1 = new FormData();
    form_data1.append('spPostings_idspPostings', postid);
    //	form_data.append('spFeatureimg', spFeatureimg);
    //	form_data.append('postedit', postedit);
    //alert("sss");
    var totalfiles = document.getElementById('filesaaass').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data1.append("files[]", document.getElementById('filesaaass').files[index]);
    
    }
    
    
    $.ajax({
    url: sendUrl + "//post-ad/addeventpiclayout.php",
    type: "POST",
    data: form_data1,
    
    contentType: false,
    cache: false,
    processData: false,
    success: function (vi) {
    //alert("1111");
    }
    });
    
    
    // $.ajax({
    // url: sendUrl+"/post-ad/addeventpiclayout.php",
    // type: 'post',
    // data: form_data,
    // dataType: 'json',
    // contentType: false, 
    // processData: false,
    // });
    
    
    
    // CUSTOM FIELDS
    var inputs = readCustomFields($("#sp-form-post"), postid);
    $.each(inputs, function (i, val) {
    $.post(sendUrl + "/post-ad/addpostcustomfields.php", val, function (response) {
    //alert(response);
    });
    });
    var pageEvent = $("#leftmenu").attr("data-event");
    if (pageEvent == 1) {
    //this is event page for add feature, sponsor or co-host
    //add feature people
    var Accessids = "";
    $(".multi_select .btn-group>ul>li input:checked").each(function (k, obj) {
    Accessids = Accessids + $(obj).val() + ",";
    });
    Accessids = Accessids.substring(0, Accessids.length - 1);
    //console.log(Accessids);
    //add feature profile
    $.post(sendUrl + "/post-ad/addpostcustomfieldsfeature.php", { Accessids: Accessids, postid: postid, postedit: postedit }, function (re) {
    
    });
    //======add soponsor in field start======
    var spon = "";
    $(".add_spon .btn-group>ul>li input:checked").each(function (k, obj) {
    spon = spon + $(obj).val() + ",";
    //alert("no");
    });
    spon = spon.substring(0, spon.length - 1);
    //console.log(spon);
    $.post(sendUrl + "/post-ad/addsponsor.php", { spon: spon, postid: postid, postedit: postedit }, function (re) {
    //alert(re);
    });
    //======add co-host========
    var cohost = "";
    $(".multi_select_cohost .btn-group>ul>li input:checked").each(function (k, obj) {
    cohost = cohost + $(obj).val() + ",";
    //alert("no");
    });
    cohost = cohost.substring(0, cohost.length - 1);
    //console.log(cohost);
    $.post(sendUrl + "/post-ad/addcohost.php", { cohost: cohost, postid: postid, postedit: postedit }, function (cohost) {
    //alert(cohost);
    });
    } else {
    //alert(multi);
    var multi = $(".multiselect").attr("title");
    if (multi == 'None selected' || multi == '') {
    
    } else {
    $.post(sendUrl + "/post-ad/addpostcustomfieldssize.php", { multi: multi, postid: postid }, function (re) {
    //alert(re);
    });
    }
    }
    //for dell image
    // IMAGE
    var imgCount = $(".postingimg").length;
    
    //alert(imgCount);
    $(".postingimg").each(function (i, e) {
    //this is for featured image strt
    var fichek = $(e).attr("data-name");
    var isCheckeed = $('#' + fichek + ':checked').val() ? true : false;
    if (isCheckeed == true) {
    spFeatureimg = 1;
    } else {
    spFeatureimg = 0;
    }
    //this is for featured image end
    var base64image = $(e).attr("src");
    
    //alert(base64image);
    //$.post(sendUrl + "/post-ad/addeventpic.php", { spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg: spFeatureimg, postedit: postedit }, function (r) {
    //alert(r);
    //Timeline prepending
    if (i == imgCount - 1) {
    $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
    $("#timeline-container").prepend(r);
    //$(btn).button('reset');
    });
    }
    //});
    });
    //=======Add vi deo start=======
    
    //Video post finaly
    //ev.preventDefault();
    var form_data = new FormData($("#sp-form-post")[0]);
    //form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
    form_data.append('spPostings_idspPostings', postid);
    form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
    $.ajax({
    url: sendUrl + "/post-ad/addpostmedia.php",
    type: "POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (vi) {
    //alert(vi);
    //window.location.reload();
    $("#dvPreview").html("");
    $("#spPreview").html("");
    $("#clearnow").val("");
    $(".grptimeline").val("");
    $("#postform .form-control").val("");
    //document.getElementById("sp-form-post").reset();
    if (postedit == true) {
    //window.location.reload();
    }
    },
    error: function (error) {
    //alert(error);
    }
    });
    
    //=======Add video end=======
    //Testing
    if (imgCount == 0) {
    $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
    $("#timeline-container").prepend(r);
    //$(btn).button('reset');
    //alert(r);
    });
    }
    //Testing Complete
    //Media
    $(".media-file-data").each(function (i, e) {
    var base64image = $(e).attr("data-media");
    var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
    var ext = arr[0].replace("data:", "");
    
    $.post("../addmedia.php", { spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid }, function (r) {
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
    //document.getElementById("sp-form-post").reset();
    //this script for delay a redirect page for another page.
    var seconds = 10;
    //alert('=================');
    //   alert(postid);
    setInterval(function () {
    seconds--;
    
    if (seconds == 0) {
    window.location.href = "posting.php?postid=" + postid.trim();
    //window.location.reload();
    }
    }, 1000);
    //====end=====
    }).always(function () {
    //$(btn).button('reset');
    });
    
    
    
    
    } else {
    $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
    }
    });

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

$("#spPostSubmitEventPro").on("click", function (){
  modal.style.display = "block";  
})

$("#spPostSubmitEvent").on("click", function () {
  var sendUrl = MAINURL;
  if ($(this).hasClass("editing"))
    postedit = true;
  else
    postedit = false;

  var btn = this;
  var idspprofile = $("#spProfiles_idspProfiles").val();

  var $form = $("#sp-form-post");
  if (idspprofile != "") {
    var title = $("#spPostingTitle").val();
    var visibility = $("#spPostingVisibility").val();
    //$("#spPostingVisibility").val("-1");
    var country = $('#spUserCountry option:selected').val();
    var state = $('#spUserState option:selected').val();
    var city = $('#spUserCity option:selected').val(); 
    var category = $('#eventcategory_ option:selected').val();
    var ethnicity = $("#ethnicity").val();
    var orgName = $("#spPostingEventOrgName").val();
    var orgEmail = $("#spPostingEventOrgEmail").val();
    var orgPhone = $("#spPostingEventOrgPhone").val();
    var poster = $("#filesaaa")[0].files;
    var posterpreview = $(".posterpreview").find("img");
    var proValid = $("#proValidation").val();
    var pro_name = $('#pro_profilename').val();
    var pro_highlight = $('#pro_highlights').val();
    var pro_category = $('#pro_category').val();
    var postPrice = 'a';
    var postVenu = document.getElementById("spPostingEventVenue_").value;
    var halCap = 'b';
    var tktCap = 'c';
    var strDate = document.getElementById("spPostingStartDate_").value;
    var endDate = document.getElementById("spPostingExpDt").value;
    var strTime = document.getElementById("spPostingStartTime_").value;
    var endTime = document.getElementById("spPostingEndTime_").value;
    var organiser = document.getElementById("spPostingEventOrgId_").value;
    var eventaddress = document.getElementById("eventaddress").value;
    var rightmenu = document.getElementById("rightmenu").value;
    var capacity = document.getElementById("hallcapacity").value;

    var eventstartdate = new Date($("#spPostingStartDate_").val());
    var eventenddate = new Date($("#spPostingExpDt").val());

    if($('#paid_ticked_chs').is(':checked')) { 
      var ticket_type_id = $('#Ticket_Typeadd').val();
      var Capacity_add_id = $('#Capacityadd').val();   
      var Price_add_id = $('#Priceadd').val(); 
      if((ticket_type_id == "") && (Capacity_add_id == "") && (Price_add_id == "")){
        alert('Please Fill At least One Ticket Type'); 
        return false;  
      }
    }  

    if (tktCap > halCap) {
      $("#tic_cap").text("Ticket Capacity cannot be greater than Hall Capacity");
    } else {
      $("#tic_cap").text(" ");
    }
    if (eventstartdate > eventenddate) {
      $("#end_date").text(" End Date should be Greater");
    } else {
      $("#end_date").text("");
    }

    if (endTime != "") {
      if(strDate==endDate){
        if (strTime >= endTime) {
          $("#end_time").text(" End Time should be Greater");
          return false;
        } else {
          $("#end_time").text(" ");
        }
      } else {
        $("#end_time").text(" ");
      }
    }

    $('.classnameticket').each(function(){
      if(($(this).val())==''){
        swal("Please check Ticket details !");
        exit;
      }
    });

    var check = true;
    $("input:radio").each(function(){
      var name = $(this).attr("name");
      if($("input:radio[name=event_payment_type]:checked").length == 0){
        check = false;
      }
      if($("input:radio[name=registration_req]:checked").length == 0){
        check = false;
      }
    });
    if ((title == "" || category == "" || ethnicity == "" || country==0 || state==0 || city==0  || eventaddress == "" || postVenu == "" || strDate == "" || endDate == "" || strTime=="" || endTime=="" ||capacity=="" || (check==false) || orgName == "" || orgEmail == "" || orgPhone == "" || (poster.length == 0 && posterpreview.length == 0)) || (proValid == 1 && (pro_name == "" || pro_highlight == "" || pro_category == ""))) {

      if(category == ""){
        $("#lbl_4").text(" Select Category");
      }else{
        $("#lbl_4").text("");
      }
  
      if(ethnicity == ""){
        $("#ethnicity_error").text(" Select Ethnicity");
      }else{
        $("#ethnicity_error").text("");
      }
  
      if(title == ""){
        $("#lbl_1").text(" Enter Event Title ");
      }else{
        $("#lbl_1").text("");
      }
  
      if(country==0){
        $("#lbl_2").text(" Select Country");
      }else{
        $("#lbl_2").text("");
      }
      
      if(state==0){
        $("#lbl_3").text(" Select State");
      }else{
        $("#lbl_3").text("");
      }
      
      if(city==0){
        $("#lbl_city").text(" Select city");
      }else{
        $("#lbl_city").text("");
      }
      
      if(eventaddress == ""){
        $("#evadd_err").text(" Please Enter Event Address");
      }else{
        $("#evadd_err").text("");
      }
      
      if(postVenu == ""){
        $("#lbl_6").text(" Enter Venue");
      }else{
        $("#lbl_6").text("");
      }
      
      if(strDate == ""){
        $("#lbl_9").text(" Select Start Date");
      }else{
        $("#lbl_9").text("");
      }
      
      if(endDate == ""){
        $("#lbl_10").text(" Select End Date");
      }else{
        $("#lbl_10").text("");
      }
      
      if(strTime == ""){
        $("#lbl_11").text(" Enter Start Time");
      }else{
        $("#lbl_11").text("");
      }
      
      if(endTime == ""){
        $("#lbl_12").text(" Enter End Time");
      }else{
        $("#lbl_12").text("");
      }
      
      if(capacity==""){
        $("#event_cap").text(" Enter Hall Capacity");
      }else{
        $("#event_cap").text("");
      }
      
      if(orgName==""){
        $("#org_name_err").text("Please enter organiser name");
      }else{
        $("#org_name_err").text("");
      }
      
      if(orgEmail==""){
        $("#org_email_err").text("Please enter organiser email");
      }else{
        $("#org_email_err").text("");
      }
      
      if(orgPhone==""){
        $("#org_phone_err").text("Please enter organiser phone");
      }else{
        $("#org_phone_err").text("");
      }
      
      if(poster.length == 0 && posterpreview.length == 0){
        $("#lbl_55").text("Please upload a poster");
      }else{
        $("#lbl_55").text("");
      }
      
      if(check==false){
        $("#type_err").text("Please select event type");
      }else{
        $("#type_err").text("");
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
                    
      swal('Please Fill the Required Fileds');
      return false;

    }

    modal.style.display = "none";
    $(".loadbox").css({ display: "block" });
    $(btn).button('loading...');
    term = $form.serializeArray();
    url = sendUrl+'/post-ad/dopostevent.php';
    $.post(url, term, function (data, status) {
    }).fail(function () {
      $(btn).effect("shake");
    }).done(function (data) {
      data = afterAjax(data);
      if(data !== false) {
        var postid = data;  
        var albumid = $(".album_id").val();
        var form_data = new FormData();
        form_data.append('spPostings_idspPostings', postid);
        //form_data.append('spFeatureimg', spFeatureimg);
        //form_data.append('postedit', postedit);
        var totalfiles = document.getElementById('filesaaa').files.length;
        for (var index = 0; index < totalfiles; index++) {
          form_data.append("files[]", document.getElementById('filesaaa').files[index]);
        }
        var totalGallery = document.getElementById('Gallery').files.length;
        for (var ind = 0; ind < totalGallery; ind++) {
          form_data.append("Gallery[]", document.getElementById('Gallery').files[ind]);
        } 
        $.ajax({
          url: sendUrl+"/post-ad/addeventpic.php",
          type: 'post',
          data: form_data,
          dataType: 'json',
          contentType: false,
          processData: false,
        });

        var form_data1 = new FormData();
        form_data1.append('spPostings_idspPostings', postid);
        //form_data.append('spFeatureimg', spFeatureimg);
        //form_data.append('postedit', postedit);
        var totalfiles = document.getElementById('filesaaass').files.length;
        for (var index = 0; index < totalfiles; index++) {
          form_data1.append("files[]", document.getElementById('filesaaass').files[index]);
        }

        $.ajax({
          url: sendUrl + "//post-ad/addeventpiclayout.php",
          type: "POST",
          data: form_data1,
          contentType: false,
          cache: false,
          processData: false,
          success: function (vi) {
          //alert("1111");
          }
        });


        // $.ajax({
        // url: sendUrl+"/post-ad/addeventpiclayout.php",
        // type: 'post',
        // data: form_data,
        // dataType: 'json',
        // contentType: false, 
        // processData: false,
        // });



        // CUSTOM FIELDS
        var inputs = readCustomFields($("#sp-form-post"), postid);
        $.each(inputs, function (i, val) {
          $.post(sendUrl + "/post-ad/addpostcustomfields.php", val, function (response) {
            //alert(response);
          });
        });
        var pageEvent = $("#leftmenu").attr("data-event");
        if (pageEvent == 1) {
          var Accessids = "";
          $(".multi_select .btn-group>ul>li input:checked").each(function (k, obj) {
            Accessids = Accessids + $(obj).val() + ",";
          });
          Accessids = Accessids.substring(0, Accessids.length - 1);
          $.post(sendUrl + "/post-ad/addpostcustomfieldsfeature.php", { Accessids: Accessids, postid: postid, postedit: postedit }, function (re) {

          });
          //======add soponsor in field start======
          var spon = "";
          $(".add_spon .btn-group>ul>li input:checked").each(function (k, obj) {
            spon = spon + $(obj).val() + ",";
            //alert("no");
          });
          spon = spon.substring(0, spon.length - 1);
          $.post(sendUrl + "/post-ad/addsponsor.php", { spon: spon, postid: postid, postedit: postedit }, function (re) {
            //alert(re);
          });
          //======add co-host========
          var cohost = "";
          $(".multi_select_cohost .btn-group>ul>li input:checked").each(function (k, obj) {
            cohost = cohost + $(obj).val() + ",";
            //alert("no");
          });
          cohost = cohost.substring(0, cohost.length - 1);
          $.post(sendUrl + "/post-ad/addcohost.php", { cohost: cohost, postid: postid, postedit: postedit }, function (cohost) {
            //alert(cohost);
          });
        } else {
          //alert(multi);
          var multi = $(".multiselect").attr("title");
          if (multi == 'None selected' || multi == '') {

          } else {
            $.post(sendUrl + "/post-ad/addpostcustomfieldssize.php", { multi: multi, postid: postid }, function (re) {
              //alert(re);
            });
          }
        }
        var imgCount = $(".postingimg").length;
        $(".postingimg").each(function (i, e) {
          //this is for featured image strt
          var fichek = $(e).attr("data-name");
          var isCheckeed = $('#' + fichek + ':checked').val() ? true : false;
          if (isCheckeed == true) {
            spFeatureimg = 1;
          } else {
            spFeatureimg = 0;
          }
          //this is for featured image end
          var base64image = $(e).attr("src");
          //$.post(sendUrl + "/post-ad/addeventpic.php", { spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg: spFeatureimg, postedit: postedit }, function (r) {
          //Timeline prepending
          if (i == imgCount - 1) {
            $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
              $("#timeline-container").prepend(r);
              //$(btn).button('reset');
            });
          }
          //});
        });
        //=======Add vi deo start=======

        //Video post finaly
        //ev.preventDefault();
        var form_data = new FormData($("#sp-form-post")[0]);
        //form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
        form_data.append('spPostings_idspPostings', postid);
        form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
        $.ajax({
          url: sendUrl + "/post-ad/addpostmedia.php",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success: function (vi) {
            $("#dvPreview").html("");
            $("#spPreview").html("");
            $("#clearnow").val("");
            $(".grptimeline").val("");
            $("#postform .form-control").val("");
            if (postedit == true) {
            //window.location.reload();
            }
          },
          error: function (error) {
          //alert(error);
          }
        });

        //=======Add video end=======
        //Testing
        if (imgCount == 0) {
          $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
            $("#timeline-container").prepend(r);
            //$(btn).button('reset');
            //alert(r);
          });
        }
        //Testing Complete
        //Media
        $(".media-file-data").each(function (i, e) {
          var base64image = $(e).attr("data-media");
          var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
          var ext = arr[0].replace("data:", "");

          $.post("../addmedia.php", { spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid }, function (r) {
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
        //document.getElementById("sp-form-post").reset();
        //this script for delay a redirect page for another page.
        var seconds = 10;

        var feature = $("input[name=feature]:checked").val();
        if(feature==0 ||feature==''){
          setInterval(function () {
            seconds--;
            if (seconds == 0) {
              window.location.href = "posting.php?postid=" + postid;
              //window.location.reload();
            }
          }, 1000);
        }else{
          setInterval(function () {
            seconds--;
            if (seconds == 0) {
              window.location.href = MAINURL+"/membership/event_pay.php?postid=" + postid;
              //window.location.reload();
            }
          }, 1000);

        }
        //====end=====
      }
    }).always(function () {
      //$(btn).button('reset');
    });
  } else {
    $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
  }
});


function afterAjax(data){
  try{
    data = JSON.parse(data);
  }
  catch(err){
    //swal(data.error);
    return data;
  }
  if(data.error !== undefined){
    $(".loadbox").css({ display: "none" });
    swal(data.error);
    return false;
  }
  return data;
}



///========draft post update for===========///



$("#spPostSubmitEventdraftupdate").on("click", function () {
  //alert('submit12');spPostSubmitEvent
  var sendUrl = MAINURL;
  if ($(this).hasClass("editing"))
  postedit = true;
  else
  postedit = false;
  
  var btn = this;
  var idspprofile = $("#spProfiles_idspProfiles").val();
  var $form = $("#sp-form-post");
  if (idspprofile != "") {
  var title = document.getElementById("spPostingTitle").value;

  var visibility = $("#spvisiblity").val();

  // var expdate = document.getElementById('spPostingExpDtevent').value;
  // document.getElementById('spPostingExpDt').value = expdate;
  // //alert(expdate);
  
  var country = $('#spUserCountry option:selected').val();
  var state = $('#spUserState option:selected').val();
  var city = $('#spPostingsCity option:selected').val(); 
  var category = $('#eventcategory_ option:selected').val();
  //var postPrice = document.getElementById("spPostingPrice").value;
  var postPrice = 'a';
  var postVenu = document.getElementById("spPostingEventVenue_").value;
  var halCap = 'b';
  var tktCap = 'c';
  //var postid_edit = document.getElementById("idspPostings").value;
  
  var strDate = document.getElementById("spPostingStartDate_").value;
  var endDate = document.getElementById("spPostingExpDt").value;
  var strTime = document.getElementById("spPostingStartTime_").value;
  var endTime = document.getElementById("spPostingEndTime_").value;
  var organiser = document.getElementById("spPostingEventOrgId_").value;
  var eventaddress = document.getElementById("eventaddress").value;
  var rightmenu = document.getElementById("rightmenu").value;
  var capacity = document.getElementById("hallcapacity").value;
  
  var eventstartdate = new Date($("#spPostingStartDate_").val());
  var eventenddate = new Date($("#spPostingExpDt").val());
  
  if($('#paid_ticked_chs').is(':checked')) { 
  
  var ticket_type_id = $('#Ticket_Typeadd').val();
  var Capacity_add_id = $('#Capacityadd').val();   
  var Price_add_id = $('#Priceadd').val(); 
  
  
  if((ticket_type_id == "") && (Capacity_add_id == "") && (Price_add_id == "")){
  alert('Please Fill At least One Ticket Type'); 
  
  return false;  
  
  }
  
  
  }  
  
  
  if (tktCap > halCap) {
  
  $("#tic_cap").text("Ticket Capacity cannot be greater than Hall Capacity");
  
  } else {
  $("#tic_cap").text(" ");
  }
  if (eventstartdate > eventenddate) {
  $("#end_date").text(" End Date should be Greater");
  } else {
  
  $("#end_date").text("");
  }
  
  if (endTime != "") {
  //alert('abcs');
  
  
  if(strDate==endDate){
  //alert('sammmmmm');
  
  if (strTime >= endTime) {
  
  $("#end_time").text(" End Time should be Greater");
  return false;
  } else {
  $("#end_time").text(" ");
  }
  }
  else {
  // alert('elsessd');
  $("#end_time").text(" ");
  }
  }
  
  $('.classnameticket').each(function(){
  if(($(this).val())==''){
  swal("Please check Ticket details !");
  exit;
  }
  });
  
  var check = true;
  $("input:radio").each(function(){
    var name = $(this).attr("name");
    if($("input:radio[name=event_payment_type]:checked").length == 0){
      check = false;
    }
    if($("input:radio[name=registration_req]:checked").length == 0){
      check = false;
    }
  });
  
  
  
  
  
  if (title == "" || category == 0 || country==0 || state==0 || city==0  || eventaddress == "" || postVenu == "" || strDate == "" || endDate == "" || strTime=="" || endTime=="" ||capacity=="" || (check==false)) {
  
  if(category == 0){
  $("#lbl_4").text(" Select Category");
  
  }else{
  $("#lbl_4").text("");
  }
  if(title == ""){
  $("#lbl_1").text(" Enter Event Title ");
  
  }else{
  $("#lbl_1").text("");
  }
  
  
  
  if(country==0){
  $("#lbl_2").text(" Select Country");
  
  }else{
  $("#lbl_2").text("");
  }
  if(state==0){
  $("#lbl_3").text(" Select State");
  
  }else{
  $("#lbl_3").text("");
  }
  if(city==0){
  $("#lbl_city").text(" Select city");
  
  }else{
  $("#lbl_city").text("");
  }
  if(eventaddress == ""){
  $("#evadd_err").text(" Please Enter Event Address");
  
  }else{
  $("#evadd_err").text("");
  }
  if(postVenu == ""){
  $("#lbl_6").text(" Enter Venue");
  
  }else{
  $("#lbl_6").text("");
  }
  if(strDate == ""){
  $("#lbl_9").text(" Select Start Date");
  
  }else{
  $("#lbl_9").text("");
  }
  if(endDate == ""){
  $("#lbl_10").text(" Select End Date");
  
  }else{
  $("#lbl_10").text("");
  }if(strTime == ""){
  $("#lbl_11").text(" Enter Start Time");
  
  }else{
  $("#lbl_11").text("");
  }
  if(endTime == ""){
  $("#lbl_12").text(" Enter End Time");
  
  }else{
  $("#lbl_12").text("");
  }
  if(capacity==""){
  $("#event_cap").text(" Enter Hall Capacity");
  
  }else{
  $("#event_cap").text("");
  }
  if(check==false){
  $("#type_err").text("Please select event type");
  
  }else{
  $("#type_err").text("");
  }
  swal('Please Fill the Required Filleds');
  return false;
  
  }
  
  //console.log("Success");
  // HERE WE WRITE A COMPLETE CODE
  $(".loadbox").css({ display: "block" });
  $(btn).button('loading...');
  term = $form.serializeArray();
  url = sendUrl+'/post-ad/dopostevent.php';
  $.post(url, term, function (data, status) {
  //alert(data);
  }).fail(function () {
  $(btn).effect("shake");
  }).done(function (data) {
  //alert(data);
  var postid = data;  
  
  //	alert(postid_edit);  
  var albumid = $(".album_id").val();
  
  
  var form_data = new FormData();
  form_data.append('spPostings_idspPostings', postid);
  //	form_data.append('spFeatureimg', spFeatureimg);
  //	form_data.append('postedit', postedit);
  
  var totalfiles = document.getElementById('filesaaa').files.length;
  for (var index = 0; index < totalfiles; index++) {
  form_data.append("files[]", document.getElementById('filesaaa').files[index]);
  } 
  // alert("dsdsjdjs");
  // if ($(this).hasClass("editing")){
  var totalGallery = document.getElementById('Gallery').files.length;
  // alert(totalGallery);
  
  for (var ind = 0; ind < totalGallery; ind++) {
  form_data.append("Gallery[]", document.getElementById('Gallery').files[ind]);
  } 
  // }
  
  
  
  $.ajax({
  url: sendUrl+"/post-ad/addeventpic.php",
  type: 'post',
  data: form_data,
  dataType: 'json',
  contentType: false,
  processData: false,
  });
  
  
  var form_data1 = new FormData();
  form_data1.append('spPostings_idspPostings', postid);
  //	form_data.append('spFeatureimg', spFeatureimg);
  //	form_data.append('postedit', postedit);
  //alert("sss");
  var totalfiles = document.getElementById('filesaaass').files.length;
  for (var index = 0; index < totalfiles; index++) {
  form_data1.append("files[]", document.getElementById('filesaaass').files[index]);
  
  }
  
  
  $.ajax({
  url: sendUrl + "//post-ad/addeventpiclayout.php",
  type: "POST",
  data: form_data1,
  
  contentType: false,
  cache: false,
  processData: false,
  success: function (vi) {
  //alert("1111");
  }
  });
  
  
  // $.ajax({
  // url: sendUrl+"/post-ad/addeventpiclayout.php",
  // type: 'post',
  // data: form_data,
  // dataType: 'json',
  // contentType: false, 
  // processData: false,
  // });
  
  
  
  // CUSTOM FIELDS
  var inputs = readCustomFields($("#sp-form-post"), postid);
  $.each(inputs, function (i, val) {
  $.post(sendUrl + "/post-ad/addpostcustomfields.php", val, function (response) {
  //alert(response);
  });
  });
  var pageEvent = $("#leftmenu").attr("data-event");
  if (pageEvent == 1) {
  //this is event page for add feature, sponsor or co-host
  //add feature people
  var Accessids = "";
  $(".multi_select .btn-group>ul>li input:checked").each(function (k, obj) {
  Accessids = Accessids + $(obj).val() + ",";
  });
  Accessids = Accessids.substring(0, Accessids.length - 1);
  //console.log(Accessids);
  //add feature profile
  $.post(sendUrl + "/post-ad/addpostcustomfieldsfeature.php", { Accessids: Accessids, postid: postid, postedit: postedit }, function (re) {
  
  });
  //======add soponsor in field start======
  var spon = "";
  $(".add_spon .btn-group>ul>li input:checked").each(function (k, obj) {
  spon = spon + $(obj).val() + ",";
  //alert("no");
  });
  spon = spon.substring(0, spon.length - 1);
  //console.log(spon);
  $.post(sendUrl + "/post-ad/addsponsor.php", { spon: spon, postid: postid, postedit: postedit }, function (re) {
  //alert(re);
  });
  //======add co-host========
  var cohost = "";
  $(".multi_select_cohost .btn-group>ul>li input:checked").each(function (k, obj) {
  cohost = cohost + $(obj).val() + ",";
  //alert("no");
  });
  cohost = cohost.substring(0, cohost.length - 1);
  //console.log(cohost);
  $.post(sendUrl + "/post-ad/addcohost.php", { cohost: cohost, postid: postid, postedit: postedit }, function (cohost) {
  //alert(cohost);
  });
  } else {
  //alert(multi);
  var multi = $(".multiselect").attr("title");
  if (multi == 'None selected' || multi == '') {
  
  } else {
  $.post(sendUrl + "/post-ad/addpostcustomfieldssize.php", { multi: multi, postid: postid }, function (re) {
  //alert(re);
  });
  }
  }
  //for dell image
  // IMAGE
  var imgCount = $(".postingimg").length;
  
  //alert(imgCount);
  $(".postingimg").each(function (i, e) {
  //this is for featured image strt
  var fichek = $(e).attr("data-name");
  var isCheckeed = $('#' + fichek + ':checked').val() ? true : false;
  if (isCheckeed == true) {
  spFeatureimg = 1;
  } else {
  spFeatureimg = 0;
  }
  //this is for featured image end
  var base64image = $(e).attr("src");
  
  //alert(base64image);
  //$.post(sendUrl + "/post-ad/addeventpic.php", { spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg: spFeatureimg, postedit: postedit }, function (r) {
  //alert(r);
  //Timeline prepending
  if (i == imgCount - 1) {
  $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
  $("#timeline-container").prepend(r);
  //$(btn).button('reset');
  });
  }
  //});
  });
  //=======Add vi deo start=======
  
  //Video post finaly
  //ev.preventDefault();
  var form_data = new FormData($("#sp-form-post")[0]);
  //form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
  form_data.append('spPostings_idspPostings', postid);
  form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
  $.ajax({
  url: sendUrl + "/post-ad/addpostmedia.php",
  type: "POST",
  data: form_data,
  contentType: false,
  cache: false,
  processData: false,
  success: function (vi) {
  //alert(vi);
  //window.location.reload();
  $("#dvPreview").html("");
  $("#spPreview").html("");
  $("#clearnow").val("");
  $(".grptimeline").val("");
  $("#postform .form-control").val("");
  //document.getElementById("sp-form-post").reset();
  if (postedit == true) {
  //window.location.reload();
  }
  },
  error: function (error) {
  //alert(error);
  }
  });
  
  //=======Add video end=======
  //Testing
  if (imgCount == 0) {
  $.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
  $("#timeline-container").prepend(r);
  //$(btn).button('reset');
  //alert(r);
  });
  }
  //Testing Complete
  //Media
  $(".media-file-data").each(function (i, e) {
  var base64image = $(e).attr("data-media");
  var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
  var ext = arr[0].replace("data:", "");
  
  $.post("../addmedia.php", { spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid }, function (r) {
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
  //document.getElementById("sp-form-post").reset();
  //this script for delay a redirect page for another page.
  var seconds = 10;
  
  var feature = $("input[name=feature]:checked").val();
  //alert('=================');
   // alert(feature);
  //   alert(MAINURL);
    if(feature==0 ||feature==''){
  setInterval(function () {
  seconds--;
  
  if (seconds == 0) {
     
  window.location.href = "posting.php?postid=" + postid.trim();
  //window.location.reload();
  }
  }, 1000);
    }else{
      setInterval(function () {
          seconds--;
          
          if (seconds == 0) {
           
          window.location.href = MAINURL+"/membership/event_pay.php?postid=" + postid.trim();
          //window.location.reload();
          }
          }, 1000);
  
    }
  //====end=====
  }).always(function () {
  //$(btn).button('reset');
  });
  
  
  
  
  } else {
  $("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
  }
  });
  


















//=================POST A STORE FORM END=============
//=================POST A  FORM DRAFT===========
//Save in Draft

$("#spSaveDraftevent1").on("click", function () {  
// alert('hiiiiiii');
var sendUrl = MAINURL;
var visibility = $("#spPostingVisibility").val();
$("#spPostingVisibility").val("0");
//alert("hello");
if($(this).hasClass("editing")) 
// alert("11111111");
postedit = true;
// alert("222222222");  
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();
var $form = $("#sp-form-post");
if (idspprofile != "") { 

var title = document.getElementById("spPostingTitle").value;
var country = $('#spUserCountry-1 option:selected').val();
var state = $('#spUserState option:selected').val();
var city = $('#spPostingsCity option:selected').val();
var category = $('#eventcategory_ option:selected').val();
//var postPrice = document.getElementById("spPostingPrice").value;
var postPrice = 'a';
var postVenu = document.getElementById("spPostingEventVenue_").value;
var halCap = 'b';
var tktCap = 'c';
var strDate = document.getElementById("spPostingStartDate_").value;
var endDate = document.getElementById("spPostingExpDt").value;
var strTime = document.getElementById("spPostingStartTime_").value;
var endTime = document.getElementById("spPostingEndTime_").value;
var organiser = document.getElementById("spPostingEventOrgId_").value;
var eventaddress = document.getElementById("eventaddress").value;

var eventstartdate = new Date($("#spPostingStartDate_").val());
var eventenddate = new Date($("#spPostingExpDt").val());


if (tktCap > halCap) {
//alert('11111');
$("#tic_cap").text("Ticket Capacity cannot be greater than Hall Capacity");
//	return false;

} else {
//alert('2222');
$("#tic_cap").text(" ");
}

if (eventstartdate > eventenddate) {


$("#end_date").text(" End Date should be Greater");
} else {

$("#end_date").text("");
}

if (endTime != "") {


if (strTime >= endTime) {

//alert("1111aaa");
$("#end_time").text(" End Time should be Greater");
//return false;
} else {
//alert("2222aaa");
$("#end_time").text(" ");
}
}




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

var imgCount = $(".postingimg").length;
$(".postingimg").each(function (i, e) {
//this is for featured image strt
var fichek = $(e).attr("data-name");
var isCheckeed = $('#' + fichek + ':checked').val() ? true : false;
if (isCheckeed == true) {
spFeatureimg = 1;
} else {
spFeatureimg = 0;
}
//this is for featured image end
var base64image = $(e).attr("src");
var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(sendUrl + "/post-ad/addeventpic.php", { spPostings_idspPostings: postid, spPostingPic: base64image, ext: ext, spFeatureimg: spFeatureimg, postedit: postedit }, function (r) {
//alert(r);
//Timeline prepending
if (i == imgCount - 1) {
$.get(sendUrl + "/publicpost/timelineentry.php", { js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline") }, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
});
}
});
});
//=======Add video start=======

//Video post finaly
//ev.preventDefault();
//alert("--------");
var form_data = new FormData($("#sp-form-post")[0]);
//form_data.push({spPostings_idspPostings: postid, spPostingAlbum_idspPostingAlbum: albumid});
form_data.append('spPostings_idspPostings', postid);
form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
$.ajax({
url: sendUrl + "/post-ad/addpostmedia.php",
type: "POST",
data: form_data,
contentType: false,
cache: false,
processData: false,
success: function (vi) {
//alert(vi);
//window.location.reload();
$("#dvPreview").html("");
$("#spPreview").html("");
$("#clearnow").val("");
$(".grptimeline").val("");
$("#postform .form-control").val("");
//document.getElementById("sp-form-post").reset();
if (postedit == true) {
//window.location.reload();
}
},
error: function (error) {
//alert(error);
}
});

//=======Add video end=======
//Testing
/*if (imgCount == 0){
$.get(sendUrl+"/publicpost/timelineentry.php", {js: "1", timelineid: postid, grouptimeline: $(btn).data("grouptimeline")}, function (r) {
$("#timeline-container").prepend(r);
//$(btn).button('reset');
//alert(r);
});
}*/
//Testing Complete
//Media
$(".media-file-data").each(function (i, e) {
var base64image = $(e).attr("data-media");
var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
var ext = arr[0].replace("data:", "");

$.post("../addmedia.php", { spPostings_idspPostings: postid, spPostingMedia: base64image, ext: ext, spPostingAlbum_idspPostingAlbum: albumid }, function (r) {
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
//document.getElementById("sp-form-post").reset();
//this script for delay a redirect page for another page.
var seconds = 10;
setInterval(function () {
seconds--;
if (seconds == 0) {
window.location.href = "posting.php?postid=" + postid.trim();
//window.location.reload();
}
}, 1000);
//====end=====
}).always(function () {
//$(btn).button('reset');
});

} else {
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select Business profile...!</div>");
}
});








//=================POST A Event FORM DRAFT END=======

/*$("#addSponseraa").on("click", function () {
alert('ppppppp');
var BaseUrl = MAINURL+"/";

var btn = this;
var $form = $(btn).closest("form");
$form.submit(function (e) {
e.preventDefault();
$(btn).button('loading');
term = $form.serializeArray();
url = $form.attr("action");
$.post(url, term, function (data, status) {
//alert(data);
var SponorId = data;
//alert(SponorId);
var imgCount = $(".sponsorimg").length;
//alert(imgCount);
if (imgCount != 0) {
var base64image = $(".sponsorimg").attr("src");
//alert(base64image);

var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(BaseUrl + "/events/dashboard/addsponsorpic.php", { spPostingPic: base64image, ext: ext, SponorId: SponorId }, function (t) {
window.location.reload();
});
}
}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');
}).done(function (data) {

}).always(function () {
$(btn).button('reset');
});
});
});*/
//=======End sponsor=======

//=================POST A STORE FORM DE-ACTIVATE===========

$("#addSponsergroup").on("click", function () {


//alert();
var company = $("#sponsorTitle").val()

var Website = $("#sponsorWebsite").val()
var Price = $("#spsponsorPrice").val()
var category = $("#sponsorCategory").val()
var Description = $("#spsponsorDesc").val()
var sponsorImage = $("#sponsorImg").val()

if (company == "" && Website == "" && Price == "" && category.length == 0 && Description == "" && sponsorImage == "") {



$("#sponsorTitle_error").text("Please Enter Company Name .");
$("#sponsorTitle").focus();

$("#sponsorWebsite_error").text("Please Enter Website.");
$("#sponsorWebsite").focus();

$("#spsponsorPrice_error").text("Please Enter Price.");
$("#spsponsorPrice").focus();


$("#sponsorCategory_error").text("Please select Category.");
$("#sponsorCategory").focus();

$("#spsponsorDesc_error").text("Please Enter Description.");
$("#spsponsorDesc").focus();

$("#sponsorImg_error").text("Choose File.");
$("#sponsorImg").focus();






return false;
} else if (company == "") {

$("#sponsorTitle_error").text("Please Enter Company Name .");
$("#sponsorTitle").focus();

return false;
} else if (Website == "") {

$("#sponsorWebsite_error").text("Please Enter Website.");
$("#sponsorWebsite").focus();

return false;
} else if (Price == "") {
//alert(Price);

$("#spsponsorPrice_error").text("Please Enter Price.");
$("#spsponsorPrice").focus();

return false;
} else if (category.length == 0) {
$("#sponsorCategory_error").text("Please select Category.");
$("#sponsorCategory").focus();

return false;
} else if (Description == "") {

$("#spsponsorDesc_error").text("Please Enter Description.");
$("#spsponsorDesc").focus();



return false;
} else if (sponsorImage == "") {


$("#sponsorImg_error").text("Choose File.");
$("#sponsorImg").focus();


return false;
}



else {


var BaseUrl = MAINURL+"/";

//	alert(BaseUrl);


var btn = this;
var $form = $(btn).closest("form");

$form.submit(function (e) {
e.preventDefault();
$(btn).button('loading');
term = $form.serializeArray();
url = $form.attr("action");
$.post(url, term, function (data, status) {
//alert(data);
var SponorId = data;
//alert(SponorId);
var imgCount = $(".sponsorimg").length;

//alert(imgCount);
if (imgCount != 0) {
var base64image = $(".sponsorimg").attr("src");
//alert(base64image);

var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(BaseUrl + "/post-ad/events/addgroup_sponsorpic.php", { spPostingPic: base64image, ext: ext, SponorId: SponorId }, function (t) {
window.location.reload();
});
}
}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');
}).done(function (data) {

}).always(function () {
$(btn).button('reset');
});
});
}
});


//=======End sponsor=======


$(".EditgroupSponser").on("click", function () {

//alert();
var company = $("#sponsorTitle1").val()

var Website = $("#sponsorWebsite1").val()
var Price = $("#spsponsorPrice1").val()
var category = $("#sponsorCategory1").val()
var Description = $("#spsponsorDesc1").val()
// var sponsorImage = $("#sponsorImg").val()


//alert(company);
/*alert(Website);
alert(Price);
alert(category);
alert(Description);
alert(sponsorImage);*/

//alert();



if (company == "" && Website == "" && Price == "" && category.length == 0 && Description == "") {


$("#sponsorTitle_error1").text("Please Enter Company Name .");
$("#sponsorTitle1").focus();

$("#sponsorWebsite_error1").text("Please Enter Website.");
$("#sponsorWebsite1").focus();

$("#spsponsorPrice_error1").text("Please Enter Price.");
$("#spsponsorPrice1").focus();


$("#sponsorCategory_error1").text("Please select Category.");
$("#sponsorCategory1").focus();

$("#spsponsorDesc_error1").text("Please Enter Description.");
$("#spsponsorDesc1").focus();

/*$("#sponsorImg_error").text("Choose File.");
$("#sponsorImg").focus();
*/


return false;
} else if (company == "") {
//alert(company);
$("#sponsorTitle_error1").text("Please Enter Company Name .");
$("#sponsorTitle1").focus();

return false;
} else if (Website == "") {
//alert(Website);

$("#sponsorWebsite_error1").text("Please Enter Website.");
$("#sponsorWebsite1").focus();

return false;
} else if (Price == "") {

$("#spsponsorPrice_error1").text("Please Enter Price.");
$("#spsponsorPrice1").focus();

return false;
} else if (category.length == 0) {
//alert(category);

$("#sponsorCategory_error1").text("Please select Category.");
$("#sponsorCategory1").focus();

return false;
} else if (Description == "") {
//alert(Description);

$("#spsponsorDesc_error1").text("Please Enter Description.");
$("#spsponsorDesc1").focus();

return false;
}/*else if (sponsorImage == "") {
alert(sponsorImage);


$("#sponsorImg_error").text("Choose File.");
$("#sponsorImg").focus();


return false;
}*/


else {


var BaseUrl = MAINURL+"/";

//	alert(BaseUrl);


var btn = this;
var $form = $(btn).closest("form");

$form.submit(function (e) {
e.preventDefault();
$(btn).button('loading');
term = $form.serializeArray();
url = $form.attr("action");
$.post(url, term, function (data, status) {
//alert(data);
var SponorId = data;
//alert(SponorId);
var imgCount = $(".sponsorimg").length;

//alert(imgCount);
if (imgCount != 0) {
var base64image = $(".sponsorimg").attr("src");
//alert(base64image);

var arr = base64image.match(/data:image\/[a-z]+;/);
var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");
$.post(BaseUrl + "/post-ad/events/addgroup_sponsorpic.php", { spPostingPic: base64image, ext: ext, SponorId: SponorId }, function (t) {
window.location.reload();
});
}
}).fail(function () {
$(btn).effect("shake");
$(btn).button('reset');
}).done(function (data) {

}).always(function () {
$(btn).button('reset');
});
});
}
});




//=================POST A STORE FORM DEACTIVATE END=======



});
