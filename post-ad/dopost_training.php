<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
//print_r($_POST); die;
//print_r($_FILES); die;
session_start();

include("../univ/baseurl.php");

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postings;
$p1 = new _postingpic;
include $_SERVER["DOCUMENT_ROOT"].'/aws/aws-autoloader.php'; 

 use Aws\S3\S3Client;

function validateFileExtensions($fileArray) {
  $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif');
  foreach($fileArray['name'] as $fileName) {
    if(!empty($fileName)) { 
      $extension = pathinfo($fileName, PATHINFO_EXTENSION);
      if(!in_array(strtolower($extension), $allowedExtensions)) {
        return "Invalid format for file: $fileName.";
      }
    }
  }
  return null; 
}

function validateFilevedioExtensions($fileArray) {
  $allowedExtensions = array('mp4', 'avi', 'mov', 'wmv', 'mkv', 'flv', 'mpg', 'mpeg', 'webm', 'avchd', '3gp', '3g2');

  if (is_array($fileArray['name'])) {
    foreach ($fileArray['name'] as $fileName) {
      if (!empty($fileName)) {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedExtensions)) {
          return "Invalid format for file: $fileName.";
        }
      }
    }
  } else {
    $fileName = $fileArray['name'];
    if (!empty($fileName)) {
      $extension = pathinfo($fileName, PATHINFO_EXTENSION);
      if (!in_array(strtolower($extension), $allowedExtensions)) {
        return "Invalid format for file: $fileName.";
      }
    }
  }

  return null;
}

