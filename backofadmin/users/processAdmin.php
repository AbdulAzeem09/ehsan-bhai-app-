<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		case 'add' :
			addUser($dbConn);
			break;
			
		case 'modify' :
			modifyUser($dbConn);
			break;

		case 'delete' :
			deleteUser($dbConn);
			break;

		case 'deactive' :
			deactive($dbConn);
			break;

		case 'active' :
			activate($dbConn);
			break;
			
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	// Add New User
	function addUser($dbConn){
		$txtUserLevel   = mysqli_real_escape_string($dbConn,$_POST['txtUserLevel']);
		$txtUserName 	= mysqli_real_escape_string($dbConn, $_POST['txtUserName']);
		$txtPassword 	= mysqli_real_escape_string($dbConn, md5($_POST['txtPassword']));
		$txtMob			= mysqli_real_escape_string($dbConn, $_POST['txtMob']);
		$txtEmail 	 	= mysqli_real_escape_string($dbConn, $_POST['txtEmail']);		
		$radStatus 	 	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		$txtImage		= $_FILES['txtImage']['name'];
		
		$sql2 = "SELECT user_id FROM tbl_user WHERE user_name = '$txtUserName'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "User Name Already Added.";
			redirect('index.php?view=add');	
		}else{
			if ($txtImage != ''){
				@unlink( ABS_PATH ."upload/user/" . $row3['user_img']);
				$user_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/user/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$user_img = $row3['user_img'];
			}
			// Insert
			$sql   = "INSERT INTO tbl_user (user_name, account_name, user_password, user_mob, user_email, user_img, user_regdate, user_last_login, user_status, user_level)
					  VALUES ('$txtUserName', '$txtUserName', '$txtPassword','$txtMob', '$txtEmail', '$user_img', NOW(),'', '$radStatus', $txtUserLevel)";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Member Added Successfully.";
			redirect('index.php');	
		}
		
	}
	//Modify User
	function modifyUser($dbConn) {
		$userId			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtUserLevel   = mysqli_real_escape_string($dbConn,$_POST['txtUserLevel']);
		$txtUserName 	= mysqli_real_escape_string($dbConn, $_POST['txtUserName']);
		if(isset($_POST['txtPassword']) && $_POST['txtPassword'] != ''){
			$txtPassword 	= mysqli_real_escape_string($dbConn, md5($_POST['txtPassword']));
		}else{
			$txtPassword 	= "";
		}
		
		$txtMob			= mysqli_real_escape_string($dbConn, $_POST['txtMob']);
		$txtEmail 	 	= mysqli_real_escape_string($dbConn, $_POST['txtEmail']);
		$radStatus 	 	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
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

		// Update
		if($txtPassword == ""){
			$sql = "UPDATE tbl_user SET  user_name='$txtUserName',  user_mob = '$txtMob', user_email = '$txtEmail', user_img = '$user_img', user_status = '$radStatus', user_level = $txtUserLevel WHERE user_id = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Member Updated Successfully.";
			redirect('index.php');	
		}else{
			$sql = "UPDATE tbl_user SET user_name='$txtUserName',user_password = '$txtPassword',  user_mob = '$txtMob', user_email = '$txtEmail', user_img = '$user_img', user_status = '$radStatus' , user_level = $txtUserLevel  WHERE user_id = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Member Updated Successfully.";
			redirect('index.php');
		}
	}

	function deleteUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}
		$sql2 = "SELECT user_img FROM tbl_user WHERE user_id = '$userId'";
		$result2 = dbQuery($dbConn, $sql2);
		if ($result2) {
			$row2 = dbFetchAssoc($result2);
			@unlink( ABS_PATH ."upload/user/" .$row2['user_img']);
		}
		
		$sql		=	"DELETE FROM tbl_user WHERE user_id=$userId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Member Deleted Successfully.";
		redirect('index.php');			
	}
	// DEACTIVE THIS USER
	function deactive($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}
		
		$sql		=	"UPDATE tbl_user SET user_status = 2 WHERE user_id = $userId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Member Banned Successfully.";
		redirect('index.php');			
	}
	// DEACTIVE THIS USER
	function activate($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}
		
		$sql		=	"UPDATE tbl_user SET user_status = 1 WHERE user_id = $userId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Member Active Successfully.";
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