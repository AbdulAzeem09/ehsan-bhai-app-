<link href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css" rel="stylesheet">


<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include('../../univ/baseurl.php');
session_start();
include '../../common.php';
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "services/";
	include_once("../../authentication/islogin.php");
} else {

  if(isset($_SESSION['pro-ac']) && $_SESSION['pro-ac'] == 1){
    $proffesionalAc = 1;
  }

	
	
	$_GET["module"] = "7";
	$_GET["categoryid"] = "7";
	$_GET["profiletype"] = "1";
	$_GET["categoryname"] = "Services";
	$_GET["categoryname"] = "Community";

	if (!isset($_SESSION['pid'])) {
		include_once("../../authentication/check.php");
		$_SESSION['afterlogin'] = "post-ad/photos/";
	}
	function sp_autoloader($class)
	{
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$_GET["categoryid"] = "2";
	$_GET["categoryname"] = "Job Board";
	$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
  if ($_SESSION['ptid'] != 1 && $_SESSION['ptid'] != 3){
    $re = new _redirect;
    $re->redirect($BaseUrl . "/services");
  }
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
				header("Location: $BaseUrl/services/dashboard/?msg=notverified");
			}
		} else {
			header("Location: $BaseUrl/services/dashboard/?msg=notverified");
		}
	}
	if ($_SESSION['ptid'] == 1) {

		$f = new _spuser;
		$fil = $f->read1($_SESSION['pid']);
//print_r($fil);die;
		if ($fil) {
			$r = mysqli_fetch_assoc($fil);
//print_r($r);
			$pid = $r['sp_pid'];
//echo $pid;die('====');
			if ($r['status'] != 2) {
				header("Location: $BaseUrl/job-board/dashboard/?msg=notverified");
			}
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


if (!isset($_GET["postid"])) {
	unset($_SESSION['spPostCountry']);
	unset($_SESSION['spPostState']);
	unset($_SESSION['spPostCity']);

	if (isset($_POST['Change_Current_Location'])) {
//print_r($_POST);die('++++');
		$_SESSION['spPostCountry'] = $_POST['spUserCountry'];
		$_SESSION['spPostState'] = $_POST['spPostState'];
		$_SESSION['spPostCity'] = $_POST['spPostCity'];
	}
	if (isset($_SESSION["spPostCountry"])) {
		$usercountry_f =    $_SESSION['spPostCountry'];
		$userstate_f = $_SESSION['spPostState'];
		$usercity_f = $_SESSION['spPostCity'];
	} else {
		$u = new _spuser;
		$res = $u->read($_SESSION["uid"]);
		if ($res != false) {
			$ruser = mysqli_fetch_assoc($res);
			$usercountry_f  = $ruser["spUserCountry"];
			$userstate_f  = $ruser["spUserState"];
			$usercity_f = $ruser["spUserCity"];
			$username = $ruser["spUserName"];
		}
	}
} else {
	$p = new _artCategory;
	if (isset($_POST['Change_Current_Location'])) {
//print_r($_POST);die('++++');
		$aa = $_POST['spUserCountry'];
		$bb = $_POST['spPostState'];
		$cc = $_POST['spPostCity'];
	}


	if ($aa) {
		$arr = array(
			"spPostingsCountry" => $aa,
			"spPostingsState" => $bb,
			"spPostingsCity " => $cc
		);
		$p->update_servics($arr, $postid);
	}

	$r = $p->read_state_servics($postid);
	if ($r != false) {
		while ($row = mysqli_fetch_assoc($r)) {

			$usercountry_f = $row['spPostingsCountry'];
			$userstate_f = $row['spPostingsState'];
			$usercity_f = $row['spPostingsCity'];
		}
	}
}

if ($_SESSION['ptid'] == 2 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 4) {
	$re = new _redirect;
	$location = $BaseUrl . "/services/";
	$re->redirect($location);
}
if (isset($_GET["postid"])) {
	$p = new _classified;

	$res = $p->read($postid);
	$cp = $res->num_rows;
//var_dump($cp);die;
//echo $cp;die;
	if ($cp == false) {

		header("Location: $BaseUrl/services/dashboard/active.php?msg=notacess");
	}

	if ($res != false) {
		while ($row = mysqli_fetch_assoc($res)) {
			$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];

			if ($_SESSION['pid'] != $spProfiles_idspProfiles) {

				header("Location: $BaseUrl/services/dashboard/active.php?msg=notacess");
			}
		}
	}
}
//print_r($_SESSION);
?>
<style>
div:where(.swal2-container) div:where(.swal2-popup) {
  font-size: large !important;
}
#car1 {
  margin-top: 8px !important;
}
button#indent {
  padding: 9px;
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

	<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script> -->
	<script src="<?php echo $BaseUrl; ?>/assets/js/posting/service.js"></script>

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
	<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
	<!--post group button on btm of the form-->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
	<!--NOTIFICATION-->
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

	<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/editor.js"></script> -->
	<!--   <script type="text/javascript" src="https://js.nicedit.com/nicEdit-latest.js"></script> -->

	<script>
		$(document).ready(function() {

//$("#spPostingNotes").Editor();
//$("#spPostingNotes").Editor("setText", "Hello");
		});
	</script>
	<link href="<?php echo $BaseUrl; ?>/assets/css/editor.css" type="text/css" rel="stylesheet" />

	<?php
	$urlCustomCss = $_SERVER['DOCUMENT_ROOT'] . '/component/custom.css.php';
	include $urlCustomCss;
	?>
