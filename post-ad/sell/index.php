<?php
   include('../../univ/baseurl.php');
   session_start();
   //die('+++==========11'); 
   /*error_reporting(E_ALL);
   ini_set('display_errors', 'On');*/
   $postId = isset($_GET["postid"]) ? (int)$_GET["postid"] : 0;
   if (!isset($_SESSION['pid'])) {
   
   	$_SESSION['afterlogin'] = "store/";
   	include_once("../../authentication/islogin.php");
   } else {
   	function sp_autoloader($class)
   	{
   		include '../../mlayer/' . $class . '.class.php';
   	}
   	spl_autoload_register("sp_autoloader");
   	
   	
   	
   	
   
   	$re = new _redirect;
   	$p = new _productposting;
   /*
   if($_SESSION['ptid'] == 2 ||  $_SESSION['ptid'] == 5){
   $redirctUrl = $BaseUrl . "/store/storeindex.php";
   $_SESSION['count'] = 0;
   $_SESSION['msg'] = "Selling not allowed on this profile. Please switch to other one.";
   $re->redirect($redirctUrl);
   }
   */
   
   if (($_SESSION['ptid'] == 2) || ($_SESSION['ptid'] == 5) || ($_SESSION['ptid'] == 6)) {
   
   
   	header("Location: $BaseUrl/store/storeindex.php?folder=home");
   }
   
   $_GET["module"] = "1";
   $_GET["categoryid"] = "1";
   $_GET["profiletype"] = "1";
   $_GET["categoryname"] = "Sell";
   
   //echo "<pre>";
   //print_r($_SESSION); 
   
   if ($_SESSION['ptid'] == 1) {
   
   
   	$f = new _spuser;
   
   // $de = $f->de();
   // print_r($de);
   // die('xxxxx');
   // while ($row = mysqli_fetch_assoc($de)) {
   // 	print_r($row);
   
   // }
   
   
   	$fil = $f->read1($_SESSION['pid']);
   //print_r($fil);die("================");
   	if ($fil) {
   		$r = mysqli_fetch_assoc($fil);
   //print_r($r); die("-----------------"); 
   		$pid = $r['sp_pid'];
   //echo $pid;die('====');
   		if ($r['status'] != 2) {
   			 header("Location: $BaseUrl/store/dashboard/?msg=notverified");
   		}
   	} else {
   		header("Location: $BaseUrl/store/dashboard/?msg=notverified");
   	}
   }
   
   $u = new _spuser;
   $res = $u->read($_SESSION["uid"]);
   if ($res != false) {
   	$ruser = mysqli_fetch_assoc($res);
   	$usercountry = $ruser["spUserCountry"];
   	$userstate = $ruser["spUserState"];
   	$usercity = $ruser["spUserCity"];
   }
   // THIS IS POSTING DETAIL 
   
   $profileid = "";
   $eCountry = "";
   $eCity = "";
   $eCityID = "";
   $eCategory = "";
   $eSubCategoryID = "";
   $eSubCategory = "";
   $ePostTitle = "";
   $ePostNotes = "";
   $eExDt = "";
   $ePrice = "";
   $shipping = "";
   $visibility = "";
   
   if ($postId) {
   
   	$r = $p->read($postId);
   //echo $p->ta->sql;
   	if ($r != false) {
   		while ($row = mysqli_fetch_assoc($r)) {
   // print_r($row);
   //die('=====');
   			$ePostTitle     = $row["spPostingTitle"];
   			$ePostNotes     = $row["spPostingNotes"];
   			$specification   = $row["specification"];
   			$description     = $row["description"];
   			$eExDt          = $row["spPostingExpDt"];
   			$ePostDate      = $row['spPostingDate'];
   			$ePrice         = $row["spPostingPrice"];
   			$profileid      = $row['spProfiles_idspProfiles'];
   			$postingflag    = $row['spPostingsFlag'];
   
   			$category    = $row['subcategory'];
   			$barcode    = $row['barcode'];
   
   
   			$quantitytype = $row['quantitytype'];
   //$phone = $row['spPostingPhone'];
   			$shipping       = $row['sppostingShippingCharge'];
   			$eCountry       = $row['spPostingsCountry'];
   			$eCity          = $row['spPostingsCity'];
   			$visibility     = $row['spPostingVisibility'];
   		}
   	}
   
   	$po = new _productposting;
   
   	$result_fel = $po->read($postId);
   //echo $po->ta->sql;
   	$ItemCondition = '';
   	$ExpiryDate = '';
   
   
   
   	if ($result_fel != false) {
   		while ($row_fel = mysqli_fetch_assoc($result_fel)) {
   
   
   			$auctionStatus = $row_fel['auctionStatus'];
   
   			$spOrderQty_11    = $row_fel['spOrderQty'];
   			$wholesaleQuantity    = $row_fel['wholesaleQuantity'];
   
   
   			$selltype = $row_fel['sellType'];
   
   			$retailQuantity = $row_fel['retailQuantity'];
   			$retailSpecDiscount = $row_fel['retailSpecDiscount'];
   			$retailDiscount = $row_fel['retailDiscount'];
   			$retailStatus = $row_fel['retailStatus'];
   			$producttype = $row_fel['product_type'];
   
   
   			if ($selltype == "Auction") {
   
   				$Quantity = $row_fel['auctionQuantity'];
   			} elseif ($selltype == "Retail") {
   
   				$Quantity = $row_fel['retailQuantity'];
   			} elseif ($selltype == "Wholesale") {
   
   				$Quantity = $row_fel['supplyability'];
   			}
   
   			if ($selltype == "Auction") {
   
   				$ItemCondition = $row_fel['auctionStatus'];
   			} elseif ($selltype == "Retail") {
   
   				$ItemCondition = $row_fel['retailStatus'];
   			}
   
   			$price = $row_fel['spPostingPrice'];
   
   			if ($selltype == "Auction") {
   
   				$ExpiryDate = $row_fel['spPostingExpDt'];
   			} elseif ($selltype == "Retail") {
   
   				$ExpiryDate = $row_fel['spPostingExpDt'];
   			}
   
   
   
   			$minorderqty = $row_fel['minorderqty'];
   			$supplyability = $row_fel['supplyability'];
   			$paymentterm = $row_fel['paymentterm'];
   			$industryType = $row_fel['industryType'];
   			$sippingcharge = $row_fel['sippingcharge'];
   			$spselectemail = $row_fel['spPostingEmail'];
   			$spselectphone = $row_fel['spPostingPhone'];
   
   			$fixedamount = $row_fel['fixedamount'];
   			$weight_shipping = $row_fel['weight_shipping'];
   			$height_shipping = $row_fel['height_shipping'];
   			$depth_shipping = $row_fel['depth_shipping'];
   			$width_shipping = $row_fel['width_shipping'];
   
   /*   $cancel= $row_fel['is_cancel'];
   $refund= $row_fel['is_refund'];
   $refundwithin= $row_fel['refund_within'];*/
   }
   }
   
   
   
   $or = new _order;
   $total = 0;
   $res = $or->quantityavailable($postId);
   if ($res != false) {
   	while ($order = mysqli_fetch_assoc($res)) {
   		if ($order["spOrderStatus"] == 0) {
   			$soldquantity += $order["spOrderQty"];
   		}
   	}
   }
   
   if (isset($soldquantity)) {
   	$available = $totalquantity - $soldquantity;
   } else {
   	$available = 0;
   }
   }
   $p = new _spprofiles;
   $res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
   
   if ($res != false) {
   	$r = mysqli_fetch_assoc($res);
   	$profileid = $r['idspProfiles'];
   	$country = $r["spProfilesCountry"];
   	$city = $r["spProfilesCity"];
   }
   if ($postId) {
   	$p1 = new _productposting;
   
   	$res = $p1->read($postId);
   	$cp = $res->num_rows;
   //var_dump($cp);die;
   //echo $cp;
   //die("ssss");
   	if ($cp == false) {
   
   		header("Location: $BaseUrl/store/dashboard/active_product.php?msg=notacess");
   	}
   
   	if ($res != false) {
   		while ($row = mysqli_fetch_assoc($res)) {
   			$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];
   
   			if ($_SESSION['pid'] != $spProfiles_idspProfiles) {
   
   				header("Location: $BaseUrl/store/dashboard/active_product.php?msg=notacess");
   			}
   		}
   	}
   }
   /*
   $objpost = new _postenquiry;
   $result = $objpost->readpost($_SESSION['uid']);
   if($result !=false){
   while($row=mysqli_fetch_assoc($result)){
   $result4=$row['sp_pid'];
   $result5=$row['spProfileType_idspProfileType'];
   //print_r($row);
   //die('kkkkkk');
   
   
   
   
   
   
   
   
   
   
   
   
   
   $objpr=new _postenquiry;
   $result98=$objpr->read98($result4);
   $row98=mysqli_fetch_assoc($result98);
   //echo $row98['spProfileEmail'];
   //die('kkkkkk');
   
   
   
   
   //$result99=$objpr->read99($result5);
   //$row99=mysqli_fetch_assoc($result99);
   //print_r($row99);
   //die('mmmm');
   
   
   if($row['status'] != 2){
   
   //die('kkkkkkk');
   //header("Location: $BaseUrl/store/storeindex.php?msg=notverified");
   //header("location:posting.php");
   }
   }	
   }else{
   //die('kkkk555kkk');
   header("Location: $BaseUrl/store/storeindex.php?msg=notverified");
   
   }
   */
   //echo $_GET["groupid"]."jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
   
   ?>
