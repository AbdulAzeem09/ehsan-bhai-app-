<?php
error_reporting(0);
//ini_set('display_errors', '1');
session_start();
include('../univ/baseurl.php');
include("../univ/main.php");
if (!isset($_SESSION['pid'])) {
	include_once("../authentication/check.php");
	$_SESSION['afterlogin'] = "my-profile/";
}

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
//include_once("../header.php");
$p = new _spprofiles;

//print_r($_POST['ptid'];
$rpvt = $p->readProfiles($_SESSION["uid"]);

//$tags = $_SESSION['tagg'];

//echo $tags ;

//print_r($_SESSION);
//die('sss');

/* $pf = new _spfreelancer_profile;

$res = $pf->read($_POST["pid"]);


$tags = "";

while($result = mysqli_fetch_assoc($res)){

$tags = $result['tags'];
}*/


if ($rpvt != false) {
$a = 0; //Business
$b = 0; //Freelacer
$c = 0; //Entertainment
$d = 0; //Personal
$e = 0; //Job seeker
$f = 0; //Dating
while ($rows = mysqli_fetch_assoc($rpvt)) {
if ($rows['idspProfileType'] == 1) //Business
{
	$a++;
}

if ($rows['idspProfileType'] == 2) //Freelancer
{
	$b++;
}

if ($rows['idspProfileType'] == 3) //Entertainment
{
	$c++;
}

if ($rows['idspProfileType'] == 4) //
{
	$d++;
}

if ($rows['idspProfileType'] == 5) //Job seeker
{
	$e++;
}

if ($rows['idspProfileType'] == 6) //Dating
{
	$f++;
}
}
}

if (isset($_POST['pid'])) {
	$result  = $p->read($_POST["pid"]);

	if ($result != false) {
		$row = mysqli_fetch_assoc($result);
//print_r($row );
		$name = $row["spProfileName"];
		$email = $row["spProfileEmail"];
		$phone = $row["spProfileCntryCode"] . $row["spProfilePhone"];
		$country = $row["spProfilesCountry"];
		$state = $row['spProfilesState'];
		$city = $row["spProfilesCity"];
		$dob = $row['spProfilesDob'];
		$about = $row["spProfileAbout"];
		$picture = $row["spProfilePic"];
		$location = $row["spprofilesLocation"];
		$language = $row["spprofilesLanguage"];
		$address = $row["spprofilesAddress"];
		$postalCode = $row['spProfilePostalCode'];
		$relationship_status = $row['relationship_status'];
		$phone_status = $row['phone_status'];
		$profile_status = $row['profile_status'];
		$email_status = $row['email_status'];
		$address_city = $row["address"];
		$spProfile_storename = $row["store_name"];
		$dob = $row["date_of_birth"];
	}
}

if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename)) {
	$storename = $spProfile_storename;
}


$pt = new _profiletypes;
$readpt = $pt->readProfileType($_POST["ptid"]);
if ($readpt) {
	$readrows = mysqli_fetch_assoc($readpt);
}
//$profiletypeid = $readrows['idspProfileType'];

$pt = new _profiletypes; 
$rpt = $pt->read();

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);

//echo $u->ta->sql;

if ($res != false) {
	$ruser = mysqli_fetch_assoc($res);
// print_r($ruser);
// echo'xxxxx';
	$username = $ruser["spUserName"];
	$userpnone = $ruser["spUserCountryCode"] . $ruser["spUserPhone"];
	$useremail = $ruser["spUserEmail"];
	$useraddress = $ruser["spUserAddress"];
	$usercountry = $ruser["spUserCountry"];
	$usercity = $ruser["spUserCity"];
//$tags = $ruser["tags"];
	$phone_status = $row['phone_status'];
	$profile_status = $row['profile_status'];
	$email_status = $row['email_status'];

	$address_city = $row["address"];
}

$con =  mysqli_connect(DOMAIN, UNAME, PASS);

if (!$con) {
	die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
	echo 'Database Not Selected';
}
?>


<script type="text/javascript">
//profile Name validate
	function spChkProfileName() {
		var userid = document.getElementById("spUser_idspUser").value;
		var spProfileName = document.getElementById("spProfileName").value;

//alert(userid);
		var ip = this;
		if (userid > 0) {
//alert("yes");
			$.get("../my-profile/availableuser.php?uname=" + spProfileName + "&userid=" + userid, function(ucheck) {
//ucheck = ucheck - $(ip).data("lo");
//alert(ucheck);
				if (ucheck == 0) {
//console.log("hi");
					$("#spProfileName").css({
						"border": "1px solid #F00",
						"box-shadow": "none"
					});
				} else {
//console.log("bye");
					$("#spProfileName").css({
						"border": "1px solid #4CAF50",
						"background-color": "transparent",
						"box-shadow": "none"
					});
				}
			});
		} else {
//console.log("no");
//$(spProfileName).closest(".has-feedback").removeClass("has-success").removeClass("has-error");
//$(spProfileName).parent().siblings(".form-control-feedback").addClass("hidden").removeClass("glyphicon-remove").removeClass("glyphicon-ok");
		}

	}
</script>

<style>
	input[type="radio"],
	input[type="checkbox"] {
/* margin: 0px 0 0; */
margin-bottom: 2px !important;
margin-top: 1px \9;
line-height: normal !important;
}

#tag {
	resize: none;
}

#Education {
	resize: none;
}

#spProfileAbout {
	resize: none;
}

textarea {
	resize: none;
}

.sa-button-container button.confirm {
	background-color: red !important;

}

.dropdown {
	margin-top: 0px !important;
}

@media only screen and (max-width: 700px) {
	.mdc16 {
		margin-right: 0px !important;
	}
	.mdc13 {
		margin-right: 7px !important;
	}
	.mdc14 {
		margin-left: -8px !important;
	}
	.mdc15{
		margin-left: 42px !important;
	}
	.mdc17{
		margin-top: 35px !important;
	}

}

</style>

<div class="panel panel-primary" style="margin-top: 15px;   ">
	<div class="panel-heading profile_head">
		<h3 class="panel-title editprofile1"><?php echo $row['spProfileTypeName'].' CREATE A NEW';?> <?php if(isset($_POST["pid"])) { echo "Edit  Page"; } else { echo "PROFILE";  } ?> </h3>
	</div>
	<div class="panel-body">
		<form enctype="multipart/form-data" action="addprofiles.php" method="post" id="sp-add-profile">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label id="profiletypeslabel" for="profiletypes" class="control-label">Select Profile</label>

						<div class="dropdown" style="margin-top:0px!important;">
							<button class="btn-default" type="button" id="profiletypes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-weight: bold; color: black;cursor: pointer;padding:5px;border-radius:3px;">Profiles <span class="caret"></span>

							</button>

							<ul class="dropdown-menu" id="iddropdown" aria-labelledby="profiletypes">

								<?php

								if ($rpvt != false) {
									while ($row = mysqli_fetch_assoc($rpt)) {


//print_r($row['idspProfileType']); 

if ($row['idspProfileType'] == 1) //Business
{
//echo $a;
	if ($a < 5) {
		echo "<li><a class='profiletypes-dd' data-ptid='" . $row['idspProfileType'] . "' href='#' data-ptypename='" . $row['spProfileTypeName'] . "' onclick='showDiv()'>" . $row['spProfileTypeName'] . "</a></li>";
	}
}

if ($row['idspProfileType'] == 2) //Freelancer
{
//echo $b ;
	if ($b < 2) {
		echo "<li><a class='profiletypes-dd' data-ptid='" . $row['idspProfileType'] . "' href='#' data-ptypename='" . $row['spProfileTypeName'] . "' onclick='showDiv()'>" . $row['spProfileTypeName'] . "</a></li>";
	}
}

if ($row['idspProfileType'] == 3) //Entertainment // professional
{
//echo $c;
	if ($c < 2) {
		echo "<li><a class='profiletypes-dd' data-ptid='" . $row['idspProfileType'] . "' href='#' data-ptypename='" . $row['spProfileTypeName'] . "' onclick='showDiv()'>" . $row['spProfileTypeName'] . "</a></li>";
	}
}

/*	if($row['idspProfileType'] == 4) //Personal
{
//if($d = 0)
if($d < 1)
{
echo "<li><a class='profiletypes-dd' data-ptid='".$row['idspProfileType']."' href='#' data-ptypename='".$row['spProfileTypeName']."'>".$row['spProfileTypeName']."</a></li>";
}
}*/

if ($row['idspProfileType'] == 5) //Job seeker //employment
{
//echo $e;
	if ($e < 1) {
		echo "<li><a class='profiletypes-dd' data-ptid='" . $row['idspProfileType'] . "' href='#' data-ptypename='" . $row['spProfileTypeName'] . "' onclick='showDiv()'>" . $row['spProfileTypeName'] . "</a></li>";
	}
}

if ($row['idspProfileType'] == 6) //Dating //family
{
//echo $f;
	if ($f < 1) {
		echo "<li><a class='profiletypes-dd' data-ptid='" . $row['idspProfileType'] . "' href='#' data-ptypename='" . $row['spProfileTypeName'] . "' onclick='showDiv()'>" . $row['spProfileTypeName'] . "</a></li>";
	}
}
}
}
?>
</ul>
</div>
</div>
</div>





