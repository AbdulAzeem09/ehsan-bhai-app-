<?php

/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");

	$p = new _postingpic;
	$pvs = new _postingpicartcraft;
	$ps = new _realstatepic;
	$pic = new _productpic;
	$pics = new _classifiedpic;
	$picsp = new _eventpic;
    $result = $p->readawskey();
			
			$row = mysqli_fetch_array($result);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p->readawskeyagain($ids=$_POST['awsid']);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = $row1['region_name']; 
			$bucketName = $row1['bucketName'];	


$path = 'https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/';
$post = $_POST['postingsrc'];
$keyname = str_replace($path,"",$post);
//echo $bucketName; die('=========');
include $_SERVER['DOCUMENT_ROOT'].'/aws/aws-autoloader.php'; 

    use Aws\S3\S3Client;
	
       $s3 = new S3Client([
			'version' => 'latest',
			'region' => $region_name,
			'credentials' => [
			'key'    => $key_name,
			'secret' => $secret_name
			]
		]);
      
    $result = $s3->deleteObject(array(
        'Bucket' => $bucketName,
        'Key'    => $keyname
    ));

	    
	if($_POST['postingwork']=='realstate'){
		$ps->remove($_POST["postingpic"]);
	}	
    
	if($_POST['postingwork']=='imgpostpvs'){
		$pvs->remove($_POST["postingpic"]);
	}	
	if($_POST['postingwork']=='imgpost'){
		$p->remove($_POST["postingpic"]);
	}	    
	if($_POST['postingwork']=='store'){
		$pic->remove($_POST["postingpic"]);
	}	    
	if($_POST['postingwork']=='service'){
		$pics->remove($_POST["postingpic"]);
	}  
	if($_POST['postingwork']=='event'){
		//die('ppppppppppppp');
		$picsp->remove_galley($_POST["postingpic"]);
	}
	if($_POST['postingwork']=='seatlayout'){
		//die('ppppppppppppp');
		$arr=array(
			"spPostingPic"=>''
		);
		$picsp->remove_event_layout($arr,$_POST["postingpic"]);
	}
	if($_POST['postingwork']=='event_1'){
		//die('ppppppppppppp');
		$picsp->remove_pics($_POST["postingpic"]);
	}
	
?>