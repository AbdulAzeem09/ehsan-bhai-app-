<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';
include('../../univ/baseurl.php');

session_start();
$_GET["module"] = "3";
$_GET["categoryid"] = "3";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "Realestate";
$proffesionalAc = 0;
if(isset($_SESSION['pro-ac']) && $_SESSION['pro-ac'] == 1){
  $proffesionalAc = 1;
}

$postId = isset($_GET["postid"]) ? (int)$_GET["postid"] : 0;

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "real-estate/";
	include_once("../../authentication/islogin.php");
} else {
	function sp_autoloader($class)
	{

		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$header_realEstate = "realEstate";

	if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || (isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1)) {
	} else {
		$re = new _redirect;
		$re->redirect($BaseUrl . "/real-estate");
// echo $_SESSION['message'];
	}


	$u = new _spuser;
	$res = $u->read($_SESSION["uid"]);
	if ($res != false) {
		$ruser = mysqli_fetch_assoc($res);
		$username = $ruser["spUserName"];
		$usercountry = $ruser["spUserCountry"];
		$userstate = $ruser["spUserState"];
		$usercity = $ruser["spUserCity"];
	}

	unset($_SESSION['post_ad_url']);

	if ($_SESSION['ptid'] == 1) {


		$f = new _spuser;
		$fil = $f->read1($_SESSION['pid']);
//print_r($fil);die("================");
		if ($fil) {
			$r = mysqli_fetch_assoc($fil);
//print_r($r); die("-----------------"); 
			$pid = $r['sp_pid'];
//echo $pid;die('====');
			if ($r['status'] != 2) {
				header("Location: $BaseUrl/real-estate/dashboard/?msg=notverified");
			}
		} else {
			header("Location: $BaseUrl/real-estate/dashboard/?msg=notverified");
		}
	}



	if ($postId) {
		$p = new _postingview;
		$r = $p->read($postId);

		if ($r != false) {
			$row = mysqli_fetch_assoc($r);

			$pid = $row['spProfiles_idspProfiles'];
			if ($pid != $_SESSION['pid']) { ?>
				<script>
					window.location = $BaseUrl.
					'/real-estate/dashboard/';
				</script>
			<?php    }
		} else {
			header("location : $BaseUrl/real-estate/dashboard/?msg=notaceess");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="The SharePage">
	<meta name="author" content="">
	<title>The SharePage</title>
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
	<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
	<!-- PAGE SCRIPT -->
	<script src="<?php echo $BaseUrl; ?>/assets/js/posting/real-estate.js?v=43"></script>

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

	<!-- DATE AND TIME PICKER -->
	<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
	<!--post group button on btm of the form-->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
	<!--NOTIFICATION-->
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

	<!--CSS FOR MULTISELECTOR-->
	<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

	<script type="text/javascript">
//USER ONE
		$(function() {
			$('#leftmenu').multiselect({
				includeSelectAllOption: true
			});

		});
	</script>
	<!--<script src="//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCF74RiSfzQZdaoT8Tep6OSpqfZliUNXNc"></script>  -->
	<script src="<?php echo $BaseUrl . '/assets/js/jquery.geocomplete.js'; ?>"></script>
<!--  <script>
$(function(){
$("#spPostingAddress_").geocomplete();
});
</script> -->

<!-- date-range start -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $BaseUrl; ?>/assets/css/date-time/daterangepicker.css" />
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/css/date-time/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/css/date-time/daterangepicker.js"></script>
<!-- date-range end   -->


<?php
$urlCustomCss = '../../component/custom.css.php';
include $urlCustomCss;
?>
</head>
<style>
	span#car1 {
		margin-top: 10px;
	}

	.left_real {
		min-height: 1520px !important;
	}

	ul#profileDropDown {
		border: none;
	}

	#profileDropDown li.active {
		background-color: #95ba3d;
	}

	#profileDropDown li.active a {
		color: #fff;
	}

	button#indent {
		padding: 9px;
	}
	#dvPreview .closed, .imagepost .closed {
		top: -3px !important;
		right: -53px !important;
	}
	.modal-title2 {
    font-family: Marksimon;
    font-size: 22px !important;
  }
  .modal-header{
    text-align:left !important; 
  }
  .modal-dialog .cntry_clm_2{
    text-align:left;
    display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(2, 1fr);
  }
  .modal-dialog .cntry_clm_4{
    text-align:left;
    display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(3, 1fr);
  }