<div class="col-md-4 ">
	<div class="form-group">
		<label for="spProfileName" class="control-label">Profile Name</label>
		<input type="hidden" value="" name="action">
		<input type="text" class="form-control aa74" id="spProfileName" maxlength="20" name="spProfileName" value="<?php echo (!empty($name) ? $name : $username); ?>" onkeyup="spChkProfileName()">
	</div>
</div>
<div class="col-md-4">
<!-- <div class="form-group">
<label for="spProfileEmail" class="control-label">Email</label>
<input type="email" class="form-control" id="spProfileEmail" name="spProfileEmail" value="<?php echo (isset($useremail) ? $useremail : '');
?>" />
</div> -->
</div>
</div>
<?php if ($_POST['ptid'] == 1 || $_POST['ptid'] == 2 || $_POST['ptid'] == 3 || $_POST['ptid'] == 4  || $_POST['ptid'] == 5 || $_POST['ptid'] == 6) { ?>
	<div id="welcomeDiv">
      
	<?php } else {  ?>
		<div id="welcomeDiv" style="display:none;" class="answer_list">
		<?php } ?>
		<div class="row">
			<div class="col-md-10">
				<?php
				if (isset($picture) && $picture != '') {
					?>
					<label  class="control-label" style="float: right; margin-right: -93px !important;">Business Logo</label> <br>
					<img id="profilepic" data-media="<?php echo (isset($picture) ? "1" : "0"); ?>" src="<?php echo (isset($picture)) ? ($picture) : ''; ?>" alt="Profile Pic 222" class="img-responsive" style="margin-right: -101px; height: 110px;width: 110px;float:right;">
					<?php
				} else {


					?>
					<span class="firstimg" data-id="0"></span>

					<img id="profilepic" data-media="<?php echo (isset($picture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png" alt="Profile Pic 111" class="img-responsive 1  mdc16" style="   margin-right: -101px; height: 110px;float:right;">
					<?php
				}
				?>
<!-- <input type="hidden" name="takeUploadedImage" id="takeUploadedImage" value="<?php //echo (isset($picture) && !empty($picture))?''.($picture):''; 
?>" > -->

<!-- <input type='file' id="imgInp" name="spProfilePic[]" multiple="multiple" /> -->
<!-- <div class="row"> -->




	<!-- </div> -->
</div>



</div>

<div class="row">

	<?php if ($readrows['idspProfileType'] == 3) {
		$ps = new _spprofessional_profile;


		if (isset($_POST['pid'])) {
			$res = $ps->read($_POST["pid"]);
//echo $pf->ta->sql;
			if ($res != false) {
				$spProfileAbout    = "";
				while ($result = mysqli_fetch_assoc($res)) {

					$tags = $result['sptags'];
				}
			}
		}


		?>
		<br>
<!--<div class="col-md-8" style="margin-top: -30px;" > 
<div class="form-group">
<label for="tag" class="control-label">Tag:</label>
<textarea class="form-control profilefield" id="tag" name="tag" value="<?php echo (isset($tags)) ? $tags : ''; ?>"><?php echo (isset($tags)) ? $tags : ''; ?></textarea>
</div>


</div>-->

<?php	 } ?>

<div class="col-md-8" style="margin-top: -30px;">

	<?php if ($readrows['idspProfileType'] == 4) {
		$u = new _spuser;
		$res = $u->read($_SESSION["uid"]);



		if ($res != false) {
			$ruser = mysqli_fetch_assoc($res);

			$tags = $ruser["tag"];
		}


		?>


		<div class="form-group" style="margin-top: -45px;">
			<label for="tag" class="control-label">Tag:</label>
			<textarea class="form-control profilefield" id="tag" name="tag" value="<?php echo (isset($tags)) ? $tags : ''; ?>"><?php echo (isset($tags)) ? $tags : ''; ?></textarea>
		</div>




	<?php	 } ?>
</div>


<div class="col-md-2"></div>


<div class="col-md-2 pull-right mdc17 <?php if (isset($_POST['pid'])) { echo 'mdc17';
}?> " id="forfreel" style="margin-right: 50px;">
<div class="dropdown">
	<?php if (isset($_POST['pid'])) {
		?>
		<button class="btn btn-primary btn-border-radius dropdown-toggle mdc15" type="button" data-toggle="dropdown" aria-expanded="false" style="background-color: #032350; padding: 6px 26px !important; margin-top: 15px; ">Upload &nbsp;&nbsp;<span class="caret"></span></button>

	<?php	} else { ?>
		<button class="btn btn-primary btn-border-radius dropdown-toggle mdc15" type="button" data-toggle="dropdown" aria-expanded="false" style="margin-left:7px;background-color: #032350; padding: 6px 26px !important; margin-top: 15px;">Upload&nbsp;&nbsp;<span class="caret"></span></button>

	<?php	} ?>
	<ul class="dropdown-menu sp-profile-det" style="padding-left: 10px; padding-bottom: 5px; padding-top: 5px;">
		<li>
			<a href="javascript:void(0)" class="btn btn-primary btn-border-radius uplodcam db_btn db_primarybtn" data-toggle="modal" data-target="#mycamUpload" style="margin: 3px 0;">Upload Through Cam</a>

		</li>
		<li>
			<a href="javascript:void(0)" class="btn btn-primary btn-border-radius uplodcam db_btn db_primarybtn" data-toggle="modal" data-target="#myimageUpload" style="margin: 6px 0; min-width: 183px;">Gallery</a>

		</li>

	</ul>
</div>
</div>

</div>

<h4><b>OVERVIEW</b></h4>




<div id="mycamUpload" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
			<div class="modal-header br_radius_top bg-white">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Through Cam</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h4>Camera</h4>
						<div id="my_camera"></div>
						<br />
						<input type=button value="Take Snapshot" onClick="take_snapshot()">
						<input type="hidden" id="spProfileId" value="<?php echo $_POST['pid']; ?>">
						<input type="hidden" id="baseImageWeb" class="image-tag">
					</div>
					<div class="col-md-6">
						<h4>Your captured image will appear here...</h4>
						<div id="results" style="width: 300px;height: 290px;overflow: hidden;"></div>
						<button type="button" class="btn btn-primary btn-border-radius" id="btnWebCam"><i class="fa fa-camera"></i> Upload</button>
					</div>
				</div>
			</div>
			<div class="modal-footer bg-white br_radius_bottom">
				<button type="button" class="btn btn-danger btn-border-radius db_btn db_orangebtn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="myimageUpload" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
			<div class="modal-header br_radius_top bg-white">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Image From Gallery</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h4>Choose your profile Image</h4>
						<div id=""></div>
						<br />

						<input type="file" name="imagefile" class="profilegalleryPic" id="basegalleryimage" name="spprofilePic[]" style="display: block;" accept="image/jpg, image/jpeg" />
						<!--   <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
						<br>
						<p style="font-size:12px!important;"><b>Please upload .jpg filetype only.</b></p>
						<input type="hidden" id="spProfileId" value="<?php echo $_POST['pid']; ?>">
					</div>

					<div class="col-md-6">
						<h4>Your selected image will appear here.</h4>
						<div id="galleryresults" style="width: 200px;height: 200px;overflow: hidden;"></div>
					</div>

				</div>
			</div>
			<div class="modal-footer bg-white br_radius_bottom x">
				<button type="button" style="float: left;" class="btn btn-default btn-border-radius db_btn db_primarybtn" id="btngalleryimg">Update Profile Photo</button>
				<button type="button" class="btn btn-default btn-border-radius db_btn db_orangebtn" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>



<script language="JavaScript">
	Webcam.set({
		width: 300,
		height: 290,
		image_format: 'jpeg',
		jpeg_quality: 90
	});

	Webcam.attach('#my_camera');

	function take_snapshot() {
		Webcam.snap(function(data_uri) {
			$(".image-tag").val(data_uri);
			document.getElementById('results').innerHTML = '<img src="' + data_uri + '" class="img-responsive" style="width:300px;height:230px;margin: 29px auto;"/>';
		});
	}

//===========UPLOAD PIC THROUGH WEBCAM=========
	$("#btnWebCam").click(function() {
		var pid = $("#spProfileId").val();
		var base64image = $("#baseImageWeb").val();

//alert(base64image);
//alert(pid);
		var arr = base64image.match(/data:image\/[a-z]+;/);

//alert(arr);
		var ext = arr[0].replace("data:image/", "");
		ext = ext.replace(";", "");
		$.post("../my-profile/uploadimageprofile.php", {
			profileid: pid,
			spprofilePic: base64image,
			mediaid: $("#profilepic").data("media"),
			ext: ext
		}, function(r) {

			setTimeout(function() {
				window.location.reload();
			}, 5000);

		});
	});
//===================END=======================