<?php
   if ($_SESSION['ptid'] == 1) {
   
   
   	if (!$postId) {
   //	if(($final_date >= 90) ){ 
   
   		$mb = new _spmembership;
   		$result = $mb->readpid($_SESSION['pid']);
   		if ($result != false) {
   
   			while ($rows = mysqli_fetch_assoc($result)) {
   //print_r($rows);
   				$payment_date = $rows["createdon"];
   				$duration = $rows['duration'];
   
   /*$res = $mb->readmember($rows["membership_id"]);
   if($res != false)
   { 
   $row = mysqli_fetch_assoc($res);
   //echo $row["spMembershipName"]."<br>";
   //$count=$row["spMembershipPostlimit"]; 
   $duration=$row["duration"];*/
   
   //print_r($row);
   $date7 =  date('Y-m-d H:i:s');
   $date8 = date('Y-m-d', strtotime($date7));
   $date5 = date('Y-m-d', strtotime($payment_date));
   $date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
   //echo  $date5."<br>".$date6."<br>".$date8; die;
   if (!(($date5 <= $date8)  && ($date6 >=  $date8))) { ?>
<script>
   // alert('eeeeeee');
   // window.location.replace("/membership?msg=notaccess");
   	
</script>
<?php
   }
   //}
   }
   } else {
   
   	$mb = new _spmembership;
   	$result_1 = $mb->read_data($_SESSION['pid']);
   	$num = 0;
   	if ($result_1) {
   		$num = mysqli_num_rows($result_1);
   	}
   
   	if ($num >= 2) {
   
   
   // $fr= new _spuser;
   // $readsp= $fr->readdataSp($_SESSION['pid']);
   // if($readsp!=false){
   // $rowsp=mysqli_fetch_assoc($readsp);
   //   $post_pay =$rowsp['post_pay'];
   //   $pidAdd =$rowsp['idspProfiles'];
   
   // }
   // if ($post_pay <= 0) {
   
   		?>
<script>
   window.location.replace("/membership?msg=notaccess");
</script>
<?php
   // }
   	}
   }
   //	}
   
   
   
   }
   }
   ?>
<style>	
   #sppreviewSaveDraftStore {
   padding-bottom: 5px !important;
   }
   .alert.alert-danger.error_show {
   display: none;
   }
   #postingtype {
   padding-bottom: 5px !important;
   }
   a:focus,
   a:hover {
   color: #09200a !important;
   text-decoration: underline;
   }
