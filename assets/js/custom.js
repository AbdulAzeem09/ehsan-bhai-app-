var hostUrl = window.location.host; 
var hostSchema = window.location.protocol;

var MAINURL = hostSchema+'//'+hostUrl;

$(document).ready(function () {
	// VALIDATE CONTACT FORM PAGE
	function conformisvalid(){
		
		var spConTopic = $("#spConTopic").val();
		var spConName = $("#spConName").val();
		var spConSubj = $("#spConSubj").val();
		var spConEmail = $("#spConEmail").val();
		var spConDesc = $("#spConDesc").val();
		var txtCaptcha = $("#txtCaptcha").val();
		var captcha = $("#captcha").val();
		var isvalid = true;
		if(spConTopic == ""){
			$(".spConTopic").html("This field is required");
			isvalid = false;
		} else{
			$(".spConTopic").html("");
		}
		if(spConName == ""){
			$(".spConName").html("This field is required");
			isvalid = false;
		}else{
			$(".spConName").html("");
		}
		if(spConSubj == ''){
			$(".spConSubj").html("This field is required");
			isvalid = false;
		}else{
			$(".spConSubj").html("");
		}
		if(spConEmail == ''){
			$(".spConEmail").html("This field is required");
			isvalid = false;
		}else{
			$(".spConEmail").html("");
			var isvalidemail = IsEmail(spConEmail);
			if(isvalidemail == false){
				$(".spConEmail").html("Enter correct email");
				isvalid = false;
			}else{
				$(".spConEmail").html("");
			}
		}
		if(spConDesc == ''){
			$(".spConDesc").html('This field is required');
			isvalid = false;
		}else{
			$(".spConDesc").html('');
		}
		//console.log(txtCaptcha);
		if(captcha == ''){
			$(".captcha").html("Please enter Human verification code");
			isvalid = false;
		}else{
			if(captcha == txtCaptcha){
				$(".captcha").html("");
			}else{
				$(".captcha").html("Wrong code entered. Please enter correct code");
				isvalid = false;
			}
		}
		if(isvalid == true){
			return true;
		}
		
	}
	// CHECK EMAIL VALID OR NOT
	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(email)) {
			return false;
		}else{
			return true;
		}
	}
	// CONTACT BUTTON
	$("#btncont").on("click", function () {
		//alert('hi');
        var btn = this;
        var $form = $(btn).closest("form");
        $form.submit(function (e) {
            e.preventDefault();
            var isvalid = conformisvalid();
			if(isvalid == true){
				$('form').unbind('submit').submit();
			}
			
        });
    });
	// INPUT FIELD KEY UP ON CONTACT PAGE ONLY TEXT
	$(".chekspvhar").keyup(function(){
		//this code executes when the keyup event occurs
		//var regExpr = /[^a-zA-Z0-9-. ]/g;
		//var regExpr = /[^a-zA-Z0-9 ]/g;
		var regExpr = /[^a-zA-Z ]/g;
        var userText = $(this).val();
        
		$(this).val(userText.replace(regExpr, ""));
	});
	
	
	
	
	
});