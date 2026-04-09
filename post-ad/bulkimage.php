<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include('../univ/baseurl.php');
session_start();
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

$countfiles = count($_FILES['spPostingPic']['name']);
//	$upload_location = '../uploadimage/';
$upload_location = $_SERVER['DOCUMENT_ROOT'].'/store/bulkimport/';
$files_arr = array();
for($index = 0;$index < $countfiles;$index++){

if(isset($_FILES['spPostingPic']['name'][$index]) && $_FILES['spPostingPic']['name'][$index] != ''){
$filename = $_FILES['spPostingPic']['name'][$index];
// echo $filename."<br>";
// $filename = chop($filename , ".png || .jpeg || .jpg" );
// echo $filename."<br>";

$array = explode('.', $filename);

$array1 = $array[0];
if (str_contains($array1, '-')) { 
$array2 = explode('-', $array1);
$filenames1 = $array2[0];

$po = new _productposting;

$result_fel = $po->read_sku($filenames1); 												if($result_fel!=false){  
$row = mysqli_fetch_assoc($result_fel);
$product_id =  $row['idspPostings'];
// echo $product_id; die("----------------");
}} else {
$po = new _productposting;

$result_fel = $po->read_sku($array1); 
if($result_fel!=false){
$row = mysqli_fetch_assoc($result_fel);  
}
$product_id =  $row['idspPostings'];

} 




$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$valid_ext = array("png","jpeg","jpg");
if(in_array($ext, $valid_ext)){
$path = $upload_location.$filename;
if(move_uploaded_file($_FILES['spPostingPic']['tmp_name'][$index],$path)){
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

$data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;
//echo $data;
if (str_contains($array1, '-')) { 
$spFeatureimg =1;

$pf = new _productpic;
$imgdata_aws = array(
"spPostingPic"=>$data, 
"spPostings_idspPostings"=>$product_id,
"spFeatureimg"=>$spFeatureimg
);
$pf->createpic_data($imgdata_aws); 
} else{

$spFeatureimg =0;

$pf = new _productpic;
$imgdata_aws = array(
"spPostingPic"=>$data, 
"spPostings_idspPostings"=>$product_id,
"spFeatureimg"=>$spFeatureimg
);
$pf->createpic_data($imgdata_aws); 

}


$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];
$imgdata = array(
"sppid"=>$pid, 
"spuid"=>$uid,
"file_name"=>$data
);

$pf->imageInsert($imgdata); 
unlink($file);



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

?>

<script>
window.location.href = "<?php echo $BaseUrl ?>/store/dashboard/image_file.php";

</script>