
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;		
		default :
			redirect('index.php');
	}
	//Modify CATEGORY
	function modify($dbConn) {
		$catId			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$txtFoldName 	= mysqli_real_escape_string($dbConn, $_POST['txtFoldName']);
		$radStatus 	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		$txtImage		= $_FILES['txtImage']['name'];
		// upload image if upload
		$sql3 = "SELECT spCategoryImage FROM spcategories WHERE idspCategory = '$catId' ";
		$result3 = dbQuery($dbConn, $sql3);
		$row3 = dbFetchAssoc($result3);
		if ($txtImage != ''){
			@unlink( ABS_PATH ."upload/category/" . $row3['spCategoryImage']);
			$user_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/category/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
		}else {
			$user_img = $row3['spCategoryImage'];
		}
		// update content
		$sql2 = "SELECT idspCategory FROM spcategories WHERE spCategoryName = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$sql = "UPDATE spcategories SET  spCategoryFolder='$txtFoldName',  spCategoryImage = '$user_img', spCategoryStatus= $radStatus WHERE idspCategory = $catId";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}else{
			$sql = "UPDATE spcategories SET spCategoryName='$txtTitle', spCategoryFolder='$txtFoldName',  spCategoryImage = '$user_img', spCategoryStatus= $radStatus WHERE idspCategory = $catId";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$txtFoldName   = mysqli_real_escape_string($dbConn,$_POST['txtFoldName']);
		$txtImage		= $_FILES['txtImage']['name'];
		
		$sql2 = "SELECT idspCategory FROM spcategories WHERE spCategoryName = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			if ($txtImage != ''){
				$user_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/category/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$user_img = $row3['user_img'];
			}
			// Insert
			$sql   = "INSERT INTO spcategories (spCategoryName, spCategoryFolder, spCategoryImage) VALUES ('$txtTitle', '$txtFoldName', '$user_img')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['catId']) && $_GET['catId'] > 0){
			$catId	=    $_GET['catId'];
		}
		
		// $sql3 = "SELECT spCategoryImage FROM spcategories WHERE idspCategory = '$catId' ";
		// $result3 = dbQuery($dbConn, $sql3);
		// $row3 = dbFetchAssoc($result3);
		// if (isset($row3['spCategoryImage']) && $row3['spCategoryImage'] != ''){
		// 	@unlink( ABS_PATH ."upload/category/" . $row3['spCategoryImage']);
		// }
		$sql = "UPDATE spcategories SET spCategoryStatus = '-7' WHERE idspCategory = $catId ";
		//$sql		=	"DELETE FROM spcategories WHERE idspCategory = $catId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
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