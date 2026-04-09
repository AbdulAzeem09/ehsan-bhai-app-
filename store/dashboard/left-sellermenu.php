<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<style>
	.left_filter1 h1 a.sellerboard {
		color: #0f8f46 !important;
	}

	.left_filter1 h1 a.sellerboard {
		color: black !important;
		background-color: orange !important;
		padding: 2px 8px;
		border-radius: 2px;
	}

	.STP {
		color: #000 !important;
		background-color: orange !important;
		border-radius: 5px;
		text-align: center;
		margin-top: 5px;
	}
</style>
<div class="w-100">


	<div class="left_grid left_group_gray">


		<div class="left_store">
			<div class="left_filter1" style="border: none;">

				<h1><a href="<?php echo $BaseUrl . '/store'; ?>"><i class="fa fa-arrow-left"></i> Back To Store</a></h1>

				<h1><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></h1>

				<h1><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" class="sellerboard">Seller Dashboard</a>
					<!-- <a  id="seller_d" class="sellerboard">Seller Dashboard</a> -->
				</h1>
				<h1><a href="<?php echo $BaseUrl . '/post-ad/sell/?post'; ?>" class="sellerboard" style="padding-right: 75px;">Sell Now</a>
					<!-- <a  id="seller_d" class="sellerboard">Seller Dashboard</a> -->
				</h1>
				<div class="dashbids">
					<?php


					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					if ($currency) {
						$res1 = mysqli_fetch_assoc($currency);

						$curr = $res1['currency'];
					} else {
						$curr = "";
					}                                //$p = new _postingview;
					$p = new _productposting;

					$result = $p->myStoreProduct($_SESSION['pid']);
					//print_r($result);
					if ($result) {
						$count_1 = $result->num_rows;
					}
					?>

					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/active_product.php") ? 'activepage' : ''; ?>">
						<a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> All Listing &nbsp; (<?php if ($count_1 != 0) {
																																												echo $count_1;
																																											} else {
																																												echo '0';
																																											} ?>)</a>
					</li>

					<?php
					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					if ($currency) {
						$res1 = mysqli_fetch_assoc($currency);
						$curr = $res1['currency'];
					} else {
						$curr = "";
					}                                         //$p = new _postingview;
					$p = new _productposting;

					$result = $p->reatilactiveProduct($_SESSION['pid']);
					if ($result) {
						$retail = $result->num_rows;
					}
					$result_p = $p->reatilactiveProduct_Personal($_SESSION['pid']);
					if ($result_p) {
						$personal = $result_p->num_rows;
					}
					?>
					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/retailactive_product.php") ? 'activepage' : ''; ?>">
						<a href="<?php echo $BaseUrl . '/store/dashboard/retailactive_product.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Retail List &nbsp; (<?php if ($retail != 0) {
																																														echo $retail;
																																													} else {
																																														echo '0';
																																													} ?>)</a>
					</li>


					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/personalactive_product.php") ? 'activepage' : ''; ?>">
						<a href="<?php echo $BaseUrl . '/store/dashboard/personalactive_product.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Personal  List &nbsp; (<?php if ($personal != 0) {
																																														echo $personal;
																																													} else {
																																														echo '0';
																																													} ?>)</a>
					</li>

					<?php

					$n = new _notification;
					$to_id = $_SESSION['pid'];
					$module = 'store';
					$by_seller_or_buyer = 2;
					$resnoti = $n->readNotification($to_id, $module, $by_seller_or_buyer);
					if ($resnoti != false) {
						$noti = $resnoti->num_rows;
					}
					?>
					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_seller_notification.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/my_seller_notification.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Notification&nbsp;<?php echo '(' . $noti . ')'; ?></a></li>


					<?php
					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					//$p = new _postingview;
					$p = new _productposting;

					$result = $p->wholesaleactiveProduct($_SESSION['pid']);
					if ($result) {
						$wholesale = $result->num_rows;
					}
					?>


					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/wholesaleactive_product.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/wholesaleactive_product.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Wholesale List &nbsp;(<?php if ($wholesale != 0) {
																																																																													echo $wholesale;
																																																																												} else {
																																																																													echo '0';
																																																																												} ?>)</a></li>

					<?php

					$userid = $_SESSION['uid'];
					$c = new _orderSuccess;
					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					//$p = new _postingview;
					$p = new _productposting;

					$result = $p->auctionactiveProduct($_SESSION['pid']);
					$auc = 0;
					if ($result) {

						$auc = $result->num_rows;
					}
					?>
					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/auctionactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/auctionclose_product.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/auctionactive_product.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Auction List &nbsp;(<?php echo $auc; ?>)</a></li>
					<?php
					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					$p = new _productposting;
					$visilty = -2;
					$_GET['categoryID'] = 1;
					//$result = $p->myStoreProduct($_SESSION['pid']);
					$result = $p->myProductVis($_SESSION['pid'], $visilty, $_GET['categoryID']);
					$deact = 0;
					if ($result) {
						$deact = $result->num_rows;
					}
					?>
					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/deactive.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/deactive.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> De-Activated Products&nbsp;(<?php echo $deact; ?>)</a></li>
					<?php
					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					$p = new _productposting;
					$result = $p->readMyDraftprofile(1, $_SESSION['pid']);
					$draf = 0;
					if ($result) {
						$draf = $result->num_rows;
					}
					?>


					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-draft.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Draft&nbsp;(<?php echo $draf; ?>)</a></li>
					<?php

					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					$p = new _productposting;

					//$result = $p->myStoreProduct($_SESSION['pid']);
					$result = $p->myExpireProduct(1, $_SESSION['pid']);
					$exp = 0;
					if ($result != false) {
						$exp = $result->num_rows;
					}
					?>
					<!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/expire.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/expire.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Expired Products&nbsp;(<?php echo $exp; ?>)</a></li> -->
					<?php
					$en = new _sppostenquiry;
					$result = $en->getsellerEnquery($_SESSION['pid']);
					$enq = 0;
					if ($result) {
						$enq = $result->num_rows;
					}
					?>
					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-enquiry.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/my-enquiry.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Enquiry&nbsp;(<?php echo $enq; ?>)</a></li>

					<?php $p = new _spcustomers_basket;
					$result = $p->readseller($_SESSION['pid']);
					$new = 0;
					if ($result) {
						$new = $result->num_rows;
					}
					?>

					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/order_mang.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/add_ship.php?oid=" . $_GET['oid']  || $_SERVER['REQUEST_URI'] == "/store/dashboard/shiped_order.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/shiped_order.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/prepare_ship.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/delivered_order.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/order_mang.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> New Orders&nbsp;(<?php echo $new; ?>)</a></li>



					<!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/prepare_ship.php") ? 'activepage' : ''; ?>"><a  href="<?php echo $BaseUrl . '/store/dashboard/prepare_ship.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Prepare for Shipment</a></li> -->

					<!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/shiped_order.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/shiped_order.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Shipped Order</a></li> -->

					<!--     <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/delivered_order.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/delivered_order.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Delivered Order</a></li> -->
					<?php


					$userid = $_SESSION['uid'];


					$c = new _orderSuccess;


					$currency = $c->readcurrency($userid);
					$res1 = mysqli_fetch_assoc($currency);
					$curr = $res1['currency'];
					$r = new _rfq;
					$result = $r->readsubmittedRfqquote($_SESSION['pid']);
					$rfq = 0;
					if ($result) {
						$rfq = $result->num_rows;
					}

					$en = new _spquotation;
					$result1 = $en->getsellerquotation($_SESSION['pid']);
					$rfq1 = 0;
					if ($result1) {
						$rfq1 = $result1->num_rows;
					}
					$total_rfq = $rfq + $rfq1;
					?>

					<li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myprivate_rfq.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/myprivate_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> RFQ&nbsp;(<?php echo $total_rfq; ?>)</a></li>

					<!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myprivate_rfq.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/myprivate_rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Private RFQ</a></li>
                         
                           <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/quotesubmitted-rfq.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/quotesubmitted-rfq.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Public RFQ</a></li> -->

					<!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/requestforreturn.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/requestforreturn.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Get Request For Return Item</a></li>
				  
				  
				  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/cancel_items.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/cancel_items.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Cancel Products</a></li>-->

					<?php


					$p = new _store_problemwithorder;
					$result = $p->getMysellerproduct($_SESSION['pid']);


					$proble = 0;
					if ($result != false) {
						$proble = $result->num_rows;
					}

					?>
					<!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/sell_problemwithorder.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/sell_problemwithorder.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Problem With Order &nbsp;(<?php echo $proble; ?>)</a></li>

		 <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/products_option_name.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/products_option_name.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Product Options Name</a></li>-->

					<?php
					$ponv = new _spproductoptionsvalues;
					$resultdef = $ponv->read(0, 0);
					$pov = 0;
					if ($resultdef) {
						$pov = $resultdef->num_rows;
					}

					?>
					<?php if ($_SESSION['ptid'] == 1) {




$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);
if($result != false){

while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$payment_date = $rows["createdon"];
$duration=$rows['duration'];
 
$date7 =  date('Y-m-d H:i:s');
$date8=date('Y-m-d', strtotime($date7));
$date5= date('Y-m-d', strtotime($payment_date));	
$date6= date('Y-m-d', strtotime($payment_date. ' +'. $duration.' days'));


if(!(($date5 <= $date8)  && ($date6 >=  $date8))){ ?>
<style>
li.business-profile {
    display: none;
}

 </style>

<?php   
}
//}
}
}