//add publish
if (isset($_POST['spPostTraining']) && ($_POST['spPostTraining'] == 'publish')) {




	$c = $p->default_currency($_SESSION['uid']);
	if ($c != false) {
		$curr = mysqli_fetch_assoc($c);
		$default_currency = $curr['currency'];
	}

	$data = array(
		"spuser_idspuser" => $_SESSION['uid'],
		"spprofiles_idspprofiles" => $_SESSION['pid'],
		"spPostingTitle" => $_POST['spPostingTitle'],
		"trainingcategory" => $_POST['trainingcategory_'],
		"spPostingCompany" => $_POST['spPostingCompany_'],
		"musiccost_type" => $_POST['musiccost_'],
		"spPostingPrice" => $_POST['spPostingPrice'],
		"txtDiscount" => $_POST['txtDiscount_'],
		"videolevel" => $_POST['videolevel_'],
		"totalhour" => $_POST['totalhour_'],
		"spPostingTraimnerBio" => $_POST['spPostingTraimnerBio_'],
		"spRequiremnt" => $_POST['spRequiremnt_'],
		"outline" => $_POST['outline_1'],
		"spPostingNotes" => $_POST['spPostingNotes'],
		"default_currency" => $default_currency,
		"status" => $_POST['spPostingVisibility'],
		"chkAcknw" => 1

	);

	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '') {
		//update
		$id = $_POST["idspPostings"];
		$p->update_training($data, $id);
		$postid = trim($_POST["idspPostings"]);
		
		if(isset($_FILES['spPostingPic'])) {
		  $errorMessage = validateFileExtensions($_FILES['spPostingPic']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		 $count = count($_FILES['spPostingPic']['name']);

		for (
			$i = 0;
			$i < $count;
			$i++
		) {

			$name = $_FILES['spPostingPic']['name'][$i];
			$temp_name = $_FILES['spPostingPic']["tmp_name"][$i];

			if (move_uploaded_file($temp_name,  "uploads/" . $name)) {
				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);


				$fi = $p->create_training_cover_images($files);
			}
		}
	}
		//intro
		$p = new _postings;
		if(isset($_FILES['spmediaTrainPrev'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spmediaTrainPrev']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  }
		  $name = $_FILES['spmediaTrainPrev']['name'];
		$temp_name = $_FILES['spmediaTrainPrev']["tmp_name"];
		if ($name) {
			move_uploaded_file($temp_name,  "uploads/" . $name);
			$files = array(
				"spuser_idspuser" => $_SESSION['uid'],
				"spprofiles_idspprofiles" => $_SESSION['pid'],
				"postid" => $postid,
				"filename" => $name
			);


			$po = $p->delete_preview_video_postid($postid);
			$fi = $p->create_training_preview_video($files);
		}
		}
		//spPostingMedia
		if(isset($_FILES['spPostingMedia'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spPostingMedia']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		$countfiles = count($_FILES['spPostingMedia']['name']);

		//echo $countfiles.'hello';  

		for (
			$i = 0;
			$i < $countfiles;
			$i++
		) {
			$filename = $_FILES['spPostingMedia']['name'][$i];
			if ($filename) {
				// Upload file
				
				move_uploaded_file($_FILES['spPostingMedia']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/training/' . $filename);

				$files = array(
					"postid" => $postid,
					"filename" => $filename
				);


				$fi = $p->create_training_video_des($files);
			}
		}
	}


		if (!empty($_FILES['spmediAttach'])) {


			$name = $_FILES['spmediAttach']['name'];
			$temp_name = $_FILES["spmediAttach"]["tmp_name"];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			
			if (!empty($extension) && $extension !== 'pdf') {
			  echo "Error: Only pdf format files are allowed.";
			  exit;
				}
			//$document_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
			$result = substr($name, 0, 20);
			$name_document = $result . '.' . $extension;

			$_FILES['spmediAttach']['name'] = $name_document;
			$file_name = $_FILES['spmediAttach']['name'];

			if (isset($name) && $name != "") {
				move_uploaded_file($temp_name, "uploads/" . $name);


				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);

				$po = $p->delete_attachment_postid($postid);
				$fi = $p->create_training_attachment($files);
			}
		}
	} else {
		//addd

		$postid = $p->create_training($data);
		//echo trim($postid);

		$p = new _postings;
		
		if(isset($_FILES['spPostingPic'])) {
		  $errorMessage = validateFileExtensions($_FILES['spPostingPic']);
		    if($errorMessage !== null) {
		      echo $errorMessage;
		      exit;
		    } 
		$count = count($_FILES['spPostingPic']['name']);

		for ($i = 0; $i < $count; $i++) {

			$name = $_FILES['spPostingPic']['name'][$i];
			$temp_name = $_FILES['spPostingPic']["tmp_name"][$i];

			if (move_uploaded_file($temp_name,  "uploads/" . $name)) {
				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);


				$fi = $p->create_training_cover_images($files);
			}
		}
  }
		//intro
		$p = new _postings;
		
		if(isset($_FILES['spmediaTrainPrev'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spmediaTrainPrev']);
		if($errorMessage !== null) {
		  echo $errorMessage;
		  exit;
		} 

		$name = $_FILES['spmediaTrainPrev']['name'];
		$temp_name = $_FILES['spmediaTrainPrev']["tmp_name"];

		if ($name) {
			move_uploaded_file($temp_name,  "uploads/" . $name);
			$files = array(
				"spuser_idspuser" => $_SESSION['uid'],
				"spprofiles_idspprofiles" => $_SESSION['pid'],
				"postid" => $postid,
				"filename" => $name
			);
			$po = $p->delete_preview_video_postid($postid);
			$fi = $p->create_training_preview_video($files);
		}
	}
		//spPostingMedia
		if(isset($_FILES['spPostingMedia'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spPostingMedia']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		$countfiles = count($_FILES['spPostingMedia']['name']);

		//echo $countfiles.'hello';  

		for ($i = 0; $i < $countfiles; $i++) {
			$filename = $_FILES['spPostingMedia']['name'][$i];

			if ($filename) {
				// Upload file
				
				move_uploaded_file($_FILES['spPostingMedia']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/training/' . $filename);


				$file = $_SERVER['DOCUMENT_ROOT'] . '/upload/training/' . $filename; 

			$result3 = $p1->readawskey();
			
			$row = mysqli_fetch_array($result3);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p1->readawskeyagain($ids=7);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = 'ca-central-1'; 
			$bucketName = 'thesharepage';	



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
        'StorageClass' => 'REDUCED_REDUNDANCY',
        'ACL'    => 'public-read',
    ]);
   // echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

echo $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;




die('-----------');





				$files = array(
					"postid" => $postid,
					"filename" => $filename
				);


				$fi = $p->create_training_video_des($files);
			}
		}
}


		if (!empty($_FILES['spmediAttach'])) {

			$name = $_FILES['spmediAttach']['name'];
			$temp_name = $_FILES["spmediAttach"]["tmp_name"];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			
			if (!empty($extension) && $extension !== 'pdf') {
			  echo "Error: Only pdf format files are allowed.";
			  exit;
			}
			//$document_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
			//$result = substr($name, 0, 20);
			//$name_document = $result . '.' . $extension;

			//$_FILES['spmediAttach']['name'] = $name_document;
			$file_name = $_FILES['spmediAttach']['name'];
			

			if (isset($name)) {
				move_uploaded_file($temp_name, "uploads/" . $name);




				 $file = "uploads/" .$name; 

			$result3 = $p1->readawskey();
			
			$row = mysqli_fetch_array($result3);
			$key_name = $row['key_name'];
			$secret_name = $row['secret_name'];	

 
			$result1 = $p1->readawskeyagain($ids=7);
			
			$row1 = mysqli_fetch_array($result1);
			$region_name = 'ca-central-1'; 
			$bucketName = 'thesharepage';	



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
        'StorageClass' => 'REDUCED_REDUNDANCY',
        'ACL'    => 'public-read',
    ]);
   // echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

echo $data='https://'.$bucketName.'.s3.'.$region_name.'.amazonaws.com/'.$key;




//die('-----------');



				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);

				$po = $p->delete_attachment_postid($postid);
				$fi = $p->create_training_attachment($files);
			}
		}
	}
}
//draft
else {

	//if ($_POST["spCategories_idspCategory"] == 8) {


	$c = $p->default_currency($_SESSION['uid']);
	if ($c != false) {
		$curr = mysqli_fetch_assoc($c);
		$default_currency = $curr['currency'];
	}

	$data = array(
		"spuser_idspuser" => $_SESSION['uid'],
		"spprofiles_idspprofiles" => $_SESSION['pid'],
		"spPostingTitle" => $_POST['spPostingTitle'],
		"trainingcategory" => $_POST['trainingcategory_'],
		"spPostingCompany" => $_POST['spPostingCompany_'],
		"musiccost_type" => $_POST['musiccost_'],
		"spPostingPrice" => $_POST['spPostingPrice'],
		"txtDiscount" => $_POST['txtDiscount_'],
		"videolevel" => $_POST['videolevel_'],
		"totalhour" => $_POST['totalhour_'],
		"spPostingTraimnerBio" => $_POST['spPostingTraimnerBio_'],
		"spRequiremnt" => $_POST['spRequiremnt_'],
		"outline" => $_POST['outline_1'],
		"spPostingNotes" => $_POST['spPostingNotes'],
		"default_currency" => $default_currency,
		"status" => 2,
		"chkAcknw" => 1

	);

	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '') {
		$id = $_POST["idspPostings"];
		$postid = $p->update_training($data, $id);
		trim($_POST["idspPostings"]);
		$postid = trim($_POST["idspPostings"]);
		
		if(isset($_FILES['spPostingPic'])) {
		$errorMessage = validateFileExtensions($_FILES['spPostingPic']);
		if($errorMessage !== null) {
		  echo $errorMessage;
		  exit;
		} 
		$count = count($_FILES['spPostingPic']['name']);

		for (
			$i = 0;
			$i < $count;
			$i++
		) {

			$name = $_FILES['spPostingPic']['name'][$i];
			$temp_name = $_FILES['spPostingPic']["tmp_name"][$i];

			if (move_uploaded_file($temp_name,  "uploads/" . $name)) {
				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);


				$fi = $p->create_training_cover_images($files);
			}
		}
}
		//intro
		$p = new _postings;
		if(isset($_FILES['spmediaTrainPrev'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spmediaTrainPrev']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 

		$name = $_FILES['spmediaTrainPrev']['name'];
		$temp_name = $_FILES['spmediaTrainPrev']["tmp_name"];
		if ($name) {
			move_uploaded_file($temp_name,  "uploads/" . $name);
			$files = array(
				"spuser_idspuser" => $_SESSION['uid'],
				"spprofiles_idspprofiles" => $_SESSION['pid'],
				"postid" => $postid,
				"filename" => $name
			);


			$po = $p->delete_preview_video_postid($postid);
			$fi = $p->create_training_preview_video($files);
		}
		}
		//spPostingMedia
		if(isset($_FILES['spPostingMedia'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spPostingMedia']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		$countfiles = count($_FILES['spPostingMedia']['name']);

		//echo $countfiles.'hello';  

		for (
			$i = 0;
			$i < $countfiles;
			$i++
		) {
			$filename = $_FILES['spPostingMedia']['name'][$i];
			if ($filename) {
				// Upload file
				
				move_uploaded_file($_FILES['spPostingMedia']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/training/' . $filename);

				$files = array(
					"postid" => $postid,
					"filename" => $filename
				);


				$fi = $p->create_training_video_des($files);
			}
		}
	}


		if (!empty($_FILES['spmediAttach'])) {

			$name = $_FILES['spmediAttach']['name'];
			$temp_name = $_FILES["spmediAttach"]["tmp_name"];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			
			if (!empty($extension) && $extension !== 'pdf') {
			  echo "Error: Only pdf format files are allowed.";
			  exit;
			}
			//$document_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
			$result = substr($name, 0, 20);
			$name_document = $result . '.' . $extension;

			$_FILES['spmediAttach']['name'] = $name_document;
			$file_name = $_FILES['spmediAttach']['name'];

			if (isset($name)) {
				move_uploaded_file($temp_name, "uploads/" . $name);


				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);

				$po = $p->delete_attachment_postid($postid);
				$fi = $p->create_training_attachment($files);
			}
		}
	} else {

		$id = $p->create_training($data);

		$postid = trim($id);
		
		if(isset($_FILES['spPostingPic'])) {
		  $errorMessage = validateFileExtensions($_FILES['spPostingPic']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		$count = count($_FILES['spPostingPic']['name']);

		for (
			$i = 0;
			$i < $count;
			$i++
		) {

			$name = $_FILES['spPostingPic']['name'][$i];
			$temp_name = $_FILES['spPostingPic']["tmp_name"][$i];

			if (move_uploaded_file($temp_name,  "uploads/" . $name)) {
				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);


				$fi = $p->create_training_cover_images($files);
			}
		}

	}	//intro
		$p = new _postings;
		
		if(isset($_FILES['spmediaTrainPrev'])) {
	    $errorMessage = validateFilevedioExtensions($_FILES['spmediaTrainPrev']);
	    if($errorMessage !== null) {
	      echo $errorMessage;
	      exit;
	    } 

		$name = $_FILES['spmediaTrainPrev']['name'];
		$temp_name = $_FILES['spmediaTrainPrev']["tmp_name"];
		if ($name) {
			move_uploaded_file($temp_name,  "uploads/" . $name);
			$files = array(
				"spuser_idspuser" => $_SESSION['uid'],
				"spprofiles_idspprofiles" => $_SESSION['pid'],
				"postid" => $postid,
				"filename" => $name
			);


			$po = $p->delete_preview_video_postid($postid);
			$fi = $p->create_training_preview_video($files);
		}
		}
		//spPostingMedia
		if(isset($_FILES['spPostingMedia'])) {
		  $errorMessage = validateFilevedioExtensions($_FILES['spPostingMedia']);
		  if($errorMessage !== null) {
		    echo $errorMessage;
		    exit;
		  } 
		$countfiles = count($_FILES['spPostingMedia']['name']);

		//echo $countfiles.'hello';  

		for (
			$i = 0;
			$i < $countfiles;
			$i++
		) {
			$filename = $_FILES['spPostingMedia']['name'][$i];
			if ($filename) {
				// Upload file

				move_uploaded_file($_FILES['spPostingMedia']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/training/' . $filename);

				$files = array(
					"postid" => $postid,
					"filename" => $filename
				);


				$fi = $p->create_training_video_des($files);
			}
		}
	}


		if (!empty($_FILES['spmediAttach'])) {

			$name = $_FILES['spmediAttach']['name'];
			$temp_name = $_FILES["spmediAttach"]["tmp_name"];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			
			if (!empty($extension) && $extension !== 'pdf') {
			  echo "Error: Only pdf format files are allowed.";
			  exit;
			}
			//$document_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
			//$result = substr($name, 0, 20);
			//$name_document = $result . '.' . $extension;

			$_FILES['spmediAttach']['name'] = $name_document;
			$file_name = $_FILES['spmediAttach']['name'];

			if (isset($name)) {
				move_uploaded_file($temp_name, "uploads/" . $name);


				$files = array(
					"spuser_idspuser" => $_SESSION['uid'],
					"spprofiles_idspprofiles" => $_SESSION['pid'],
					"postid" => $postid,
					"filename" => $name
				);

				$po = $p->delete_attachment_postid($postid);
				$fi = $p->create_training_attachment($files);
			}
		}
	}
	//}
}
if (isset($_POST["idspPostings"]))
	$_SESSION['msg'] = "update";
else
	$_SESSION['msg'] = "insert";



?>
<script>
	window.location.replace('<?php echo $BaseUrl ?>/trainings/dashboard/pending.php');
</script>