</style>

<body onload="pageOnload('post')">
	<?php

	include_once("../../header.php");

	$p = new _spprofiles;
	$rp = $p->readProfiles($_SESSION['uid']);
	$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
	if ($res != false) {
		$r = mysqli_fetch_assoc($res);
		$name = $r['spProfileName'];
		$icon = $r['spprofiletypeicon'];
	} else {
		$name = "Select Profile";
		$icon = "<i class='fa fa-user'></i>";
	}

//print_r($_GET['postid']);
//////////////////////// subscription payment

	$p = new _spprofiles;

	$res = $p->read($_SESSION['pid']);
	if ($res != false) {

		$r = mysqli_fetch_assoc($res);
//echo "<pre>";
//print_r($r);
		$name = ucwords(strtolower($r['spProfileName']));
		$icon = $r['spprofiletypeicon'];
		$spdate_created = $r['spdate_created'];
		$Date =  $spdate_created;
		$date1 =  strtotime($Date);

		$date2 =  date('Y-m-d H:i:s');
		$date3 = strtotime($date2);
//echo $date1."<br>".$date3; 



		$datediff = $date3  -  $date1;
//echo "<br>";
		$final_date = round($datediff / (60 * 60 * 24));
		if ($postId == 0) {
			if ($_SESSION['ptid'] == 1) {
//	if(($final_date >= 90) ){ 
				$pr = new _postingview;
				$prf = $pr->profile_real_state($_SESSION['pid']);
				$da = $prf->num_rows;
//echo $da;
				if ($da >= 5) {
					$mb = new _spmembership;
					$result = $mb->readpid($_SESSION['pid']);

					if ($result != false) {

						while ($rows = mysqli_fetch_assoc($result)) {
//print_r($rows);
							$payment_date = $rows["createdon"];
							$duration = $rows['duration'];

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8 = date('Y-m-d', strtotime($date7));
$date5 = date('Y-m-d', strtotime($payment_date));
$date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
//echo  $date5."<br>".$date6."<br>".$date8; die;
if (!(($date5 <= $date8)  && ($date6 >=  $date8))) { ?>
	<script>
		window.location.replace("/membership?msg=notaccess");
	</script>

	<?php
}
//}

}
} else {
	$mb = new _spmembership;
	$result_1 = $mb->read_realestate($_SESSION['pid']);
	$num = 0;
	if ($result_1) {
		$num = mysqli_num_rows($result_1);
	}

	if ($num >= 2) {
		$fr= new _spuser;
		$readsp= $fr->readdataSp($_SESSION['pid']);
		if($readsp!=false){
			$rowsp=mysqli_fetch_assoc($readsp);
			$post_pay =$rowsp['post_pay'];
			$pidAdd =$rowsp['idspProfiles'];
			
		}
		if ($post_pay <= 0) {
			$_SESSION['post_ad_ulr']= $BaseUrl . '/component/custom.css.php';

			?>
			<script>
				window.location.replace("/membership/postmember_buy.php");
			</script>
			<?php
		}
	}
}
}
}
}
}

?>
<?php

// new ==========================================>


$eState = "";
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