</head>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">


		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Change Current Location</h4>
			</div>
			<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
			<form action="" method="post">
				<!--<input type="hidden" name="spPostingVisibility" value="0">-->
				<div class="modal-body">
					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label for="spPostingCountry" class="lbl_2">Country</label>
								<select class="form-control " name="spUserCountry" id="spUserCountry">
									<option value="">Select Country</option>
									<?php




									$co = new _country;
									$result3 = $co->readCountry();
									if ($result3 != false) {
										while ($row3 = mysqli_fetch_assoc($result3)) {

											?>
											<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry_f) && $usercountry_f == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
											<?php
										}
									}
									?>
								</select>

							</div>
						</div>
						<div class="col-md-4">
							<div class="loadUserState">
								<label for="spPostingCity" class="lbl_3">State</label>
								<select class="form-control" name="spPostState" id="spUserState">
									<option>Select State</option>

									<?php
/*echo "<pre>";
print_r($_SESSION); die;
*/
if (isset($usercountry_f) && $usercountry_f > 0) {
	$countryId =  $usercountry_f;
	$pr = new _state;
	$result2 = $pr->readState($usercountry_f);
	if ($result2 != false) {
		while ($row2 = mysqli_fetch_assoc($result2)) { ?>
			<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate_f) && $userstate_f  == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
			<?php
		}
	}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
	<div class="loadCity">
		<div class="form-group">
			<label for="spPostingCity">City</label>
			<select id="spUserCity" class="form-control" name="spPostCity">
				<option>Select City</option>
				<?php

				$stateId = $userstate_f;
				$co = new _city;
				$result3 = $co->readCity($userstate_f);
//echo $co->ta->sql;
				if ($result3 != false) {
					while ($row3 = mysqli_fetch_assoc($result3)) { ?>
						<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity_f) && $usercity_f == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
					}
				}
				?>
			</select>
			<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
		</div>
	</div>
</div>


</div>
</div>
<div class="modal-footer">
	<input type="submit" value="Save" class="btn btn-primary btn-border-radius" name="Change_Current_Location">
	<input type="button" class="btn btn-danger btn-border-radius" name="Closeresetlocation" data-dismiss="modal" value="Cancel">
</div>
</form>
</div>

</div>
</div>


<body onload="pageOnload('post')">
	<?php
	$header_servic = "header_servic";
	include_once("../../header.php");

	$p = new _spprofiles;
	$classiFied = new _classified;
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
				<form action="../../album/createalbum.php" method="post" id="sp-create-album" class="sharestorepos no-margin" enctype="multipart/form-data">
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



	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>



	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" />


	<style type="text/css">
		.tagLine-max-char {
			padding: 7px;
			font-size: smaller;
			font-weight: 600;
		}

		.label-info {
			background-color: #032350;
		}

		.bootstrap-tagsinput {
			background-color: #edeef0;
			padding: 0px 0px 0px 4px;
			border-radius: 0px;
			line-height: 32px;
			width: 66%;
		}







		<?php





		$co = new _country;

		$result3 = $co->readCountry();
