<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		case 'modify' :
			modifyAccount($dbConn);
			break;
			
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	
	//Modify User
	function modifyAccount($dbConn) {
		$userId			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtAccountName	= mysqli_real_escape_string($dbConn, $_POST['txtAccountName']);
		$txtImage		= $_FILES['txtImage']['name'];

		$sql3 = "SELECT user_img FROM tbl_user WHERE user_id = '$userId' ";
		$result3 = dbQuery($dbConn, $sql3);
		$row3 = dbFetchAssoc($result3);
		if ($txtImage != ''){
			@unlink( ABS_PATH ."upload/user/" . $row3['user_img']);
			$user_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/user/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
		}else {
			$user_img = $row3['user_img'];
		}
		$_SESSION['userImg']	=	$user_img;
		
		$sql = "UPDATE tbl_user SET account_name = '$txtAccountName', user_img = '$user_img'  WHERE user_id = $userId";
		$result = dbQuery($dbConn, $sql);
		if ($result) {
			$_SESSION['accountName'] = $txtAccountName;
		}
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Account Updated Successfully.";

		redirect('index.php');
		
	}

	// Upload Imge
	function uploadPagePic($inputName, $uploadDir,$newW, $newH){
		$image     = $_FILES[$inputName];
		$imagePath = '';
		$thumbnailPath = '';
		$imgSize = getimagesize($image['tmp_name']);
		// if a file is given
		if (trim($image['tmp_name']) != '') {
			$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];
			// generate a random new file name to avoid name conflict
			$imagePath = md5(rand() * time()) . ".$ext";
			list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
			// make sure the image width does not exceed the
			// maximum allowed width
			if (LIMIT_PRODUCT_WIDTH && $width > $newW) {
				$result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
				$imagePath = $result;
			} else {
				$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
			}
			// make sure the image height does not exceed the
			// maximum allowed height
			
			if (LIMIT_PRODUCT_HEIGHT && $height > $newH) {
				$result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
				$imagePath = $result;
			} else {
				$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
			}
		}
		//return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
		return $imagePath;
	}
?>