if ($postId) {
	$p = new _postingview;
	$r = $p->read($postId); 

	if ($r != false) {
		while ($row = mysqli_fetch_assoc($r)) {
			
//print_r($row); 
// exit;
			$prop_data = array();
			echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
			$ePostTitle = $row["spPostingTitle"];

			$spPostingVisibility = $row["spPostingVisibility"];
			$address = $row["spPostingAddress"];
			$ePostNotes = $row["spPostingNotes"];
			$eExDt = $row["spPostingExpDt"];
			$ePrice = $row["spPostingPrice"];
			$profileid = $row['idspProfiles'];
			$spPostingYearBuilt = $row['spPostingYearBuilt'];
			$spPostingBedroom = $row['spPostingBedroom'];
			$spPartialPostingBathroom = $row['spPartialPostingBathroom'];
			$spPostBasement = $row['spPostBasement'];
			$spPostTaxAmt = $row['spPostTaxAmt'];
			$spPostTaxYear = $row['spPostTaxYear'];
			$spPostListId = $row['spPostListId'];

			$strata_title = $row['strata_title'];
			$building_style = $row['building_style'];
			$strata_fee = $row['strata_fee'];



			$spRoomRent = $row['spRoomRent'];
			$spPostDurstion = $row['spPostDurstion'];
			$spPostDepositAmt = $row['spPostDepositAmt'];
			$postingflag = $row['spPostingsFlag'];
			$phone = $row['spProfilePhone'];
			$shipping = $row['sppostingShippingCharge'];
			$eCountry = $row['spPostingsCountry'];
			if(isset($eCountry) && $eCountry != ''){
			  $eCountryObj = selectQ("select country_title from tbl_country where country_id=?", "i", [$eCountry], "one");
			  $eCountryTitle = $eCountryObj['country_title'];
			}
			$eState = $row['spPostingsState'];
			if(isset($eCountry) && $eCountry != ''){
			  $eStateObj= selectQ("select state_title from tbl_state where country_id=? and state_id=?", "ii", [$eCountry, $eState], "one");
			  $eStateTitle = $eStateObj['state_title'];
			}
			$eCity = $row['spPostingsCity'];
			if(isset($eState) && $eState != ''){
			  $eCityObj = selectQ("select city_title from tbl_city where country_id=? and state_id=? and city_id=?", "iii", [$eCountry, $eState, $eCity], "one");
			  $eCityTitle = $eCityObj['city_title'];
			}
			$houseStyle = $row['spPostingHouseStyle'];
			$prop_data_spPostingPropStatus = $row['spPostingPropStatus'];
			$prop_data = $row['spPostingMeal'];
// array_push($prop_data,$row['spPostingPropStatus']);
			$seller_name = $row['seller_name'];
			$seller_email = $row['seller_email'];

			$saller_picture = $row['saller_picture'];



			$seller_mnumber = $row['seller_mnumber'];
			$status_active_sold = $row['status_active_sold'];
			$spPostingPostalcode = $row['spPostingPostalcode'];
			$spPostingBathroom = $row['spPostingBathroom'];
			$spPostingkeyword = $row["spPostingkeyword"];
			$spPostingSoldBy = $row["spPostingSoldBy"];
			$spPostingOpenHouse = $row["spPostingOpenHouse"];
			$openHouseDayone = $row["openHouseDayone"];
			$openHouseDayoneStrtTime = $row["openHouseDayoneStrtTime"];
			$openHouseDayoneEndTime = $row["openHouseDayoneEndTime"];
			$BreakFast = $row["BreakFast"];
			$Lunch = $row["Lunch"];
			$Dinner = $row["Dinner"];
			$spPostHighLit = $row["spPostHighLit"];


//condition,FEATURES
			$spPostDog = $row["spPostDog"];
			$spPostCat = $row["spPostCat"];
			$spPostSmoke = $row["spPostSmoke"];
			$spPostStainless = $row["spPostStainless"];
			$spPostCentralAir = $row["spPostCentralAir"];
			$spPostLotsCloset = $row["spPostLotsCloset"];
			$spPostOpenFloor = $row["spPostOpenFloor"];
			$spPostBuildAment = $row["spPostBuildAment"];
			$spPostWasher = $row["spPostWasher"];
			$spPostSpacious = $row["spPostSpacious"];
			$spPostGargParking = $row["spPostGargParking"];
			$spPostJettedTub = $row["spPostJettedTub"];
			$spPostSwimPool = $row["spPostSwimPool"];
			$spPostBedType = $row["spPostBedType"];
			$spPostFirePlace = $row["spPostFirePlace"];
			$spPostBalcony = $row["spPostBalcony"];
			$spPostFenced = $row["spPostFenced"];
			$spPostFitnesArea = $row["spPostFitnesArea"];
			$spPostStorage = $row["spPostStorage"];
			$spPostClosePublic = $row["spPostClosePublic"];
			$spPostHeat = $row["spPostHeat"];
			$spPostWater = $row["spPostWater"];
			$spPostElect = $row["spPostElect"];
			$spPostCableTv = $row["spPostCableTv"];
			$spPostInternet = $row["spPostInternet"];
			$spPostSecurtyCam = $row["spPostSecurtyCam"];
			$spPostCntrlAces = $row["spPostCntrlAces"];
			$spPostFulyEquipedGym = $row["spPostFulyEquipedGym"];
			$spPostConcierge = $row["spPostConcierge"];
			$spPostElevator = $row["spPostElevator"];
			$spPostOnsiteStore = $row["spPostOnsiteStore"];
			$spPostParking = $row["spPostParking"];
			$spPostingPropStatus1 = $row["spPostingPropStatus"];
			$spPostingSqurefoot = $row["spPostingSqurefoot"];
			$Lot_Size_Formate = $row["Lot_Size_Formate"];
			$spPostUnitNum = $row["spPostUnitNum"];
			$spPostFurnish = $row['spPostFurnish'];
			$spPostAgencyFee = $row["spPostAgencyFee"];
			$spPostingServicChrg = $row["spPostingServicChrg"];
			$spPostingCleaningChrg = $row["spPostingCleaningChrg"];
			$spPostAvailTo = $row["spPostAvailTo"];
// echo  $spPostAvailTo;
			$spPostAvailFrom = $row["spPostAvailFrom"];
			$spPostRentalMonth = $row["spPostRentalMonth"];
			$spPostRentalWeek = $row["spPostRentalWeek"];
			$spPostRentalNight = $row["spPostRentalNight"];
			$spPostingPropertyType = $row["spPostingPropertyType"];
			$spPostingRentBy = $row["spPostingRentBy"];
			$community = $row['community'];
			$lotSize = $row['lotSize'];
			$defaltcurrency = $row['defaltcurrency'];
			$pf  = new _postfield;
			$result_pf = $pf->read($postId);


//echo $pf->ta->sql."<br>"; 
			if ($result_pf) {
				$organizerId = "";
				$venu = "";
				$hallcapicty = "";
				$ticketCapty = "";
				$spStartDate = "";
				$spEndDate   = "";
				$srtTime     = "";
				$endTime     = "";
				$category    = "";


				while ($row2 = mysqli_fetch_assoc($result_pf)) {

					if ($category == '') {
						if ($row2['spPostFieldName'] == 'eventcategory_' || $row2['spPostFieldName'] == 'eventcategory') {
							$category = $row2['spPostFieldValue'];
						}
					}
					if ($organizerId == '') {
						if ($row2['spPostFieldName'] == 'spPostingEventOrgId_' || $row2['spPostFieldName'] == 'spPostingEventOrgId') {
							$organizerId = $row2['spPostFieldValue'];
						}
					}
					if ($venu == '') {
						if ($row2['spPostFieldName'] == 'spPostingEventVenue_' || $row2['spPostFieldName'] == 'spPostingEventVenue') {
							$venu = $row2['spPostFieldValue'];
						}
					}
					if ($hallcapicty == '') {
						if ($row2['spPostFieldName'] == 'hallcapacity_' || $row2['spPostFieldName'] == 'hallcapacity') {
							$hallcapicty = $row2['spPostFieldValue'];
						}
					}
					if ($ticketCapty == '') {
						if ($row2['spPostFieldName'] == 'ticketcapacity_' || $row2['spPostFieldName'] == 'ticketcapacity') {
							$ticketCapty = $row2['spPostFieldValue'];
						}
					}
					if ($spStartDate == '') {
						if ($row2['spPostFieldName'] == 'spPostingStartDate_' || $row2['spPostFieldName'] == 'spPostingStartDate') {
							$spStartDate = $row2['spPostFieldValue'];
						}
					}
					if ($spEndDate == '') {
						if ($row2['spPostFieldName'] == 'spPostingEndDate_' || $row2['spPostFieldName'] == 'spPostingEndDate') {
							$spEndDate = $row2['spPostFieldValue'];
						}
					}
					if ($srtTime == '') {
						if ($row2['spPostFieldName'] == 'spPostingStartTime_' || $row2['spPostFieldName'] == 'spPostingStartTime') {
							$srtTime = $row2['spPostFieldValue'];
						}
					}
					if ($endTime == '') {
						if ($row2['spPostFieldName'] == 'spPostingEndTime_' || $row2['spPostFieldName'] == 'spPostingEndTime') {
							$endTime = $row2['spPostFieldValue'];
						}
					}
				}
			}
		}
	}
}

