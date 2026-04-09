<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<?php 
error_reporting(E_ALL); 
   ini_set('display_errors', 1);
   session_start();
   require_once('dbconfig.php');
   //print_r($_POST);die;
		/*include('../../univ/baseurl.php');
	include( "../../univ/main.php");*/
/*if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "membership/";
    include_once ("../authentication/check.php");
    
}else{*/

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	require_once 'stripe-php/init.php'; 
	
	   \Stripe\Stripe::setApiKey(SECRET_KEY); 
	   
		if(isset($_POST['sub_id'])){
		$stripe = new \Stripe\StripeClient(SECRET_KEY);
  $stripe->subscriptions->cancel(
    $_POST['sub_id'],
    []
  );
  
  //print_r($stripe);
	}else{

$id=$_GET['id'];

	$pr = new _spprofiles;
	$m = new _spmembership;
	$result = $pr->profileforresume($_SESSION["uid"]);
	if($result != false){
		while($rows = mysqli_fetch_assoc($result)){
			if($rows["idspProfileType"] == 1)
			{
				$profileid = $rows["idspProfiles"];
				$subdate = $rows["spProfileSubscriptionDate"];
			}
		//	$res = $m->readmember($rows["spMembership_idspMembership"]);
			
			$res = $m->readmember($_GET['id']);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				//print_r($row);die;
				//echo $row["spMembershipName"]."<br>";
				$membership_name=$row["spMembershipName"];
				$count=$row["spMembershipPostlimit"]."<br>";
			 $duration=$row["spMembershipDuration"];
				
			}
		}
	}
// Get user ID from current SESSION 
$userID = $_SESSION['uid']; 
 
