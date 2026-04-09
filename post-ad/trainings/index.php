<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "store/";
	include_once("../../authentication/islogin.php");
} else {
	$_GET["module"] = "8";
	$_GET["categoryid"] = "8";
	$_GET["profiletype"] = "1";
	$_GET["categoryname"] = "Trainings";

	if (!isset($_SESSION['pid'])) {
		include_once("../../authentication/check.php");
		$_SESSION['afterlogin'] = "post-ad/photos/";
	}
	function sp_autoloader($class)
	{
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$header_train = "header_train";
	
	$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;


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
				header("Location: $BaseUrl/trainings/dashboard/?msg=notverified");
			}
		} else {
			header("Location: $BaseUrl/trainings/dashboard/?msg=notverified");
		}
	}



	if ($_SESSION['ptid'] == 1) {


		if (empty($_GET['postid'])) {
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
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="The SharePage">
	<meta name="author" content="Office Soft">
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

	<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>-->
	<script src="<?php echo $BaseUrl; ?>/assets/js/posting/training.js"></script>

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
	<script src="<?php echo $BaseUrl; ?>/js/alert.min.js"></script>

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
	<!--post group button on btm of the form-->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
	<!--NOTIFICATION-->
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

	<link href="<?php echo $BaseUrl; ?>/assets/css/editor.css" type="text/css" rel="stylesheet" />
<!--<script src="<?php echo $BaseUrl; ?>/assets/js/editor.js"></script>
<script>
$(document).ready(function() {
$("#spPostingNotes").Editor();
});
$(document).ready(function() {
$("#outline_").Editor();
});
</script>-->
<style>
	.imagepost .closed {
		font-size: 15px;
		position: absolute;
		top: -5px;
		right: -95px;
		cursor: pointer;
		padding: 2px 4px;
		border-radius: 50%;
		opacity: 0;
	}

	span.fa.fa-remove.attach.dynamicimg.closed {
		right: -5px;
	}

	span#car1 {
		margin-top: 10px;
	}

	.dropdown-menu {
		border: none !important;
	}

	#profileDropDown li.active {
		background-color: #417281 !important;
	}

	#profileDropDown li.active a {
		color: #fff !important;
	}
</style>
<script>
	function numericFilter(txb) {
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
	}
</script>
<?php
include '../component/custom.css.php';
include('../component/f_links.php');
?>
</head>

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

	?>
	<!--Album creation modal-->
	<div class="loadbox">
		<div class="loader"></div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content no-radius">
				<form action="../../album/createalbum.php" onsubmit="return checkadd1()" method="post" id="sp-create-album" class="sharestorepos no-margin" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel"><b>Create New Album</b></h4>
					</div>
					<div class="modal-body">

						<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

						<input type="hidden" name="sppostingalbumFlag" value="<?php echo $_GET["module"]; ?>">

						<div class="form-group">
							<label for="spAlbumName" class="control-label contact">Album Name</label>
							<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
						</div>

						<div class="form-group">
							<label for="spAlbumDescription" class="contact">Description</label>
							<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="spaddalbum" type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Done-->
	<section>
		<div class="container-fluid">
			<div class="row">
<!-- <div class="col-md-3 no-padding">
<div class="left_train" id="leftArtFrm">
<img src="<?php echo $BaseUrl; ?>/assets/images/training/left-training.jpg" class="img-responsive" alt="" />
</div>
</div> -->
<div class="col-md-12">

	<div class="row">
		<div class="col-md-12">
			<form enctype="multipart/form-data"  onsubmit="return checkadd_1()"  action="<?php echo $BaseUrl ?>/post-ad/dopost_training.php" method="post" id="sp-form-post" name="postform" >



				<div class="row">
					<div class="col-md-12 no-padding ">
						<ul class="breadcrumb">
							<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl; ?>/trainings/">HOME</a></li> 
							<li style="font-weight: 600;font-size: 15px;">TRAININGS</li>
						</ul>
					</div>
				</div>
				<div class="train_form ">
					<?php


					?>
					<h3>
						<i class="fa fa-pencil"></i>
						<?php
						if (isset($_GET["postid"]) != "") {

							echo "Edit Course";
						} else {
							echo "Add Course";
						}
						?>

						<!--<a href="<?php echo $BaseUrl . '/trainings'; ?>" class="pull-right">Back to Home</a>-->
					</h3>

					<div class="add_form_body">

						<div class="">
							<div class="">
								<div class="row no-margin">
									<div class="col-md-4 no-padding">

									</div>
									<div class="col-md-4 no-padding">

									</div>