?>

<div class="loadbox">
	<div class="loader"></div>
</div>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 no-padding">
				<div class="left_real" id="leftArtFrm">
					<img src="<?php echo $BaseUrl; ?>/assets/images/real/left-real-form.png" class="img-responsive" alt="" style="height: 1520px;" />
				</div>
			</div>
			<div class="col-md-9">

				<div class="row">
					<div class="col-md-12">
						<form enctype="multipart/form-data" onSubmit="javascript:void(0);" method="post" id="sp-form-post" name="postform">
							<div class="event_form realForm">
								<div class="modTitle">
									<h2>Module Name: <span>Real Estate</span></h2>
								</div>
								<h3><i class="fa fa-pencil" style="color:white;"></i> ADD Property
									<a href="<?php echo $BaseUrl . '/real-estate/dashboard/'; ?>" class="pull-right">&nbsp; | Dashboard&nbsp;&nbsp;</a>
									<a href="<?php echo $BaseUrl . '/real-estate'; ?>" class="pull-right">Back to Home</a>
								</h3>
								<div class="add_form_body">
									<div class="">
										<div class="">
											<div class="<?php //echo (isset($_GET['postid']) and $_GET['postid']) ? 'hidden' : ''; ?>">
												<?php if (!$postId) { ?>
													<label 222 class="radio-inline realFrmType"><input type="radio" class="chkForm spPostField realDataFrmType1" name="spPostListing" data-filter="1" checked="" id="sell" <?php echo (isset($_GET['type']) && $_GET['type'] == 0) ? "checked" : ""; ?> value="Sell">Sell</label>
												<?php } ?>
												<script type="text/javascript">
