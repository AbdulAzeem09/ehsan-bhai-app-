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
		case 'active' :
			active($dbConn);
			break;
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	// Add New User
	function addUser($dbConn){
			//echo "<pre>"; print_r(); exit;
			if($_POST["countrycode"] == "")
			{
				$_SESSION['count'] = 0;
				$_SESSION['errorMessage'] = "Please Select Country Code.";
				redirect('index.php');
			}
			else
			{
				$countrycode            = "+".$_POST["countrycode"];
				$userName 				= $_POST["fname"]." ".$_POST["lname"];
				$pass 					= hash("sha256", $_POST['password']);
				$spUserName				= $userName;
				$spUserFirstName		= $_POST['fname'];
				$spUserLastName			= $_POST['lname'];
				$spUserPhone			= $_POST['mobile'];
				$spUserEmail			= $_POST['email'];
				$spUserPassword			= $pass;
				$spUserActive         	= $_POST["radStatus"];
				$is_email_verify 	  	= 0;
				$is_phone_verify		= 0;
				$spUserLock				= 0;
				
				$sql = "select * from spuser where spUserEmail='$spUserEmail'";
				$result = dbQuery($dbConn, $sql);
				$res = mysqli_fetch_assoc($result);
				
				$sql2 = "select * from spuser where spUserPhone='$spUserPhone'";
				$result2 = dbQuery($dbConn, $sql2);
				$res2 = mysqli_fetch_assoc($result2);
				
				if(!empty($res))
				{
					$_SESSION['count'] = 0;
					$_SESSION['errorMessage'] = "This Email Address Already Exits.";
					redirect('index.php');
				}
				else if(!empty($res2))
				{
					$_SESSION['count'] = 0;
					$_SESSION['errorMessage'] = "This Mobile Number Already Exits.";
					redirect('index.php');
				}
				else
				{
					$sql = "insert into spuser(spUserName,spUserFirstName,spUserLastName,spUserPhone,spUserEmail,spUserPassword,spUserActive,is_email_verify,is_phone_verify,spUserLock,spUserCountryCode)values('$spUserName','$spUserFirstName','$spUserLastName','$spUserPhone','$spUserEmail','$spUserPassword','$spUserActive','$is_email_verify','$is_phone_verify','$spUserLock','$countrycode')";
					$result = dbQuery($dbConn, $sql);
					$last_id = mysqli_insert_id($dbConn);
					
					$sql2 = "insert into spprofiles(spUser_idspUser,spProfileName,spProfileEmail,spProfilephone,spProfilesDefault,spProfileType_idspProfileType,spProfileCntryCode)values($last_id,'$userName','$spUserEmail','$spUserPhone',1,4,$countrycode)";
					$result2 = dbQuery($dbConn, $sql2);
					
					$sql3 = "select * from tbl_point where point_id=2";
					$result3 = dbQuery($dbConn, $sql3);
					
					if ($result3 != false) {
						
						$row = mysqli_fetch_array($result3);
						$point = $row['point_total'];

						$sql4 = "insert into sppoints(pointPercentage,pointBalance,spUser_idspUser,spPointComment,spPoint_type)values($point,$point,$last_id,'User Registration','D')";
						$result4 = dbQuery($dbConn, $sql4);
					}
					
					$_SESSION['count'] = 1;
					$_SESSION['errorMessage'] = "Member Added Successfully.";
					redirect('index.php');	
					
				}
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


	function active($dbConn){
		//print_r($_GET);die("ddddddddddddd");
		$status= $_GET["status"];
		$id= $_GET["id"];
		$sql="UPDATE `spbuiseness_files` SET `status`='$status' WHERE id = $id";
	    $result = dbQuery($dbConn, $sql);
		redirect('index.php?view=baccount');
	}

?>