<!-- <div class="col-md-4 no-padding">
<div class="dropdown pull-right">
<div class="btn-group top_profile_box" role="group" aria-label="Basic example">
<button type="button" class="btn btn-success" style="cursor:default;">Select Profile</button>
<button class="btn butn_profile dropdown-toggle" type="button" id="profiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="<?php echo $icon; ?>"></span> <?php echo $name; ?><span class="caret"></span></button>

<ul class="dropdown-menu" id="profilesdd" aria-labelledby="profiles">
<?php
$profile = new _spprofiles;
$res = $profile->categoryprofiles($_GET["categoryid"], $_SESSION['uid']);
//echo $profile->ta->sql;
if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {
if ($row['spProfileType_idspProfileType'] == 2) {
// freelance or job board profile not show
} else {
//echo "<li><a href='#' class='profiledd' data-pid='".$row['idspProfiles']."' data-profileicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> " .$row["spProfileName"]."</a></li>";
echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'><img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src=' " . ($row["spProfilePic"]) . "' >&nbsp;&nbsp;<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";


$profilename = $row["spProfileName"];
$profilesid = $row["idspProfiles"];
$profilepicture = $row["spProfilePic"];
$country = $row["spProfilesCountry"];
$city = $row["spProfilesCity"];
$icon = $row["spprofiletypeicon"];
}
}
} else {
echo "<li role='separator' class='divider'></li>
<li id='myprofile'><a href='/my-profile/' id='sp-profile-register'>Add New Profile</a></li>";
}
?>
</ul>
</div>
</div>
</div> -->
</div>
<!-- <div >
<div class="row no-margin">
<div class="col-md-12 no-padding">
<h4>Your Contact Information</h4>
<p>This information will not be shared on the website. We will only use this to contact you if we have questions about your submission.</p>
</div>
</div>
</div> -->


<div>
	<?php
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
	$visiblty = "";

	if (isset($_GET["postid"])) {
		$p = new _postings;
		$r = $p->read_training($postid);
		if ($pro_id != false) {
			$proid =  mysqli_fetch_assoc($pro_id);
			$profile_id = $proid['spProfiles_idspProfiles'];
		}
//echo $p->ta->sql;
		if ($r != false) {
			while ($row = mysqli_fetch_assoc($r)) {
//print_r($row);

				echo "<input type='hidden' id='postprofile' value='" . $profile_id . "'>";
				$ePostTitle = $row["spPostingTitle"];
				$outline_1 = $row["outline"];
				$ePostNotes = $row["spPostingNotes"];
				$eExDt = $row["spPostingExpDt"];
				$ePrice = $row["spPostingPrice"];
				$profileid = $profile_id;
				$postingflag = $row['spPostingsFlag'];
				$shipping = $row['sppostingShippingCharge'];
				$eCountry = $row['spPostingsCountry'];
				$eCity = $row['spPostingsCity'];
				$visiblty = $row['spPostingVisibility'];
				$videolevel = $row['videolevel'];
				$spPostingCompany = $row['spPostingCompany'];

				$pf  = new _postfield;
$result_pf = $pf->read($postid);                                                             //echo $pf->ta->sql."<br>";
if ($result_pf) {
	$category = "";
	$musicLyric = "";
	$newReleas = "";
	$musiDirct = "";
	$artistName = "";
	$musiComp = "";
	$musicLang = "";
	$discount     = "";
	$postAs    = "";
	$tag = "";
	$album = "";
	$outline = "";

	while ($row2 = mysqli_fetch_assoc($result_pf)) {
// print_r($row2);
		if ($category == '') {
			if ($row2['spPostFieldName'] == 'musiccategory_') {
				$category = $row2['spPostFieldValue'];
			}
		}
		if ($musicLyric == '') {
			if ($row2['spPostFieldName'] == 'spPostMusicLyrics_') {
				$musicLyric = $row2['spPostFieldValue'];
			}
		}
		if ($newReleas == '') {
			if ($row2['spPostFieldName'] == 'spPostNewRelease_') {
				$newReleas = $row2['spPostFieldValue'];
			}
		}
		if ($musiDirct == '') {
			if ($row2['spPostFieldName'] == 'spPostMusicDirector_') {
				$musiDirct = $row2['spPostFieldValue'];
			}
		}
		if ($artistName == '') {
			if ($row2['spPostFieldName'] == 'spPostArtistName_') {
				$artistName = $row2['spPostFieldValue'];
			}
		}
		if ($musiComp == '') {
			if ($row2['spPostFieldName'] == 'spPostingMusicCmpId_') {
				$musiComp = $row2['spPostFieldValue'];
			}
		}
		if ($musicLang == '') {
			if ($row2['spPostFieldName'] == 'spPostLanguage_') {
				$musicLang = $row2['spPostFieldValue'];
			}
		}
		if ($tag == '') {
			if ($row2['spPostFieldName'] == 'tag_') {
				$tag = $row2['spPostFieldValue'];
			}
		}
		if ($album == '') {
			if ($row2['spPostFieldName'] == 'musicalbum_') {
				$album = $row2['spPostFieldValue'];
			}
		}
		if ($outline == '') {
			if ($row2['spPostFieldName'] == 'outline_') {
				$outline = $row2['spPostFieldValue'];
			}
		}
	}
}
}
}
}
$p = new _spprofiles;
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
//echo $p->ta->sql;
if ($res != false) {
	$r = mysqli_fetch_assoc($res);
	$profileid = $r['idspProfiles'];
	$country = $r["spProfilesCountry"];
	$city = $r["spProfilesCity"];
}
?>