</style>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="The SharePage">
      <title>The SharePage</title>
      <link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
      <link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">
      <!--Bootstrap core css-->
      <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <!--Font awesome core css-->
      <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!--custom css jis ki wja say issue ho rha tha form submit main-->
      <!-- Bootstrap Color Picker -->
      <link href="<?php echo $BaseUrl;  ?>/assets/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" />
      <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
      <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
      <!-- PAGE SCRIPT -->
      <script src="<?php echo $BaseUrl; ?>/assets/js/posting/store.js?v=4"></script>
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
      <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
      <!-- DATE AND TIME PICKER -->
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
      <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
      <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
      <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
      <!--post group button on btm of the form-->
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
      <!--NOTIFICATION-->
      <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
      <!-- add crop image fils -->
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/cropimage/cropper.css">
      <script src="<?php echo $BaseUrl; ?>/assets/js/cropimage/dropzone.js"></script>
      <script src="<?php echo $BaseUrl; ?>/assets/js/cropimage/cropper.js"></script>
      <!-- end -->
      <script>
         function numericFilter(txb) {
         	txb.value = txb.value.replace(/[^\0-9]/ig, "");
         }
      </script>
      <script type="text/javascript">
         $(function() {
         	$('#sppostingShippingCharge').keypress(function(event) {
         		if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
         	event.preventDefault(); //stop character from entering input
         	}
         	});
         });
      </script>
      <?php
         $urlCustomCss = $BaseUrl . '/component/custom.css.php';
         include $urlCustomCss;
         ?>
      <link href="<?php echo $BaseUrl; ?>/assets/css/design.css" rel="stylesheet" type="text/css">
      <style type="text/css" media="screen">
         /* add crop image css */
         .image_area {
         position: relative;
         }
         img {
         display: block;
         max-width: 100%;
         }
         .preview {
         overflow: hidden;
         width: 160px; 
         height: 160px;
         margin: 10px;
         border: 1px solid red;
         }
         .modal-lg{
         max-width: 1000px !important;
         }
         .overlay {
         position: absolute;
         bottom: 10px;
         left: 0;
         right: 0;
         background-color: rgba(255, 255, 255, 0.5);
         overflow: hidden;
         height: 0;
         transition: .5s ease;
         width: 100%;
         }
         .image_area:hover .overlay {
         height: 50%;
         cursor: pointer;
         }
         .text {
         color: #333;
         font-size: 20px;
         position: absolute;
         top: 50%;
         left: 50%;
         -webkit-transform: translate(-50%, -50%);
         -ms-transform: translate(-50%, -50%);
         transform: translate(-50%, -50%);
         text-align: center;
         }
         /* emd */
         .btn:focus {
         ouline: 0px;
         body {
         font-family: "Open Sans";
         }
         }
         #wrapper {
         display: inline;
         }
         #wrapper1 {
         display: inline;
         }
         .inner_top_form button {
         padding: 9px !important;
         }
      </style>
   </head>
   <body onload="pageOnload('post')">
      <?php
         $header_store = "header_store";
         include_once("../../header.php");
         
         
         $p = new _spprofiles;
         
         $res = $p->read($_SESSION['pid']);
         if ($res != false) {
         
         	$r = mysqli_fetch_assoc($res);
         //echo "<pre>";
         //print_r($_SESSION['ptid']);
         //print_r($r); die("-----------");
         	$name = ucwords(strtolower($r['spProfileName']));
         	$icon = $r['spprofiletypeicon'];
         	$spProfileType_idspProfileType = $r['spProfileType_idspProfileType'];
         	$spdate_created = $r['spdate_created'];
         	$Date =  $spdate_created;
         	$date1 =  strtotime($Date);
         
         	$date2 =  date('Y-m-d H:i:s');
         	$date3 = strtotime($date2);
         //echo $date1."<br>".$date3; 
         
         
         
         	$datediff = $date3  -  $date1;
         //echo "<br>";
         	$final_date = round($datediff / (60 * 60 * 24));
         } else {
         
         	$name = "Select Profile";
         	$icon = "<i class='fa fa-user'></i>";
         }
         $resultOfProfile  = $p->read($_SESSION["pid"]);
         if ($resultOfProfile != false) {
         	$sprows = mysqli_fetch_assoc($resultOfProfile);
         	$profileType = $sprows["spProfileType_idspProfileType"];
         }
         
         
         
         ?>
      <style>
         #car1 {
         margin-top: 10px;
         }
      </style>
      <div class="loadbox">
         <div class="loader"></div>
      </div>
      <section>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 no-padding hidden-xs">
                  <div class="left_saa">
                     <img src="<?php echo $BaseUrl; ?>/assets/images/submit-add/l-sadd.jpg" class="img-responsive" alt="" />
                  </div>
               </div>
               <div class="col-md-9 col-xs-12">
                  <input type="hidden" class="form-control" id="spPostingExpDt_old" name="spPostingExpDt_old" value="<?php echo $eExDt; ?>">
                  <div class="row">
                     <div class="col-md-12">
                        <form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostproduct.php" method="post" id="sp-form-post" name="postform">
                           <div class="modTitle" style="padding-left: 15px;">
                              <h2><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color: #337ab7!important;font-size:12.5px"><span>RETURN TO STORE</span></a></h2>
                           </div>
                           <div class="add_form bradius-15" style="border-radius: 20px;border-top-left-radius: 20px;border-top-right-radius: 20px; ">
                              <?php
                                 if ($postId > 0) {
                                 	if ($visibility == 0) {
                                 		$lblpage = "This is a draft posting";
                                 	} else if ($visibility == -2) {
                                 		$lblpage = "De-Activate Product";
                                 	} else if (isset($_GET['exp']) && $_GET['exp'] == 1) {
                                 		$lblpage = "Expird Post";
                                 	} else {
                                 		$lblpage = "Update post";
                                 	}
                                 } else {
                                 //$lblpage = "SUBMIT AN AD";
                                 	$lblpage = "SELL YOUR ITEMS";
                                 }
                                 ?>
                              <h3 style="border-top-left-radius: 20px!important;border-top-right-radius: 20px!important;font-size: 20px;background-color: #cef5cf!important;"><i class="fa fa-pencil"></i> <b><?php echo $lblpage; ?></b> <a href="<?php echo $BaseUrl . '/store/dashboard'; ?>" class="pull-right stordashclr" style="color: #0a160a;;"><i class="fa fa-dashboard"></i> Dashboard</a></h3>
                              <div class="add_form_body">
                                 <?php if ($profileType == '2' || $profileType == '5') {
                                    echo "Please choose other profile for selling products.";
                                    exit;
                                    } ?>
                                 <div class="">
                                    <div class="">
                                       <div style="padding-bottom: 0px;padding-top: 11px;">
                                          <div class="row no-margin">
                                             <div class="col-md-3 no-padding">
                                             </div>
                                             <div class="col-md-6 col-xs-12 ">
                                                <?php
                                                   echo "<input type='hidden' id='postprofile' value='" . $profileid . "'>";
                                                   
                                                   ?>
                                                <div class="addcustomsell ">
                                                   <div class="form-group">
                                                      <div class="sell_rad" style="padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px; <?php if ($postId) {
                                                         echo "text-align: center;";
                                                         } ?>">
                                                         <?php if ($postId) { ?>
                                                         <label for="sellType_" class="">Selected Sell Type :&nbsp;</label>
                                                         <label><?php echo $selltype; ?></label>
                                                         <input type="hidden" id="sellType_" name="sellType" value="<?php echo $selltype; ?>">
                                                         <?php } else { ?>
                                                         <label for="sellType_" class="">Select Sell Type :&nbsp;</label>
                                                         <select class="form-control spPostField" data-filter="1" name="sellType" id="sellType_" style="width: 133px;display: inline;border-radius: 17px;border: 2px solid #5cb85c;" <?php if (!empty($selltype)) {
                                                            echo "disabled";
                                                            } ?>>
                                                            <option value="0">Select Type</option>
                                                            <?php
                                                               if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 3) { ?>
                                                            <option value="Auction" <?php if ($selltype == "Auction") {
                                                               echo "selected";
                                                               } ?>>Auction</option>
                                                            <option value="Retail" <?php if ($selltype == "Retail") {
                                                               echo "selected";
                                                               } ?>>Retail</option>
                                                            <option value="Wholesale" <?php if ($selltype == "Wholesale") {
                                                               echo "selected";
                                                               } ?>>Wholesale</option>
                                                            <?php } else { ?>
                                                            <option value="Personal" <?php if ($selltype == "Personal") {
                                                               echo "selected";
                                                               } ?>>Personal</option>
                                                            <option value="Auction" <?php if ($selltype == "Auction") {
                                                               echo "selected";
                                                               } ?>>Auction</option>
                                                            <?php } ?>
                                                         </select>
                                                         <?php } ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-3 col-xs-12" style="padding-top: 10px;">
                                                <div class="dropdown profilecentr pull-right <?php echo ($postId) ? 'hidden' : ''; ?>">
                                                </div>
                                                <?php if ($postId) { ?>
                                                <h5 style="float: right;"> Product Id : <?php echo $postId; ?></h5>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="space"></div>
                                       <?php if ($postId) { ?>
                                       <div id="sell_frm">
                                          <?php  } else { ?>
                                          <div id="sell_frm" style="display:none;">
                                             <?php  } ?>
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <input type="hidden" id="postid" value="<?php echo $postId; ?>">
                                                   <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
                                                   <input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
                                                   <input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">
                                                   <input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
                                                   <?php
                                                      $userid = $_SESSION['uid'];
                                                      //$profid=$_SESSION['pid'];
                                                      $c = new _spuser;
                                                      $currency = $c->getcurrency($userid);
                                                      if ($currency) {
                                                      	$res = mysqli_fetch_assoc($currency);
                                                      	$curre = $res['currency'];
                                                      }
                                                      ?>
                                                   <!--<div class="form-group">
                                                      <!--<label for="default-currency" >Default Currency<span>* <span class="lbl_1"></span></span></label>
                                                      <label for="spPostingTitle" >Currency <span>* <span class="lbl_1"></span></span></label>
                                                      
                                                      
                                                      </div>-->
                                                   <input type="hidden" class="form-control" readonly id="default_currency" name="default_currency" value="<?php echo $curre; ?>" placeholder="" required />
                                                   <input id='idspPostings' name='idspPostings' value="<?php echo $postId; ?>" type='hidden'>
                                                   <div class="row no-margin">
                                                      <div id="invalid"></div>
                                                      <div class="col-md-12 no-padding">
                                                         <div class="form-group">
                                                            <label for="spPostingTitle">Title <span>* <span class="lbl_1"></span></span></label>
                                                            <input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" maxlength="40" value="<?php echo $ePostTitle ?>" placeholder="" required />
                                                         </div>
                                                         <div class="">
                                                            <?php
                                                               if ($eExDt) {
                                                               //echo $eExDt; die("----");
                                                               	$todayDate = date("Y-m-d");
                                                               	$dateExp = date('Y-m-d', strtotime($eExDt));
                                                               	if ($todayDate > $dateExp) {
                                                               		$expDate = date('Y-m-d', strtotime("+90 days"));
                                                               	} else {
                                                               		$expDate = $dateExp;
                                                               	}
                                                               //echo date('Y-m-d', strtotime($eExDt));
                                                               } else {
                                                               	$expDate = date('Y-m-d', strtotime("+90 days"));
                                                               }
                                                               
                                                               //echo $expDate; die("----");
                                                               ?>
                                                            <input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo $expDate; ?>">
                                                         </div>
                                                         <div class="addcustomfields row">
                                                            <!--add custom fields-->
                                                            <?php
                                                               include("../sell.php");
                                                               //include("../auction.php");
                                                               
                                                               ?>
                                                            <!--Getcustomfield-->
                                                         </div>
                                                         <?php include("../variants.php"); ?>
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="specification">Specification<span>* <span class="lbl_55"></span></span></label>
                                                         <textarea class="form-control" maxlength="500" id="specification" name="specification" required><?php if (!empty($specification)) {
                                                            echo $specification;
                                                            }  ?> </textarea>
                                                      </div>
                                                      <div class="form-group">
                                                         <label for="specification">Description<span>* <span class="lbl_99"></span></span></label>
                                                         <textarea class="form-control" maxlength="500" id="description" name="description" required><?php if (!empty($description)) {
                                                            echo $description;
                                                            }  ?> </textarea>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <div class="form-group">
                                                         <label class="lbl_7a">Shipping Charge</label> <br>
                                                         <label class="radio-inline">
                                                            <input checked="checked" type="radio" id="forfreeshipping" name="sippingcharge" <?php if ($sippingcharge  == 1) {
                                                               echo 'checked="checked"';
                                                               } ?> value="1">Free
                                                            <!-- 1 for Art -->
                                                         </label>
                                                         <label class="radio-inline">
                                                            <input type="radio" id="forfixedamountshipping" name="sippingcharge" <?php if ($sippingcharge == 2) {
                                                               echo 'checked="checked"';
                                                               } ?> value="2">Fixed Amount
                                                            <?php
                                                               ?>
                                                            <!-- 2 for Craft -->
                                                         </label>
                                                         <br>
                                                         <!--label class="radio-inline" style=" margin-left: 0px; ">
                                                            <input type="radio" id="forpercompanyahipping" name="sippingcharge" <?php if ($sippingcharge == 3) {
                                                               echo 'checked="checked"';
                                                               } ?>  value="3">Per Shipping Company
                                                            < 3 for Craft >
                                                            </label -->
                                                      </div>
                                                   </div>
                                                   <div class="col-md-3" id="bar_c">
                                                      <div class="form-group">
                                                         <label class="lbl_7a">Barcode<span>* <span class="lbl_77"></span></span></label> <br>
                                                         <input class="form-control" value="<?php echo $barcode; ?>" type="text" id="barcode" name="barcode">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-9" id="forhideandshowshippingforbhak" <?php if ($sippingcharge == 1 || $sippingcharge == "") {
                                                      echo "style='display: none;'";
                                                      } ?>>
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <label for="" class="">Add Fixed Amount</label>
                                                            <div class="form-group">
                                                               <div id="ifYes">
                                                                  <input style=" width: 100px;margin: left 15px; " onkeyup="numericFilter(this);" type="text" class="form-control" name="fixedamount" value="<?php echo $fixedamount; ?>" placeholder="" required />
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <!-- <div class="col-md-9" id="forhideandshowshipping">
                                                      <div class="row">
                                                      <div class="col-md-6">
                                                      
                                                      <label for="" class="">Add Weight And Size For Shipping</label>
                                                      
                                                      <div class="row">
                                                      <div class="col-md-6">
                                                      
                                                      <div class="form-group">
                                                      <div id="ifYes">
                                                      <label for="quantity_" class="lbl_8">Weight(G) </label>
                                                      <input onkeyup="numericFilter(this);" type="text" class="form-control" name="weight_shipping" value="<?php echo $weight_shipping; ?>" placeholder="" required />
                                                      </div>
                                                      </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                      <div class="form-group">
                                                      <div id="ifYes">
                                                      <label for="quantity_" class="lbl_8">Width </label>
                                                      <input onkeyup="numericFilter(this);" type="text" class="form-control" name="width_shipping" value="<?php echo $width_shipping; ?>" placeholder="" required />
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      
                                                      <div class="col-md-3" style=" margin-top: 19px; ">
                                                      <div class="form-group">
                                                      <div id="ifYes">
                                                      <label for="quantity_" class="lbl_8">Height </label>
                                                      <input onkeyup="numericFilter(this);" type="text" class="form-control" name="height_shipping" value="<?php echo $height_shipping; ?>" placeholder="" required />
                                                      </div>
                                                      </div>
                                                      </div>
                                                      
                                                      <div class="col-md-3" style=" margin-top: 19px; ">
                                                      <div class="form-group">
                                                      <div id="ifYes">
                                                      <label for="quantity_" class="lbl_8">Depth </label>
                                                      <input onkeyup="numericFilter(this);" type="text" class="form-control" name="depth_shipping" value="<?php echo $depth_shipping; ?>" placeholder="" required />
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div>
                                                      </div><br><br><br><br><br></br><br>
                                                      <div class="form-group">
                                                      <label for="spPostingNotes" class="pull-left">Description</label>
                                                      <textarea class="form-control" maxlength="500" id="spPostingNotes" name="spPostingNotes" required><?php if (!empty($ePostNotes)) {
                                                         echo $ePostNotes;
                                                         }  ?> </textarea>
                                                      </div> -->
                                                </div>
                                             </div>
                                             <!-- featureimage -->
                                             <div style="padding: 15px;">
                                                <!--Testing Complete-->
                                                <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                   <div class="col-md-3">
                                                      <div class="form-group">
                                                         <label for="featurepic">Add Feature Image <span class="lbl_15">*</span></label>
                                                         <input type="file" class="featurepic setvaluue" name="spPostingPic" id="filesaaa"  accept="image/*">
                                                         <input type="hidden"  style="display:none;" class="featuredImageCrop" name="featuredImageCrop">
                                                         <p class="help-block"><small>Browse files from your device</small></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-9">
                                                      <div class="form-group">
                                                         <label for="featurePicPreview">Picture Preview</label>
                                                         <div id="imagePreview"></div>
                                                         <div id="featurePicPreview">
                                                            <div class="row">
                                                               <div id="fePreview">
                                                                  <?php
                                                                     $i = 1;
                                                                     $pic = new _productpic;
                                                                     if ($postId) {
                                                                     	$res = $pic->read_0($postId);
                                                                     //print_r($res);
                                                                     	if ($res != false) {
                                                                     		while ($rows = mysqli_fetch_assoc($res)) {
                                                                     			$picture = $rows['spPostingPic'];
                                                                     			if ($rows['spFeatureimg'] == 0) {
                                                                     				$select = "checked";
                                                                     			} else {
                                                                     				$select = '';
                                                                     			}
                                                                     
                                                                     
                                                                     			if ($i == 1) {
                                                                     
                                                                     				echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'  data-work='store' data-aws='2' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage'  data-name='fi_" . $i . "' src='" . ($picture) . "' style='width: 119%!important;'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $postId . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
                                                                     			}
                                                                     //$i++;
                                                                     		}
                                                                     	}
                                                                     }
                                                                     
                                                                     ?>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo (isset($visibility) ? $visibility : "-1"); ?>">
                                             <!--Testing-->
                                             <div style="padding: 15px;">
                                                <!--Testing Complete-->
                                                <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                   <div class="col-md-3">
                                                      <div class="form-group">
                                                         <label for="postingpic">Add Sample Images</label>
                                                         <input type="file" class="postingpic" name="spPostingPic[]" id="filesaaa1" accept="image/*" multiple="multiple">
                                                         <p class="help-block"><small>Browse files from your device</small></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-9">
                                                      <div class="form-group">
                                                         <label for="postingPicPreview">Picture Preview</label>
                                                         <div id="imagePreview"></div>
                                                         <div id="postingPicPreview">
                                                            <div class="row">
                                                               <div id="dvPreview">
                                                                  <?php
                                                                     $i = 1;
                                                                     $pic = new _productpic;
                                                                     if ($postId) {
                                                                     	$res1 = $pic->read_1($postId);
                                                                     //print_r($res1);
                                                                     	if ($res1 != false) {
                                                                     		while ($rows = mysqli_fetch_assoc($res1)) {
                                                                     
                                                                     
                                                                     			if ($rows['spFeatureimg'] == 1) {
                                                                     				$picture = $rows['spPostingPic'];
                                                                     				$select = "checked";
                                                                     			} else {
                                                                     				$picture = "";
                                                                     				$select = '';
                                                                     			}
                                                                     
                                                                     
                                                                     
                                                                     			if ($i == 1) {
                                                                     				echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'  data-work='store' data-aws='2' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage'  data-name='fi_" . $i . "' src='" . ($picture) . "' style='width: 119%!important;'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $postId . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
                                                                     //$i++;
                                                                     			}
                                                                     
                                                                     
                                                                     
                                                                     //$i++;
                                                                     		}
                                                                     	}
                                                                     }
                                                                     
                                                                     ?>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!--checking-->
                                             <div class="row" style="padding: 15px;">
                                                <div class="col-md-6">
                                                </div>
                                             </div>
                                             <!--complete-->
                                             <div class="row" style="padding: 15px;">
                                                <div class="col-md-4 ">
                                                   <div class="form-group">
                                                      <label for="email">Contact By</label>
                                                      <div class="radio form-control no-margin" id="contatcby">
                                                         <label class="checkbox-inline">
                                                         <input type="checkbox" id="spPostingEmail" name="spPostingEmail" <?php if ($spselectemail == 1) {
                                                            echo 'checked="checked"';
                                                            } ?> value="1"> Email
                                                         </label>
                                                         <label class="checkbox-inline">
                                                         <input type="checkbox" id="spPostingPhone" name="spPostingPhone" <?php if ($spselectphone == 1) {
                                                            echo 'checked="checked"';
                                                            } ?> value="0"> Phone
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php if ($postId) { ?>
                                             <div class="row" id="bootomsellfrm">
                                                <?php  } else { ?>
                                                <div class="row">
                                                   <div class="col-md-4">
                                                      <div id="sp-group-container" class="input-group hidden">
                                                         <input class="form-control publicbtn" id='group_' name="group" type="text" placeholder="Type to Select Group...">
                                                         <span class="input-group-btn">
                                                         <a href="../../my-groups/" class="btn btn-default publicbtn_drpdown" type="button">Add New</a>
                                                         </span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row" id="bootomsellfrm" style="padding: 15px; display:none;">
                                                   <?php  } ?>
                                                   <div class="col-md-3 col-xs-12">
                                                      <div class="btn-group">
                                                      <?php if (!isset($_SESSION['sign-up']) && $_SESSION['sign-up'] != 1) { ?>
                                                         <button id="postingtype" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="button" class="btn btn-safe  <?php echo (isset($_GET["groupflag"]) ? "hidden" : "btn-border-radius ") ?>">Public &nbsp;<span class="caret"></span></button>
                                                         <!--  <button type="button" style="padding-bottom: 21px;" class="btn  btn-success dropdown-toggle publicbtn_drpdown yle<?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>"  style="height: 34px;"></button>-->
                                                         <ul class="dropdown-menu posttype" style="    border-radius: 15px!important;">
                                                            <li><a id="postpublic" style="cursor:pointer;" class="publicselect">Public</a></li>
                                                            <li><a id="postgroup" style="cursor:pointer;" class="publicselect">Group</a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                   <?php } ?>
                                                   <div class="col-md-8  col-xs-12">
                                                      <?php
                                                         if ($postId && $postId > 0) {
                                                         
                                                         	if ($visibility == 1) {
                                                         		?>
                                                         		<?php if (!isset($_SESSION['sign-up']) && $_SESSION['sign-up'] != 1) { ?>
                                                      <button id="spPostSubmitStorepublish" type="button" class="btn-border-radius btn btn-safe bradius-20 <?php echo ($postId ? "editing" : ""); ?>" style="margin-left: -97px; ">Publish</button>
                                                      <button id="spprevieweditSaveDraftStore" type="button" class="btn btn-change btn-border-radius <?php echo ($postId ? "editing" : ""); ?>">Save Draft</button>
                                                      <button id="sppreviewSaveDraftStore" type="button" class="btn btn-misc" style="border-radius: 20px;"> Preview</button>
                                                      <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php/'; ?>" class="btn btn-red btn-border-radius">Cancel Post</a><?php } ?>
                                                      <?php
                                                         } else if ($visibility == -2) {
                                                         	?>
                                                         	<?php if (!isset($_SESSION['sign-up']) && $_SESSION['sign-up'] != 1) { ?>
                                                      <button id="spPostSubmitStore" type="button" class="btn btn-safe btn-border-radius">Upadate & Activate Product</button>
                                                      <a href="<?php echo $BaseUrl . '/store/dashboard/deactive.php/'; ?>" class="btn btn-red btn butn_cancel bradius-20">Cancel Post</a>
                                                      <button id="spPostSaveStore" type="button" class="btn btn-safe btn-border-radius bradius-20 <?php echo ($postId ? "editing" : ""); ?>">Update</button>&nbsp;&nbsp;&nbsp;
                                                      <?php } ?>
                                                      <?php
                                                         } else if (isset($_GET['exp']) && $_GET['exp'] == 1) {
                                                         
                                                         	?>
                                                      <button id="spPostSubmitStore" type="button" class="btn-border-radius btn btn-submit bradius-20 <?php echo ($postId ? "editing" : ""); ?>">Repost</button>
                                                      <a href="<?php echo $BaseUrl . '/store/dashboard/expire.php/'; ?>" class="btn butn_cancel btn-border-radius">Cancel Post</a>
                                                      <button id="spPostSaveStore" type="button" class="btn-border-radius btn btn-submit bradius-20 <?php echo ($postId ? "editing" : ""); ?>">Update</button>&nbsp;&nbsp;&nbsp;
                                                      <?php
                                                         } else {
                                                         	if ($visibility == 0) {
                                                         
                                                         		?>
                                                      <button id="spPostSubmitStore" type="button" class="btn btn-safe btn-border-radius bradius-20 <?php echo ($postId ? "editing" : ""); ?>">Publish</button>&nbsp;&nbsp;&nbsp;
                                                      <button id="spPostSaveStore" type="button" class="btn-border-radius btn btn-safe bradius-20 <?php echo ($postId ? "editing" : ""); ?>">Update</button>&nbsp;&nbsp;&nbsp;
                                                      <?php  } else { ?>
                                                      <!-- <button id="" type="button" class="btn btn-submit bradius-20 <?php echo (isset($postId) ? "editing" : ""); ?>" style="border-radius: 20px;">Update</button>&nbsp;&nbsp;&nbsp; -->
                                                      <?php  }
                                                         ?>
                                                      <?php
                                                         if ($visibility == -1) { ?>
                                                      <button id="spSaveDeactiveStore" type="button" class="btn btn-change btn-border-radius bradius-20">De-Activate</button>&nbsp;&nbsp;&nbsp;
                                                      <?php
                                                         }
                                                         
                                                         ?>
                                                      <a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php/'; ?>" class="btn btn-red  btn-border-radius" >Cancel</a>
                                                      <?php
                                                         }
                                                         } else {
                                                         ?>
                                                         <?php if (!isset($_SESSION['sign-up']) && $_SESSION['sign-up'] != 1) { ?>
                                                      <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>" id="sell_can" class="btn btn-safe ">View All Drafts</a>&nbsp;&nbsp;
                                                      <button id="sppreviewSaveDraftStore" type="button" class="btn btn-misc"> Preview</button><?php } ?>
                                                     <?php if (isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1) { ?>
                                                     <div style="display: flex; align-items: center;">
                                                       <button id="spdraft" type="button" class="btn btn-safe">Save into draft</button>
                                                         <a href="<?php echo $BaseUrl . '/registration-steps.php?pageid=7'; ?>" class="btn btn-danger btn-border-radius" style="margin-left: 10px;">Cancel</a>
                                                     </div><?php } ?>
                                        <?php if (!isset($_SESSION['sign-up']) && $_SESSION['sign-up'] != 1) { ?>
                                                      <button  id="spdraft" type="button" class="btn btn-safe">Save into draft</button>
                                                      <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" id="sell_can" class="btn btn-change">Reset Post</a><?php } ?>
                                                      <?php
                                                         }
                                                         ?>
                                                      <?php
                                                         if ($postId && $visibility == -1 && $_GET['exp'] != 1) { ?>
                                                      <button id="spPostSubmitStore" type="button" class="btn-border-radius btn btn-submit bradius-20 <?php echo ($postId ? "editing" : ""); ?>" style="border-radius: 20px;">Update</button>&nbsp;&nbsp;&nbsp;
                                                      <?php } ?>
                                                      <?php
                                                         if ($postId) { ?>
                                                      <a type="button" class="btn btn-safe btn-border-radius bradius-20"  href='../../store/previewdetail.php?catid=1&postid=<?php echo  $postId ?> '>Preview</a>
                                                      <a class='btn-border-radius btn btn-red pull-right' onclick="return confirm('Are You Sure')" href='deletePost.php?postid=<?php echo  $postId ?> '>Delete post</a>
                                                      <?php     } ?>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include('../../component/f_footer.php'); ?>
      <!-- bootstrap color picker -->
      <script src="<?php echo $BaseUrl . '/assets/colorpicker/bootstrap-colorpicker.min.js';  ?>" type="text/javascript"></script>
      <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
      <?php include('../../component/f_btm_script.php'); ?>
      <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
      <script type="text/javascript">
         //Colorpicker
         	$(".my-colorpicker1").colorpicker();
         //color picker with addon
         	$(".my-colorpicker2").colorpicker();
      </script>
   </body>
   <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">Crop Image Before Upload</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
         </button>
      </div>
      <div class="modal-body">
         <div class="img-container">
            <div class="row">
               <div class="col-md-8">
                  <img src="" id="sample_image" />
               </div>
               <div class="col-md-4">
                  <div class="preview"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" id="crop" class="btn btn-primary">Crop</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
   </div>
</html>
<?php
   }
   ?>
<script>
   if ((specification == '')) {
   	if (specification == '') {
   		$(".lbl_55").text('required');
   
   	} else {
   
   		$(".lbl_55").text('*');
   	}
   	swal("Please fill Required Fields");
   	return false;
   }
   
   
   
   
   
   
   $(document).ready(function() {
   
   	$('#spPostingTitle').keypress(function() {
   
   		$('.lbl_1').remove();
   
   	});
   
   
   	$('#filesaaa1').click(function() {
   
   		var img = $('#filesaaa1').val();
   //alert("sfjdsfjd");
   		if (img == "") {
   			$('.lbl_15').remove();
   
   		}
   	});
   
   	$('#sppreviewSaveDraftStore').click(function() {
   		$("#invalid").hide();
   
   	});
   
   //copy
   	$('#spdraft').click(function() {
   		$("#invalid").hide();
   
   	});
   
   
   
   });
</script>
<script type="text/javascript">
   $(function() {
   
   	$(".addcustomsell").on("change", "#sellType_", function(e) {
   
   
   
   		if ($(this).val() == "Auction") {
   
   
   
   			$(".hidbuy").load("../auction.php", {
   				profileid: $("#spProfiles_idspProfiles").val(),
   				retailflag: 1,
   				postid: $("#postid").val()
   			}, function(response) {
   				$("#sellflag").val(2);
   				$("#industry_select").show();
   				$("#bootomsellfrm").show(1000);
   
   			});
   
   			$("#sell_frm").show(1000);
   		} else if ($(this).val() == "Wholesale") {
   
   //wholesale panel
   			$(".hidbuy").load("../wholesell.php", {
   				profileid: $("#spProfiles_idspProfiles").val(),
   				retailflag: 1,
   				postid: $("#postid").val()
   			}, function(response) {
   				$("#sellflag").val(0);
   				$("#industry_select").show();
   				$("#bootomsellfrm").show(1000);
   			});
   
   			$("#sell_frm").show(1000);
   		} else if ($(this).val() == "Retail") {
   
   			$(".hidbuy").load("../retail.php", {
   				profileid: $("#spProfiles_idspProfiles").val(),
   				retailflag: 1,
   				postid: $("#postid").val()
   			}, function(response) {
   				$("#sellflag").val(2);
   				$("#industry_select").show();
   				$("#bootomsellfrm").show(1000);
   			});
   
   			$("#sell_frm").show(1000);
   
   
   		} else if ($(this).val() == "Personal") {
   
   			$(".hidbuy").load("../personalSell.php", {
   				profileid: $("#spProfiles_idspProfiles").val(),
   				retailflag: 1,
   				postid: $("#postid").val()
   			}, function(response) {
   				$("#sellflag").val(2);
   				$("#industry_select").show();
   				$("#bootomsellfrm").show(1000);
   				$("#bar_c").hide();
   			});
   
   			$("#sell_frm").show(1000);
   		} else if ($(this).val() == "0") {
   
   			$("#sell_frm").hide(1000);
   			$("#bootomsellfrm").hide(1000);
   
   		}
   
   	});
   
   
   
   //$(".sell_frm").on('change',"#protype", function(){
   
   //var protype = $(this).val();
   //alert('jjj');
   	if (protype == 1) {
   
   		$("#showvarients").show();
   
   	} else {
   		$("#showvarients").hide();
   	}
   });
</script>
<script type="text/javascript">
   $(function() {
   	$('#auctionPrice').keypress(function(e) {
   		if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
   e.preventDefault(); //stop character from entering input
   }
   });
   
   	$('#auctionQuantity_').keypress(function(e) {
   		if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
   e.preventDefault(); //stop character from entering input
   }
   });
   
   	$('.size').keypress(function(e) {
   		if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
   e.preventDefault(); //stop character from entering input
   }
   });
   
   
   });
