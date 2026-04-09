<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _eventpic;

$result = $p->readawskey();

$row = mysqli_fetch_array($result);
$key_name = $row['key_name'];
$secret_name = $row['secret_name'];	


$result1 = $p->readawskeyagain($ids=6);

$row1 = mysqli_fetch_array($result1);
$region_name = $row1['region_name']; 
$bucketName = $row1['bucketName'];		

include $_SERVER['DOCUMENT_ROOT'].'/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;
$s3 = new S3Client([
'version' => 'latest',
'region' => $region_name,
'credentials' => [
'key'    => $key_name,
'secret' => $secret_name
]
]);

//echo "<pre>";
//print_r($_FILES);
//exit;

/*print_r($_POST);*/
if($_FILES['files']['name']){
$countfiles = count($_FILES['files']['name']);
$upload_location = '../uploadimage/';
$files_arr = array();
for($index = 0;$index < $countfiles;$index++){

if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){
$filename = $_FILES['files']['name'][$index];
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$valid_ext = array("png","jpeg","jpg");
if(in_array($ext, $valid_ext)){
$path = $upload_location.$filename;
if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
$files_arr[] = $path;
}
}

}


$file_Path4 = $path ;

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

echo  $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;
//echo $data;
unlink($file_Path4);



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['spFeatureimg'])){
$FeatureImg = $_POST['spFeatureimg'];
}else{
$FeatureImg = 0;
}

//echo $_POST['postedit']. '--'.$_POST['del'];

if(isset($_POST['postedit']) && $_POST['postedit'] == true){
if (isset($_POST['del'])) {
if($_POST['del'] == 0){
$postid = $_POST['spPostings_idspPostings'];
$result = $p->removePostPic($postid);
}
}

/*print_r($_POST["spPostings_idspPostings"]);
print_r($data);
print_r($FeatureImg);*/
//$p->create($_POST["spPostings_idspPostings"], $data);
$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
//echo $p->ta->sql;
echo $_POST["spPostings_idspPostings"];


}else{
//$p->create($_POST["spPostings_idspPostings"], $data);
//print_r($_POST["spPostings_idspPostings"]);
/*print_r($data);
print_r($FeatureImg);*/


$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
//echo $p->ta->sql;
echo $_POST["spPostings_idspPostings"];
}

}
}


if($_FILES['Gallery']['name']){
$countGallery = count($_FILES['Gallery']['name']);

$files_arrr = array();
$upload_loc = '../uploadimage1/';
for($indx = 0;$indx < $countGallery;$indx++){

$filenm = $_FILES['Gallery']['name'][$indx];

$paths = $upload_loc.$filenm;
if(move_uploaded_file($_FILES['Gallery']['tmp_name'][$indx],$paths)){
$files_arrr[] = $paths;

}





$file_Path5 = $paths ;

$keys = random_int(1000000000, 9999999999);

try {
$result = $s3->putObject([
'Bucket' => $bucketName,
'Key'    => $keys,  
'Body'   => fopen($file_Path5, 'r'),
'ACL'    => 'public-read',
]);
//  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
echo "There was an error uploading the file.\n";
echo $e->getMessage();
}
$datagallery='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$keys;

unlink($file_Path5);

$postid1 = $_POST['spPostings_idspPostings'];
$GalleryArray = array(
"post_id"=>$postid1,
"image_name"=>$datagallery
);
$f = new _spevent;
$f->createGallery($GalleryArray);

}
}

?>