//===========UPLOAD PIC Gallery=========


	$(function() {

		$(".profilegalleryPic").change(function() {
			if (typeof(FileReader) != "undefined") {
				var galleryresults = $("#galleryresults");
//spPreview.html("");
				var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp|.webp)$/;
				$($(this)[0].files).each(function() {
					var file = $(this);
//alert(file[0].size);
					if (file[0].size <= 2097152) {
						if (regex.test(file[0].name.toLowerCase())) {
							var reader = new FileReader();
							reader.onload = function(e) {
								var img = $("<div class='col-md-2 sponsorpost'><span id='removeimg' onclick='removeimg()' class='fa fa-remove dynamicspimg close'></span><img class='divgalleryimg overlayImage' id='imgpreviwe' style='width: 200px;height: 200px;overflow: hidden;' src='" + e.target.result + "'/></div>");

								galleryresults.html(img);
								document.getElementById("galleryresults").classList.remove('hidden');

							}
							reader.readAsDataURL(file[0]);
						} else {
							alert(file[0].name + " is not a valid image file.");
							document.getElementById("basegalleryimage").value = "";


//spPreview.html("");
							return false;
						}
					} else {
						alert(file[0].name + " is too large. Please upload image less then 2Mb.");
						return false;
					}
				});
			} else {
				alert("This browser does not support HTML5 FileReader.");
			}
		});
	});


	function removeimg() {
		document.getElementById("galleryresults").innerHTML = "";
		document.getElementById("basegalleryimage").value = "";
	}

	$("#btngalleryimg").click(function() {
		//alert('---');
		var pid = $("#spProfileId").val();

		var ptid = $("#ptypeid").val();
		var imgCount = $(".divgalleryimg").length;
		var base64image = $(".divgalleryimg").attr("src");

		var arr = base64image.match(/data:image\/[a-z]+;/);

		var ext = arr[0].replace("data:image/", "");
		ext = ext.replace(";", "");
		if (pid == '' || pid == 0) {
			$("#profilepic").attr("src", base64image);
			$("#profilepic").removeClass("hide");
			$('#myimageUpload').modal('hide');
			var formData = new FormData();
			formData.append('profileid', pid);
			formData.append('ptid', ptid);
			formData.append('mediaid', $("#profilepic").data("media"));
			formData.append('ext', ext);
			// Attach file 
			//formData.append('spprofilePic', $('input[type=file]')[0].files[i]); 
			var totalfiles = document.getElementById('basegalleryimage').files.length;
			for (var index = 0; index < totalfiles; index++) {
				formData.append("files[]", document.getElementById('basegalleryimage').files[index]);

			}
			//basegalleryimage

			$.ajax({
				url: "../my-profile/uploadimage.php",
				data: formData,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function(vi) {
				//alert(vi);

					if(pid){
						document.getElementById('profilepic').src = '' + vi + '';
						$(".db_orangebtn").click();
					}
					//location.reload();
					//window.location.replace(MAINURL + "/my-profile/?msg=uploded");
				}
			});







		} else {

			var formData = new FormData();
			formData.append('profileid', pid);
			formData.append('mediaid', $("#profilepic").data("media"));
			formData.append('ext', ext);
			// Attach file 
			//formData.append('spprofilePic', $('input[type=file]')[0].files[i]); 
			var totalfiles = document.getElementById('basegalleryimage').files.length;
			for (var index = 0; index < totalfiles; index++) {
				formData.append("files[]", document.getElementById('basegalleryimage').files[index]);

			}
			//basegalleryimage

			$.ajax({
				url: "../my-profile/uploadimage.php",
				data: formData,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function(vi) {
					//alert(vi);
					document.getElementById('profilepic').src = '' + vi + '';
					$(".db_orangebtn").click();
					//location.reload();
					//window.location.replace(MAINURL + "/my-profile/?msg=uploded");
				}
			});
			//	$.post("../my-profile/uploadimage.php", {profileid: pid, spprofilePic: base64image, mediaid: , ext: ext}, function (r) {
			//window.location.reload();
			//});
		}










	});
//===================END======================= 
</script>

<!--	<div class="space" style="min-height: 70px;"></div>	 -->
<input id="idspProfiles" name="idspProfiles" type="hidden" value=<?php echo (isset($_POST["pid"])) ? $_POST["pid"] : ''; ?>>

<input name="spUser_idspUser" id="spUser_idspUser" type="hidden" value=<?php echo $_SESSION["uid"]; ?>>

<input class="spProfileType_idspProfileType" name="spProfileType_idspProfileType" type="hidden" id="ptypeid" value="<?php echo $_POST["ptid"]; ?>">

<input type="hidden" id="spProfileTypename" value="<?php echo $_POST["ptype"]; ?>">


<div class="row ">
<!----<div class="col-md-4">
<div class="form-group">
<label for="spProfileName" class="control-label">Profile Name</label>
<input type="text" class="form-control" id="spProfileName"  maxlength="20" name="spProfileName" value="<?php //echo (isset($name)?$name:$username); 
?>" <?php //echo (isset($name)?'readonly':''); 
?> onkeyup="spChkProfileName()" > 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spProfileEmail" class="control-label">Email</label>
<input type="email" class="form-control" id="spProfileEmail" name="spProfileEmail" value="<?php //echo (isset($useremail)?$useremail:''); 
?>" />
</div>
</div>----->


<!--<div class="col-md-4 pull-right" style="margin-right: -100px; margin-top: 0px;">
<div class="form-group ">
<label for="spProfilePostalCode" class="control-label ">Email Status</label><br>



<input type="radio"  name="email_status" value="private" <?php if (isset($email_status) && $email_status == "private") {
echo 'checked';
} elseif (!isset($email_status)) {
echo 'checked';
} else {
echo " ";
} ?>>Private 
<input type="radio"  name="email_status" value="public" <?php echo (isset($email_status) && $email_status == "public") ? 'checked' : ''; ?>>Public

</div>
</div>
<!-- <div class="col-md-4">
<div class="form-group">
<label for="spProfilePhone" class="control-label">Personal Phone</label>
<input type="text" class="form-control"  
</div>
</div> -->
</div>

<div id="profilefield">
	<!-- Job seeker Field -->