</script>
<script>
   function myFunction(browser) {
   	document.getElementById("selltype").value = browser;
   }
   
   $("#preview_product").click(function() {
   	var selltype = $("#sellType_").val();
   	var spPostingTitle = $("#spPostingTitle").val();
   	var specification = $("#specification").val();
   	var auctionQuantity_ = $("#auctionQuantity_").val();
   	var auctionStatus_ = $("#auctionStatus_").val();
   	var auctionPrice = $("#auctionPrice").val();
   	var spPostingNotes = $("#spPostingNotes").val();
   
   });
   
   
   $("#spPostSubmitStorepublish").click(function() {
   
   	var postid = "<?php echo $postId; ?>"
   	var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
   
   	$.ajax({
   		url: MAINURL + "/store/prevpublish.php",
   		type: "POST",
   		data: 'postid=' + postid,
   
   		success: function(vi) {
   
   
   			window.location.href = MAINURL + "/post-ad/sell/posting.php?postid=" + postid.trim();
   
   		},
   		error: function(error) {
   
   		}
   	});
   
   
   });
   
   function so_input() {
   	$('#refund').show();
   }
   
   function so_out() {
   	$('#refund').hide();
   }
   
   
   function loadDocReturn(id) {
   
   	if (id == 0) {
   		document.getElementById("ifYes").style.display = "none";
   		$('#return_within_iid').val('');
   	}
   	if (id == 1) {
   		document.getElementById("ifYes").style.display = "block";
   	}
   }
   
   
   $('#forfreeshipping').click(function() {
   	$("#forhideandshowshipping").hide();
   	$("#forhideandshowshippingforbhak").hide();
   });
   $('#forfixedamountshipping').click(function() {
   	$("#forhideandshowshipping").hide();
   	$("#forhideandshowshippingforbhak").show();
   });
   $('#forpercompanyahipping').click(function() {
   	$("#forhideandshowshipping").show();
   	$("#forhideandshowshippingforbhak").hide();
   });
   if ($('#forfreeshipping').is(':checked')) {
   	document.getElementById("forhideandshowshipping").style.display = "none";
   	document.getElementById("forhideandshowshippingforbhak").style.display = "none";
   }
