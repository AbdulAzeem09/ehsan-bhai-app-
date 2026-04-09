
//REGISTER SCRIPT 

var hostUrl = window.location.host; 
var hostSchema = window.location.protocol;
var MAINURL = hostSchema+'//'+hostUrl;
var BASE_URL = MAINURL;
$(document).ready(function () {

// THIS IS LOGIN SCRIPT
function islogincorrect(){
var email = document.getElementById("loginame").value;
var email =email.trim();
var pass = document.getElementById("lpass").value;
isvalid = true;
if(email.trim() == ""){
$(".loginame").html("This field is required");
isvalid = false;
}else{

var isvalidemail = IsEmail(email);
if(isvalidemail == false){
$(".loginame").html("Enter correct email");
isvalid = false;
}else{
$(".loginame").html("");
}
}
if(pass.trim() == ""){
$(".lpass").html("This field is required");
isvalid = false;
}else{
$(".lpass").html('');
}

if(isvalid == true){
return true;
}
}
$("#signin").one("click", function () {
//alert('=========');
var $form = $("#blogin");
$form.submit(function (e) {
e.preventDefault();

var islogin = islogincorrect();
if(islogin == true){
if ($form.find("span").hasClass("glyphicon-remove")) {
$("#signin").effect("shake");
$("#signin").button('reset');
return false;
}
term = $form.serializeArray();
url = $form.attr("action");
var posting = $.post(url, term, function (data, status) {
//console.log(data);
if (data == 0){
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Invalid Email or Password, Please enter the valid Email or Password</div>");
$("#loginame").val("");
$("#lpass").val("");
}else if(data == 1){
$("#invalid").show();
$("#loginame").val("");
$("#lpass").val("");
$("#blogin").hide();
}else if(data == 2){
$("#invalid").html("<div class='alert alert-info error_show' role='alert'>Your account is not active yet. Please kindly verify your email through the link that is sent to your email in order to activate your account.</div>");
$("#lpass").val("");
}else{
$("#signin").button('loading');
window.location.href = data;
}
});
//==========end
}
// MESSAGE HIDE AFTER SPECIFIC TIME
var seconds = 3;
setInterval(function () {
seconds--;
if (seconds == 0) {
$(".loginame").html("");
$(".lpass").html("");
}
}, 1000);
//====end=====
var captcha = $("#captcha").val();
if(captcha){
	if(captcha == txtCaptcha){
		$(".captcha").html("");
	}else{
		$(".captcha").html("Wrong code entered. Please enter correct code");
		isvalid = false;
	}
}

});

});



//====================END=====================
// function isvalidregister(){
// 	var fName = document.getElementById("spUserFirstName").value;
// 	var lName = document.getElementById("spUserLastName").value;
// 	var email = document.getElementById("spUserEmail").value;
// 	var pass = document.getElementById("bpass").value;
// 	var cpass = document.getElementById("respUserEnpass").value;
// 	var address= $('#address').val();
// 	var country = $('#spUserCountry option:selected').val();
// 	var state = $('#spUserState option:selected').val();
// 	var city = $('#spUserCity option:selected').val();
// 	var mobNumber = document.getElementById("respUserEphone").value;
// 	//var captcha = $("#captcha").val();
// 	var txtCaptcha = $("#txtCaptcha").val();
// 	var spUserDob = $("#spUserDob").val();
// 	var terms = $('#terms').val();
// 	var txtCountryCode = $("#txtCountryCode").val();
// 	var isvalid = true;

// 	if($("#terms").prop('checked') == false){
// 		$(".spTerms").html("Please check terms and conditions.");
// 		isvalid = false;
// 	}
// 	else{
// 		$(".spTerms").html("");
// 	}
// 	if(fName.trim() == ''){
// 		$(".spUserFirstName").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserFirstName").html("");
// 	}
// 	if(lName.trim() == ''){
// 		$(".spUserLastName").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserLastName").html("");
// 	}
// 	if(email.trim() == ''){
// 		$(".spUserEmail").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		var isvalidemail = IsEmail(email);
// 		if(isvalidemail == false){

// 			$(".spUserEmail").html("Enter correct email");
// 			isvalid = false;
// 		}else{
// 			var isEmailAlreadyExist = IsEmailAlreadyExist(email);
// 			if(isEmailAlreadyExist == true){
// 				$(".loginame").html(email+" email already exists.");
// 				isvalid = false;
// 			}else{
// 				$(".loginame").html("");
// 			}
// 		}
// 	}
// 	if(pass.trim() == ''){
// 		$(".bpass").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".bpass").html("");
// 	}
// 	if(cpass.trim() == ''){
// 		$(".respUserEnpass").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".respUserEnpass").html("");
// 	}
// 	if(pass.trim() != cpass.trim()){
// 		$(".respUserEnpass").html("Password does not match.");
// 		isvalid = false;
// 	}else{
// 		$(".respUserEnpass").html("");
// 	}
// 	if(address == ""){
// 		$(".spUserAddress").html("This field is required");
// 	}else{
// 		$(".spUserAddress").html("");
// 	}
// 	if(country == ""){
// 		$(".spUserCountry").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserCountry").html("");
// 	}
// 	if(state == 0){
// 		$(".spUserState").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserState").html("");
// 	}
// 	if(city == 0){
// 		$(".spUserCity").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserCity").html("");
// 	}
// 	if(mobNumber.trim() == '' || txtCountryCode == ''){
// 		if (txtCountryCode == '' && mobNumber.trim() == '') {
// 			$(".respUserEphone").html("Please enter country code and number");
// 		}else if (mobNumber.trim() == '' && txtCountryCode != '') {
// 			$(".respUserEphone").html("Please enter number");
// 		}else{
// 			$(".respUserEphone").html("Please enter country code");
// 		}
// 		isvalid = false;
// 	}else{
// 		$(".respUserEphone").html("");
// 	}
// 	if(spUserDob.trim() == ''){
// 		$(".spUserDob").html("This field is required");
// 		isvalid = false;
// 	}else{
// 		$(".spUserDob").html("");
// 	}
// /*	if(captcha.trim() == ''){
// 		$(".captcha").html("Please enter Human verification code");
// 		isvalid = false;
// 	}else{
// 		if(captcha == txtCaptcha){
// 			$(".captcha").html("");
// 		}else{
// 			$(".captcha").html("Wrong code entered. Please enter correct code");
// 			isvalid = false;
// 		}
// 	} */
// 	if(isvalid == true){
// 		return true;
// 	}
// }
// CHECK EMAIL VALID OR NOT
function IsEmail(email) {
var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if(!regex.test(email)) {
return false;
}else{
return true;
}
}

// CHECK EMAIL VALID OR NOT
// function IsEmailAlreadyExist(email) {
// 	var emailExist = false;
// 	$.get(BASE_URL+"/authentication/availableemail.php?uemail=" + email, function (echeck) {
//            if (echeck == 0)
//            {
//                emailExist = true;
//            }
//           });
//           return emailExist;
// } 
// INPUT FIELD KEY UP ON CONTACT PAGE ONLY TEXT
$(".chekspvhar").keyup(function(){
//this code executes when the keyup event occurs
//var regExpr = /[^a-zA-Z0-9-. ]/g;
//var regExpr = /[^a-zA-Z0-9 ]/g;
var regExpr = /[^a-zA-Z ]/g;
var userText = $(this).val();

$(this).val(userText.replace(regExpr, ""));
});
// THIS IS FORM WHEN USER REGISTRATION AN ACCOUNT
// $("#buregister").one("click", function () {
// 	var $form = $("#buRegForm");
// 	$form.submit(function (e) {
// 		e.preventDefault();
// 		var isvalid = isvalidregister();

// 		if(isvalid == true){
// 			//========THIS IS SCRIPT IF COUNTRY CODE IS EMPTY=========
// 			var countryCode = $(".selected-dial-code").text();
// 			if(countryCode == ""){
// 				$(".lbl_9").addClass("label_error");
// 			}else{
// 				//console.log(countryCode);
// 				$("#txtCountryCode").val(countryCode);
// 				$(".lbl_9").removeClass("label_error");
// 				// HERE IS COMPLETE CODE FOR ADDING 
// 				$("#buregister").button('loading');

// 				if ($form.find("span").hasClass("glyphicon-remove")) {
// 					$("#buregister").effect("shake");
// 					$("#buregister").button('reset');
// 					return false;
// 				}
// 				term = $form.serializeArray();		
// 				url = $form.attr("action");
// 				var posting = $.post(url, term, function (data, status) {
// 					//console.log(data);
// 					if (data > 0) {
// 						$("#buregister").button('reset');
// 						// remove the form at local storage that was sent on sign-up.php.
// 					    if (localStorage.getItem(formIdentifier) != null) {
// 					        localStorage.removeItem(formIdentifier);
// 					        console.log("form storage removed");
// 					    }
// 						window.location = BASE_URL+"/emailvarify.php";
// 					} else {
// 						$("#buregister").button('reset');
// 					}
// 				});
// 				//==========END====================
// 			}
// 			//========THIS IS SCRIPT IF COUNTRY CODE IS EMPTY=========
// 		}


// 		// MESSAGE HIDE AFTER SPECIFIC TIME
// 		var seconds = 3;
// 		setInterval(function () {
// 			seconds--;
// 			if (seconds == 0) {
// 				$(".erormsg").html("");
// 			}
// 		}, 1000);
// 		//====end=====								
// 	});	
// });
$(document).ready(function () {

var value = $("#bpass").val();
var cvalue = $("#respUserEnpass").val();
var email = $('#spUserEmail').val();
if(email!=null){
email =email.trim();
}

//  $.validator.addMethod("checklower", function(value) {
//    return /[a-z]/.test(value);
//  });
//  $.validator.addMethod("checkupper", function(value) {
//    return /[A-Z]/.test(value);
//  });
//  $.validator.addMethod("checkdigit", function(value) {
//    return /[0-9]/.test(value);
//  });
//  $.validator.addMethod("pwcheck", function(value) {
//    return /[!#$%^&\-@._*]/.test(value);
//  });
$.validator.addMethod("emailcheck", function(value) {
return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
});



$("#buregister").click(function(){
var captcha = $("#captcha").val();
var txtCaptcha = $("#txtCaptcha").val();



if(captcha == txtCaptcha){
//	alert("aaaaaaaaaaaa");
$(".captcha").html("");
}else{
//alert("111111111111111111");
$(".captcha").html("Wrong code entered. Please enter correct code");
return false;
}
});

$("#buRegForm").validate({

errorPlacement: function(error, element) {

var zz = document.getElementById("respUserEphone").value;
	if (zz == 0 || zz == "") {
	//alert('11');
	document.getElementById("phone_validate").innerHTML = "<b>This field is required</b>";
	return false;
	}

//$('#buregister').on(function(){
/*var ref=$('#refferalcodeused').val();
//alert(ref);
if(ref!=''){


$.ajax({
url: "authentication/register.php", 
type: "POST",


data:{'ref_code': ref},
success: function (result) {

}
// when call is sucessfull
},

);


}*/
//});


//	alert("aaaaaaaaaaaa");
if (element.attr("name") == "terms") {
error.appendTo(".terms_con");
} 
else if(element.attr("name") == "respUserEphone") {
error.appendTo(".respUserEphoneDiv");
}else {
error.insertAfter(element)
}
},
rules: {
spUserFirstName: {
required: true,
},
spUserLastName: {
required: true,
},
spUserEmail: {
email:true,
emailcheck: true,
required: true,
remote: {
url: "authentication/availableEmailCheck.php",
type: "post",
}
},
spUserPassword: {
required: true,
},
respUserEnpass_: {
required: true,
equalTo: "#bpass"
},

respUserEphone: {
required: true,
},
respUserEphone: {
required: true,
},
address: {
required: true,
},
spUserCountry: {
required: true,
},
spUserState: { 
required: true,
},
/*spUserCity: {
//required: true,
}*/
zipcode: {
required: true,
},
spUserDob: {
required: true,
},
terms: {
required: true,
},

}, 
messages: {

spUserEmail: {
emailcheck: "Please enter ttya valid email address.",
remote: "This Email is already registered!."
},
respUserEnpass_: {
equalTo: "Password does not match",
},
terms : {
required: "Please check terms and conditions.",
},
},
submitHandler: function (form) {

var formData = new FormData(form);



$.ajax({
url: "authentication/register.php",
method: 'POST',
data: formData,
contentType: false,
processData: false,
cache: false,
success: function(html){
// alert('1111');
//alert(html);



let result = html.trim();

if(result=="Wrong"){
// alert('222');


$(".rfc").html("Referral Code is Invalid");
//$("#refferalcodeused").val("");
document.getElementById('refferalcodeused').value = "";


}
if(html == 1){
//alert('success');

window.location = BASE_URL+"/verifyemail.php";

}
if (html == '1') {
$("#buregister").button('reset');
if (localStorage.getItem(formIdentifier) != null) {
localStorage.removeItem(formIdentifier);
console.log("form storage removed");
}
// window.location = BASE_URL+"/emailvarify.php";
window.location = BASE_URL+"/otp.php";
} 
$("#results").append(html);
}
});

/* $.ajax({
url: "authentication/register.php",
method: 'POST',
data: formData,
// dataType: "json",
// contentType: false,
// processData: false,
// beforeSend: function() {
//     $("div.loading").removeClass('loadinghide');
// },
success: function(response) {
alert(response);
console.log(response);
if(response=="Wrong"){
let result = response.trim();

$(".rfc").html("Referral Code is Invalid");
//$("#refferalcodeused").val("");
document.getElementById('refferalcodeused').value = "";


}
if (response == '1') {
$("#buregister").button('reset');
if (localStorage.getItem(formIdentifier) != null) {
localStorage.removeItem(formIdentifier);
console.log("form storage removed");
}
// window.location = BASE_URL+"/emailvarify.php";
window.location = BASE_URL+"/otp.php";
} 
},
});*/

}

});
});

//============================END================================
//whern pass key change currently not use any where
$("#bpass").on("change", function () {
$ip = $("#bpass");
if ($ip.val().length > 5) {
if (!$("#regnamecheck").hasClass("glyphicon-remove")) {
$.get("authentication/login.php?regname=" + $("#spUserFirstName").val() + "&bpass=" + $ip.val(), function (ucheck) {
if (ucheck == 1) {
$ip.closest(".has-feedback").addClass("has-error").removeClass("has-success");
$ip.parent().siblings(".form-control-feedback").removeClass("hidden").removeClass("glyphicon-ok").addClass("glyphicon-remove");
} else {
$ip.closest(".has-feedback").addClass("has-success").removeClass("has-error");
$ip.parent().siblings(".form-control-feedback").removeClass("hidden").removeClass("glyphicon-remove").addClass("glyphicon-ok");
}
});
}
}
});


// CHECK PHONE IS VALID
$("#btnChksms").on("click", function(){
var cod = $("#txtCode").val();
var uid = $("#txtuid").val();
if(cod.trim() == ''){
$(".errormsg").html("<div class='alert alert-danger'>This field is required</div>");
}else{
if(uid > 0){
$.ajax({
type: "POST",
url: BASE_URL+"/authentication/validcode.php",
cache:false,
data: 'cod='+cod+'&uid='+uid,
success: function(data) {
//console.log(data.trim());
//window.location.reload();
$("#reg_sucess_rm").html("");
if(data.trim() == 0){
//window.location = BASE_URL+"login.php";
$(".errormsg").html("<div class='alert alert-success'>Please check your email. You will receive an email with a link to verify your email. Once your email is verified, you will be able to login and start using The SharePage.</div>");
$(".thnkform").html('');
}else{
$(".errormsg").html("<div class='alert alert-danger'>Code entered is not correct. Please enter the correct code.</div>");
}
}
});
}else{
$(".errormsg").html("<div class='alert alert-danger'>Code entered is not correct. Please enter the correct code.</div>");
}
}
});
// END
// ===RESEND CODE SEND TO THE USER
$("#resendcod").on("click", function(){
var uid = $("#txtuid").val();
if(uid > 0){
$.ajax({
type: "POST",
url: BASE_URL+"/authentication/resend-signup.php",
cache:false,
data: 'uid='+uid,
success: function(data) {
//console.log(data.trim());
//window.location.reload();
if(data.trim() == 1){
$(".errormsg").html("<div class='alert alert-success'>Code Sent To Your Mobile Number.</div>");

}else{
$(".errormsg").html("<div class='alert alert-danger'>Some error is occoured kindly refresh you page and try to login.</div>");
}
}
});
}
});
// ===end

});