// $(document).ready(function() { 
//     $("#sell").click();
// });
												</script>




												<?php if (!$postId) { ?>
													<label class="radio-inline realFrmType " ><input type="radio" class="chkForm spPostField realDataFrmType2" name="spPostListing" data-filter="0" id="" <?php echo (isset($_GET['type']) && $_GET['type'] == 1) ? "checked" : ""; ?> value="Rent">Rent</label>
												<?php } ?>
											</div>
											<?php
											if (isset($_GET['postid']) && $_GET['type'] == 2) {
												?>
												<label class="radio-inline"><input type="radio" class="chkForm spPostField realDataFrmType3" name="spPostListing" data-filter="1" id="" <?php echo (isset($_GET['type']) && $_GET['type'] == 2) ? "checked" : ""; ?> value="Rent">Rent A Room</label>
												<?php
											} else if (isset($_GET['postid']) && $_GET['type'] == 1) {
												?>
												<label class="radio-inline"><input type="radio" disabled="disabled" class="chkForm spPostField realDataFrmType2" name="spPostListing" data-filter="1" id="" <?php if (isset($_GET['type']) && $_GET['type'] == 1) {
													echo "checked";
												} ?> value="Rent">Rent Entire Place</label>
												<?php
											} else if ($postId && $_GET['type'] == 0) {
												?>
												<label 111 class="radio-inline"><input type="radio" disabled="disabled" class="chkForm spPostField realDataFrmType1" name="spPostListing" data-filter="1" id="" <?php echo (isset($_GET['type']) && $_GET['type'] == 0) ? "checked" : ""; ?> value="Sell">Sell</label>
												<?php
											}
											?>


											<div>
												<?php
												$p = new _spprofiles;
												$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

												if ($res != false) {
													$r = mysqli_fetch_assoc($res);
													$profileid = $r['idspProfiles'];
													$country = $r["spProfilesCountry"];
													$city = $r["spProfilesCity"];
												}
												?>

												<div class="row">
													<div class="col-md-12">

														<input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) {
															echo $_GET["postid"];
														} ?>">
														<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
														<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
														<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
														<input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">

														<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">

														<?php
														$p = new _album;
														$pid = $_SESSION['pid'];
														$albumid = $p->timelinealbum($pid);
														?>
														<input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum" class="album_id" value="<?php echo $albumid; ?>">
														<?php
														if (isset($_GET["postid"])) {
															echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
														}
														?>

														<div class="row no-margin">
