<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _realstatepic;
	
	return 1;
	//print_r($_POST); die('============='); 
	
	$img = $_POST["seller_picture"];
	//echo $postid."hello"; die("----------");

$BaseUrl=$_SERVER["DOCUMENT_ROOT"];


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// $p = new _postingpic;
	
    $uploads_dir = '../uploadimage/';
	$name = $_FILES["seller_picture"]["name"];
	$tmp_name = $_FILES["seller_picture"]["tmp_name"];
	
  move_uploaded_file($tmp_name, "$uploads_dir/$name");

		    $file = $uploads_dir.$name; 
//echo $file ; die;('==============');
			$result = $p->readawskey();
			
			$row = mysqli_fetch_array($result);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p->readawskeyagain($ids=3);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = $row1['region_name']; 
			$bucketName = $row1['bucketName'];	

include $BaseUrl.'/aws/aws-autoloader.php'; 

use Aws\S3\S3Client;
$s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
    'key'    => $key_name,
    'secret' => $secret_name
    ]
]);

$file_Path4 = $file ;

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
//echo $data; die('aaaaaaaa');
unlink($file);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if(isset($_POST['spFeatureimg'])){
		$FeatureImg = $_POST['spFeatureimg'];
	}else{
		$FeatureImg = 0;
	}

	//echo $_POST['postedit']. '--'.$_POST['del'];



$postid=$_POST["spPostings_idspPostings"];

$data1=array(
	'saller_picture'=>$data
);




		$p->update_img($data1,$postid);
		//print_r($_POST["spPostings_idspPostings"]);
        
	//	$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
		//echo $p->ta->sql; 
		//echo $_POST["spPostings_idspPostings"];
	
	//echo $p->ta->sql;
	
	
?>