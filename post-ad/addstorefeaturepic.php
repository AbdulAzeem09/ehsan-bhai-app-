<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';

function sp_autoloader($class){
  if(file_exists('../mlayer/' . $class . '.class.php')){
    include_once '../mlayer/' . $class . '.class.php';
  }
}
spl_autoload_register("sp_autoloader");  

$postid = !empty($_POST['spPostings_idspPostings']) ? $_POST['spPostings_idspPostings'] : "";
if(!$postid){
  errorOut('PostId not found');
}

$s3 = new s3Class(2);
$allS3SellerPic = $s3->storeAllInS3('files');

$p = new _productpic;
if (isset($_POST['del'])) {
	if($_POST['del'] == 0){
		$p->removePostPic($postid);
	}
}
	
 
foreach($allS3SellerPic as $one){
  $p->createPic($postid, $one['url'], 1);
} 

successOut($allS3SellerPic);

	
?>