</div>
<?php if ($readrows['idspProfileType'] == 4) {

	$u = new _spuser;
	$res = $u->read($_SESSION["uid"]);



	if ($res != false) {
		$ruser = mysqli_fetch_assoc($res);


		$tags = $ruser["memberrelation"];
		$cmpyPhoneNo = $ruser["personal_PhoneNo"];
		$relationship_status = $ruser["relationship_status"];
		$storename = $ruser["spDynamicWholesell"];
		$Category = $ruser["category"];
		$Highlights = $ruser["highlights"];
		$LanguageFluency = $ruser["languagefluency"];
		$sphobbies = $ruser["sphobbies"];
		$spProfileeducation = $ruser["Education"];
		$spProfileAbout = $ruser["spProfileAbout"];
	}





	?>

	<div class="row">

		<div class="col-md-3">
			<div class="form-group">
				<label for="spProfilePostalCode" class="control-label pb_10">Phone Status</label>
				<br>

				<input type="radio" name="phone_status" value="private" <?php if (isset($phone_status) && $phone_status == "private") {
					echo 'checked';
				} elseif (!isset($phone_status)) {
					echo 'checked';
				} else {
					echo " ";
				} ?>>Private &nbsp;&nbsp;
				<input type="radio" name="phone_status" value="public" <?php echo (isset($phone_status) && $phone_status == "public") ? 'checked' : ''; ?>>Public &nbsp;&nbsp;

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="spProfilePostalCode" class="control-label pb_10">Profile Status</label>
				<br>

				<input type="radio" name="profile_status" value="private" <?php if (isset($profile_status) && $profile_status == "private") {
					echo 'checked';
				} elseif (!isset($profile_status)) {
					echo 'checked';
				} else {
					echo " ";
				} ?>>Private &nbsp;&nbsp;
				<input type="radio" name="profile_status" value="public" <?php echo (isset($profile_status) && $profile_status == "public") ? 'checked' : ''; ?>>Public &nbsp;&nbsp;

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group ">
				<label for="spProfilePostalCode" class="control-label pb_10 ">Email Status</label><br>



				<input type="radio" name="email_status" value="private" <?php if (isset($email_status) && $email_status == "private") {
					echo 'checked';
				} elseif (!isset($email_status)) {
					echo 'checked';
				} else {
					echo " ";
				} ?>>Private &nbsp;&nbsp;
				<input type="radio" name="email_status" value="public" <?php echo (isset($email_status) && $email_status == "public") ? 'checked' : ''; ?>>Public

			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<!-- <label for="spProfilePostalCode" class="control-label">Add Family Members</label> -->

				<a href="javascript:void(0)" class="btn btn-primary btn-border-radius uplodcam db_btn db_primarybtn" data-toggle="modal" data-target="#familymember">Add Family Members</a>

				<div id="familymember" class="modal fade mdd" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content sharestorepos bradius-15">
							<div class="modal-header br_radius_top bg-white">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add Family Members</h4>
							</div>

<!--	<form action="addfamily.php" method="POST" id="addfamilyfrm">
<div class="alert alert-danger" role="alert">

</div> -->

<input type="hidden" id="spProfileId" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="spuserId" value="<?php echo $_SESSION['uid']; ?>">
<div class="modal-body">
	<div class="row">
		<div class="after-add-more">
			<div class="col-md-6">
				<div class="form-group">
					<label for="membername" class="control-label">Name</label>

					<input type="text" class='form-control membername ' list="suggested_user" name="membername[]" onkeydown="return /[a-z]/i.test(event.key)" id='membername' onInput="getuser(event)">
					<datalist id="suggested_user"></datalist>

					<input type="hidden" name="memberprofileid" class="form-control" id="memberprofileid" value="<?php echo $_SESSION['pid']; ?>">

					<span id="fam_error" style="color:red;"></span>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="membername" class="control-label">Relationship</label>
					<select name="memberrelation[]" id="memberrelation" class="form-control memberrelation">
						<option value="">Choose relationship:</option>
						<option value="Mother">Mother</option>
						<option value="Father">Father</option>
						<option value="Daughter">Daughter</option>
						<option value="Son">Son</option>
						<option value="Sister">Sister</option>
						<option value="Brother">Brother</option>
						<option value="Auntie">Auntie</option>
						<option value="Uncle">Uncle</option>
						<option value="Niece">Niece</option>
						<option value="Nephew">Nephew</option>
						<option value="Cousin">Cousin</option>
						<option value="Grandmother">Grandmother</option>
						<option value="Grandfather">Grandfather</option>
						<option value="Granddaughter">Granddaughter</option>
						<option value="Grandson">Grandson</option>
						<option value="Stepsister">Stepsister</option>
						<option value="Stepbrother">Stepbrother</option>
						<option value="Stepmother">Stepmother</option>
						<option value="Stepfather">Stepfather</option>
						<option value="Stepdaughter">Stepdaughter</option>
						<option value="Stepson">Stepson</option>
						<option value="Sister-in-law">Sister-in-law</option>
						<option value="Brother-in-law">Brother-in-law</option>
						<option value="Mother-in-law">Mother-in-law</option>
						<option value="Father-in-law">Father-in-law</option>
						<option value="Daughter-in-law">Daughter-in-law</option>
						<option value="Son-in-law">Son-in-law</option>
					</select>
					<span id="rel_error" style="color:red;"></span>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<button type="button" class="btn btn-primary btn-border-radius pull-right add-more" style="margin-right: 16px;"> Add New </button>
	</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
	<button type="button" id="btn-close" class="btn btn-default btn-border-radius  db_btn db_orangebtn" data-dismiss="modal">Close</button>
	<button type="button" id="addfamily" onclick=" " class="btn btn-default btn-border-radius db_btn db_primarybtn">Submit</button>
</div>

<!--	</form>-->


</div>
</div>
</div>

</div>
</div>


</div>




<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="companyPhoneNo_" class="control-label">Personal Phone<span class="red">* <span class="lbl_11"></span></span></label>
			<input type="number" class="form-control profilefield" id="personal_PhoneNo_" name="personal_PhoneNo" value="<?php echo (isset($cmpyPhoneNo)) ? $cmpyPhoneNo : ''; ?>" required />
		</div>
	</div>





	<div class="col-md-4">
		<script type="text/javascript">
			$(document).ready(function() {
				$("body").on("click", ".add-more", function() {
					var html = $(".after-add-more").first().clone();
					$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger btn-border-radius remove'>- Remove</a>");


					$(".after-add-more").last().after(html);
					$(".after-add-more").last().find('.membername').val('');





				});

				$("body").on("click", ".remove", function() {
					$(this).parents(".after-add-more").remove();
				});
			});






//==========ON CHANGE LOAD COUNTRY IN PROFILE=======
			$("#spProfilesCountry").on("change", function() {
//alert(this.value);
				$("#spProfileCity").val(" ");
				var countryId = this.value;
				$.post("loadstate.php", {
					countryId: countryId
				}, function(r) {
//alert(r);
					$(".loadState").html(r);
				});
			});
//==========ON CHANGE LOAD COUNTRY IN PROFILE=======
		</script>
<!-- <div class="form-group">
<label for="spProfileCountry" class="control-label">Country</label>
<input type="text" class="form-control" id="spProfilesCountry" name="spProfilesCountry" required="" value="<?php echo (isset($country) ? $country : $usercountry); ?>">
</div> -->
<div class="form-group">
	<label for="spProfilesCountry">Address</label>

	<!--   <input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php echo $address_city; ?>"  > -->

	<input type="text" list="suggested_address" class="form-control" name="address" id="address" onkeyup="getaddress();" value="<?php echo $address_city; ?>">

	<datalist id="suggested_address"></datalist>

	<input type="hidden" name="latitude" id="latitude">
	<input type="hidden" name="longitude" id="longitude">
<!--   <select id="spProfilesCountry" class="form-control " name="spProfilesCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($country) && $country == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select> -->
</div>
<!-- <div class="form-group">
<label for="spProfilesCountry">Country</label>
<select id="spProfilesCountry" class="form-control " name="spProfilesCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($country) && $country == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
</div> -->
</div>

<div class="col-md-4">
	<div class="form-group">
		<label for="spProfilePostalCode" class="control-label">Postal Code/Zip</label>
		<input type="text" class="form-control" id="spProfilePostalCode" name="spProfilePostalCode" value="<?php echo (isset($postalCode)) ? $postalCode : ''; ?>">
	</div>
</div>

<!-- <div class="col-md-4">
<div class="form-group">
<label for="spProfilePhone" class="control-label">Personal Phone</label>
<input type="text" class="form-control" id="spProfilePhone" name="spProfilePhone" value="<?php //echo (isset($userpnone)?$userpnone:''); 
?>" readonly />
</div>
</div> -->

<!--<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label pb_10">Phone Status</label>
<br>

<input type="radio"  name="phone_status" value="private" <?php if (isset($phone_status) && $phone_status == "private") {
echo 'checked';
} elseif (!isset($phone_status)) {
echo 'checked';
} else {
echo " ";
} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="phone_status" value="public" <?php echo (isset($phone_status) && $phone_status == "public") ? 'checked' : ''; ?>>Public &nbsp;&nbsp;
<!-- <select name="phone_status" class="form-control" >
<option value="private" <?php echo (isset($phone_status) && $phone_status == "private") ? 'selected' : ''; ?> >Private</option>
<option value="public" <?php echo (isset($phone_status) && $phone_status == "public") ? 'selected' : ''; ?>>Public</option>
</select> 
</div>
</div>-->
</div>
<!-- 	<div class="loadState">
<?php
if (isset($state) && $state > 0) {
$countryId = $country;
?>
<div class="col-md-4">
<div class="form-group">
<label for="spPostState_">State</label>
<select class="form-control spPostField" id="spPostState_" name="spPostState_" >
<option>Select State</option>
<?php
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($state) && $state == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
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
</div> -->
<!-- 	<div class="loadCity">
<?php
if (isset($city) && $city > 0) {
$stateId = $state;
?>
<div class="col-md-4">
<div class="form-group">
<label for="spPostCity_">City</label>
<select id="spPostCity_" class="form-control spPostField " name="spPostCity_">
<?php
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($city) && $city == $row3['city_id']) ? 'selected' : ''; ?> ><?php echo $row3['city_title']; ?></option> <?php
}
}
?>
</select>
</div>
</div>
<?php
}
?>
</div> -->
<!-- <div class="col-md-4">
<div class="form-group">
<label for="spProfilesState" class="control-label">Province/State</label>
<input type="text" class="form-control" id="spProfilesState" name="spProfilesState" required="" value="">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spProfileCity" class="control-label">City</label>
<input type="text" class="form-control" id="spProfilesCity" name="spProfilesCity" required="" value="<?php echo (isset($city) ? $city : $usercity); ?>">
</div>
</div> -->
<div class="row">
<!-- <?php
$p = new _spprofiles;
$ptyperes = $p->readProfiles($_SESSION["uid"]);

while ($newrows = mysqli_fetch_assoc($ptyperes)) {

$profiletypeid = $newrows['idspProfileType'];
}

?>  -->





<div class="col-md-4">
	<div class="form-group">
		<label for="spProfilePostalCode" class="control-label">Relationship Status</label>
		<select name="relationship_status" class="form-control">
			<option>Select</option>
			<option value="Single" <?php echo (isset($relationship_status) && $relationship_status == "Single") ? 'selected' : ''; ?>>Single</option>
			<option value="In a Relationship" <?php echo (isset($relationship_status) && $relationship_status == "In a Relationship") ? 'selected' : ''; ?>>In a Relationship</option>
			<option value="Married" <?php echo (isset($relationship_status) && $relationship_status == "Married") ? 'selected' : ''; ?>>Married</option>
			<option value="Not Disclosed" <?php echo (isset($relationship_status) && $relationship_status == "Not Disclosed") ? 'selected' : ''; ?>>Not Disclosed</option>
		</select>
	</div>
</div>

<div class="col-md-4">
	<div class="form-group">
		<label for="storeName" class="control-label">Store Name</label>
		<input type="text" class="form-control profilefield spDynamicWholesell" id="<?php echo (isset($storename) ? "" : "storeName"); ?>" name="spDynamicWholesell" value="<?php if (isset($storename)) {
			echo $storename;
		} ?>">
	</div>
	<p class="hidden" id="checkstore">This storename is taken. Try another.</p>
</div>

<div class="col-md-4">
	<div class="form-group">
		<label for="dob_" class="control-label">Date Of Birth</label>
		<input type="date" class="form-control profilefield " id="dob_" name="dob_" value="<?php if (isset($dob)) {echo $dob;} ?>">
	</div>

</div>








<!--     <div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label">Relationship Status</label>
<select name="relationship_status" class="form-control" >
<option>Select</option>
<option value="Single" <?php echo (isset($relationship_status) && $relationship_status == "Single") ? 'selected' : ''; ?> >Single</option>
<option value="In a Relationship" <?php echo (isset($relationship_status) && $relationship_status == "In a Relationship") ? 'selected' : ''; ?>>In a Relationship</option>
<option value="Married" <?php echo (isset($relationship_status) && $relationship_status == "Married") ? 'selected' : ''; ?>>Married</option>
</select>
</div>
</div> -->

<!-- 	<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label">Phone Status</label>
<select name="phone_status" class="form-control" >

