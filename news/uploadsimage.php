<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 'on');
*/
function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;

//print_r($_FILES); die('======');

	  
												  $result = $p->readawskey();
			
													$row = mysqli_fetch_array($result);
													$key_name = $row['key_name'];
													$secret_name = $row['secret_name'];	
														
										 
													$result1 = $p->readawskeyagain($ids=12);
													
													$row1 = mysqli_fetch_array($result1);
													$region_name = $row1['region_name']; 
													$bucketName = $row1['bucketName'];		
	
include $_SERVER["DOCUMENT_ROOT"].'/aws/aws-autoloader.php'; 

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
                                                 
												 
												
                                               
  
  
  
  
											$countfiles =1;
											$upload_location = '../uploadimage/';
											$files_arr = array();
										//	for($index = 0;$index < $countfiles;$index++){
											   

											   if(isset($_FILES['files']['name']) && $_FILES['files']['name'] != ''){
												  $filename = $_FILES['files']['name'];
												  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
												  $valid_ext = array("png","jpeg","jpg");
												//  if(in_array($ext, $valid_ext)){
													 // die('asdadasda');
													  $path = $upload_location.$filename;
													// die('------');
													 if(move_uploaded_file($_FILES['files']['tmp_name'],$path)){
														$files_arr[] = $path;
													 }
												 // }

											 
											   
												 
												            $file_Path4 = $path ;
//die('==========');
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
                                                     $spname=$_POST['names'];
															$data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;
															
															
															
															
															
															 /* $spname=$_POST['names'];
													           $p->updateprofilepic($_POST["profileid"], $data,$spname);

															   unlink($file);
		 												
	                                                           header("Location:/news/myprofile.php"); 
															//echo $data;*/
												}
															
															
												else {
												$data=$_POST['hideenimg'];
												}
											$spname=$_POST['names'];
											$p->updateprofilepic($_POST["profileid"], $data,$spname);

												unlink($file);
		 											
	                                        header("Location:/news/myprofile.php"); 
	                                    	
	
	 
 
 
 	
			
			
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/*





	$img = $_POST["spprofilePic"];
	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
//	$data = base64_decode($img);
	$p->updateprofilepic($_POST["profileid"], $data);
	
	//Upload image in media using album
	$album = new _album;
	$media = new _postingalbum; //Create media 
	$result = $album->readimagealmb($_POST["profileid"]);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		$albumid = $row["idspPostingAlbum"];
	} */
	/*
	if( $_POST["mediaid"] == 0)
	{
		$media->profileimg($_POST["profileid"] ,$data , $albumid);
	} */
	//}
?>
