<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

	include '../../univ/baseurl.php';
	include_once($BaseUrl.'/mlayer/_data.class.php');
	include_once($BaseUrl.'/mlayer/_tableadapter.class.php');
	include_once($BaseUrl.'/mlayer/_postings.class.php'); 
	include_once($BaseUrl.'/mlayer/_postingpic.class.php'); 
	include_once($BaseUrl.'/mlayer/_postingalbum.class.php'); 


/*
    	function sp_autoloader($class) {

			$exclude_array = array("Aws\S3\S3Client","Aws\AwsClient","Aws\AwsClientTrait","Aws\AwsClientInterface","Aws\S3\S3ClientTrait","Aws\Api\Parser\PayloadParserTrait","Aws\S3\S3ClientInterface","Aws\S3\RegionalEndpoint\ConfigurationProvider","Aws\AbstractConfigurationProvider","Aws\ConfigurationProviderInterface","Aws\HandlerList","Aws\ClientResolver","Aws\Signature\SignatureProvider","Aws\Api\ApiProvider","Aws\Api\Service","Aws\Api\AbstractModel","Aws\Api\ShapeMap","Aws\Api\Parser\RestXmlParser","Aws\Api\Parser\AbstractRestParser","Aws\Api\Parser\AbstractParser");

			if(!in_array($class,$exclude_array))
			{
					echo $class."<br>";

			include '../../mlayer/' . $class . '.class.php';
			}
		}

		
		spl_autoload_register("sp_autoloader");
		/*

/*$postid = $_POST['spPostings_idspPostings'];
*/
$spCategories_idspCategory = $_POST['spCategories_idspCategory'];
$spPostingVisibility = $_POST['spPostingVisibility'];

$spPostingDate = $_POST['spPostingDate'];
$spPostingNotes =  $_POST['spPostingNotes'];

$spProfiles_idspProfiles =  $_POST['spProfiles_idspProfiles'];
$albumid = $_POST["spPostingAlbum_idspPostingAlbum"];


//echo "<pre>";
 //print_r($_POST);
 //exit;
 $p = new _postings;

	$pc = new _postingpic;

	$pa = new _postingalbum;


   
      /////////code for s3////////
	  $resultk = $pc->readawskey();
	  $row = mysqli_fetch_array($resultk);
	  $key_name = $row['key_name'];
	  $secret_name = $row['secret_name'];	
	  $result12 = $pc->readawskeyagain($ids=7);
													
	  $row1 = mysqli_fetch_array($result12);
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
		////// end code for s3////////

						
$postdata= array( 
	          "spCategories_idspCategory" => $spCategories_idspCategory,
	          "spPostingVisibility" => $spPostingVisibility,
	          "spProfiles_idspProfiles" => $spProfiles_idspProfiles,
	          "spPostingDate" => $spPostingDate,
	           "spPostingNotes" => $spPostingNotes,

              );



	if(!empty($spCategories_idspCategory)){
		//echo "here";

		//print_r($_GET);
		$id = $p->post($postdata);


$countfiles = count($_FILES['spPostingPic']['name']);
for($index = 0;$index < $countfiles;$index++){

if(isset($_FILES['spPostingPic']['name'][$index]) && $_FILES['spPostingPic']['name'][$index] != ''){
	
	$file_tmp_name =$_FILES['spPostingPic']['tmp_name'][$index];
	$upload_location = $BaseUrl.'/uploadimage/';
	
		if(isset($_FILES['spPostingPic']['name'][$index]) && $_FILES['spPostingPic']['name'][$index] != ''){
			 $filename = $_FILES['spPostingPic']['name'][$index];
			 $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			 $valid_ext = array("png","jpeg","jpg","gif");
			  if(in_array($ext, $valid_ext)){
						$path = $upload_location.$filename;
			           move_uploaded_file($_FILES['spPostingPic']['tmp_name'][$index],$path);
					}

		}
											   
												 
	   $key = random_int(1000000000, 9999999999);
		try {
				$result3 = $s3->putObject([
						'Bucket' => $bucketName,
						'Key'    => $key,  
						'Body'   => fopen($path, 'r'),
						'ACL'    => 'public-read',
					]);
		  //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
			} catch (Aws\S3\Exception\S3Exception $e) {
			echo "There was an error uploading the file.\n";
			echo $e->getMessage();
		  }

		  $profimgdata='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;
		  unlink($path);

        $FeatureImg = 1;
       $pc->createPic($id, $profimgdata, $FeatureImg);
		
}

}

//if(isset($_FILES['spPostingMedia']['name']) || isset($_FILES['spPostingDocument']['name'])){

	$UploadDirectory	= $BaseUrl.'/upload/';

	if($_FILES['spPostingDocument']['size'] != 0 && $_FILES['spPostingDocument']['name']!=""){
		$File_Name1 = $_FILES['spPostingDocument']['name'];
		$File_Ext1           = substr($File_Name1, strrpos($File_Name1, '.')); //get file extention
	    $FileExt1 = str_replace('.', '', $File_Ext1);


	}
	
	if($_FILES['spPostingMedia']['size'] != 0 && $_FILES['spPostingMedia']['name']!=""){
		$File_Name   = $_FILES['spPostingMedia']['name'];
		$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$FileExt = str_replace('.', '', $File_Ext);


	}
	



	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.



	if($FileExt == 'mp3'){
		$spFileName = "audio";
	}else if($FileExt == 'mp4'){
		$spFileName = "video";
	}else if($FileExt == "pdf"){
		$spFileName = "pdf";
	}else{
		$spFileName = "document";
	}

if($_FILES['spPostingMedia']['size'] != 0 && $_FILES['spPostingMedia']['name']!=""){
	if(move_uploaded_file($_FILES['spPostingMedia']['tmp_name'], $UploadDirectory.$File_Name )){

												 
		$key1 = random_int(1000000000, 9999999999);
		try {
				$result4 = $s3->putObject([
						'Bucket' => $bucketName,
						'Key'    => $key1,  
						'Body'   => fopen($UploadDirectory.$File_Name, 'r'),
						'ACL'    => 'public-read',
					]);
		  //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
			} catch (Aws\S3\Exception\S3Exception $e) {
			echo "There was an error uploading the file.\n";
			echo $e->getMessage();
		  }

		  $profimgdata1='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key1;
		  unlink($UploadDirectory.$File_Name);


	$pa->create($id, $albumid,  $profimgdata1, $FileExt, $spProfiles_idspProfiles);
		
	}

}
if($_FILES['spPostingDocument']['size'] != 0  && $_FILES['spPostingDocument']['name']!=""){
	if(move_uploaded_file($_FILES['spPostingDocument']['tmp_name'], $UploadDirectory.$File_Name1 )){	
		
		$key2 = random_int(1000000000, 9999999999);
		try {
				$result5 = $s3->putObject([
						'Bucket' => $bucketName,
						'Key'    => $key2,  
						'Body'   => fopen($UploadDirectory.$File_Name1, 'r'),
						'ACL'    => 'public-read',
					]);
		  //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
			} catch (Aws\S3\Exception\S3Exception $e) {
			echo "There was an error uploading the file.\n";
			echo $e->getMessage();
		  }

		  $profimgdata2='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key2;
		  unlink($UploadDirectory.$File_Name1);


		$pa->create($id, $albumid, $profimgdata2, $FileExt1, $spProfiles_idspProfiles);

	}
}

//}


	$data = array("status" => 200, "message" => "success","data"=>$postdata);


	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	


echo json_encode($data);

?>