<!--<div class="col-md-12 no-padding">

	<div class="form-group">-->
		<?php

		$bc = new _currency;
		$uid = $_SESSION['uid'];

		$dataucurrency = $bc->readCurrencyuser($uid);
		$rowucurrency = mysqli_fetch_array($dataucurrency);

		?>

		<!--<label for="spPostingTitle" class="lbl1">Currency <span class="red">*</span></label>-->
		<input type="hidden" readonly class="form-control" value="<?php echo $rowucurrency['currency']; ?>" name="defaltcurrency">
<!--</div>
</div>-->
<div class="col-md-12 no-padding">
	<div class="col-md-6 no-padding">
		<div class="form-group">
			<label for="spPostingTitle" class="lbl_1">Title </label><span class="red">*</span>
			<input maxlength="60" type="text" class="form-control" id="spPostingTitle" maxlength="60" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder="" required />
		</div>
	</div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
	<div class="col-md-6 ">
		<div class="form-group">
			<label for="spPostingAddress_" class="lbl_16">Address

			</label><span class="red">*</span>
			<input type="text" class="form-control spPostField" data-filter="0" id="spPostingAddress_" name="spPostingAddress" value="<?php echo (isset($address) && $address != '') ? $address : ''; ?>" autocomplete="off" maxlength="40" required>
		</div>
	</div>
	<script>
		var input = document.getElementById('spPostingAddress_');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      var city = "";
      var state = "";
      var country = "";

      for (var i = 0; i < place.address_components.length; i++) {
        var component = place.address_components[i];
        if (component.types.includes('locality')) {
          city = component.long_name;
        } else if (component.types.includes('administrative_area_level_1')) {
          state = component.long_name;
        } else if (component.types.includes('country')) {
          country = component.long_name;
        }
      }
      $("#spUserCountry_real_estate").val(country);
      $("#spUserState_real_estate").val(state);
      $("#spUserCity_real_estate").val(city);
    });
	</script>

  <input type="hidden" name="spPostingsCountry" id="spUserCountry_real_estate" value="<?php echo (isset($eCountryTitle) && $eCountryTitle != '') ? $eCountryTitle : ''; ?>" />
  <input type="hidden" name="spPostingsState" id="spUserState_real_estate" value="<?php echo (isset($eStateTitle) && $eStateTitle != '') ? $eStateTitle : ''; ?>" />
  <input type="hidden" name="spPostingsCity" id="spUserCity_real_estate" value="<?php echo (isset($eCityTitle) && $eCityTitle != '') ? $eCityTitle : ''; ?>" />
  

	<div class="addcustomfields">
		<!--add custom fields-->
		<?php
		if ($postId) {
			$f = new _postfield;
			$res = $f->field($postId);
			if ($res != false) {
				while ($result = mysqli_fetch_assoc($res)) {
					$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
				}
			}
		}
		if (isset($_GET['type']) && $_GET['type'] == 1) {
			include("loadRent.php");
		} else if (isset($_GET['type']) && $_GET['type'] == 2) {

			include("loadRoomfield.php");
		} else {
			include("../realestate.php");
		}

		?>
		<!--Getcustomfield-->
	</div>




	<div class="form-group">
		<label for="Description" class="lbl_17">Description</label><span style="color:red;">*</span> 
		<span id="error_1" style="color:red"></span>
		<textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="2500" required ><?php echo $ePostNotes ?> </textarea>

	</div>