<div class="row">
	<div class="col-md-12">

		<input type="hidden" id="postid" value="<?php if (isset($_GET['postid'])) {
			echo $_GET["postid"];
		} ?>">
		<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
		<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
		<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="0">

		<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
		<input type="hidden" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) && $eCountry != '') ? $eCountry : $country; ?>">
		<input type="hidden" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) && $eCity != '') ? $eCity : $city; ?>">
		<?php
		$p = new _album;
		$pid = $_SESSION['pid'];
		$albumid = $p->timelinealbum($pid);
		?>
		<input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
		<?php
		if (isset($_GET["postid"])) {
			echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
		}
		?>
		<!--Art Gallery-->
		<!--Art Gallery complete-->
		<div class="row no-margin">
			<div class="col-md-12 no-padding">
				<div class="form-group">
					<label for="spPostingTitle" class="lbl_1">Course Title <span>*</span>
					</label>

					<input type="text" class="form-control" id="tax1_id" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder=""  />
					<span id="error_1" class="text-danger"></span>


				</div>

				<div class="" id="cusFieldVdo">
					<!--add custom fields-->
					<?php
					if (isset($_GET["postid"])) {
						$f = new _postfield;
						$res = $f->field($postid);
						if ($res != false) {
							while ($result = mysqli_fetch_assoc($res)) {
								$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
							}
						}
					}

					include("../training.php");

					?>
					<!--Getcustomfield-->
				</div>


				<div class="form-group">
					<label for="outline_">Course outline</label>
					<textarea name="outline_1" id="outline_1" class="form-control spPostField"><?php echo $outline_1; ?></textarea>
				</div>
				<div class="form-group">
					<label for="spPostingNotes">Description</label>
					<textarea class="form-control" id="spPostingNotes1" name="spPostingNotes"><?php echo $ePostNotes ?></textarea>
				</div>


			</div>
		</div>
		<!--Testing-->
		<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
			<div class="row">
				<div class="col-md-3" style="margin-left: 16px;">
					<div class="form-group">

						<label for="postingpic">Upload Cover Images </label>
						<input type="file" id="postingpic_training" class="postingpic" name="spPostingPic[]" multiple="multiple" <?php echo (!isset($_GET['postid'])) ? "" : " "; ?>>
						<p class="help-block"><small>Browse files from your device</small></p>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="postingPicPreview">Picture Preview</label>
						<div id="imagePreview"></div>
						<div id="postingPicPreview">

							<div id="dvPreview">
								<?php
								$i = 1;
								$pic = new _postings;
								if (isset($_GET['postid'])) {
									$res = $pic->read_cover_images($postid);
									if ($res != false) {
										while ($rows = mysqli_fetch_assoc($res)) {
											$picture = $rows['filename'];

											echo "<div class='col-md-2 imagepost 22' id='cover_" . ($rows['id']) . "'><span class='fa fa-remove cover dynamicimg closed' data-pic='" . $rows['id'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src=' " . '../uploads/' . ($picture) . "'/></div>";

											$i++;
										}
									}
								}

								?>
							</div>
						</div>
					</div>








					<script>
						$(document).ready(function() {
							$(".cover").click(function() {
								var id1 = $(this).attr("data-pic");
//alert(id);

								$.ajax({
									url: "delete_cover.php",
									cache: false,
									data: {
										'data-cover': id1
									},
									success: function(html) {
										$('#cover_' + id1).html('');
									}
								});
							});
						});
					</script>
					<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
					<input type="hidden" name="post-id" id="post_id" value="<?php echo $_GET['postid']; ?>">
				</div>
			</div>
		</div>
		<div class="space"></div>
		<div class="row ">
			<div class="col-md-3">
				<div class="form-group">
					<label for="postingvideo">Introduction video </label>
					<input type="file" id="prevideo" class="spmediaTrainPrev" name="spmediaTrainPrev" accept="video/*" <?php echo (!isset($_GET['postid'])) ? "" : " "; ?>>
					<p class="help-block"><small>Browse files from your device</small></p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label for="postingPicPreview">Video Preview</label>
					<div class="row">
						<div id="preview-container">


							<?php
							$i = 1;
							$pic = new _postings;
							if (isset($_GET['postid'])) {
								$res = $pic->read_preview_video($postid);
								if ($res != false) {
									while ($rows = mysqli_fetch_assoc($res)) {
//print_r($rows);
										$picture = $rows['filename'];

										echo "<div class='col-md-2 imagepost 11' id='preview_" . ($rows['id']) . "'><span class='fa fa-remove preview dynamicimg closed' data-pic='" . $rows['id'] . "' ></span><video width='220' height='140' controls><source src=' " . '../uploads/' . ($picture) . "' type='video/mp4'></video></div>";

										$i++;
									}
								}
							}

							?>

						</div>
					</div>
				</div>
			</div>

			<script>
				$(document).ready(function() {
					$(".preview").click(function() {
						var id2 = $(this).attr("data-pic");
//alert(id);

						$.ajax({
							url: "delete_preview_video.php",
							cache: false,
							data: {
								'data-preview': id2
							},
							success: function(html) {
								$('#preview_' + id2).html('');
							}
						});
					});
				});
			</script>

		</div>
		<!-- PREVIEW THE ATTACHMENT FILES -->
		<div class="space"></div>
		<div class="row ">
			<div class="col-md-3">
				<div class="form-group">
					<label for="postingvideo">Description video </label>
					<!--spmediaTrain-->
					<input type="file" id="addvideo" class="" name="spPostingMedia[]" accept="video/*" multiple="multiple" <?php echo (!isset($_GET['postid'])) ? "" : " "; ?>>
					<p class="help-block"><small>Browse files from your device</small></p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label for="postingPicPreview">Video Preview</label>
					<div class="row">
						<div id="preview-container1">


							<?php
							$i = 1;
							$pic = new _postings;
							if (isset($_GET['postid'])) {
								$res = $pic->read_video_tr($postid);
								if ($res != false) {
									while ($rows = mysqli_fetch_assoc($res)) {
										$picture = $rows['filename'];

										echo "<div class='col-md-3 imagepost 33'  id='add_" . ($rows['id']) . "'><span class='fa fa-remove add dynamicimg closed' data-pic='" . $rows['id'] . "' ></span><video width='220' height='140' controls><source src=' " . $BaseUrl . '/upload/training/' . ($picture) . "' type='video/mp4'></video></div>";

										$i++;
									}
								}
							}

							?>

						</div>
					</div>
				</div>
			</div>

			<script>
				$(document).ready(function() {
					$(".add").click(function() {
						var id3 = $(this).attr("data-pic");
//alert(id);

						$.ajax({
							url: "delete_video.php",
							cache: false,
							data: {
								'data-add': id3
							},
							success: function(html) {
								$('#add_' + id3).html('');
							}
						});
					});
				});
			</script>

<!-- <div class="col-md-3">
<button type="button" class="add-box btn btn-info"><span class="glyphicon glyphicon-plus"></span> Add More</button>
</div>


<div class="form-horizontal" style="margin-left: 16px;">
<div class="text-box form-group">
</div>
</div>-->


</div>

<script type="text/javascript">
/* $(document).ready(function() {
$('.add-box').click(function() {
var n = $('.text-box').length + 1;
if (n > 5) {
alert('Only 5 Savy :D');
return false;
}
var box_html = $('<div class="text-box form-group"><div class="col-sm-4"><input type="file" id="addvideopp" class="form-control  documents" name="spPostingMedia[]" accept="video/*"/></div><div class="col-sm-2"><button type="button" class="remove-box btn btn-danger btn-sm"><i class="fa fa-minus-circle fa-lg"></i></button></div></div>');
$('.text-box:last').after(box_html);
box_html.fadeIn('slow');
});

$('.form-horizontal').on('click', '.remove-box', function() {
$(this).closest(".form-group").remove();
return false;
});
});*/
</script>


<!-- PREVIEW THE ATTACHMENT FILES -->
<div class="space"></div>
<div class="row ">
	<div class="col-md-3">
		<div class="form-group">
			<label for="postingattachment">Do you want to attach any exercise files</label>
			<input type="file" id="addattachment" class="spmediAttach" name="spmediAttach">
			<p class="help-block"><small>Browse files from your device</small></p>
		</div>
	</div>
	<div class="col-md-9">
		<div class="form-group">
			<label for="postingPicPreview">Attachment Preview </label>
			<div class="row">
				<div id="attach-container">


					<?php
					$i = 1;
					$pic = new _postings;
					if (isset($_GET['postid'])) {
						$res = $pic->read_attachment($postid);
						if ($res != false) {
							while ($rows = mysqli_fetch_assoc($res)) {
								$picture = $rows['filename'];
								if ($picture) {
									echo "<div class='col-md-2 imagepost 44' id='attach_" . ($rows['id']) . "'><span class='fa fa-remove attach dynamicimg closed' data-pic='" . $rows['id'] . "' ></span><embed width='400px' height='200px' src=' " . $BaseUrl . '/post-ad/uploads/' . ($picture) . "' ></div>";
								}
								$i++;
							}
						}
					}

					?>

				</div>
			</div>
		</div>

		<script>
			$(document).ready(function() {
				$(".attach").click(function() {
					var id4 = $(this).attr("data-pic");
//alert(id);

					$.ajax({
						url: "delete_attachment.php",
						cache: false,
						data: {
							'data-attach': id4
						},
						success: function(html) {
							$('#attach_' + id4).html('');
						}
					});
				});
			});
		</script>
	</div>
</div>
<!--complete-->
</div>
</div>

</div>
</div>


</div>
</div>

</div>
<div class="row no-margin">

	<div class="col-md-12 text-right">

		<!-- this is preview button -->
		<!-- <button type="submit" id="preview" class="btn butn_preview">Preview</button> -->
		<!-- <button id="spPostSubmit" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button> -->
		<!-- <button id="spPostSubmitStore" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button> -->
		<a href="<?php echo $BaseUrl . '/trainings/dashboard'; ?>"  class="btn btn-danger  btn-border-radius" style="color:white;">Cancel</a>
		<button  id="spPostDraft1" name="spPostDraft" type="submit" class="btn btn-warning  btn-border-radius">Save As Draft</button>
		<button  id="spPostTraining1" value="publish" name="spPostTraining" type="submit" class=" btn-border-radius btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button>




		<!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->
	</div>
</div>
</form>
</div>
<script type="text/javascript">
	function checkadd_1() {

  //alert("==========");
		var sub_cat = $("#tax1_id").val();
		var train = $("#train_id").val();
		var duration = $("#duration").val();
		var trainer_id = $("#trainer_id").val();
		var spRequiremnt = $("#spRequiremnt_").val();

		
		if((sub_cat == "") || (train == "") || (duration == "") || (trainer_id == "") || (spRequiremnt == "")){

			if (sub_cat == "") {
				$("#error_1").text("Enter Course Title");

			} else{
				$("#error_1").text("");
			}
			
			if (train == "") {
//alert("==============");
				
				$("#error_2").text("Enter Company Name");
				
			} else {

				$("#error_2").text("");

				
			}

			if (duration == "") {

				
				$("#error_3").text("Enter Total Duration");

			} else {

				$("#error_3").text("");


			}


			if (trainer_id == "") {

				
				$("#error_4").text("Enter Trainer Bio");

			} else {

				$("#error_4").text("");


			}



			if (spRequiremnt == "") {

				
				$("#error_5").text("Enter Requirements ");

			} else {

				$("#error_5").text("");


			}
			return false
		}

	}
</script>



</div>
</div>
</div>
</section>
<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

</body>

</html>
<?php
}
?>
