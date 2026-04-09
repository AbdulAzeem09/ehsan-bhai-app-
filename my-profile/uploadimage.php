<?php

//die("---------xxxxxxx---------");
//die('======');
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spprofiles;

//print_r($_FILES); die('======');


$result = $p->readawskey();

$row = mysqli_fetch_array($result);
$key_name = $row['key_name'];
$secret_name = $row['secret_name'];


$result1 = $p->readawskeyagain($ids = 12);

$row1 = mysqli_fetch_array($result1);
$region_name = $row1['region_name'];
$bucketName = $row1['bucketName'];

include $_SERVER["DOCUMENT_ROOT"] . '/aws/aws-autoloader.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
	'version' => 'latest',
	'region' => $region_name,
	'credentials' => [
		'key'    => $key_name,
		'secret' => $secret_name
	]
]);


/*print_r($_POST);*/
if (!empty($_FILES['files'])) {
	$countfiles = count($_FILES['files']['name']);
	$upload_location = '../uploadimage/';
	$files_arr = array();
	for ($index = 0; $index < $countfiles; $index++) {

		if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
			$filename = $_FILES['files']['name'][$index];
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$valid_ext = array("png", "jpeg", "jpg");
			if (in_array($ext, $valid_ext)) {
				$path = $upload_location . $filename;
				if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
					$files_arr[] = $path;
				}
			}
		}
	}
}
$file_Path4 = $path;

$key = random_int(1000000000, 9999999999);

try {
	$result = $s3->putObject([
		'Bucket' => $bucketName,
		'Key'    => $key,
		'Body'   => fopen($file_Path4, 'r'),
		'ACL'    => 'public-read',
	]);
	//  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
	echo "There was an error uploading the file.\n";
	echo $e->getMessage();
}

$data = 'https://' . $bucketName . '.s3.' . $region_name . '.amazonaws.com/' . $key;
//echo $data;
unlink($file);



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//$sppictures=$p->insertpics($data);

//die("---------yyyyyyy---------");

$img = $_POST["spprofilePic"];
$img = str_replace("data:image/" . $_POST["ext"] . ";base64,", "", $img);
$img = str_replace(" ", "+", $img);
//	$data = base64_decode($img);

$p->updateprofilepic2($_POST["profileid"], $data);


if($_POST["profileid"]==''){

	$ptid=$_POST["ptid"];
	$data = 'https://' . $bucketName . '.s3.' . $region_name . '.amazonaws.com/' . $key;
	$_SESSION['profile_pic']=$data;
 /*$arr=array(
      "ptid"=>$ptid,
	  "image"=>$data

 );*/
//	$p->create_image($arr);
}

//Upload image in media using album
$album = new _album;
$media = new _postingalbum; //Create media 
$result = $album->readimagealmb($_POST["profileid"]);

if ($result != false) {
	$row = mysqli_fetch_assoc($result);
	$albumid = $row["idspPostingAlbum"];          
	echo $row["spProfilePic"];
}
//echo $albumid;
//die();
if ($_POST["mediaid"] == 0) {
	$media->profileimg($_POST["profileid"], $data, $albumid);
}
