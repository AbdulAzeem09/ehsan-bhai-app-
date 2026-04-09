<?php
	/*error_reporting(E_ALL);
   ini_set('display_errors', 1);*/
//session_save_path('"https://thesharepage.com/"/cgi-bin/tmp');
  session_start();
/*print_r($_COOKIE);
print_r($_SESSION);*/
	include('../univ/baseurl.php');
	include('../univ/main.php');

/*	session_start();*/
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
			
									$paymentMessage = '';
												//	if(!empty($_POST['stripeToken'])){
													
														$stripeToken  = $_POST['stripeToken'];
														$customerName = $_POST['customerName'];
														$cardNumber = $_POST['cardNumber'];
														$cardCVC = $_POST['cardCVC'];
														$cardExpMonth = $_POST['cardExpMonth'];
														$cardExpYear = $_POST['cardExpYear']; 
														$cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;
														
														require_once('../stripe-php/init.php'); 
														
														//set stripe secret key and publishable key
														$stripe = array(
														"secret_key"      => SECRET_KEY,
														"publishable_key" => PUBLIC_KEY
														);    
														\Stripe\Stripe::setApiKey($stripe['secret_key']);    
														
														try{
														//die('====');
															//add customer to stripe
															$customer = \Stripe\Customer::create(array(
															'name' => $customerName,
															'description' =>  'PRO TITLE',
															'email' => $customerEmail,
															'source'  => $stripeToken,
															"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
															));  
															// item details for which payment made
															$seller_id = $_POST['seller_id'];
															//$itemPrice = number_format($_POST['price'], 2, '.', '');
															//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
															$totalAmount = $_POST['total_amount'];
															//$totalAmount = $totalprice;  //$totalprice
															$currency = $_POST['currency_code'];
															$orderQty = $_POST['spOrderQty'];
															//$orderNumber ="WER12345";   
															$orderNumber = "WER".rand(10000000,99999999);   
															//print_r($_POST); die('=================');
															// details for which payment performed
															//die('dfhgsdfh');
															//echo $customer->id.' '.$totalAmount.' '.$currency.' '.$orderNumber;
														  
															$payDetails = \Stripe\Charge::create(array(
															'customer' => $customer->id,
															'amount'   => $totalAmount*100,
															'currency' => $currency,
															'description' => 'ITEM NAME',
															'metadata' => array(
															'order_id' => $orderNumber
															)
															));
														/*	print_r($payDetails).'<br>';
															die('====');
															print_r($paymenyResponse);*/
															
															
															$paymenyResponse = $payDetails->jsonSerialize();
															
														}
														catch (Error\Card $e) {
															
															$paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();
														}
														catch (Error\InvalidRequest $e) {
															
															$paymentMessage = "<strong>".ucfirst($e->getStripeParam())."</strong> ".$e->getMessage();
														} 
														catch (\Exception $e) {
															$paymentMessage = "<strong>".ucfirst($e->getStripeParam())." </strong> ".$e->getMessage();
														} 
														
														if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
														//die('======');
														$balanceTransaction = $paymenyResponse['balance_transaction'];
														
														$u = new _spuser;
  $p = new _spprofiles;

  $user  = $u->read($_SESSION['uid']);

  $userdata = mysqli_fetch_array($user);
              //$rp = $p->readProfiles($_SESSION['uid']);
              //login with default profile
              $rp = $p->readDefaultProfile($_SESSION['uid']);
              if ($rp != false) {
                $row = mysqli_fetch_array($rp);
                $updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

                $_SESSION['login_user'] = $userdata['spUserName'];
              $_SESSION['uid'] = $userdata['idspUser'];
              $_SESSION['spUserEmail'] = $userdata['spUserEmail'];
              

                $_SESSION['pid']      = $row['idspProfiles'];
                $_SESSION['myprofile']    = $row["spProfileName"];
                $_SESSION['MyProfileName']  = $row["spProfileName"];
                $_SESSION['ptname']     = $row["spProfileTypeName"];
                $_SESSION['ptpeicon']     = $row["spprofiletypeicon"];
                $_SESSION['ptid']       = $row["spProfileType_idspProfileType"];
                $_SESSION['isActive']     = 1;
                $c = new _order;
                $res = $c->read($_SESSION['pid']);
                if ($res != false) {
                  $_SESSION['cartcount'] = $res->num_rows;
                  //echo $_SESSION['cartcount'];
                } else {
                  $_SESSION['cartcount'] = 0;
                }
              }
			  
			  
			  
    $fc = new _payment_milestone;
   /* echo "<pre>";
   print_r($_REQUEST);*/

   $pay = array(
                   "payer_email" => $_SESSION['spUserEmail'],
                   "post_id" => $_POST['postid'],
                   "txn_id" => $balanceTransaction,
                   "mc_currency" => $_POST['currency_code'],
                   "payment_gross" => $_POST['total_amount'],
                   "payment_date" => date('Y-m-d')

               );
	$id = $fc->create($pay);

  $mi = new _milestone;
  $milestone = $mi->read($_POST['postid']);


  $milestonedata = mysqli_fetch_array($milestone);

 /* print_r($milestonedata);*/

if( $milestonedata['hired'] == 0){

  $link = '<a href="'.$BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$milestonedata['freelancer_projectid'].'">Here</a>';

}else{

   $link = '<a href="'.$BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$milestonedata['freelancer_projectid'].'">Here</a>';


}


//echo $fc->ta->sql;
                      $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $milestonedata['bussiness_profile_id'],'sellerProfileid' => $milestonedata['freelancer_profileid'],'module'=>'freelancer','message'=>'New Milestone created Click '.$link.' to check!' );
                         $pl->addenquiry($addmssage);

    if (isset($id)) {

        $u = new _spprofiles;

                  $reciverdata = $u->read($milestonedata['freelancer_profileid']); 

         if ($reciverdata != false) {

                    


                        $reciver = mysqli_fetch_array($reciverdata);

                        //print_r($reciver);


                     $reciveruserid = $reciver['spUser_idspUser'];   

                        /* print_r($bookedbuy);*/

                        $recivername = $reciver['spProfileName'];
                       
                        $reciveremail =  $reciver['spProfileEmail'];

         }  
$em = new _email;
         $em->sendmilestonecreated($recivername,$reciveremail,$link);

    
    }
														
														}
	
	
	



/*print_r($_SESSION);*/







                                                
   /* $re = new _redirect;*/
	/*$location = $BaseUrl."/freelancer/dashboard/freelancer_hire_project.php";
    $re->redirect($location);*/
	

    // header('location:inbox.php');
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include('../component/f_links.php');?>
      
  </head>
  <body onload="pageOnload('cart')"  class="bg_gray">
    <?php
      
      include_once("../header.php");
      
      
    ?>
    <section class="landing_page">
            <div class="container">
              <div class="row">
                <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <?php include('../component/left-landing.php');?>
                    </div>  
                    
                    <div class="col-md-10">
                      <div class="cartbox">
                        <div class="cart_header">
                          <h1><i class="fa fa-shopping-cart"></i> Milestone</h1>
                          
                        </div>
                        <div class="cart_body text-center successBody">
                          <i class="fa fa-check"></i>
                          <h2>Payment has been Successful</h2>
                          <p>Your Payment has been successfully Completed</p>
                          <a href="<?php echo $BaseUrl;?>/freelancer/dashboard/freelancer_hire_project.php" class="btn create_add no-radius">Go to dashboard</a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>

