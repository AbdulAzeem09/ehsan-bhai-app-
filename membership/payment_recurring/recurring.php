<link rel="stylesheet" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<?php 
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
// Include configuration file  
require_once 'dbconfig.php'; 
?>
<script src="https://js.stripe.com/v2/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="panel">
    <form action="payment.php" method="POST" id="paymentFrm">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="ez-toc-section" id="Plan_Subscription_with_Stripe"></span>Plan Subscription with Stripe<span class="ez-toc-section-end"></span></h3>
			
            <!-- Plan Info -->
            <p>
                <b>Select Plan:</b>
                <select name="subscr_plan" id="subscr_plan">
                    <?php foreach($plans as $id=>$plan){ ?>
                        <option value="<?php echo $id; ?>"><?php echo $plan['name'].' [$'.$plan['price'].'/'.$plan['interval'].']'; ?></option>
                    <?php } ?>
                </select>
            </p>
        </div>
        <div class="panel-body">
            <!-- Display errors returned by createToken -->
            <div class="card-errors"></div>
			
            <!-- Payment form -->
            <div class="form-group">
                <label>NAME</label>
                <input type="text" name="name" id="name" placeholder="Enter name" required="" autofocus="">
            </div>
            <!--<div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" id="email" placeholder="Enter email" required="">
            </div>-->
            <div class="form-group">
                <label>CARD NUMBER</label>
                <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" maxlength="16" autocomplete="off" required="">
            </div>
            <div class="row">
                <div class="left">
                    <div class="form-group">
                        <label>EXPIRY DATE</label>
                        <div class="col-1">
                            <input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" maxlength="2" required="">
                        </div>
                        <div class="col-2">
                            <input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" maxlength="4" required="">
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label>CVC CODE</label>
                        <input type="text" name="card_cvc" id="card_cvc" placeholder="CVC" maxlength="3" autocomplete="off" required="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="payBtn">Submit Payment</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Create Stripe Token and Validate Card with Stripe.js Library: -->
<script src="https://js.stripe.com/v2/"></script>

<script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo PUBLIC_KEY; ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        // Enable the submit button
        $('#payBtn').removeAttr("disabled");
        // Display the errors on the form
        $(".payment-status").html('<p>'+response.error.message+'</p>');
    } else {
        var form$ = $("#paymentFrm");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}

$(document).ready(function() {
    // On form submit
    $("#paymentFrm").submit(function() {
        // Disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
		
        // Create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
        }, stripeResponseHandler);
		
        // Submit from callback
        return false;
    });
});
</script>


