
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			addd($dbConn);
			break;
		case 'modify' :
			modifyCat($dbConn);
			break;
		case 'delete' :
			deletee($dbConn);
			break;
		
		default :
			redirect('index.php');
	}
	//Add Category
	function addd($dbConn){
		$txtTitle		= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$txtIcon		= mysqli_real_escape_string($dbConn, $_POST['txtIcon']);
		
		
		$sql = "SELECT idspProfileType FROM spprofiletype WHERE spProfileTypeName = '$txtTitle'";
		$result = dbQuery($dbConn, $sql);
		if(dbNumRows($result) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "danger";
			$_SESSION['errorMessage'] = "Already exist.";
			redirect("index.php?view=add");
		}else{
			
			$sql2 = "INSERT INTO spprofiletype(spProfileTypeName, spprofiletypeicon) VALUES ( '$txtTitle', '$txtIcon')";
			$result2 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Added Successfully.";
			redirect("index.php?view=list");
		}
	}
	
	function deletee($dbConn) {
		if(isset($_GET['ptId']) && ($_GET['ptId'])>0 ){
			$ptId = $_GET['ptId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		
		$sql    =	"DELETE FROM spprofiletype WHERE idspProfileType ='$ptId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Delted Successfully";
		redirect("index.php?view=list");
		
	}
	
	//Modify Category
	function modifyCat($dbConn){
		$CatId			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtTitle		= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$txtdesc		= mysqli_real_escape_string($dbConn, $_POST['txtdesc']);
		$Catbanner	= $_FILES['Catbanner']['name'];
		
		$sql3 = "SELECT cat_img FROM tbl_category WHERE cat_id = '$CatId' ";
		$result3 = dbQuery($dbConn, $sql3);
		$row3 = dbFetchAssoc($result3);
		if ($Catbanner != ''){
			@unlink( ABS_PATH ."upload/category/" . $row3['cat_img']);
			$Cat_bann  =   uploadPagePic('Catbanner' , ABS_PATH ."upload/category/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
		}else {
			$Cat_bann = $row3['cat_img'];
		}
		
		$sql = "SELECT cat_id FROM tbl_category WHERE cat_title = '$txtTitle'";
		$result = dbQuery($dbConn, $sql);
		if(dbNumRows($result) > 0){
			
			$sql2 = "UPDATE tbl_category SET cat_desc ='$txtdesc', cat_img = '$Cat_bann' WHERE cat_id = '$CatId' ";
			$result2 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Category Updated Successfully.";
			redirect("index.php?view=list");
			
		}else{
			$sql2 = "UPDATE tbl_category SET cat_title ='$txtTitle', cat_desc ='$txtdesc' , cat_img = '$Cat_bann' WHERE cat_id = '$CatId' ";
			$result2 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Category Updated Successfully.";
			redirect("index.php?view=list");
		}
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