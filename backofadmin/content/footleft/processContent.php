
<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		case 'delete' :
			deletee($dbConn);
			break;
		
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
		$pageId	= mysqli_real_escape_string($dbConn, $_POST['pageId']);
		$txtTitle	= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$radStatus	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		$txtDesc	=  $_POST['txtDesc'];
		$txtImage	= $_FILES['txtImage']['name'];

		
		$sql = "SELECT * FROM spcontent WHERE contPageId = $pageId";
		$result = dbQuery($dbConn,$sql);
		if (dbNumRows($result) > 0) {
			if ($txtImage != ''){
				$sql3 = "SELECT contIcon FROM spcontent WHERE contPageId = '$pageId' ";
				$result3 = dbQuery($dbConn, $sql3);
				$row3 = dbFetchAssoc($result3);

				@unlink( ABS_PATH ."upload/content/" . $row3['contIcon']);
				$cont_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/content/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$cont_img = $row3['contIcon'];
			}

			$sql2 = "UPDATE spcontent SET contTitle = '$txtTitle', contDesc = '$txtDesc',contIcon = '$cont_img'  WHERE contPageId = $pageId";
		}else{
			if ($txtImage != ''){
				$cont_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/content/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$cont_img = '';
			}
			$sql2 = "INSERT INTO spcontent(contPageId, contTitle, contDesc, contIcon, contStatus) VALUES ($pageId,'$txtTitle', '$txtDesc', '$cont_img', $radStatus)";
		}
		//echo $sql2;
		$result2 = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	}
	//modify 
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtTitle	= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$radStatus	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		$txtDesc	=  $_POST['txtDesc'];
		$txtImage	= $_FILES['txtImage']['name'];

		$sql3 = "SELECT contIcon FROM spcontent WHERE idspContent = '$hidId' ";
		$result3 = dbQuery($dbConn, $sql3);
		$row3 = dbFetchAssoc($result3);
		if ($txtImage != ''){
			@unlink( ABS_PATH ."upload/content/" . $row3['contIcon']);
			$cont_img  =   uploadPagePic('txtImage' , ABS_PATH ."upload/content/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
		}else {
			$cont_img = $row3['contIcon'];
		}


		$sql = "UPDATE spcontent SET contTitle = '$txtTitle', contDesc = '$txtDesc',contIcon = '$cont_img', contStatus = '$radStatus'  WHERE idspContent = $hidId";
		
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}
	
	
	// Upload Image
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