//print_r($result3);die;
		if ($result3 != false) {
			while ($row3 = mysqli_fetch_assoc($result3)) {


				if (isset($usercountry) && $usercountry == $row3['country_id']) {
					$currentcountry = $row3['country_title'];
					$currentcountry_id = $row3['country_id'];
				}

/*            $p = new _classified;
$r = $p->read($postid);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
$currentcountry_id = $row['spPostCountry'];
$spUserState_real = $row['spUserState'];
$spUserCity_real = $row['spUserCity'];

}
}*/


/*  if (isset($_GET["postid"])) {


$usercountry    = $spPostCountry_real ;
$currentcountry =    $spUserState_real ;
$currentcountry_id =  $spUserCity_real ;

}
*/
}
}

if (isset($userstate) && $userstate > 0) {
	$countryId = $currentcountry_id;
	$pr = new _state;
	$result2 = $pr->readState($countryId);
	if ($result2 != false) {
		while ($row2 = mysqli_fetch_assoc($result2)) {




			if (isset($userstate) && $userstate == $row2["state_id"]) {
				$currentstate_id = $row2["state_id"];
				$currentstate = $row2["state_title"];
			}
		}
	}
}
if (isset($usercity) && $usercity > 0) {
	$stateId = $currentstate_id;
	$co = new _city;
	$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
	if ($result3 != false) {
		while ($row3 = mysqli_fetch_assoc($result3)) {
			if (isset($usercity) && $usercity == $row3['city_id']) {
				$currentcity = $row3['city_title'];
				$currentcity_id = $row3['city_id'];
			}
		}
	}
} ?>
</style>
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 no-padding">
				<div class="left_service" id="">
					<img src="<?php echo $BaseUrl; ?>/assets/images/service/left-service.jpg" class="img-responsive" alt="" />
				</div>
			</div>
			<div class="col-md-9">

				<div class="row">
					<div class="col-md-12">
						<form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostclassified.php" method="post" id="sp-form-post" name="postform">
							<div class="modTitle" style="padding-left: 15px;">
								<h2>Module Name: <span>Classified Ads</span></h2>
							</div>
							<div class="serv_form ">
								<h3>
									<i class="fa fa-pencil"></i>
									<?php
									if (isset($_GET["postid"])) {
										echo "Update An AD";
									} else {
										echo " POST An  Ad";
									}

									?>

									<a href="<?php echo $BaseUrl . '/services'; ?>" style="color:white; padding-left :11px;" class="pull-right">Back to Home</a>
									<a href="<?php echo $BaseUrl . '/services/dashboard/index.php'; ?>" style="color:white; border-right: solid 1px #fff; padding-right: 10px;" class="pull-right">Dashboard</a>
								</h3>

								<div style="float:right;margin-top: 10px;">
									<?php
/*if ($_SESSION["spPostCountry"]) {

$usercountry = $_SESSION["spPostCountry"];
//echo $usercountry;
//die('======11');	
//die('==');
$userstate = $_SESSION["spPostState"];
//echo $userstate;
//die('======');
$usercity = $_SESSION["spPostCity"];
//echo $usercity;	
//die('======');				

}*/
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
	while ($row3 = mysqli_fetch_assoc($result3)) {
//print_r($row3);

//echo $usercountry;
//die('==');
		if (isset($usercountry_f) && $usercountry_f == $row3['country_id']) {
//echo $usercountry;
//die('==');
			$currentcountry = $row3['country_title'];
			$currentcountry_id = $row3['country_id'];
		}
	}
}

if (isset($userstate_f) && $userstate_f > 0) {
	$countryId = $currentcountry_id;
	$pr = new _state;
	$result2 = $pr->readState($countryId);
	if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
//die('===');
	if (isset($userstate_f) && $userstate_f == $row2["state_id"]) {
		$currentstate_id = $row2["state_id"];
		$currentstate = $row2["state_title"];
//echo $currentstate;		
	}
}
}
}
if (isset($usercity_f) && $usercity_f > 0) {
	$stateId = $currentstate_id;
	$co = new _city;
	$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
	if ($result3 != false) {
		while ($row3 = mysqli_fetch_assoc($result3)) {
//print_r($row3);
			if (isset($usercity_f) && $usercity_f == $row3['city_id']) {
				$currentcity = $row3['city_title'];
//echo $currentcity;
//die('==');

				$currentcity_id = $row3['city_id'];
			}
		}
	}
};
?>
<p>
	<small>Current Location: <?php echo $currentcountry . ', ' . $currentstate . ', ' . $currentcity; ?><br>
		<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
	</small>
