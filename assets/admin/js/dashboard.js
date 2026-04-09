
//var MAINURL = "http://localhost/share-page";
var hostUrl = window.location.host; 
var hostSchema = window.location.protocol;

var MAINURL = hostSchema+'//'+hostUrl;
// ALL DASHBOARD FUNCTION 
$(document).ready(function () {
	
	// CHANGE ON/OFF ON PIN CREATE DASHBOARD
	$('#chngePin').on('change', function() {
		if ($('#chngePin').is(":checked")){
			// ENABLE PIN
			$("#enableArea").removeClass("hidden");
		}else{
			// DISABLE PIN
			$("#enableArea").addClass("hidden");
		}			
	});
	// GENERATE OTP
	$(".getnrateOtp").on("click", function(){    
	

var curr_pwd = $("#curr_pwd").val();
var current_pin = $("#current_pin").val();
//alert(curr_pwd);
//alert(current_pin);
var txtConfirmPin = document.getElementById("txtConfirmPin").value;
var txtPin = document.getElementById("txtPin").value;
if(txtPin == txtConfirmPin){
	$("#error").html("");

}



	if((txtConfirmPin == '')||(txtPin == '')||(curr_pwd == '')||(current_pin =='')||(curr_pwd != current_pin)||(txtPin != txtConfirmPin)){

		//alert('00000000');

		
		if (txtPin=='') {
			$("#error74").html("Please Enter New Password");
		    }else{
				$("#error74").html("");
			}


		if (txtConfirmPin=='') {
			$("#error").html("Please Enter New Password");
		    }else{
				$("#error").html("");
			}
		     if (txtPin == txtConfirmPin) {
				$("#error").html("");
			
		    }else{
				$("#error").html("Password  does not match ");
			}
			if (curr_pwd == current_pin) {
				$("#error_pin").html("");
              } else {
			$("#error_pin").html("Current pin does not match");
			
			}
			return false;


	}


		
		var createby = $("#txtCreateBy").val();    
		
		$.post(MAINURL+"/dashboard/sticky-pin/generateotp.php", {createby: createby}, function (r) {
			//console.log(r);
			$("#code").removeClass("hidden");
			if(createby=="SMS"){
				$("#sms_msg").show();
				$("#email_msg").hide();
			}else if(createby=="Email"){
				$("#email_msg").show();
				$("#sms_msg").hide();
			}
			var rr = r.replace(/^\s+|\s+$/gm,'');
			$("#ggg").val(rr); 
		});
		
	});
		
	$(".getnrateOtp_f").on("click", function(){    
		
		var createby = "Email";
		
		$.post(MAINURL+"/dashboard/sticky-pin/generateotp_f.php", {createby: createby}, function (r) {
			//console.log(r);
			$("#code").removeClass("hidden");  
			if(createby=="SMS"){
				$("#sms_msg").show();
				$("#email_msg").hide();
			}else if(createby=="Email"){
				$("#email_msg").show(); 
				$("#sms_msg").hide();
			}
			//var rr = r.replace(/^\s+|\s+$/gm,'');
			var rr = $.trim(r);
			$("#otp").val(rr); 
			
		});
		
	});
		
		
		
		
		
		
		
		
		
	});