<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
		
	
	//$img = $_POST["spPostingPic"];
		$p = new _postingpicartcraft;


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	

	
    $uploads_dir = '../uploadimage/';
	$name = $_FILES["spPostingPic"]["name"];
	$tmp_name = $_FILES["spPostingPic"]["tmp_name"];
	
  move_uploaded_file($tmp_name, "$uploads_dir/$name");

		    $file = $uploads_dir.$name; 

			$result = $p->readawskey();
			
			$row = mysqli_fetch_array($result);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p->readawskeyagain($ids=7);
			
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

ECHO $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;

unlink($file);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$data = 'SUSHIL'; 
	
	
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
		//echo $_POST["spPostings_idspPostings"];
		

	}else{
		//$p->create($_POST["spPostings_idspPostings"], $data);
		//print_r($_POST["spPostings_idspPostings"]);
        /*print_r($data);
        print_r($FeatureImg);*/


		$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
		//echo $p->ta->sql;
		//echo $_POST["spPostings_idspPostings"];
	}
	
	
	
?>