<option value="private" <?php echo (isset($phone_status) && $phone_status == "private") ? 'selected' : ''; ?> >Private</option>
<option value="public" <?php echo (isset($phone_status) && $phone_status == "public") ? 'selected' : ''; ?>>Public</option>

</select>
</div>
</div> -->





<!-- <div class="col-md-4" id="dobbusiness">
<div class="form-group">
<label for="spProfileDob" class="control-label">Date Of Birth</label>
<input type="date" class="form-control" id="spProfilesDob" name="spProfilesDob" value="<?php echo (isset($dob) ? $dob : ''); ?>">
</div>
</div> -->


</div>

<div class="row">
	<input type="hidden" class="control-label" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid)) ? $spprofileid : ''; ?>">

	<div class="col-md-4">
		<div class="form-group">
			<label for="category_" class="control-label"> Career Category </label>
			<select class="form-control profilefield" id="category_" name="category">


				<option value="0">Select Category</option>

				<?php
//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
				$m = new _masterdetails;
				$masterid = 25;
				$result = $m->read($masterid);
				if($result != false){
					while($rows = mysqli_fetch_assoc($result)){ ?>

						<option value='<?php echo $rows["idmasterDetails"]; ?>' <?php if(isset($Category)){if(strtoupper($Category) == trim(strtoupper($rows["idmasterDetails"]))){echo "selected";}}?> ><?php echo ucfirst(strtolower($rows["masterDetails"]));?></option><?php
					}
				}
				?>


			</select>
			<span id="error_c" class="red"></span>
			<!-- <textarea class="form-control profilefield" id="interestin_" name="interestin_" ><?php echo (empty($row["Interests in"]) ? "" : $row["Interests in"]); ?></textarea>  -->
		</div>
	</div>


	<div class="col-md-8">
		<div class="form-group">
			<label for="highlights_" class="control-label">Career Highlights</label>
			<input type="text" class="form-control profilefield" id="highlights_" maxlength="150" name="highlights" value="<?php echo (isset($Highlights)) ? $Highlights : ''; ?>">
			<span id="error_h" class="red"></span>
		</div>
	</div>

</div>



<div class="row">

	<div class="col-md-6">
		<div class="form-group">
			<label for="languagefluency_" class="control-label">Language Fluency</label>
			<input type="text" class="form-control profilefield" id="languagefluency_" name="languagefluency" value="<?php echo (isset($LanguageFluency)) ? $LanguageFluency : ''; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="sphobbies" class="control-label">Hobbies</label>
			<input type="text" class="form-control profilefield" id="sphobbies" name="sphobbies" value="<?php echo (isset($sphobbies)) ? $sphobbies : ''; ?>">
		</div>
	</div>


</div>


<div class="row">
	<div class="col-md-12" id="yourAddresRemove">
		<div class="form-group">
			<label for="spProfileAbout" class="control-label">Education</label>
			<textarea class="form-control" rows="3" id="Education" name="Education" value="<?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?>"><?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?></textarea>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" id="yourAddresRemove">
		<div class="form-group">
			<label for="spProfileAbout" class="control-label">About Myself</label>
			<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?>"><?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?></textarea>
		</div>
	</div>
</div>

<?php



//echo "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='".$rows['idspPostings']."' OR spProfile_idspProfile='".$_SESSION['pid']."'";

/*$query = mysqli_query($con,"SELECT * FROM userfamily WHERE spuserId='".$_SESSION['uid']."' AND spProfileId='".$_SESSION['pid']."'ORDER BY id DESC");*/
$query = mysqli_query($con, "SELECT * FROM userfamily WHERE spuserId='" . $_SESSION['uid'] . "' ORDER BY id DESC");

if (mysqli_num_rows($query) > 0) {

	/*$member = mysqli_fetch_assoc($query);*/


	?>



	<div class="row">
		<div class="col-md-12" id="Familylist">
			<label>Family Member</label>
			<input type="hidden" id="valid" value="<?php echo mysqli_num_rows($query); ?>">
			<table class="table  table-striped">
				<thead>
					<tr>
						<th>id </th>
						<th>Name</th>
						<th>Relation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="newfamily">
					<?php
					$m = 1;

					while ($member = mysqli_fetch_array($query)) {
//echo $member['id'];
//die('ssss');

						?>
						<tr id="deleterecord<?php echo $member['id'];  ?>">
							<td><?php echo $m; ?></td>
							<td id="name<?php echo $member['id'];  ?>"><?php echo ucwords($member['membername']); ?></td>
							<td id="relation<?php echo $member['id'];  ?>"><?php $rel = $member['memberrelation'];
							if ($rel == 0) {
								echo "No Relation";
							} else {
								echo ($rel);
							} ?></td>
							<td><a href="#" id="del_fam" onclick="delfam(<?php echo $member['id'];  ?>);"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;<a href="#" data-toggle="modal" data-target="#editfamilymember<?php echo $member['id'];  ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>


								<div id="editfamilymember<?php echo $member['id'];  ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content sharestorepos bradius-15">
											<div class="modal-header br_radius_top bg-white">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Edit Family Members</h4>
											</div>

											<form action="editfamily.php" method="POST" id="editfamilyfrm">

												<input type="hidden" id="spProfileId" value="<?php echo $_SESSION['pid']; ?>">
												<input type="hidden" id="spuserId" value="<?php echo $_SESSION['uid']; ?>">
												<input type="hidden" id="editid" value="<?php echo $member['id']; ?>">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="membername" class="control-label">Name</label>




																<input type="text" class='form-control' list="editsuggested_user" name="membername" id='editmembername<?php echo $member['id']; ?>' value="<?php echo $member['membername']; ?>" onInput="editgetuser(event,<?php echo $member['id']; ?>)">
																<datalist id="editsuggested_user"></datalist>

																<input type="hidden" name="memberprofileid" class="form-control" id="editmemberprofileid<?php echo $member['id']; ?>" value="<?php echo $member['id'] ?>">

																<span id="edit_fam_error<?php echo $member['id']; ?>" style="color:red;"></span>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="membername" class="control-label">Relation</label>
																<select name="memberrelation" id="editmemberrelation<?php echo $member['id']; ?>" class="form-control">
																	<option value="0" <?php if ($member['memberrelation'] == "") {
																		echo "selected";
																	} ?>>Choose relationship:</option>
																	<option value="Mother" <?php if ($member['memberrelation'] == "Mother") {
																		echo "selected";
																	} ?>>Mother</option>
																	<option value="Father" <?php if ($member['memberrelation'] == "Father") {
																		echo "selected";
																	} ?>>Father</option>
																	<option value="Daughter" <?php if ($member['memberrelation'] == "Daughter") {
																		echo "selected";
																	} ?>>Daughter</option>
																	<option value="Son" <?php if ($member['memberrelation'] == "Son") {
																		echo "selected";
																	} ?>>Son</option>
																	<option value="Sister" <?php if ($member['memberrelation'] == "Sister") {
																		echo "selected";
																	} ?>>Sister</option>
																	<option value="Brother" <?php if ($member['memberrelation'] == "Brother") {
																		echo "selected";
																	} ?>>Brother</option>
																	<option value="Auntie" <?php if ($member['memberrelation'] == "Auntie") {
																		echo "selected";
																	} ?>>Auntie</option>
																	<option value="Uncle" <?php if ($member['memberrelation'] == "Uncle") {
																		echo "selected";
																	} ?>>Uncle</option>
																	<option value="Niece" <?php if ($member['memberrelation'] == "Niece") {
																		echo "selected";
																	} ?>>Niece</option>
																	<option value="Nephew" <?php if ($member['memberrelation'] == "Nephew") {
																		echo "selected";
																	} ?>>Nephew</option>
																	<option value="Cousin" <?php if ($member['memberrelation'] == "Cousin") {
																		echo "selected";
																	} ?>>Cousin</option>
																	<option value="Grandmother" <?php if ($member['memberrelation'] == "Grandmother") {
																		echo "selected";
																	} ?>>Grandmother</option>
																	<option value="Grandfather" <?php if ($member['memberrelation'] == "Grandfather") {
																		echo "selected";
																	} ?>>Grandfather</option>
																	<option value="Granddaughter" <?php if ($member['memberrelation'] == "Granddaughter") {
																		echo "selected";
																	} ?>>Granddaughter</option>
																	<option value="Grandson" <?php if ($member['memberrelation'] == "Grandson") {
																		echo "selected";
																	} ?>>Grandson</option>
																	<option value="Stepsister" <?php if ($member['memberrelation'] == "Stepsister") {
																		echo "selected";
																	} ?>>Stepsister</option>
																	<option value="Stepbrother" <?php if ($member['memberrelation'] == "Stepbrother") {
																		echo "selected";
																	} ?>>Stepbrother</option>
																	<option value="Stepmother" <?php if ($member['memberrelation'] == "Stepmother") {
																		echo "selected";
																	} ?>>Stepmother</option>
																	<option value="Stepfather" <?php if ($member['memberrelation'] == "Stepfather") {
																		echo "selected";
																	} ?>>Stepfather</option>
																	<option value="Stepdaughter" <?php if ($member['memberrelation'] == "Stepdaughter") {
																		echo "selected";
																	} ?>>Stepdaughter</option>
																	<option value="Stepson" <?php if ($member['memberrelation'] == "Stepson") {
																		echo "selected";
																	} ?>>Stepson</option>
																	<option value="Sister-in-law" <?php if ($member['memberrelation'] == "Sister-in-law") {
																		echo "selected";
																	} ?>>Sister-in-law</option>
																	<option value="Brother-in-law" <?php if ($member['memberrelation'] == "Brother-in-law") {
																		echo "selected";
																	} ?>>Brother-in-law</option>
																	<option value="Mother-in-law" <?php if ($member['memberrelation'] == "Mother-in-law") {
																		echo "selected";
																	} ?>>Mother-in-law</option>
																	<option value="Father-in-law" <?php if ($member['memberrelation'] == "Father-in-law") {
																		echo "selected";
																	} ?>>Father-in-law</option>
																	<option value="Daughter-in-law" <?php if ($member['memberrelation'] == "Daughter-in-law") {
																		echo "selected";
																	} ?>>Daughter-in-law</option>
																	<option value="Son-in-law" <?php if ($member['memberrelation'] == "Son-in-law") {
																		echo "selected";
																	} ?>>Son-in-law</option>
																</select>
																<span id="edit_rel_error<?php echo $member['id']; ?>"></span>
															</div>
														</div>

													</div>
												</div>

												<div class="modal-footer bg-white br_radius_bottom">
													<button type="button" class="btn btn-default btn-border-radius db_btn db_orangebtn" data-dismiss="modal">Close</button>
													<button type="button" id="editfamilybtn" onclick="updatefamily(<?php echo $member['id']; ?>)" class="btn btn-default btn-border-radius db_btn db_primarybtn editfamilybtn">Submit</button>
												</div>

											</form>


										</div>
									</div>
								</div>


							</td>
						</tr>


						<?php
						$m++;
					}

					?>

				</tbody>
			</table>
<!-- <div class="form-group">
<label for="spProfileAbout" class="control-label">About Myself</label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout"><?php echo (isset($about) ? $about : ''); ?></textarea>
</div>	 -->
</div>
</div>
<?php } ?>