</script>
<script>
   $(document).ready(function(){
   
   	var $modal = $('#modal');
   
   	var image = document.getElementById('sample_image');
   
   	var cropper;
   
   $('.setvaluue').change(function(event){
   	var files = event.target.files;
   		var url = ' ';
   		var done = function(url){
   			image.src = url;
   			$modal.modal('show');
   		};
   
   		if(files && files.length > 0)
   		{
   			reader = new FileReader();
   			reader.onload = function(event)
   			{
   				done(reader.result);
   			};
   			reader.readAsDataURL(files[0]);
   		}
   	});
   
   	$modal.on('shown.bs.modal', function() {
   		cropper = new Cropper(image, {
   			aspectRatio: 1,
   			viewMode: 3,
   			preview:'.preview'
   		});
   	}).on('hidden.bs.modal', function(){
   		cropper.destroy();
      		cropper = null;
   	});
   
   	$('#crop').click(function(){
   		canvas = cropper.getCroppedCanvas({
   			width:400,
   			height:400
   		});
   
   		canvas.toBlob(function(blob){
   			url = URL.createObjectURL(blob);
   			var reader = new FileReader();
   			reader.readAsDataURL(blob);
   			reader.onloadend = function(){
   				var base64data = reader.result;
   				$modal.modal('hide');
   				$('.featuredImageCrop').val(base64data);
   				$('.postingimg ').attr('src', base64data);
   			};
   		});
   	});
   	
   });
</script>
