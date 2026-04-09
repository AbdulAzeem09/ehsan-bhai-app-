<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');


	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	//$p = new _postingpic;
	$sp = new _sponsorpic;
	
	$img = $_POST["spPostingPic"];
//print_r($_FILES); die('=====================');
	//print_r($img);
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    $uploads_dir = '../../uploadimage/';
	$name = $_FILES["spPostingPic"]["name"];
	$tmp_name = $_FILES["spPostingPic"]["tmp_name"];
  move_uploaded_file($tmp_name, "$uploads_dir/$name");

		    $file = $uploads_dir.$name; 

			$result = $sp->readawskey();
			
			$row = mysqli_fetch_array($result);
			//print_r($row); die;
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $sp->readawskeyagain($ids=6);
			
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

unlink($file);
//echo $data; die;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);

	//echo $_POST['postedit']. '--'.$_POST['del'];

	if(isset($_POST['SponorId']) && $_POST['SponorId'] != ''){
		$sp->updatepic($_POST["SponorId"], $data);
		//echo $_POST['SponorId'];
	}
?>
	