else { ?>
<style>
li.business-profile {
    display: none;
}

 </style>
<?php  }








					?>
						<li  class="business-profile <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/products_option_value.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/products_option_value.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Product Options Value&nbsp;(<?php echo $pov; ?>)</a></li>

						<li class="business-profile <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/bulkimport.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/bulkimport.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Bulk Import</a></li>
						<?php
						$pf = new _productpic;
						// die("------------");
						$result = $pf->readbulk($_SESSION['pid'], $_SESSION['uid']);
						$img = 0;
						if ($result) {
							$img = $result->num_rows;
						}
						?>


						<li class="business-profile <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/image_file.php") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/image_file.php'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Upload Image&nbsp;(<?php echo $img ?>)</a></li>

						<?php

						$m = new _subcategory;
						$catid = 1;
						$result = $m->read($catid);
						$bulkim = 0;
						if ($result) {
							$bulkim = $result->num_rows;
						}

						?>
						<li class="business-profile <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/bulk_import_attr.php?action=category") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/bulk_import_attr.php?action=category'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Bulk Import Attribute&nbsp;(<?php echo $bulkim ?>)</a></li>

					<?php } ?>
					<?php if ($_SESSION['ptid'] == 1) { ?>


						<li class="business-profile"><a href="<?php echo $BaseUrl . '/store/pos-dashboard/index.php'; ?>" class="STP"><b style=" font-size: 20px;">Switch To POS</b></a></li>
					<?php } ?>

					<!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/POS_transations.php?action=category") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/POS_transations.php?action=category'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> POS Transactions</a></li>-->
					<!-- <li><i class="fa fa-caret-right" aria-hidden="true"></i>POS Transations(<?php  ?>)</li>-->

					<!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/mam_transactions.php?action=category") ? 'activepage' : ''; ?>"><a href="<?php echo $BaseUrl . '/store/dashboard/mam_transactions.php?action=category'; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Mambership Transactions</a></li>-->

				</div>

				<!--<h1><a href="<?php //echo $BaseUrl.'/store/dashboard/faq.php'; 
									?>">FAQ</a></h1>-->


			</div>
		</div>
	</div>

</div>
<script>
	/*$(document).ready(function(){
		$("#seller_d").click(function(){
			//alert('==');
			
			swal({
  title: "Do You Want to go Seller Dashboard?",
//text: "You Want to Logout!",
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes, Delete!",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
},
function(isConfirm) {
   window.location.replace('<?php echo $BaseUrl; ?>/store/dashboard/sell_dashboard.php');
});
		});	
		});	*/
</script>