</p>
</div>

<div class="add_form_body">

	<div class="">
		<div class="">
			<div class="row no-margin">
				<div class="col-md-4 no-padding">

				</div>
				<div class="col-md-4 no-padding">

				</div>
				<div class="col-md-4 no-padding">
<!--          <div class="dropdown pull-right">
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
echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'><img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src='" . ($row["spProfilePic"]) . "' >&nbsp;&nbsp;<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";


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
</div> -->
</div>
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
	$Skills = "";
	$ePostNotes = "";
	$eExDt = "";
	$ePrice = "";
	$shipping = "";
	$visiblty = "";

	if (isset($_GET["postid"])) {
		$p = new _classified;
		$r = $p->read($postid);
//echo $p->ta->sql;
		if ($r != false) {
			while ($row = mysqli_fetch_assoc($r)) {

// print_r($row);

				echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
				$ePostTitle = $row["spPostingTitle"];


				$Skills = $row["skill"];


				$ePostNotes = $row["spPostingNotes"];
				$eExDt = $row["spPostingExpDt"];
				$ePrice = $row["spPostingPrice"];
				$profileid = $row['idspProfiles'];
				$eCity = $row['spPostingsCity'];
				$visiblty = $row['spPostingVisibility'];

				$postingflag = $row['spPostingsFlag'];
				$phone = $row['spProfilePhone'];
				$shipping = $row['sppostingShippingCharge'];
				$eCountry = $row['spPostingsCountry'];
				$userCountry = "";
				$eState = $row['spPostingsState'];
				$userCity = "";
				$postalCode = "";
				$postSelect = "";
				$postServComty = "";
				$isEmail = "";
				$isPhone = "";

				$userCountry = $row['spPostCountry'];


//$spPostCountry_real = $row['spPostCountry'];
// $spUserState_real = $row['spUserState'];
// $spUserCity_real = $row['spUserCity'];





				$userState = $row['spPostState'];

				$userCity = $row['spPostCity'];

				$postalCode = $row['spPostPostalCode'];


				$postSelect = $row['spPostSelection'];



				$postServComty = $row['spPostSerComty'];

				$isEmail = $row['spPostShowEmail'];

				$isPhone = $row['spPostShowPhone_'];
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
	<div class="space"></div>
	<div class="row">
		<div class="col-md-12">
			<?php
//echo $country . "<br>";
//echo $eCountry . "<br>";   
//die('1111111');
			?>
			<input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) {
				echo $_GET["postid"];
			} ?>">
			<input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">
			<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
			<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
			<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">

			<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
			<input type="hidden" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo $usercountry_f; ?>">
			<input type="hidden" class="form-control" id="spPostingsState" name="spPostingsState" value="<?php echo $userstate_f; ?>">
			<input type="hidden" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo $usercity_f; ?>">
			<input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt" value="
			<?php
			if ($eExDt) {
				echo date('Y-m-d', strtotime($eExDt));
			} else {
				echo date('Y-m-d', strtotime("+90 days"));
			}
		?>">

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
		<!--Art Gallery-->
		<!--Art Gallery complete-->
		<div class="row">
<!--  <div class="col-md-3">
<div class="form-group">
<label for="spPostCountry_" class="lbl_1">Country</label>
<select id="spPostCountry_" class="form-control spPostField " name="spPostCountry">
<option value="0">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($userCountry) && $userCountry == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
</div>
</div>-->

<!-- <div class="loadState">
<?php
if (isset($userState) && $userState > 0) {
$countryId = $userCountry;
?>
<div class="col-md-3">
<div class="form-group">
<label for="spPostState_" class="lbl_2">State</label>
<select class="form-control spPostField" id="spPostState_" name="spPostState" >
<option>Select State</option>
<?php
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userState) && $userState == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
?>
</div>-->
<!-- <div class="loadCity">
<?php
// if (isset($userCity) && $userCity > 0) {
//   $stateId = $userState;
?>
<div class="col-md-3">
<div class="form-group">
<label for="spPostCity_">City</label>
<select id="spPostCity_" class="form-control spPostField " name="spPostCity">
<?php
//  $co = new _city;
//  $result3 = $co->readCity($stateId);
//echo $co->ta->sql;
// if($result3 != false){
//while ($row3 = mysqli_fetch_assoc($result3)) { 
?>
<option value='<?php //echo $row3['city_id']; 
?>' <?php //echo (isset($userCity) && $userCity == //$row3['city_id'])?'selected':''; 
?> ><?php //echo $row3['city_title'];
?></option> <?php
// }
//  }
?>
</select>
</div>
</div>
<?php
//}
?>
</div>-->

<!--<div class="col-md-3">
<div class="form-group">
<label for="spPostPostalCode_" class="lbl_3">Postal Code/Zip</label>
<input type="text" class="form-control spPostField" id="spPostPostalCode_" name="spPostPostalCode" value="<?php //echo (isset($postalCode) && $postalCode != '')?$postalCode:'';
?>" >
</div>
</div>-->
<div class="col-md-3">
	<div class="form-group">
		<label for="spPostSelection_" class="postsection_error">Posting Section<span class="red">*</span> <span class="postsection_error_msg"></span></label>
		<select name="spPostSelection" id="spPostSelection_" class="form-control spPostField">
			<option value="">Posting Section</option>
			<option value="Services" <?php echo (isset($postSelect) && $postSelect == 'Services') ? 'selected' : ''; ?>>Services</option>
			<option value="Community" <?php echo (isset($postSelect) && $postSelect == 'Community') ? 'selected' : ''; ?>>Community</option>
		</select>
	</div>
</div>



<div class="loadserv">
	<?php
	if (isset($postSelect) && $postSelect == "Services") {
		?>
		<div class="col-md-3">
			<div class="form-group">
				<label for="spPostSerComty_">Services</label>
				<select id="spPostSerComty_" class="form-control spPostField " name="spPostSerComty">
					<?php
					$getServices = $classiFied->classifiedCategoryByType(1);
					if ($getServices->num_rows > 0) {
						while ($ser = mysqli_fetch_assoc($getServices)) {

							?>
							<option <?php echo (isset($postServComty) && $postServComty == $ser["clasifiedTitle"]) ? 'selected' : ''; ?> value="<?php echo $ser["clasifiedTitle"] ?>"><?php echo ucfirst(strtolower($ser["clasifiedTitle"])) ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>



		<?php
	} else if (isset($postSelect) && $postSelect == "Community") {
		?>
		<div class="col-md-3">
			<div class="form-group">
				<label for="spPostSerComty_">Community</label>
				<select id="spPostSerComty_" class="form-control spPostField " name="spPostSerComty">
					<?php
					$getServices = $classiFied->classifiedCategoryByType(0);
//print_r($getServices); die('');
					if ($getServices->num_rows > 0) {
						while ($ser = mysqli_fetch_assoc($getServices)) {
							echo print_r($ser["clasifiedTitle"]);

							?>
							<option <?php echo (isset($postServComty) && $postServComty == $ser["clasifiedTitle"]) ? 'selected' : ''; ?> value="<?php echo $ser["clasifiedTitle"] ?>"><?php echo ucfirst(strtolower($ser["clasifiedTitle"]));  ?></option>
							<?php
						}
					}

					?>



				</select>


			</div>



		</div>



		<?php
	} ?>






</div>



<div class="col-md-5">
	<div class="form-group">
		<label for="spPostPostalCode_" class="lbl_131">Postal Code/Zip<span class="error lbl_41" style="color:red">*</span></label>


		<input type="text" class="form-control spPostField" maxlength="6" id="spPostPostalCode_" name="spPostPostalCode" value="<?php echo (isset($postalCode) && $postalCode != '') ? $postalCode : ''; ?>">
	</div>
</div>
<!-- <div class="col-md-4">
<div class="form-group">
<label for="servicecategory_">Category</label>
<select class="form-control spPostField" id="servicecategory_" data-filter="1" name="servicecategory_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]); ?>">
<?php
$m = new _masterdetails;
$masterid = 8;
$result = $m->read($masterid);

if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) {
echo "<option value='" . $rows["masterDetails"] . "'>" . $rows["masterDetails"] . "</option>";
}
}
?>
</select>
</div>
</div> -->



</div>
<div class="row no-margin">
	<div class="col-md-12 no-padding">
		<div class="form-group">
			<label for="spPostingTitle">Title<span style="color:red">*</span><span class="red"><span class="error lbl_13"></span></label>
			<input type="text" class="form-control profilefield myhead" style="width:66%;" id="spPostingTitle" name="spPostingTitle" maxlength="100" placeholder="Looking For 500 Businesses" value="<?php if($ePostTitle) echo $ePostTitle;
			else '';?>" placeholder="LOOKING FOR 500 BUSINESSES" required />
		</div>
		<label for="skill_" class="control-label">
			Highlight <span class="red">* <span class="error lbl_14"></span>
		</span>
		<span style="font-weight:lighter;">(<em><i>Enter max 10 entries by pressing enter per entry</i></em>)</span>
	</label>
	<div class="form-group">

		<input type="text" required class="form-control profilefield myhead" name="skill" id="skill1" style=" background-color: #032350;" value="<?php echo (isset($Skills)) ? $Skills : ''; ?>" data-role="tagsinput" />



	</div>

	<script>
		$(document).ready(function() {
			$("#skill1").change(function() {
				$(".lbl_14").removeClass("label_error");
				$(".lbl_14").text("");
			});
			$("#spPostPostalCode").change(function() {
				$(".lbl_41").removeClass("label_error");
				$(".lbl_41").text("");
			});
			$("#spPostingTitle").change(function() {
				$(".lbl_13").removeClass("label_error");
				$(".lbl_13").text("");
			});

		});
	</script>












	<div class="row">

<!-- <div class="col-md-6">
<div class="form-group">
<label for="spPostListing_">Listing</label>
<select class="form-control spPostField" data-filter="1" id="spPostListing_" name="spPostListing_" value="">
<option value="Sell">Sell</option>
<option value="Rent">Rent</option>
</select>
</div>
</div> -->
</div>
<div class="addcustomfields">
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

//include("../services.php");

	?>
	<!--Getcustomfield-->
</div>

<script>
	$(document).ready(function() {
/* $("#spPostingNotes").Editor();*/
/* $("#spPostingNotes").Editor("setText", '<?php echo addslashes($ePostNotes); ?>');*/
	});
</script>

<div class="form-group">
	<label for="spPostingNotes" class="lbl_4">Job Description<span style="color:red">*</span> <span id="errorDesc"></span></label>

	<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
	<textarea name="spPostingNotes" id="spPostingNotes" style="display:none;" required><?php echo $ePostNotes ?></textarea>

	<div id="editor-container" style=" height: 135px; "><?php echo $ePostNotes ?></div>


	<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
	<script>
		var quill = new Quill('#editor-container', {
			modules: {
				toolbar: [
					[{
						header: [1, 2, false]
					}],
					['bold', 'italic', 'underline']
					]
			},
theme: 'snow' // or 'bubble'
});


		quill.on("text-change", function() {
			var editor_content = quill.container.firstChild.innerHTML;
//alert(editor_content);
			document.getElementById("spPostingNotes").value = editor_content;
		});
	</script>
</div>


</div>
</div>

<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "selected" : ""); ?>">
	<div class="col-md-3">
		<div class="form-group">

			<label for="featurepic">Add Feature Images<span class="red">*</span> <span class="lbl_pic_error_mcg red"></span></label>
			<input type="file" class="featurepic" id="filesaaa1" name="spPostingPic[]">
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
						$pic = new _classifiedpic;
						if (isset($_GET['postid'])) {
							$res = $pic->readFeature($postid);
							if ($res != false) {
								while ($rows = mysqli_fetch_assoc($res)) {
// print_r ($rows);
									$picture = $rows['spPostingPic'];
									if ($rows['spFeatureimg'] == 1) {
										$select = "checked";
									} else {
										$select = '';
									}
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";
									/* echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='".$_GET['postid']."' data-picid='".$rows['idspPostingPic']."'><input type='radio' class='featureImg' name='featureImg' id='fi_".$i."' value='0' ".$select." />Feature Image</label></div>";*/
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
//$i++;
									if ($i == 1) {

										echo "<div class='col-md-2 imagepost 22'><span class='fa fa-remove dynamicimg closed'  data-work='service' data-aws='9' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
									}
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


<!--Testing-->
<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "selected" : ""); ?>">
	<div class="col-md-3">
		<div class="form-group">

			<label for="postingpic">Upload Images</label>
			<input type="file" class="postingpic" id="filesaaa" name="spPostingPic1[]" multiple="multiple">
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
//$i = 1;
						$pic = new _classifiedpic;
						if (isset($_GET['postid'])) {
							$res = $pic->read_1($postid);
							if ($res != false) {
								while ($rows = mysqli_fetch_assoc($res)) {
//print_r ($rows);
									$picture = $rows['spPostingPic'];
									if ($rows['spFeatureimg'] == 0) {
										$select = "checked";
									} else {
										$select = '';
									}
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";
									echo "<div class='col-md-2 imagepost  11'><span class='fa fa-remove dynamicimg closed'  data-work='service' data-aws='9' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
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
<div class="space"></div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>
				<!-- <input type="checkbox" class="spPostField" name="spPostingAgree" id="spPostingAgree_" value="false"> -->
				<input type="checkbox" style="margin-top:50px!imporatnt;" class="form-check-input spPostField" name="spPostingAgree" id="spPostingAgree_" value="1" <?php if (isset($_GET["postid"])) {
					echo 'checked';
				} ?>>
				<a href="<?php echo $BaseUrl . "/page/?page=privacy_policy"; ?>" style="color:#337ab7 !important;font-size: initial" target="_blank">I agree to the terms and conditions</a>
			</label><br>
			<span class="spTerms erormsg red"></span>
		</div>
	</div>
<!--   <div class="col-md-4">
<div class="form-group">
<label><input type="checkbox" class="spPostField" name="spPostShowPhone" id="spPostShowPhone_" value="0" data-filter="0" > Show Phone no in ad</label>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label><input type="checkbox" class="spPostField" name="spPostShowEmail" id="spPostShowEmail_" value="0" data-filter="0" > Show Email in ad</label>
</div>
</div> -->
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
		<?php
		if (isset($_GET['active']) && $_GET['active'] == 1) {
			$update = "Update Post";
		} elseif (isset($_GET['active']) && $_GET['active'] == 2) {
			$update = "Renew";
		} else {
			$update = "Publish";
		}
		?>
		<a href="<?php echo isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1 ? $BaseUrl . '/registration-steps.php?pageid=8' : $BaseUrl . '/services/dashboard/index.php'; ?>" class="btn btn-danger btn-border-radius">Cancel</a>
		
		<?php if (!isset($_SESSION['sign-up']) || $_SESSION['sign-up'] != 1) { ?>
		<button id="spSaveDraftServ" type="button" class="btn butn_draf  btn-border-radius">Save As Draft</button>
		<?php } ?>
    <?php
      $proprofile = selectQ("select * from spprofessional_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
      if(isset($proprofile) && !empty($proprofile)){
        $proffesionalAc = 0;
      }
    ?>
    <input type="hidden" id="proValidation" value="<?php if($proffesionalAc == 1) { echo 1; } else { echo 0; } ?>">
		<button style="background-color:#41b1b9; color:white;border-radius: 10px;" id="<?php if($proffesionalAc == 1) { echo "spPostAdsPro"; } else { echo "spPostAds"; } ?>" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? $update : "Submit") ?></button>


		<!--a href="javascript:history.go(-1)" class="btn butn_cancel" >Cancel</a -->

		<!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->
		<div id="myModals" style="display:none;" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title2 text-center" style="margin-bottom: 10px; margin-top: 10px; ">Create Professional Profile</h5>
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
            <button  id="spPostAds" type="button" class="btn butn_save btn-border-radius">Submit
            <button id="spPostAdsProClose"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>


<script>
	$(document).ready(function() {

		$(".bootstrap-tagsinput input").on("keypress", function(e) {


			if (e.which == 13 || e.which == 44) {
				var numItems = $('.tag').length;
//alert(numItems);
				if (numItems >= 10) {
					Swal.fire('Maximum 10 Skills Can Be Added');

					$('.tag').children().last().click();
				}
			}
		});
	});
</script>

<script type="text/javascript">
//==========ON CHANGE LOAD CITY==========
	$("#spUserState").on("change", function() {

		var state = this.value;
		$.post("loadUserCity.php", {
			state: state
		}, function(r) {
//alert(r);
			$(".loadCity").html(r);
		});

	});
//==========ON CHANGE LOAD CITY==========
</script>

</html>
<?php
} ?>
