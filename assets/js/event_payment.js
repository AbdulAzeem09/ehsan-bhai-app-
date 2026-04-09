
function stripePay(event) {
    event.preventDefault(); 
    if(validateForm() == true) 
    {
     $('#payNow').attr('disabled', 'disabled');
     $('#payNow').val('Payment Processing....');
     str = $('#cardExpMonth').val();
     parts = str.split("/");

    card_month = parts[0]; // '22'
    exp_year = parts[1]; // '88'
     Stripe.createToken({
      number:$('#cardNumber').val(),
      cvc:$('#cardCVC').val(),
      exp_month : card_month,
      exp_year : exp_year
     }, stripeResponseHandler);
     return false;
    }
}

function stripePay2(event) {
    event.preventDefault(); 
    if(validateForm() == true) {
     $('#payNow').attr('disabled', 'disabled');
     $('#payNow').val('Payment Processing....');
     Stripe.createToken({
      number:$('#cardNumber').val(),
      cvc:$('#cardCVC').val(),
      exp_month : $('#cardExpMonth').val(),
      exp_year : $('#cardExpYear').val()
     }, stripeResponseHandler2);
     return false;
    }
}

function stripeResponseHandler(status, response) {
 if(response.error) {
  $('#payNow').attr('disabled', false);
  $('#message').html(response.error.message).show();
 } else {
  var stripeToken = response['id'];
  $('#paymentForm').append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");

  $('#paymentForm').submit();
 }
}

function stripeResponseHandler2(status, response) {
 if(response.error) {
  $('#payNow').attr('disabled', false);
  $('#message').html(response.error.message).show();
 } else {
  var stripeToken = response['id'];
  $('#paymentForm').append("<input type='hidden' name='stripeToken' value='" + stripeToken + "' />");

 }
}

function validateForm() {
 var validCard = 0;
 var valid = false;
 var fistname = $('#fistname').val();
 var lastname = $('#lastname').val();
 var email = $('#email').val();
 var card_month = $('#card_month').val(); 
 var cardCVC = $('#cardCVC').val(); 
 var card_number = $('#card_number').val(); 

 var billing_address = $('#billing_address').val();
 var postcode = $('#postcode').val();
 var country = $('#country').val();
 var province = $('#province').val();
 var city = $('#city').val();
 var cardExpMonth = $('#cardExpMonth').val();
 //var cardExpYear = $('#cardExpYear').val();
 var cardNumber = $('#cardNumber').val();
 var card_name = $('#card_name').val();
 //var customerName = $('#customerName').val();

 var validateName = /^[a-z ,.'-]+$/i;
 var validateMonth = /^([0-9]{2}[/]?){2}$/;
 //var validateYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
 var cvv_expression = /^[0-9]{3,3}$/;

//  $('#cardNumber').validateCreditCard(function(result){
//   if(result.valid) {
//    $('#cardNumber').removeClass('require');
//    $('#errorCardNumber').text('');
//    validCard = 1;
//   } else {
//    $('#cardNumber').addClass('require');
//    $('#errorCardNumber').text('Invalid Card Number');
//    $('#errorCardExpMonth').text('Invalid Month');
//    $('#errorCardExpYear').text('Invalid Year');
//    $('#errorCardCvc').text('Invalid CVC');
//    validCard = 0;
//   }
//  });
validCard = 1;
 if(validCard == 1) {


  if(fistname == '') {
   $('#fistname').addClass('require');
   $('#errorfistname').text('Required Field');
   valid = false;
  } else {
   $('#fistname').removeClass('require');
   $('#errorfistname').text('');
   valid = true;
  }

  if(lastname == '') {
   $('#lastname').addClass('require');
   $('#errorlastname').text('Required Field');
   valid = false;
  } else {
   $('#lastname').removeClass('require');
   $('#errorlastname').text('');
   valid = true;
  }

  if(email == '') {
   $('#email').addClass('require');
   $('#erroremail').text('Required Field');
   valid = false;
  } else {
   $('#email').removeClass('require');
   $('#erroremail').text('');
   valid = true;
  }

  if(cardNumber == '') {
   $('#cardNumber').addClass('require');
   $('#errorCardNumber').text('Required Field');
   valid = false;
  } else {
   $('#cardNumber').removeClass('require');
   $('#errorCardNumber').text('');
   valid = true;
  }

  if(cardExpMonth == '') {
   $('#cardExpMonth').addClass('require');
   $('#errorCardExpMonth').text('Required Field');
   valid = false;
  } else {
   $('#cardExpMonth').removeClass('require');
   $('#errorCardExpMonth').text('');
   valid = true;
  }

  if(cardCVC == '') {
   $('#cardCVC').addClass('require');
   $('#errorCardCvc').text('Required Field');
   valid = false;
  } else {
   $('#cardCVC').removeClass('require');
   $('#errorCardCvc').text('');
   valid = true;
  }

  if(card_name == '') {
   $('#card_name').addClass('require');
   $('#errorcard_name').text('Required Field');
   valid = false;
  } else {
   $('#card_name').removeClass('require');
   $('#errorcard_name').text('');
   valid = true;
  }

  if(billing_address == '') {
   $('#billing_address').addClass('require');
   $('#errorbilling_address').text('Required Field');
   valid = false;
  } else {
   $('#billing_address').removeClass('require');
   $('#errorbilling_address').text('');
   valid = true;
  }

  if(postcode == '') {
   $('#postcode').addClass('require');
   $('#errorpostcode').text('Required Field');
   valid = false;
  } else {
   $('#postcode').removeClass('require');
   $('#errorpostcode').text('');
   valid = true;
  }

  if(country == '') {
   $('#country').addClass('require');
   $('#errorcountry').text('Required Field');
   valid = false;
  } else {
   $('#country').removeClass('require');
   $('#errorcountry').text('');
   valid = true;
  }

  if(province == '') {
   $('#province').addClass('require');
   $('#errorprovince').text('Required Field');
   valid = false;
  } else {
   $('#province').removeClass('require');
   $('#errorprovince').text('');
   valid = true;
  }

  if(city == '') {
   $('#city').addClass('require');
   $('#errorcity').text('Required Field');
   valid = false;
  } else {
   $('#city').removeClass('require');
   $('#errorcity').text('');
   valid = true;
  }

	 
  /*if(!validateName.test(customerName)) {
   $('#customerName').addClass('require');
   $('#errorCustomerName').text('Invalid Name');
   valid = false;
  } else {
   $('#customerName').removeClass('require');
   $('#errorCustomerName').text('');
   valid = true;
  }


  if(!validateMonth.test(cardExpMonth)){
   $('#cardExpMonth').addClass('require');
   $('#errorCardExpMonth').text('Invalid Data');
   valid = false;
  } else { 
   $('#cardExpMonth').removeClass('require');
   $('#errorCardExpMonth').text('');
   valid = true;
  }

  if(!validateYear.test(cardExpYear)){
   $('#cardExpYear').addClass('require');
   $('#errorCardExpYear').text('Invalid Data');
   valid = false;
  } else {
   $('#cardExpYear').removeClass('require');
   $('#errorCardExpYear').text('');
   valid = true;
  }

  if(!cvv_expression.test(cardCVC)) {
   $('#cardCVC').addClass('require');
   $('#errorCardCvc').text('Invalid Data');
   valid = false;
  } else {
   $('#cardCVC').removeClass('require');
   $('#errorCardCvc').text('');
   valid = true;
  }*/
 }
 return valid;
}

function validateNumber(event) {
	
 var charCode = (event.which) ? event.which : event.keyCode;
 if (charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57)){
  return false;
 }
 return true;
}