<?php
}
?>



<?php if ($readrows['idspProfileType'] == 2) {
	$pf = new _spfreelancer_profile;

	if (isset($_POST['pid'])) {
		$res = $pf->read($_POST["pid"]);
//echo $pf->ta->sql;
		if ($res != false) {
			$spProfileAbout    = "";
			while ($result = mysqli_fetch_assoc($res)) {
				if ($spProfileAbout == '') {

					$spProfileAbout = $result['spProfileAbout'];
					$spProfileeducation = $result['spProfileeducation'];
				}
			}
		}
	}

	?>



	<div class="row">
		<div class="col-md-12" id="yourAddresRemove">
			<div class="form-group">
				<label for="spProfileAbout" class="control-label">Education</label>
				<textarea class="form-control" rows="3" id="Education" name="Education" value="<?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?>"><?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?></textarea>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12" id="yourAddresRemove">
			<div class="form-group">
				<label for="spProfileAbout" class="control-label">About Myself</label>
				<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?>"><?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?></textarea>
			</div>
		</div>
	</div>








<?php } elseif ($readrows['idspProfileType'] == 3) {
	$ps = new _spprofessional_profile;


	if (isset($_POST['pid'])) {
		$res = $ps->read($_POST["pid"]);
//echo $pf->ta->sql;
		if ($res != false) {
			$spProfileAbout    = "";
			while ($result = mysqli_fetch_assoc($res)) {
				if ($spProfileAbout == '') {
					$spProfileAbout = $result['spProfileAbout'];
					$spProfileeducation = $result['spProfileeducation'];
					$sphobbies = $result['sphobbies'];
				}
			}
		}
	}

	?>

<!--<div class="row">
<div class="col-md-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Education</label>
<textarea class="form-control" rows="3" id="Education" name="Education" value="<?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?>"><?php echo (isset($spProfileeducation)) ? $spProfileeducation : ''; ?></textarea>
</div>	
</div>
</div-->



<?php  } elseif ($readrows['idspProfileType'] == 5) {
	$em = new _spemployment_profile;

	if (isset($_POST['pid'])) {
		$res = $em->read($_POST["pid"]);
//echo $pf->ta->sql;
		if ($res != false) {
			$spProfileAbout    = "";
			while ($result = mysqli_fetch_assoc($res)) {
				if ($spProfileAbout == '') {
					$spProfileAbout = $result['spProfileAbout'];
				}
			}
		}
	}

	?>

	<div class="row">
		<div class="col-md-12" id="yourAddresRemove">
			<div class="form-group">
				<label for="spProfileAbout" class="control-label">About Myself</label>
				<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?>"><?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?></textarea>
			</div>
		</div>
	</div>

<?php  } elseif ($readrows['idspProfileType'] == 6) {
	$fm = new _spfamily_profile;

	if (isset($_POST['pid'])) {
		$res = $fm->read($_POST["pid"]);
//echo $pf->ta->sql;
		if ($res != false) {
			$spProfileAbout    = "";
			while ($result = mysqli_fetch_assoc($res)) {
				if ($spProfileAbout == '') {
					$spProfileAbout = $result['spProfileAbout'];
				}
			}
		}
	}

	?>

	<div class="row">
		<div class="col-md-12" id="yourAddresRemove">
			<div class="form-group">
<!--<label for="spProfileAbout" class="control-label">About Myself555555</label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php //echo (isset($spProfileAbout))?$spProfileAbout: ''; 
?>"><?php //echo (isset($spProfileAbout))?$spProfileAbout: ''; 
?></textarea> -->
</div>
</div>
</div>

<?php  } else { ?>




<?php } ?>

<!-- <?php if ($readrows['idspProfileType'] == 3) { ?> 



<div class="row">
<div class="col-md-12" id="yourAddresRemove">
<div class="form-group">
<label for="spProfileAbout" class="control-label">About Myself</label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?>"><?php echo (isset($spProfileAbout)) ? $spProfileAbout : ''; ?></textarea>
</div>	
</div>
</div>
<?php } ?>-->

<!-- 	<div class="col-md-12" id="yourAddresRemove">
<div class="form-group">
<label for="spprofilesAddress" class="control-label">My Address</label>
<textarea class="form-control" rows="3" id="spprofilesAddress" name="spprofilesAddress"><?php echo (isset($address) ? $address : $useraddress); ?></textarea>
</div>	
</div> -->



<!--read Album images-->

<?php
$pc = new _postingalbum;
if (isset($_POST['pid'])) {
	$result = $pc->readimage($_POST["pid"]);
	if ($result != false) {
		echo "<p class='title' style='font-size:20px;margin-bottom:10px;'>Profile Pictures</p>";
		while ($rw = mysqli_fetch_assoc($result)) {
			$picture = $rw['spPostingMedia'];
			echo "<img alt='Posting Pic' class='img-thumbnail imagehover sppointer chosedefault' style='width:72px; height: 72px;' src='" . ($picture) . "' data-media='" . $rw['idspPostingMedia'] . "'>";
			echo "\x20\x20\x20";
		}
	}
}

?>
<div class="row m_btm_10">
	<?php
//$pf = new _profilefield;
	$pf = new _spbusiness_profile;
	$defaultbusiness 	= "";
	$defaultshowEmail 	= "";
	$defaultAddNews 	= "";
	$defaultShowPhone 	= "";
	$defaultLinkStore 	= "";
	$defaultLinkVideo 	= "";
	if (isset($_POST['pid'])) {
		$res = $pf->read($_POST["pid"]);
		if ($res == "") {
			$result = "";
		} else {
			while ($result = mysqli_fetch_assoc($res)) {

				$defaultbusiness = $result['defaultbusiness'];
				$defaultshowEmail = $result['showEmailProfile'];
				$defaultAddNews = $result['showAddNews'];
				$defaultShowPhone = $result['showPhoneProfile'];
				$defaultLinkStore = $result['showLinkStore'];
				$defaultLinkVideo = $result['showLinkVideo'];
			}
		}
/*
if($res != false){
$defaultbusiness 	= "";
$defaultshowEmail 	= "";
$defaultAddNews 	= "";
$defaultShowPhone 	= "";
$defaultLinkStore 	= "";
$defaultLinkVideo 	= "";

while($result = mysqli_fetch_assoc($res)){
$row[$result["spProfileFieldLabel"]] = $result["spProfileFieldValue"];

if($defaultbusiness == ''){
if($result['spProfileFieldName'] == 'defaultbusiness_'){
echo $defaultbusiness = $result['spProfileFieldValue'];
}
}
if($defaultshowEmail == ''){
if($result['spProfileFieldName'] == 'showEmailProfile_'){
$defaultshowEmail = $result['spProfileFieldValue']; 
}
}
if($defaultAddNews == ''){
if($result['spProfileFieldName'] == 'showAddNews_'){
$defaultAddNews = $result['spProfileFieldValue']; 
}
}
if($defaultShowPhone == ''){
if($result['spProfileFieldName'] == 'showPhoneProfile_'){
$defaultShowPhone = $result['spProfileFieldValue']; 
}
}
if($defaultLinkStore == ''){
if($result['spProfileFieldName'] == 'showLinkStore_'){
$defaultLinkStore = $result['spProfileFieldValue']; 
}
}
if($defaultLinkVideo == ''){
if($result['spProfileFieldName'] == 'showLinkVideo_'){
$defaultLinkVideo = $result['spProfileFieldValue']; 
}
}
}
}
*/
}