</div>
</div>
<!--Testing-->
<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
	<div class="col-md-3">
		<div class="form-group">
			<label for="postingpic" class="lbl_pic_error">Add Images </label><span class="red">*</span>
			<span class="lbl_pic_error_mcg red"></span>
			<input type="hidden" value="<?php echo $_GET['postid']; ?>" id="hiddenidforimg">
			<input type="file" showFeatured="1" class="postingpic" id="postingpic_realestate" name="spPostingPic[]" multiple="multiple" required="Photos are very important to attract others to your ads. Please add photos.">
			<p class="help-block"><small>Browse files from your device</small></p>
		</div>
	</div>
	<div class="col-md-9">
		<div class="form-group">
			<label for="postingPicPreview">Picture Preview</label>
			<div id="imagePreview"></div>
			<div id="postingPicPreview">
				<div class="row">
					<div id="dvPreview" style="margin: 0px 15px;">
						<?php
						$i = 1;
						$pic = new _realstatepic;

						if ($postId) {
							$res = $pic->read($postId);
							if ($res != false) {
							  while ($rows = mysqli_fetch_assoc($res)) {
									$picture = $rows['spPostingPic'];
									if ($rows['spFeatureimg'] == 1) {
										$select = "checked";
									} else {
										$select = '';
									}
									echo "<div class='col-md-2 imagepost' style='margin-left: 50px;'>
									  <span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' data-work='realstate' data-aws='3' data-src='" . $rows['spPostingPic'] . "' ></span>
									  <img class='overlayImage' style='width:150px; height: 150px; object-fit:cover; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/>
									  <label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'>
									  
									  <label style='font-size: 9px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_$i' value='1' $select />Feature Image</label>
									
									</div>";
									$i++;
								}
							}
						}

						?>
					</div>
				</div>
			</div>
			<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
		</div>
	</div>
</div>

<div class="showAgentDetail">

	<?php
	if (isset($_GET['type']) && $_GET['type'] == 1) {
		include('loadOtherInfo.php');
	} else if (isset($_GET['type']) && $_GET['type'] == 2) {

		include('loadOtherInfo.php');
	} else {
		include('loadAgentDetail.php'); 
	}


	?>
</div>
<!--complete-->
</div>
</div>
</div>
</div>
</div>
</div>
<?php //if(!isset($_GET['postid'])){ ?>
	<div style="margin-left: 20px;">
		<b>Do you want to feature your listing? (35 USD)</b><br>
		<input type="radio" id="answer1" name="is_feature" value="1">
		<label for="yes">Yes</label>
		<input type="radio" id="answer2" name="is_feature" value="2" checked>
		<label for="no">No</label>
	</div>
	<?php //} ?>
