<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();
include '../univ/baseurl.php';
 

$BaseUrl1 = $_SERVER["DOCUMENT_ROOT"];

include_once($BaseUrl1 . '/mlayer/_data.class.php');
include_once($BaseUrl1 . '/mlayer/_tableadapter.class.php');
include_once($BaseUrl1 . '/mlayer/_storebanner.class.php');
include_once($BaseUrl1 . '/mlayer/_redirect.class.php');




$b = new _storebanner;


$keyresult = $b->readawskey();
$keyrow = mysqli_fetch_array($keyresult);
$key_name = $keyrow['key_name'];
$secret_name = $keyrow['secret_name'];

$bucketresult = $b->readawskeyagain(2);
$bucketrow = mysqli_fetch_array($bucketresult);
$region_name = $bucketrow['region_name'];
$bucketName = $bucketrow['bucketName'];

include $BaseUrl1 . '/aws/aws-autoloader.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
	'version' => 'latest',
	'region' => $region_name,
	'credentials' => [
		'key'    => $key_name,
		'secret' => $secret_name
	]
]);


$upload_location = '../uploadimage/';
if (isset($_FILES['combannerfile']['name']) && $_FILES['combannerfile']['name'] != '') {

	$filename = $_FILES['combannerfile']['name'];
	$fpath = $upload_location . $filename;
	move_uploaded_file($_FILES['combannerfile']['tmp_name'], $fpath);
}


$file_Path4 = $path;

$bankey = random_int(1000000000, 9999999999);

try {
	$result = $s3->putObject([
		'Bucket' => $bucketName,
		'Key'    => $bankey,
		'Body'   => fopen($fpath, 'r'),
		'ACL'    => 'public-read',
	]);
} catch (Aws\S3\Exception\S3Exception $e) {
	echo "There was an error uploading the file.\n";
	echo $e->getMessage();
}

$data = 'https://' . $bucketName . '.s3.' . $region_name . '.amazonaws.com/' . $bankey;
unlink($fpath);



$ban=$b->readbanner($_POST["profileid"]);

if ($ban) {
	$b->updatebannerpic_store($_POST["profileid"], $data);
} else {

	$b->create(array("idspProfiles" => $_POST["profileid"], "idspUser" => $_POST["userid"], "company_banner" => $data));
}


$profid = $_POST["profileid"];
//echo "1"   https://dev.thesharepage.com/store/my-all-product.php?userid=997
$re = new _redirect;
$redirctUrl = "my-all-product.php";
//$re->redirect($redirctUrl);

//echo $b->ta->sql;
$b = new _storebanner;
$result2  = $b->getStoreBannerByProfileId($_SESSION['pid']);
if ($result2 != false) {
	$bannerrow = mysqli_fetch_assoc($result2);
	$bannerpicture = $bannerrow["spStorebanner"];
	echo $bannerpicture;
}

//$re->redirect($redirctUrl);
header('location:'.$BaseUrl.'/store/my-all-product.php?userid='.$profid);