?>
<div class="col-md-6">
	<!--profile Album Code Done-->
	<div class="checkbox hidden" id="defaultbusiness">

		<label><input type="checkbox" id="servicebusiness" name="defaultbusiness" value="1" <?php echo (isset($defaultbusiness) && $defaultbusiness == 1) ? 'checked' : ''; ?>>

			Publish in Business Space
		</label>
	</div>

</div>
<div class="col-md-6">
	<div class="checkbox hidden" id="defaultshowEmail">
		<label><input type="checkbox" id="showEmail" name="showEmailProfile" value="1" <?php echo (isset($defaultshowEmail) && $defaultshowEmail == 1) ? 'checked' : ''; ?>>Show email on profile</label>
	</div>
</div>
<div class="col-md-6">
<!-- <div class="checkbox hidden" id="defaultAddNews">
<label><input type="checkbox" id="addnews" name="showAddNews" value="1" <?php echo (isset($defaultAddNews) && $defaultAddNews == 1) ? 'checked' : ''; ?>>Add news</label>
</div> -->
</div>
<div class="col-md-6">
	<div class="checkbox hidden" id="defaultShowPhone">
		<!-- <label><input type="checkbox" id="showPhone" value="1" name="showPhoneProfile" <?php echo (isset($defaultShowPhone) && $defaultShowPhone == 1) ? 'checked' : ''; ?>>Show phone on profile</label> -->
	</div>
</div>
<div class="col-md-6">
	<div class="checkbox hidden" id="defaultLinkStore">
		<!-- <label><input type="checkbox" id="LinkStore" value="1" name="showLinkStore" <?php echo (isset($defaultLinkStore) && $defaultLinkStore == 1) ? 'checked' : ''; ?>>Link store</label> -->
	</div>
</div>
<div class="col-md-6">
	<div class="checkbox hidden" id="defaultLinkVideo">
		<!-- <label><input type="checkbox" id="LinkVido" value="1" name="showLinkVideo" <?php echo (isset($defaultLinkVideo) && $defaultLinkVideo == 1) ? 'checked' : ''; ?>>Link video/training</label> -->
	</div>
</div>

<!---
<input type="hidden" class="<?php echo (isset($defaultbusiness) && $defaultbusiness == 1) ? 'selected' : 'select'; ?> profilefield" id="checkbusiness" name="defaultbusiness" 	value="<?php echo (isset($defaultbusiness)) ? $defaultbusiness : 0; ?>"  >
<input type="hidden" class="<?php echo (isset($defaultshowEmail) && $defaultshowEmail == 1) ? 'selected' : 'select'; ?> profilefield" id="showEmailProfile" name="showEmailProfile_"	value="<?php echo (isset($defaultshowEmail)) ? $defaultshowEmail : 0; ?>" >
<input type="hidden" class="<?php echo (isset($defaultAddNews) && $defaultAddNews == 1) ? 'selected' : 'select'; ?> profilefield" id="checkAddNews" 	name="showAddNews" 		value="<?php echo (isset($defaultAddNews)) ? $defaultAddNews : 0; ?>" >
<input type="hidden" class="<?php echo (isset($defaultShowPhone) && $defaultShowPhone == 1) ? 'selected' : 'select'; ?> profilefield" id="checkPhone" 	name="showPhoneProfile" 	value="<?php echo (isset($defaultShowPhone)) ? $defaultShowPhone : 0; ?>" >
<input type="hidden" class="<?php echo (isset($defaultLinkStore) && $defaultLinkStore == 1) ? 'selected' : 'select'; ?> profilefield" id="checkLinkstore" name="showLinkStore" 		value="<?php echo (isset($defaultLinkStore)) ? $defaultLinkStore : 0; ?>" >
<input type="hidden" class="<?php echo (isset($defaultLinkVideo) && $defaultLinkVideo == 1) ? 'selected' : 'select'; ?> profilefield" id="checkLinkVideo" name="showLinkVideo" 		value="<?php echo (isset($defaultLinkVideo)) ? $defaultLinkVideo : 0; ?>" >
---->

</div>
<style>
	.row.profile {
		margin-right: -8px;
	}

	@media only screen and (max-width: 700px) {
		.md12 {
			margin-right: 0px !important;
		}
	}

</style>
<div class="row profile">

	<button type="button" id="idupdate" class="btn butn_cancel btn-submit pull-right addprofile db_primarybtn btn-border-radius <?php echo (isset($_POST["pid"]) ? "editing" : ""); ?> "><?php echo (isset($_POST["pid"]) ? "Update" : "Create Profile"); ?></button>
	<a href="../my-profile" class="btn butn_cancel pull-right db_btn md12 btn-border-radius" style="margin-right: 5px;">Cancel</a>



	<?php 
//if(isset($_POST["ptid"]) && $_POST["ptid"] != 5){
	if ($readrows['idspProfileType'] != 4) {
//deleteProfile.php/?profileid=<?php echo $_POST["pid"];
		?>
		<a href="javascript:void(0)" class=" md12 btn butn_cancel db_btn pull-right btn-border-radius <?php echo (isset($_POST["pid"]) ? "" : "hidden"); ?> " id="deleteprofile1" style="margin-right: 5px;background-color:red;"  onclick='del_profile("<?php echo $_POST["pid"]; ?>");'> Delete Profile </a>
		<?php
	}
//}
	?>
</div>
</div>

</form>
</div>
</div>


<!--script type="text/javascript">
document.getElementById("idupdate").onclick = function () {
var details=document.getElementById('details_').innerHTML;
if(details=='')
{
return false; 	 

}
}
</script-->

<script type="text/javascript">
	document.getElementById("idupdate").onclick = function() {


	}
</script>


<script type="text/javascript">
	$(document).ready(function() {
/*$('.profiletypes-dd').on('change', function() {
//var show=$('.profiletypes-dd').val();
//alert(show);
if ( this.value == 1)
//.....................^.......
{
$("#welcomeDiv").show();
}

});*/

	});

	function showDiv() {
		document.getElementById('welcomeDiv').style.display = "block";
	}

	$(".op_user").click(function() {
/*$('#suggested_user option').filter(function() { 
var pid == this.value;
}).data("id");*/

// alert(pid);

	});

/*    $('#membername').change(function() {

var x = $(this).find(':selected').data('id');

$('#memberprofileid').val(x);
});

$('#editmembername').change(function() {

var x = $(this).find(':selected').data('id');

$('#editmemberprofileid').val(x);
});

*/