</div>
<div class="row no-margin">

	<div class="col-md-12 ">

	</div>

	<div class="col-md-12 text-right">

		<?php if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 4) { ?>
			<a href="<?php if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1) { echo $BaseUrl . '/registration-steps.php?pageid=7'; } else {echo $BaseUrl.'/real-estate'; } ?>"   class="btn btn-danger btn-border-radius">Cancel</a>
			<?php
			if (isset($_GET["postid"])) {
				echo "<a class='btn btn-danger btn-border-radius' href='deletePost.php?postid=" . $_GET['postid'] . "''>Delete post</a>";
			}
			?>
			<?php if (!isset($_SESSION['sign-up']) || $_SESSION['sign-up'] != 1) { ?>
			<button id="spSaveDraft" type="submit" data-is-draft="1"  class="btn butn_draf btn-border-radius">Save As Draft</button>
			<?php } ?>
			<?php if (isset($_GET["postid"]) &&  $_GET['repost'] == 3) { ?>

				<button id="spPostSubmitReal" type="button" class="111 btn butn_save btn-border-radius <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="background-color: #95ba3d;">Publish</button>

			<?php } else { ?>
			  <?php
          $proprofile = selectQ("select * from spprofessional_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
          if(isset($proprofile) && !empty($proprofile)){
            $proffesionalAc = 0;
          }
        ?>
			  <input type="hidden" id="proValidation" value="<?php if($proffesionalAc == 1) { echo 1; } else { echo 0; } ?>">
				<button id="<?php if($proffesionalAc == 1) { echo 'spPostSubmitRealPro'; } else { echo 'spPostSubmitReal'; } ?>"  onClick="javascript:void(0);" type="submit" class="22 btn butn_save btn-border-radius <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="background-color: #95ba3d;"><?php echo (isset($_GET["postid"]) ? "Update" : "Submit") ?></button>

			<?php } ?>

      <div id="myModals" style="display:none;" class="modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title2 text-center">Create Professional Profile</h5>
              <div class="form-group">
                <label for="pro_profilename" class="text-left proname">Professional Profile Name</label>
                <input type="text" class="form-control" id="pro_profilename" name="spProfileName" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php if(isset($username) && $proffesionalAc == 1){ echo $username; }?>" required>
              </div>
              <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
                <div class="">
                  <label for="carrerhighlight" class=" my-2 text-capitalize carrerhighlight">Career Highlights<span class="req_star">*</span></label>
                  <input type="text" class="form-control" name="carrerhighlight" id="pro_highlights" required>
                </div>
                <div class="form-group">
                  <div class="">
                    <label for="pro_category" class="my-2 text-capitalize careercat">Career Category<span class="req_star">*</span></label>
                    <select class="form-control" id="pro_category" name="category"  aria-label="Default select example" required>
                    <option value="">Select Category</option>
				            <?php
					            $m = new _masterdetails;
                      $result = $m->read(25);
                      if($result != false){
                        while($rows = mysqli_fetch_assoc($result)){ ?>
                          <option value='<?php echo $rows["idmasterDetails"]; ?>'><?php echo ucfirst(strtolower($rows["masterDetails"]));?></option><?php
                        }
                      }
				            ?>
                    </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button  id="spPostSubmitReal" type="button" class="btn butn_save btn-border-radius">Submit
                <button id="spPostSubmitProclose"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      
		<?php  } else { ?>

			<div id="Notabussiness" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content no-radius">

						<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
							<button type="button" class="close" data-dismiss="modal">×</button>
							<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
							<h2>Your current profile does not have access to this page. Please create or switch your current profile to either <span>"Professional Profile,Business Profile or Personal profile "</span> to access this page.</h2>
							<div class="space-md"></div>
							<a href="<?php echo $BaseUrl ?>/my-profile" class="btn">Create or Switch Profile</a>
							<a href="<?php echo $BaseUrl ?>/events" class="btn">Back to Home</a>
						</div>
					</div>
				</div>
			</div>


			<button id="" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" data-toggle="modal" data-target="#Notabussiness"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button>
			<button id="" data-toggle="modal" data-target="#Notabussiness" type="button" class="btn butn_draf <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>">Save Draft</button>





		<?php } ?>

	</div>
</div>
</form>
</div>

</div>
</div>
</div>
</section>
<?php include_once('../../component/f_links.php'); ?>
<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
} ?>