$payment_id = $statusMsg = $api_error = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe token is not empty 
if( !empty($_POST['stripeToken'])){
    // die("==================");
    // Retrieve stripe token, card and user info from the submitted form data 
    $token  = $_POST['stripeToken']; 
    $name = $_POST['name']; 
    $email = $_SESSION['spUserEmail']; 
    $card_number = preg_replace('/\s+/', '', $_POST['card_number']); 
    $card_exp_month = $_POST['card_exp_month']; 
    $card_exp_year = $_POST['card_exp_year']; 
    $card_cvc = $_POST['card_cvc']; 
     
    // Plan info 
    $planID = $_GET['id']; 
   // $planInfo = $plans[$planID]; 
    $planName = $membership_name; 
    $planPrice = $_POST['price']; 
    $planInterval = 'month'; 
    //die("==========");
    // Include Stripe PHP library 
   
     
    // Set API key 
 
     
    // Add customer to stripe 
    $customer = \Stripe\Customer::create(array( 
        'email' => $email, 
        'source'  => $token 
    )); 
     
    // Convert price to cents 
    $priceCents = round($planPrice*100); 
     
    // Create a plan 
    try { 
        $plan = \Stripe\Plan::create(array( 
            "product" => [ 
                "name" => $planName 
            ], 
            "amount" => $priceCents, 
            "currency" => $currency, 
            "interval" => $planInterval, 
            "interval_count" => 1 
        )); 
    }catch(Exception $e) { 
        $api_error = $e->getMessage(); 
    } 
     
    if(empty($api_error) && $plan){ 
        // Creates a new subscription 
        try { 
            $subscription = \Stripe\Subscription::create(array( 
                "customer" => $customer->id, 
                "items" => array( 
                    array( 
                        "plan" => $plan->id, 
                    ), 
                ), 
            )); 
        }catch(Exception $e) { 
            $api_error = $e->getMessage(); 
        } 
         
        if(empty($api_error) && $subscription){ 
            // Retrieve subscription data 
            $subsData = $subscription->jsonSerialize(); 
     
            // Check whether the subscription activation is successful 
            if($subsData['status'] == 'active'){ 
                // Subscription info 
                $subscrID = $subsData['id']; 
                $custID = $subsData['customer']; 
                $planID = $subsData['plan']['id']; 
                $planAmount = ($subsData['plan']['amount']/100); 
                $planCurrency = $subsData['plan']['currency']; 
                $planinterval = $subsData['plan']['interval']; 
                $planIntervalCount = $subsData['plan']['interval_count']; 
                $created = date("Y-m-d H:i:s", $subsData['created']); 
                $current_period_start = date("Y-m-d H:i:s", $subsData['current_period_start']); 
                $current_period_end = date("Y-m-d H:i:s", $subsData['current_period_end']); 
                $status = $subsData['status']; 
                     
                // Insert transaction data into the database 
             /*   $sql = "INSERT INTO user_subscriptions_details (user_id,stripe_subscription_id,stripe_customer_id,stripe_plan_id,plan_amount,plan_amount_currency,plan_interval,plan_interval_count,payer_email,created,plan_period_start,plan_period_end,status) VALUES('".$userID."','".$subscrID."','".$custID."','".$planID."','".$planAmount."','".$planCurrency."','".$planinterval."','".$planIntervalCount."','".$email."','".$created."','".$current_period_start."','".$current_period_end."','".$status."')"; 
                $insert = $db->query($sql);  */
                  $fr= new _spuser;
$fr1= $fr->readdatabybuyerid($_SESSION['uid']);
//var_dump($fr1);

if($fr1!=false){
	$fr2=mysqli_fetch_assoc($fr1);
    $trial=$fr2['duration'];
	if($trial==0){
	$new_duration = $duration+0;
	}
	else{
	$new_duration=$duration;
	}
}

							
							
							
					/*if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){ *///$cardDetails
													//die('======');
							$tansation = "123456789";
								$uid = $_SESSION['uid'];
								$pid = $_SESSION['pid'];
							//echo $_POST['price'];
								$dat = array(
													"amount"=>$_POST['price'],
													"membership_id"=>$_GET['id'],
													"txn_numberpid"=>$tansation,
													"uid"=>$uid,
													"pid"=>$pid,
													"duration"=>$new_duration,
													"subscriber_id"=>$subscrID,
													"customer_id"=>$custID,
													"plan_id"=>$planID,
													"currency"=>$planCurrency
													
													);
											$fr2=$fr->update_duration($_SESSION['uid']);
											
											//if($trial==0){
									$mb = new _spmembership;
                                    $result = $mb->create($dat);
											//}
									
												//}
                // Update subscription id in the users table  
				
				
                if(!empty($userID)){
				
				
                    /*$subscription_id = $db->insert_id;  
                    $update = $db->query("UPDATE users SET subscription_id = {$subscription_id} WHERE id = {$userID}");  */
                } 
                 
                $ordStatus = 'success'; 
                $statusMsg = 'Your Subscription Payment has been Successful!'; 
header("Location:https://dev.thesharepage.com/membership/?msg=success");
            }else{ 
                $statusMsg = "Subscription activation failed!"; 
            } 
        }else{ 
            $statusMsg = "Subscription creation failed! ".$api_error; 
        } 
    }else{ 
        $statusMsg = "Plan creation failed! ".$api_error; 
    } 
}else{ 
    $statusMsg = "Error on form submission, please try again."; 
}
}
?>

<div class="container">
    <div class="status">
        <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
        <?php if(!empty($subscrID)){ ?>
            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $subscription_id; ?></p>
            <p><b>Transaction ID:</b> <?php echo $subscrID; ?></p>
            <p><b>Amount:</b> <?php echo $planAmount.' '.$planCurrency; ?></p>
			
            <h4>Subscription Information</h4>
            <p><b>Plan Name:</b> <?php echo $planName; ?></p>
            <p><b>Amount:</b> <?php echo $planPrice.' '.$currency; ?></p>
            <p><b>Plan Interval:</b> <?php echo $planInterval; ?></p>
            <p><b>Period Start:</b> <?php echo $current_period_start; ?></p>
            <p><b>Period End:</b> <?php echo $current_period_end; ?></p>
            <p><b>Status:</b> <?php echo $status; ?></p>
        <?php } ?>
    </div>
    <a href="https://dev.thesharepage.com/membership/member_buy.php?id=<?php echo $_GET['id']?>" class="btn-link">Back to Subscription Page</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<?php //} ?>