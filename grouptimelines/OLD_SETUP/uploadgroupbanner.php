<?php

 include('../univ/baseurl.php');
 include('../helpers/image.php');
//die('====');
// print_r($_POST);
// exit();
function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
  // Validate file extensions before upload
  $image = new Image();
  $image->validateFileImageExtensions($_FILES['bannerfile']);

     $b = new _spgroup;

     $id=$_POST['groupid'];
     $gid=$_POST['groupid'];
     $spGroupName=$_POST['gname'];
     $gName=$_POST['gname'];
	 $spGroupCategory=$_POST['spgroupCategory'];
     $spUserCountry=$_POST['spUserCountry'];
     $spUserState=$_POST['spUserState'];
	 $spUserCity=$_POST['spUserCity'];
	  //$address=$_POST['address'];
      $zipcode=$_POST['zipcode'];
	$spGroupTag=$_POST['spGroupTag'];
	$spGroupAbout=$_POST['spGroupAbout'];
	$spgroupflag=$_POST['spgroupflag'];
	$bannerpic=$_FILES['bannerfile']['name'];
	 //echo $spGroupAbout;
	 //die('===');
 // print_r($bannerpic);exit();
//$sql="WHERE idspGroup = $id"
		

$data=array("spGroupName"=> $spGroupName, "spUserCountry"=>$spUserCountry,"spUserState"=>$spUserState,"spUserCity"=>$spUserCity,"zipcode"=>$zipcode,"spGroupTagline"=>$spGroupTag,"spGroupAbout"=>$spGroupAbout,"spgroupflag"=>$spgroupflag,"spgroupCategory"=>$spGroupCategory);
//print_r($data);
if($bannerpic!=false){
	//die('=====');
$data1=array("spgroupimage"=>$bannerpic);
$b->updategrppic($gid,$data1);
}
//die('=====');
$b->updategroupUG($data,$id); 

// echo $b->ta->sql;
//grouptimelines/?groupid=319&groupname=group%20friend%20test&timeline
// 	$b = new _storegroupbanner;
//$uploads_dir = '../uploadimage/';
$name = $_FILES["bannerfile"]["name"];
	
$tmp_name = $_FILES["bannerfile"]["tmp_name"];	
move_uploaded_file($tmp_name,  "../uploadimage/".$name);
 



header("location:".$BaseUrl."/grouptimelines/group-setting.php?groupid=".$id."&groupname=".$gName."&timeline&page=1"."&msg=update"); 
 
 //$file = $uploads_dir.$name; 

 			//$result = $b->readawskey();
			
 			//print_r($result);
			//die('hgfh');
// 			$row = mysqli_fetch_array($result);
// 			$key_name = $row['key_name'];
// 			$secret_name = $row['secret_name'];	

//  $ids=13;
// 			$result1 = $b->readawskeyagain($ids);
			
// 			$row1 = mysqli_fetch_array($result1);
// 			$region_name = $row1['region_name']; 
// 			$bucketName = $row1['bucketName'];	

// include $BaseUrl.'/aws/aws-autoloader.php'; 

// use Aws\S3\S3Client;
// $s3 = new S3Client([
//     'version' => 'latest',
//     'region' => $region_name,
//     'credentials' => [
//     'key'    => $key_name,
//     'secret' => $secret_name
//     ]
// ]);

// $file_Path4 = $file ;

// $key = random_int(1000000000, 9999999999);

// try {
//     $result = $s3->putObject([
//         'Bucket' => $bucketName,
//         'Key'    => $key,  
//         'Body'   => fopen($file_Path4, 'r'),
//         'ACL'    => 'public-read',
//     ]);
//   //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
// } catch (Aws\S3\Exception\S3Exception $e) {
//     echo "There was an error uploading the file.\n";
//     echo $e->getMessage();
// }


//$data='https://'.$bucketName.'.s3


// update query banner
// function updategroupUG($spGroupName,$spUserCountry,$spUserState,$spUserCity,$address,$zipcode,$spGroupTag,$spGroupAbout,$spgroupflag,$id) {
//         $this->banner->update(array("spGroupName"=> $spGroupName, "spUserCountry"=>$spUserCountry,"spUserState"=>$spUserState,"spUserCity"=>$spUserCity,"address"=>$address,"zipcode"=>$zipcode,"spGroupTag"=>$spGroupTag,"spGroupAbout"=>$spGroupAbout,"spgroupflag"=>$spgroupflag), "WHERE idspGroup ='" . $id . "'");
//         echo $this->banner->sql;
//     }

?>
