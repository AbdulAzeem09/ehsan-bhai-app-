<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../univ/baseurl.php');
include("../univ/main.php");
require_once('../helpers/image.php');
session_start();

/* print_r($_SESSION);*/
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-profile/";
	include_once("../authentication/check.php");
} else {


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$u = new _spuser;
	$base = $_SERVER['DOCUMENT_ROOT'];
	// require_once '../library/config.php';
	/*require_once '../library/config.php';
    require_once '../library/functions.php';*/
	//$conn = _data::getConnection();
	$con = mysqli_connect(DBHOST, UNAME, PASS);

	if (!$con) {
		die('Not Connected To Server');
	}

	//Connection to database
	if (!mysqli_select_db($con, DBNAME)) {
		echo 'Database Not Selected';
	}

	//print_r($_FILES); exit;
	/*print_r($_POST);
exit;
*/


	$spProfile_idspProfile = $_POST['spProfile_idspProfile'];
  if(isset($_POST['spUserEmail'])){
    $spUserEmail = $_POST['spUserEmail'];
  } else {
    echo "Invalid Email";die;
  }
  if(isset($_POST['spUserPhone'])){
    $spUserPhone = $_POST['spUserPhone'];
  } else {
    echo "Invalid Phone";die;
  }
	$address = $_POST['address'];

	/*print_r($spProfile_idspProfile);
*/


	$uid = $_POST['uid'];
	/*$membername = $_POST['membername'];
$memberrelation = $_POST['memberrelation'];
$memberprofileid = $_POST['memberprofileid'];*/

	/*$array = explode('.', $file);
$fileName=$array[0];
$fileExt=$array[1];
$newfile=$fileName."_".time().".".$fileExt;*/

    $image = new Image;
    $image->validateFileImageExtensions($_FILES["uploadidentity"]);
   

    $image->validateFileImageExtensions($_FILES["uploadidentity1"]);
   
	$filename = time() . $_FILES["uploadidentity"]['name'];

	if (!empty($_FILES["uploadidentity1"]["name"])) {
		$filename1 = time() . $_FILES["uploadidentity1"]['name'];
		if (move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $base . '/upload/user/user_id/' . $filename1)) {
			
			$sql1 = "UPDATE useridentity SET upload_spfile = '$filename1',status=0 WHERE id =" . $_POST["up_id"];

			$result = mysqli_query($con, $sql1);
			if ($result) {
				
			}
			echo "hello";
		}
	} else {
		echo "bad";
	}

	//print_r($filename);
	if (isset($_POST["isupdate"]) && $_POST["isupdate"] == 1) {
		if ($_FILES['uploadidentity']['error'] == 4) {
			$filename = $_POST["idimage"];
			$sql = "UPDATE useridentity SET spProfile_idspProfile = '$spProfile_idspProfile', uid= '$uid', idimage='$filename', created_on=curdate(), spUserPhone='$spUserPhone',spUserEmail='$spUserEmail', address='$address' WHERE id =" . $_POST["up_id"];
		} else {
			//$filename = $_POST["idimage"];
			//unlink($BaseUrl . '/upload/user/user_id/'. $filename);
			$base = $_SERVER['DOCUMENT_ROOT'];
			if (move_uploaded_file($_FILES['uploadidentity']['tmp_name'], $base . '/upload/user/user_id/' . $filename)) {


				$sql = "UPDATE useridentity SET spProfile_idspProfile = '$spProfile_idspProfile', uid= '$uid', idimage='$filename', created_on=curdate(), spUserPhone='$spUserPhone',spUserEmail='$spUserEmail', address='$address' WHERE id =" . $_POST["up_id"];
				//echo "hereimage";
				if (!mysqli_query($con, $sql)) {
					echo 'Could not insert';
				} else {
					echo "Thank you";
				}
			} else {

				echo "Not Uploaded";
			}
		}

		$u->update(array("spUserEmail" => $spUserEmail, "spUserAddress" => $_POST["address"]), $uid);
	} else {
		if (move_uploaded_file($_FILES['uploadidentity']['tmp_name'], $base . '/upload/user/user_id/' . $filename)) {
			if (!empty($_FILES["uploadidentity1"]["name"])) {
				$filename1 = time() . $_FILES["uploadidentity1"]['name'];
				move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $base . '/upload/user/user_id/' . $filename1);
			} else {
				$filename1="";
				echo "bad";
			}


			$sql   = "INSERT INTO useridentity (spProfile_idspProfile, uid, idimage,upload_spfile, created_on, spUserPhone, spUserEmail, address) VALUES ('$spProfile_idspProfile','$uid','$filename','$filename1', curdate(),'$spUserPhone', '$spUserEmail', '$address')";

			if (!mysqli_query($con, $sql)) {
				echo 'Could not insert';
			} else {
				echo "Thank you";
			}
		} else {

			echo "Not Uploaded";
		}
	}

	/*print_r($userid);*/

	//$sql   = "INSERT INTO userfamily (spuserId, spProfileId, membername,memberrelation,memberprofileid) VALUES ('$spuserId','$spProfileId','$membername' ,'$memberrelation','$memberprofileid')";

	/*$result = dbQuery($con, $sql);*/



	/*if (!mysqli_query($con, $sql)) {
		echo 'Could not insert';
	} else {
		echo "Thank you";
	}*/
}
