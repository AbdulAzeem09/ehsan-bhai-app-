<?php
  error_reporting(E_ALL);
 ini_set('display_errors', '1');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	ignore_user_abort(true);
 
	$postid = $_POST["spPostings_idspPostings"];

	spl_autoload_register("sp_autoloader");
	$p = new _postingalbum;
	
	$BaseUrl=$_SERVER['DOCUMENT_ROOT'];
	//$img = $_POST["spPostingVideo"];
	//echo $_FILES["spPostingMedia"]["tmp_name"];

/*print_r($_FILES); 
 die('====');*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_FILES['spPostingDocument']['size'] != 0){
		$File_Name = strtolower($_FILES['spPostingDocument']['name']);
	 $name = $_FILES["spPostingDocument"]["name"];
	$tmp_name = $_FILES["spPostingDocument"]["tmp_name"];
	}
	
	if($_FILES['spPostingMedia']['size'] != 0){
		$File_Name   = strtolower($_FILES['spPostingMedia']['name']);
	$name = $_FILES["spPostingMedia"]["name"];
	$tmp_name = $_FILES["spPostingMedia"]["tmp_name"];
	}
	
    $uploads_dir = '../uploadimage/';
  //move_uploaded_file($tmp_name, "$uploads_dir/$name");

		   $file = $uploads_dir.$name;  
//echo $name; die('==============');
			$result = $p->readawskey();
			
			$row = mysqli_fetch_array($result);
			//print_r($row); die;
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p->readawskeyagain($ids=13);
			
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

//echo $file_Path4 = $file ;


$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,  
       // 'Body'   => fopen($file_Path4, 'r'),
           'SourceFile' => $tmp_name,
        'ACL'    => 'public-read',
    ]);
  //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

  $NewFileName='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

//unlink($file);
//echo $data; die;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	

	
	//$UploadDirectory	= '../upload/';




	if($_FILES['spPostingDocument']['size'] != 0){
		$File_Name = strtolower($_FILES['spPostingDocument']['name']);
	}
	
	if($_FILES['spPostingMedia']['size'] != 0){
		$File_Name   = strtolower($_FILES['spPostingMedia']['name']);
	}
	//echo $File_Name;*/
	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.

	//echo $File_Name;


	$FileExt = str_replace('.', '', $File_Ext); 
	if($FileExt == 'mp3'){
		$spFileName = "audio";
	}else if($FileExt == 'mp4'){
		$spFileName = "video";
	}else if($FileExt == "pdf"){
		$spFileName = "pdf";
	}else{
		$spFileName = "document";
	}

	//$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; //new file name

	/*if(move_uploaded_file($_FILES['spPostingMedia']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
		
	}
	if(move_uploaded_file($_FILES['spPostingDocument']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}*/

	$pid = $_POST['spProfiles_idspProfiles'];
	$albumid = $_POST["spPostingAlbum_idspPostingAlbum_"];
	//$img = str_replace("data:".$_POST["ext"]."base64,", "", $img);
	//$img = str_replace(" ", "+", $img);
	//$data = base64_decode($img);
	
	$result = $p->create($postid, $albumid, $NewFileName, $FileExt, $pid,$name);
	//echo $p->ta->sql;
