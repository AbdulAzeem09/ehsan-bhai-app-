<?php
	include('../../univ/baseurl.php');
	session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="freelancer/";
    include_once ("../../authentication/islogin.php");
    
}else{
	
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	// FIRST CHEK IF USER COME FROM PAYPAL OR LINK
	if (isset($_REQUEST['txn_id']) && !empty($_REQUEST['txn_id'])) {

		$item_name 	= $_REQUEST['item_name'];
		$amount 	= $_REQUEST['mc_gross'];
		$currency 	= $_REQUEST['mc_currency']; 
		$payer_email = $_REQUEST['payer_email']; 
		$first_name = $_REQUEST['first_name'];
		$last_name 	= $_REQUEST['last_name'];
		//$country 	= $_REQUEST['residence_country']; 
		$txn_id 	= $_REQUEST['txn_id'];
		$txn_type 	= $_REQUEST['txn_type']; 
		$payment_status = $_REQUEST['payer_status']; 
		$payment_type = $_REQUEST['payment_type']; 
		$payer_id 	= $_REQUEST['payer_id']; 
		$create_date = date('Y-m-d H:i:s');
		$payment_date = date('Y-m-d H:i:s');

		// first update ORDER NULL => 1 AND ALSO UPDATE TXN ID IN ORDER
		$fps = new _freelance_project_status;
		$fa  = new _freelance_account;

		// ======get current balance
		$result3 = $fa->readProBlnc($_SESSION['pid']);
		if ($result3) {
			$row3 = mysqli_fetch_assoc($result3);
			$blncOld = $row3['fa_current_amount'] + $amount;
		}else{
			$blncOld = $amount;
		}
		// ======end==============

		$result = $fps->readFreeCode($item_name);
		//echo $fps->ta->sql;
		if ($result){
			$row = mysqli_fetch_assoc($result);
			// update txn id
			$fps->updateTxn($item_name, $txn_id);

			// UPDATE FREELANCE ACCOUNT
			$data = array(
				"spUser_idspuser" => $_SESSION['uid'],
				"spProfile_idspProfile" => $_SESSION['pid'],
				"spPosting_idspPostings" => $item_name,
				"fa_debit" => $amount,
				"fa_current_amount" => $blncOld,
				"fa_status" => "Amount Add",
				"fa_date" => $payment_date,
				"txn_id" => $txn_id
			);
			$fa->transactionupdate($data);	
		}
	}else{
		$re = new _redirect;
		$redirctUrl= $BaseUrl."/freelancer/";
		$re->redirect($redirctUrl);
	}


	$activePage = 17;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
   		<?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	</head>
	<body  class="bg_gray">
		<?php
			$header_select = "freelancers";
			include_once("../../header.php");
		?>
		<section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    <?php include('left-menu.php');?>
                </div>
               	<div class="col-xs-12 col-sm-9 nopadding">
               		<?php include('top-banner-freelancer.php');?>
               		<div class="col-md-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              	<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
                              	<li>Success</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 nopadding">
                    	<div class="cartbox">
	                		<div class="cart_body text-center successBody">
	                			<i class="fa fa-check"></i>
	                			<h2>Payment has been Successful</h2>
	                			<p>Your Payment has been successfully Completed</p>
	                			
	                		</div>
	                	</div>
	                	<div class="space-lg"></div>
                    </div>
                    


                	
                </div>
            </div>
        </section>
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
	
	</body>
</html>
<?php
} ?>