//deleteProfile.php/?profileid=php echo $_POST["pid"];

	function del_profile(famid) {

		swal({
			title: "Are you sure?",

			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes, delete it!',
			closeOnConfirm: false,
//closeOnCancel: false

		},
		function(){

			$.ajax({
				url: "deleteProfile.php",
				type: "GET",
				data: 'profileid=' + famid,
				success: function(vi) {
					window.location.reload();

				}

			});
		});

	}



	function delfam(famid) {

		swal({
			title: "Are you sure you want Delete?",
			type: "warning",
			confirmButtonClass: "sweet_ok btn-danger",
			confirmButtonColor: "red",
			confirmButtonText: "Yes, Please",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		}, function(isConfirm) {

//alert(orderId);
			if (isConfirm) {
				$.ajax({
					url: "deletefamily.php",
					type: "POST",
					data: 'id=' + famid,
					success: function(vi) {

						swal({


							title: "Family Member Deleted Successfully!",
							type: 'success',
							showConfirmButton: true

						},
						function() {

$("#deleterecord" + famid + "").html(""); //window.location.reload();

});

//window.location.reload();
//alert(vi);
//$('#update_gallery').html(vi);
					},
					error: function(error) {

					}
				});
			}

		});




	}

	$("#addfamily").click(function(e) {
//alert('========');
/* var name = $('input[name="membername[]"]').map(function(){ 
var name= this.value; 
}).get();

console.log(name);


*/

		var n = $("input[name^='membername[]']").length;

/*var array = $("input[name^='membername[]']");


for(i=0;i<n;i++)
{
//card_value=  array[i].val();
name=  array.eq(i).val(); //gets jquery object at index i

//alert(card_value);
var name_err = 0;
if(name==""){
var name_err=1;
}
}*/

//alert(name);
		var family_status = true;
		var name = $('input[name="membername[]"]').map(function() {
			if (this.value) {
				return this.value;
			} else {
				family_status = false;
				return this.value;

			}

		}).get();
		if (family_status == false) {
			alert("Please fill name field.");
			return false;
		}

		var name_err = 0;
		if (name == "") {
			var name_err = 1;
		}

		var mem_err = 0;

		var m = $('select[name="memberrelation[]"] option:selected').each(function() {
			var mem_name = ($(this).val());
//alert(m);
/*if (mem_name == "") {
alert("Please fill relation field.");
return false;
e.preventDefault();
var mem_err = 1;
}*/
		});




/*
var mem_err = 0;

var m = $("select[name^='memberrelation[]']").length;
//	 alert(m);
//var array1 = $("input[name^='memberrelation[]']");
for(i=0;i<m;i++)
{
//card_value=  array[i].val();
var mem_name = ($(this).val()); //gets jquery object at index i
if(mem_name==""){
alert("Please fill relation field.");
return false;
e.preventDefault();
var mem_err=1;
}

}
*/


		var relation_status = true;
		var relation = $('select[name="memberrelation[]"]').map(function() {
			if (this.value) {
				return this.value;
			} else {
				relation_status = false;
				return this.value;
			}
		}).get();

		if (relation_status == false) {
			alert("Please fill relation field.")
			return false;
		}



		var spProfileId = $("#spProfileId").val();
		var spuserId = $("#spuserId").val();
		var memberprofileid = $("#memberprofileid").val();
//alert(memberprofileid);
		var id = $("#valid").val();
///alert(memberprofileid);



		var flag = 0;

		if (name != "") {
			var strArr = new Array();
//strArr = name.split("");

//if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
//{
//flag=1;
//	}


		}



		if (name_err == 1) {
			alert("Please fill Name field.");
			return false;
		} else {
//alert("1");
			$.ajax({
				url: "addfamily.php",
				type: "POST",
				data: 'id=' + id + '&membername=' + name + '&memberrelation=' + relation + '&spProfileId=' + spProfileId + '&spuserId=' + spuserId + '&memberprofileid=' + memberprofileid,
				success: function(vi) {


					swal({

						title: "Family Member Added Successfully!",
						type: 'success',
						showConfirmButton: true

					},
					function() {
//alert(vi);
						$("#newfamily").append(vi);
//	$("#newfamily").append("<tr><td>"+id+"</td><td>"+name+"</td><td>"+relation+"</td><td><a href='#' id='del_fam' onclick='delfam("+vi+");'><i class='fa fa-trash' aria-hidden='true' ></i></a>&nbsp;<a href='#'  data-toggle='modal' data-target='#editfamilymember"+vi+"'><i class='fa fa-pencil' aria-hidden='true'></i></a></td></tr>");

						document.getElementById("btn-close").click();
						document.getElementById("membername").value = "";
						document.getElementById("memberrelation").value = "";
					});

//window.location.reload();
//alert(vi);
//$('#update_gallery').html(vi);
				},
				error: function(error) {

				}
			});
		}



	});


	function updatefamily(editid) {

//alert(editid);
		var name = $("#editmembername" + editid).val();
		var relation = $("#editmemberrelation" + editid).val();
		var spProfileId = $("#spProfileId").val();
		var spuserId = $("#spuserId").val();
		var memberprofileid = $("#editmemberprofileid" + editid).val();
//alert(name);

//alert(memberprofileid);
//alert(name);
/*var editid  = $("#editid").val();*/

//alert(editid);

/*alert(name);
alert(relation);
alert(editid);*/



		var flag = 0;

		if (name != "") {
//alert(name);
//alert(relation);
			var strArr = new Array();
			strArr = name.split("");

if (strArr[0] == " ") // this is the the key part. you can do whatever you want here!
{
	flag = 1;
}


}

if (name == "" && relation == "0") {
//alert(name);
//alert(relation);

//alert("here");
	$("#edit_fam_error" + editid).text("Please Select Name.");
	$("#edit_rel_error" + editid).text("Please Select Relation.");

} else if (flag == 1) {

//alert("here1");
	$("#edit_fam_error" + editid).text("Space Not Allowed.");


} else if (name == "" && relation != "0") {

//alert("here2");
	$("#edit_fam_error" + editid).text("Please Select Name.");
	$("#edit_rel_error" + editid).text("");

} else if (relation == "0" && name != "") {

//alert("here3");
	$("#edit_fam_error" + editid).text("");
	$("#edit_rel_error" + editid).text("Please Select Relation.");

} //else if(memberprofileid == "" ){

//alert(memberprofileid);
//$("#edit_fam_error"+editid).text("Please Select Correct User Name.");


//}
	else {


		$.ajax({
			url: "editfamily.php",
			type: "POST",
			data: 'membername=' + name + '&memberrelation=' + relation + '&spProfileId=' + spProfileId + '&spuserId=' + spuserId + '&editid=' + editid + '&memberprofileid=' + memberprofileid,
			success: function(vi) {
//alert(relation);
				$(".db_orangebtn").click();
				$("#name" + editid + "").text(name);
				$("#relation" + editid + "").text(relation);

				swal({


					title: "Family Member Updated Successfully!",
					type: 'success',
					showConfirmButton: true

				},
				function() {

//window.location.reload();

				});

			},
//error: function(error){


		});

	}




}



/*
$(".editfamilybtn").on( "click", function(){


var editid  = $("#editid").val();
var name = $("#editmembername"+editid).val();
var relation = $("#editmemberrelation"+editid).val();
var spProfileId  = $("#spProfileId").val();
var spuserId  = $("#spuserId").val();


alert(name);
alert(relation);
alert(editid);

//var editid  = $("#editid").val();


var flag=0;

if (name!="")
{
var strArr = new Array();
strArr = name.split("");

if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
{
flag=1;
}


}

if(name == "" && relation == "0"){
$("#edit_fam_error").text("Please Enter Name.");
$("#edit_rel_error").text("Please Select Relation.");

}else if(flag == 1){

$("#edit_fam_error").text("Space Not Allowed.");

}else if(name == "" && relation != "0" ){


$("#edit_fam_error").text("Please Enter Name.");
$("#edit_rel_error").text("");

}else if(relation == "0" && name != "" ){

$("#edit_fam_error").text("");
$("#edit_rel_error").text("Please Select Relation.");

}else{


$.ajax({
url: "editfamily.php",
type: "POST",
data:  'membername='+name+'&memberrelation='+relation+'&spProfileId='+spProfileId+'&spuserId='+spuserId+'&editid='+editid,
success: function(vi){


swal({


title: "Family Member Updated Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});

},
error: function(error){

}          
});

}


});

*/

function getuser(event) {

//var address = $("#address").val();
	const name = event.target.value;

	var Profile_id = $("#spProfileId").val();
//alert(name);

	$.ajax({
		type: "POST",
		url: "getuser.php",
		cache: false,
		data: {
			'name': name,
			'pid': Profile_id
		},
		success: function(data) {

//console.log(data);
			$("#suggested_user").html(data);

			var pid = $("#suggested_user option[value='" + $('#membername').val() + "']").attr('data-id');

//$("#memberprofileid").val(pid);

/*var obj = JSON.parse(data);
//console.log(obj.address);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');

$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);
*/

		}
	});



}


function editgetuser(event, edit_id) {

//var address = $("#address").val();
	var name = event.target.value;

	var Profile_id = $("#spProfileId").val();
//alert(name);

	$.ajax({
		type: "POST",
		url: "getuser.php",
		cache: false,
		data: {
			'name': name,
			'pid': Profile_id
		},
		success: function(data) {




//alert($('#editmembername').val());

//var mebername = $('#editmembername'+edit_id).val();

// alert(mebername);
//  alert(edit_id);
//alert('#editmembername'+edit_id);



//console.log(data);
			$("#editsuggested_user").html(data);

			var pid = $("#editsuggested_user option[value='" + $('#editmembername' + edit_id).val() + "']").attr('data-id');
			var mname = $("#editsuggested_user option[value='" + $('#editmembername' + edit_id).val() + "']").attr('value');

// $('#input').val("GeeksForGeeks"); 
			$("#editmemberprofileid" + edit_id).val(pid);
//$('#editmembername'+edit_id).val("");
			if (!empty(mname)) {

				$('#editmembername' + edit_id).val(mname);
			}

/*editmembername*/

/*var obj = JSON.parse(data);
//console.log(obj.address);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');

$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);
*/

		}
	});



}


function getaddress() {

	var address = $("#address").val();

	$.ajax({
		type: "POST",
		url: "../address.php",
		cache: false,
		data: {
			'address': address
		},
		success: function(data) {

			var obj = JSON.parse(data);
			console.log(obj.address);

			$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


			$("#latitude").val(obj.latitude);
			$("#longitude").val(obj.longitude);

		}
	});
}

$(".op_address").on("click", function() {

	var addre = $(this).val();
	$("#address").val(addre);

});
/*$("#idupdate").on("click", function() {
var aa = $("#hourlyrate_").val();
var bb = $("#profiletype_").val();
var cc = $("#skill_").val();
var dd = $("#certification_").val();


if((aa=="") || (bb==0) || (cc=="") || (dd=="")){
if(aa!="")
{
$("#span4").html('');
}
else{

$("#span4").html('Please fill Field');

}
if(bb!="")
{
$(".error_category ").html("");
}
else{

$(".error_category ").html("Please fill Field ");

}
if(cc!="")
{
$(".error_skills").html("");
}
else{

$(".error_skills").html("Please fill Field ");

}
if(dd!="")
{
$(".error_certification").html("");
}
else{

$(".error_certification").html("Please fill Field ");

}

return false;

}



});*/


/*	$('#idupdate').on('click',function(){  
var aa=$('#highlights_').val();
if(aa!='')
{
alert('okkkk');
}
else{
alert('not okkkk');
return false;
}
*/
</script>
<script>
/*	function closemodal(){

}*/
</script>

<script>
	$(document).ready(function() {

		$('#idupdate').click(function() {
//var aa1=$("#category_").val();
//var bb2=$("#highlights_").val();
//var cc3=$("#details_").val();
			var img = $('#profilepic').attr("src");
//var img = $('#profilepic').attr('src');       
//alert(aa);   

			$('#imgInp').val(img);

/*if((aa1=="0") || (bb2=="") || (cc3=="")){
alert('==55');
if(aa1=="0"){
//alert('==');
$("#error_c").html('This field is required.');
}else{
$("#error_c").html('');

}

if(bb2==""){
$("#error_h").html('This field is required.');
}
else{
$("#error_h").html('');

}

if(cc3==""){
$("#erros").html('This field is required.');
}else{
$("#erros").html('');

}
return false;

}*/






		});


	});


</script>


