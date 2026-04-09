<?php
//error_reporting(E_ALL);
//ini_set("display_errors", "On");


include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
	include_once("../authentication/check.php");
	$_SESSION['afterlogin'] = "timeline/";
}
function sp_autoloader($class){
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

include_once "../common.php";

$re = new _redirect;
$p = new _spprofiles;

$agentId = isset($_GET['agentId']) ? (int) $_GET['agentId'] : 0;

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";

$postId = !empty($_GET['postId']) ? $_GET['postId'] : "";

$companyName = "";
if ($agentId > 0) {
  $result  = $p->read($agentId);
  if ($result != false) {
	  $row = mysqli_fetch_assoc($result);
  //print_r($row);
	  $name   = $row["spProfileName"];
	  $email  = $row["spProfileEmail"];
	  $phone  = $row["spProfilePhone"];
	  $email_status = $row['email_status'];
	  $phone_status = $row['phone_status'];
  //echo $phone;
	  $country = $row["spProfilesCountry"];
	  $city   = $row["spProfilesCity"];
	  $dob    = $row['spProfilesDob'];
	  $about  = $row["spProfileAbout"];
	  $picture    = $row["spProfilePic"];
	  $location   = $row["spprofilesLocation"];
	  $language   = $row["spprofilesLanguage"];
	  $address    = $row["address"];
  }
//profile detail
	$c = new _profilefield;
	$r = $c->read($agentId);
//echo $c->ta->sql;
	if ($r != false) {
		while ($rw = mysqli_fetch_assoc($r)) {
			if ($companyName == '') {
				if ($rw['spProfileFieldName'] == 'companyname_') {
					$companyName = $rw['spProfileFieldValue'];
				}
			}
		}
	}
} 
elseif($postId){
  $row = selectQ('SELECT seller_name , seller_email , seller_mnumber, saller_picture FROM sprealstate  where idspPostings=?', 'i', [$postId], 'one');
  if(!$row){
    die("Invalid post");
  }
  $name   = $row["seller_name"];
  $email  = $row["seller_email"];
  $phone  = $row["seller_mnumber"];
  $picture    = $row["saller_picture"];
  $country = $city   = $dob    = $about  = $location   = $language   = $address = "";
  $email_status = "public";
  $phone_status = "public";

}
else {
	$redirctUrl = $BaseUrl . "/real-estate/agents.php";
	$re->redirect($redirctUrl);
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
	<?php include('../component/links.php'); ?>
	<!--This script for posting timeline data Start-->
	<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
	<!--This script for posting timeline data End-->

	<style>
		.list-wrapper {
			padding: 15px;
			overflow: hidden;
		}

		.list-item {
			border: 1px solid #EEE;
			background: #FFF;
			margin-bottom: 10px;
			padding: 10px;
			box-shadow: 0px 0px 10px 0px #EEE;
			display: contents;
		}

		.list-item h4 {
			color: #FF7182;
			font-size: 18px;
			margin: 0 0 5px;
		}

		.list-item p {
			margin: 0;
		}

		.simple-pagination ul {
			margin: 0 0 20px;
			padding: 0;
			list-style: none;
			text-align: center;
		}

		.simple-pagination li {
			display: inline-block;
			margin-right: 5px;
		}

		.simple-pagination li a,
		.simple-pagination li span {
			color: #666;
			padding: 5px 10px;
			text-decoration: none;
			border: 1px solid #95ba3d;
			background-color: #95ba3d;
			box-shadow: 0px 0px 10px 0px #EEE;
		}

		.simple-pagination .current {
			color: #FFF;

		}



		.simple-pagination .prev.current,
		.simple-pagination .next.current {}

		.realBox .boxHead {
			background-color: #95ba3d;

		}
	</style>
</head>

<body class="bg_gray">
	<?php include_once("../header.php"); ?>
	<section class="realTopBread">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="agentbreadCrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/real-estate'; ?>">Home</a></li>
							<li class="breadcrumb-item active"><?php echo $name; ?></li>
						</ol>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-right">
						<?php if (!isset($_SESSION['guet_yes']) || (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] != 'yes')) { ?>

							<a href="<?php echo $BaseUrl . '/real-estate/dashboard/'; ?>" class="btn butn_dash_real btn-border-radius"><i class="fa fa-dashboard"></i> Dashboard</a> <?php } ?>
							<?php
							$u = new _spuser;
							if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 3) {
// IS EMAIL IS VERIFIED
								$p_result = $u->isverify($_SESSION['uid']);
								if ($p_result == 1) {
									$pv = new _postingview;
									$reuslt_vld = $pv->chekposting(3, $_SESSION['pid']);

									if ($reuslt_vld == false) {
										?>

										<a href="<?php echo $BaseUrl . '/real-estate/all-room.php'; ?>" class="btn butn_find_room1 btn-border-radius" style="background-color:#83a532; color:white; border:none; border-radius:5px">Search Apartments</a>
										<?php
									}
								}
							}
							?>
							<!-- if(isset($home) && $home == true){ ?> -->
							<?php
// }else{
							?>
							<a style="margin-top: 0px; background-color:#3ea941;" href="<?php echo $BaseUrl . '/real-estate/agents.php'; ?>" class="btn butn_save m_top_20 btn-border-radius">Back to result</a>
							<?php
// }
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo ($picture); ?>" class="img-responsive">
					</div>
					<div class="col-md-9">
						<div class="agentDetail">
							<h2><?php echo $name; ?></h2>
							<p class="agency"><?php echo $companyName; ?></p>
							<ul>

								<li><span style="margin-right:10px"><?php echo $about; ?></span>
									<?php if ($email_status == "public") { ?><i class="fa fa-envelope"></i> <?php echo $email; ?></li>
								<?php } ?>
								<?php if ($phone_status == "public") { ?>
									<li><i class="fa fa-phone"></i> <?php echo $phone; ?></li>
								<?php } ?>

								<?php if ($email_status == "private") { ?><i class="fa fa-envelope"></i> <?php echo $email_status; ?></li>
							<?php } ?>
							<?php if ($phone_status == "private") { ?>
								<li><i class="fa fa-phone"></i> <?php echo $phone_status; ?></li>
							<?php } ?>
							<li><i class="fa fa-map-marker"></i> <?php echo $address; ?></li>

						</ul>

					</div>

				</div>
			</div>
		</div>
	</section>
	<section class="">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="heading08">
						<h2>My PROPERTIES</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<?php

				$start = 0;
				$limit = 1;
				$p      = new _postingview;
				$pf     = new _postfield;
				if($postId){
				  $res = $p->getAgentListBySellerNumber($_GET["categoryID"], $phone);
				}
				else{
				  $res = $p->getAgentList($_GET["categoryID"], $agentId);
				}
				$rain = $res->num_rows;
				?>
				
				<div class="list-wrapper">
				
				<?php

//echo $p->ta->sql;
				if ($res != false) {
					while ($row = mysqli_fetch_assoc($res)) {
//posting fields
						$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
						if ($result_pf) {
							$address = "";
							$bedroom = "";
							$bathroom = "";
							$sqrfoot = "";
							$basement = "";
							$propertyType = "";

							while ($row2 = mysqli_fetch_assoc($result_pf)) {

								if ($propertyType == '') {
									if ($row2['spPostFieldName'] == 'spPostingPropertyType_') {
										$propertyType = $row2['spPostFieldValue'];
									}
								}
								if ($address == '') {
									if ($row2['spPostFieldName'] == 'spPostingAddress_') {
										$address = $row2['spPostFieldValue'];
									}
								}
								if ($bedroom == '') {
									if ($row2['spPostFieldName'] == 'spPostingBedroom_') {
										$bedroom = $row2['spPostFieldValue'];
									}
								}
								if ($bathroom == '') {
									if ($row2['spPostFieldName'] == 'spPostingBathroom_') {
										$bathroom = $row2['spPostFieldValue'];
									}
								}
								if ($sqrfoot == '') {
									if ($row2['spPostFieldName'] == 'spPostingSqurefoot_') {
										$sqrfoot = $row2['spPostFieldValue'];
									}
								}
								if ($basement == '') {
									if ($row2['spPostFieldName'] == 'spPostBasement_') {
										$basement = $row2['spPostFieldValue'];
									}
								}
							}
						}
						?>
						<div class="list-item">
							<div class="col-md-3">
								<div class="realBox">
									<a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row['idspPostings']; ?>">
										<div class="boxHead">
											<h2 style="white-space: nowrap; width: 240px; overflow: hidden; text-overflow: ellipsis;"><?php echo $row['spPostingTitle']; ?></h2>
											<p style="white-space: nowrap; width: 245px; overflow: hidden; text-overflow: ellipsis;">
												<i class="fa fa-map-marker"></i>
												<?php
												if (strlen($row['spPostingAddress']) < 30) {
													echo $row['spPostingAddress'];
												} else {
													echo substr($row['spPostingAddress'], 0, 30) . "...";
												}
												?>
											</p>
										</div>
										<?php
										$pic = new _realstatepic;

										$res2 = $pic->readFeature($row['idspPostings']);
										if ($res2 != false) {
											if ($res2->num_rows > 0) {
												if ($res2 != false) {
													$rp = mysqli_fetch_assoc($res2);
													$pic2 = $rp['spPostingPic'];
													echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
												}
											} else {
												$res2 = $pic->read($row['idspPostings']);
												if ($res2 != false) {
													$rp = mysqli_fetch_assoc($res2);
													$pic2 = $rp['spPostingPic'];
													echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
												}
											}
										} else {
											$res2 = $pic->read($row['idspPostings']);
											if ($res2 != false) {
												$rp = mysqli_fetch_assoc($res2);
												$pic2 = $rp['spPostingPic'];
												echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
											} else {
												echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
											}
										} ?>
										<div class="midLayer">
											<ul>
												<li title="Square Foot" style="    margin-left: 5px;"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($row['spPostingSqurefoot'] > 0) ? $row['spPostingSqurefoot'] : 0; ?></li>
												<li title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($row['spPostingBedroom'] > 0) ? $row['spPostingBedroom'] : 0; ?></li>
												<li title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($row['spPostingBathroom'] > 0) ? $row['spPostingBathroom'] : 0; ?></li>
												<li title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($row['spPostBasement'] > 0) ? $row['spPostBasement'] : 0; ?></li>
											</ul>
										</div>
										<div class="boxFoot bg_white text-center">

											<?php if (strlen($row['spPostingPropertyType']) < 15) { ?>
												<p class="proType"><?php echo $row['spPostingPropertyType']; ?></p>
											<?php } else { ?>
												<p class="proType"><?php echo (substr($row['spPostingPropertyType'], 0, 15) . '...'); ?></p>

											<?php } ?>


											<p><span><?php echo $row['defaltcurrency'] . ' ' . $row['spPostingPrice']; ?></span>
												<?php if ($row['spPostingPropStatus'] == 'Active') { ?>
													<span style="color:green;"><?php echo $row['spPostingPropStatus']; ?></span>
												<?php } ?>
												<?php if ($row['spPostingPropStatus'] == 'Sold') { ?>
													<span style="color:red;"><?php echo $row['spPostingPropStatus']; ?></span>
												<?php } ?>
											</p>
										</div>
									</a>
								</div>
							</div>
							</div> <?php
						}
					}
					?>

				</div>
				<?php 

				if($rain >16)
				{

					?>

					<div id="pagination-container"></div>
					<?php
				}
				?>

			</div>
		</div>
	</section>
	<div class="space"></div>
	<?php
	include('../component/footer.php');
	include('../component/btm_script.php');
	?>
</body>

</html>

<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

	var items = $(".list-wrapper .list-item");
	var numItems = items.length;
	var perPage = 16;

	items.slice(perPage).hide();

	$('#pagination-container').pagination({
		items: numItems,
		itemsOnPage: perPage,
		prevText: "&laquo;",
		nextText: "&raquo;",
		onPageClick: function(pageNumber) {
			var showFrom = perPage * (pageNumber - 1);
			var showTo = showFrom + perPage;
			items.hide().slice(showFrom, showTo).show();
		}
	});
</script>
