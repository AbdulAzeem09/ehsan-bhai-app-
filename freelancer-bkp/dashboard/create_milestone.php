<?php 
  session_start();
 // print_r($_SESSION);

	include('../../univ/baseurl.php');


	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _milestone;
  /// print_r($_POST);
	$id = $fc->create($_POST);
//echo $fc->ta->sql;




                                                      $cancel_return = $BaseUrl."/freelancer/dashboard/freelancer_hire_project.php";
                                                      // RETURN SUCCESS LINK
                                                      $success_return = $BaseUrl."/paymentstatus/payment_success_milestone.php?postid=".$id."&uid=".$_SESSION['uid'];
                                                      // ===END
                                              



                                                      //Here we can use paypal url or sanbox url.
                                                      // sandbox
                                                      $paypal_url   = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                                                      // live payment
                                                      //$paypal_url   = 'https://www.paypal.com/cgi-bin/webscr';
                                                      //Here we can used seller email id. 
                                                      $merchant_email = 'developer-facilitator@thesharepage.com';
													  //live email - thesharepage.com@gmail.com.

                                                    ?>
                                                    
	<div style = "text-align:center"><h1>IF PAYPAL GIVES ERROR THEN RELOAD THE PAGE AGAIN OR GO TO BACK ON PAGE...</h1></div>
   <form action="<?php echo $paypal_url; ?>" method="post" name="myform">
                                                                    <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                                                                          <!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
                                                                          <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
                                                                          <input type="hidden" name="return" value="<?php echo $success_return; ?>">
                                                                          <input type="hidden" name="rm" value="2" />
                                                                              <input type="hidden" name="lc" value="2" />
                                                                              <input type="hidden" name="no_shipping" value="1" />
                                                                              <input type="hidden" name="no_note" value="1" />
                                                                              <input type="hidden" name="currency_code" value="USD">
                                                                              <input type="hidden" name="page_style" value="paypal" />
                                                                              <input type="hidden" name="charset" value="utf-8" />
                                                                          <input type="hidden" name="cbt" value="Back to FormGet" />

                                                                          <!-- Redirect direct to card detail Page -->
                                                                          
                                                                          <input type="hidden" name="landing_page" value="billing">

                                                                          <!-- Redirect direct to card detail Page End -->


                                                                          <!-- Specify a Buy Now button. -->
                                                                          <input type="hidden" name="cmd" value="_cart">
                                                                          <input type="hidden" name="upload" value="1">
                                                            

                                                                     <input type='hidden' name='item_name_1' value='milestone'>
                                                                     <input type='hidden' name='item_number_1' value='1' >
                     
                        
                                                                     <input type='hidden' id='' name='quantity_1' value='1'>
                                                                     
                                                                     <input type="hidden" class="form-control" name="amount_1" id="amount" value="<?php echo $_POST['amount']; ?>">

                                                                 </form>
                                                                 <script type="text/javascript">document.myform.submit();</script>

                                                    <?php  
    
   /* $re = new _redirect;*/
	/*$location = $BaseUrl."/freelancer/dashboard/freelancer_hire_project.php";
    $re->redirect($location);*/
	

    // header('location:inbox.php');
    
?>


