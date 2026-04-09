<?php

function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
   
   spl_autoload_register("sp_autoloader");
	
   $b = new _storebanner;


   $keyresult = $b->readawskey();
   $keyrow = mysqli_fetch_array($keyresult);
   $key_name = $keyrow['key_name'];
   $secret_name = $keyrow['secret_name'];	

   $bucketresult = $b->readawskeyagain(2);
   $bucketrow = mysqli_fetch_array($bucketresult);
   $region_name = $bucketrow['region_name']; 
   $bucketName = $bucketrow['bucketName'];		
   
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


	$upload_location = '../uploadimage/';
    if(isset($_FILES['bannerfile']['name']) && $_FILES['bannerfile']['name'] != '')
	{
	 
	  $filename = $_FILES['bannerfile']['name'];
	  $fpath = $upload_location.$filename;
	  move_uploaded_file($_FILES['bannerfile']['tmp_name'],$fpath);
	}
												 

   $file_Path4 = $path ;
   
   $bankey = random_int(1000000000, 9999999999);
   
   try {
		  $result = $s3->putObject([ 'Bucket' => $bucketName,
									 'Key'    => $bankey,  
									 'Body'   => fopen($fpath, 'r'),
									 'ACL'    => 'public-read',
									]);
		} catch (Aws\S3\Exception\S3Exception $e) {
			echo "There was an error uploading the file.\n";
			echo $e->getMessage();
	    }

	$data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$bankey;
	unlink($fpath);


	$b->create(array("idspProfiles" => $_POST["profileid"],"idspUser" => $_POST["userid"],"spStorebanner"=>$data));


 if($_POST["profileid"] != ""){
       $b->updatebannerpic($_POST["profileid"], $data);

 }else{

 $b->create(array("idspProfiles" => $_POST["profileid"],"idspUser" => $_POST["userid"],"spStorebanner"=>$data));

 }
 

//echo $b->ta->sql;
	

	
?> 