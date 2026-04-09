<?php
include('../univ/baseurl.php');
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$activitydate = date("Y-m-d H:i:s");
	$profile = new _spprofiles;
	$result = $profile->readjobseeker($_SESSION["pid"]);
	$profileid="";
	if($result != false){
		$row = mysqli_fetch_assoc($result);
		$profileid = $row['idspProfiles'];
	}



	
	
	
	
	
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
    $uploads_dir = '../uploadimage/';
	$name = $_FILES["resume"]["name"];
	$tmp_name = $_FILES["resume"]["tmp_name"];
	
  move_uploaded_file($tmp_name, "$uploads_dir/$name");

		    $file = $uploads_dir.$name; 

			$result = $profile->readawskey();
			
			$row = mysqli_fetch_array($result);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $profile->readawskeyagain($ids=4);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = $row1['region_name']; 
			$bucketName = $row1['bucketName'];	

/*include $BaseUrl.'/aws/aws-autoloader.php'; 

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

 $NewFileName='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key; 

unlink($file);

*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	
	
	
	
	
	   /*$UploadDirectory	= '../resume/';

	if($_FILES['resume']['size'] != 0){
		$File_Name   = strtolower($_FILES['resume']['name']);
	}

	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = md5(rand() * time()); //Random number to be added to name.

	$FileExt = str_replace('.', '', $File_Ext);
	$spFileName = "resume";

	$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; 
/*	print_r($NewFileName);exit;*/

	/*if(move_uploaded_file($_FILES['resume']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$p = new _sppost_has_spprofile;
$cid =	$p->create($_POST["postid"], $profileid ,$_POST["categoryid"] , $activitydate , $_POST["closingdate"] ,$name , $_POST["coverletter"]);
	
	if(!isset($profileid)){
		echo "no";
	}


  $link = '<a href="'.$BaseUrl.'/job-board/job-detail.php?postid='.$_POST["postid"].'">Here</a>';

//echo $link;/job-detail.php?postid=
//echo $fc->ta->sql;
                      $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $profileid,'sellerProfileid' => $_POST["clientid"],'module'=>'job board','message'=>'You have Applicant for job Click '.$link.' to check!' );
                         $pl->addenquiry($addmssage);

                         //echo $pl->ta->sql;
                        // exit;
	$re = new _redirect;

	$location ="../job-board/job-detail.php?postid=".$_POST["postid"]."&job=success";
    $re->redirect($location);
?>