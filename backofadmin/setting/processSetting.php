
<?php


	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'mainclr' :
			mainclr($dbConn);
			break;
		case 'homeBnr' :
			homeBnr($dbConn);
			break;
		case 'homeLogo' :
			homeLogo($dbConn);
			break;
		case 'headings' :
			headings($dbConn);
			break;	

			case 'emailcontent' :
			emailcontent($dbConn);
			break;
		default :
			redirect('index.php');
	}
	// this is home page banner
	function homeBnr($dbConn){
		$txtCategoryId  = mysqli_real_escape_string($dbConn,$_POST['txtCategoryId']);
		$txtImage		= $_FILES['txtImage']['name'];
        //echo $txtImage;
		//die('==');
		$sql2 = "SELECT idspSetting FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			// get picture name
			$sql3 = "SELECT spSettingBanner FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId' ";
			$result3 = dbQuery($dbConn, $sql3);
			$row3 = dbFetchAssoc($result3);
			if ($txtImage != ''){
				@unlink( ABS_PATH ."upload/banner/" . $row3['spSettingBanner']);
				$bannerImg  =   uploadPagePic('txtImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$bannerImg = $row3['spSettingBanner'];
			}
			
			// echo $txtCategoryId;
			

			$sql = "UPDATE tbl_setting SET spCategory_idspCategory = '$txtCategoryId',spSettingBanner = '$bannerImg' WHERE spCategory_idspCategory = $txtCategoryId ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=home');	
		}else{
			if ($txtImage != ''){
				$BannerMod  =   uploadPagePic('txtImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$BannerMod = '';
			}
			// Insert
			$sql   = "INSERT INTO tbl_setting (spCategory_idspCategory, spSettingBanner) VALUES ('$txtCategoryId','$BannerMod')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=home');
			$sql = "UPDATE tbl_setting SET  WHERE spCategory_idspCategory = $txtCategoryId ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			//redirect('index.php?view=home');	
		}
	}


    //======HOME LOGO=====

function homeLogo($dbConn){
	//die('=========');
		$txtCategoryId1  = mysqli_real_escape_string($dbConn,$_POST['txtCategoryId1']);
		$logoImage		= $_FILES['logoImage']['name'];
        //echo $logoImage;
		//die('==');
		$sql2 = "SELECT idspSetting FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId1' ";
		
		//echo $sql2;
		//die('==');
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			// get picture name
			$sql3 = "SELECT spSettingLogo FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId1' ";
			$result3 = dbQuery($dbConn, $sql3);
			$row3 = dbFetchAssoc($result3);
			
			if ($logoImage != ''){
				@unlink( ABS_PATH ."upload/banner/" . $row3['spSettingLogo']);
				$logoImg  =   uploadPagePic('logoImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$logoImg = $row3['spSettingLogo'];
			}
			
			// echo $txtCategoryId;
			

			$sql = "UPDATE tbl_setting SET spCategory_idspCategory = '$txtCategoryId1',spSettingLogo = '$logoImg' WHERE spCategory_idspCategory = $txtCategoryId1 ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=home');	
		}else{
			if ($txtImage != ''){
				$LogoMod  =   uploadPagePic('logoImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$LogoMod = '';
			}
			
			//die('/////');
			// Insert
			$sql   = "INSERT INTO tbl_setting (spCategory_idspCategory, spSettingLogo) VALUES ('$txtCategoryId1','$LogoMod')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=home');
			$sql = "UPDATE tbl_setting SET  WHERE spCategory_idspCategory = $txtCategoryId1 ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=home');	
			
			
			//die('===');
		}
	}


function emailcontent($dbConn){
		// $txtCategoryId  = mysqli_real_escape_string($dbConn,$_POST['txtCategoryId']);
		// echo $txthome=$_POST['hometxt'];
		// 	exit();
		$txtCategoryId=1;
		$sql2 = "SELECT content FROM spemailcontent WHERE id = 1 ";

		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			// get picture name
			// $sql3 = "SELECT heading FROM homepage_heading WHERE spCategory_idspCategory = '$txtCategoryId' ";
			// $result3 = dbQuery($dbConn, $sql3);
			// $row3 = dbFetchAssoc($result3);
			$emailcontent=$_POST['emailcontent'];

			$sql = "UPDATE spemailcontent SET content='$emailcontent' WHERE id = 1 ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=emailcontent');
		}else{
			
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Data Not Updated.Something Went Wrong.";
			redirect('index.php?view=headings');
		}
			
	}
    




	// Home page Heading update
	function headings($dbConn){
		// $txtCategoryId  = mysqli_real_escape_string($dbConn,$_POST['txtCategoryId']);
		// echo $txthome=$_POST['hometxt'];
		// 	exit();
		$txtCategoryId=1;
		$sql2 = "SELECT heading FROM homepage_heading WHERE spCategory_idspCategory = '$txtCategoryId' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			// get picture name
			// $sql3 = "SELECT heading FROM homepage_heading WHERE spCategory_idspCategory = '$txtCategoryId' ";
			// $result3 = dbQuery($dbConn, $sql3);
			// $row3 = dbFetchAssoc($result3);
			$txthome=$_POST['hometxt'];

			$sql = "UPDATE homepage_heading SET heading='$txthome' WHERE spCategory_idspCategory = $txtCategoryId ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=headings');
		}else{
			
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Data Not Updated.Something Went Wrong.";
			redirect('index.php?view=headings');
		}
			
	}
	// this is all module page settings
	function mainclr($dbConn){
		$txtCategoryId  = mysqli_real_escape_string($dbConn,$_POST['txtCategoryId']);
		$txtMainClr   	= mysqli_real_escape_string($dbConn,$_POST['txtMainClr']);
		$txtBtnClr   	= mysqli_real_escape_string($dbConn,$_POST['txtBtnClr']);
		$txtImage		= $_FILES['txtImage']['name'];

		if ($txtCategoryId == 1) {
			$redirct = "store";
		}elseif ($txtCategoryId == 2) {
			$redirct = "jobBoard";
		}elseif ($txtCategoryId == 3) {
			$redirct = "reaalEstate";
		}elseif ($txtCategoryId == 5) {
			$redirct = "freelance";
		}elseif ($txtCategoryId == 7) {
			$redirct = "clasified";
		}elseif ($txtCategoryId == 8) {
			$redirct = "trainings";
		}elseif ($txtCategoryId == 9) {
			$redirct = "events";
		}elseif ($txtCategoryId == 10) {
			$redirct = "videos";
		}elseif ($txtCategoryId == 13) {
			$redirct = "artgallery";
		}elseif ($txtCategoryId == 14) {
			$redirct = "music";
		}elseif ($txtCategoryId == 19) {
			$redirct = "directory";
		}else{
			$redirct = "list";
		}
		
		$sql2 = "SELECT idspSetting FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			// get picture name
			$sql3 = "SELECT spSettingBanner FROM tbl_setting WHERE spCategory_idspCategory = '$txtCategoryId' ";
			$result3 = dbQuery($dbConn, $sql3);
			$row3 = dbFetchAssoc($result3);
			if ($txtImage != ''){
				@unlink( ABS_PATH ."upload/banner/" . $row3['spSettingBanner']);
				$bannerImg  =   uploadPagePic('txtImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$bannerImg = $row3['spSettingBanner'];
			}

			$sql = "UPDATE tbl_setting SET spCategory_idspCategory = $txtCategoryId, spSettingBanner = '$bannerImg', spSettingMainClr = '$txtMainClr', spSettingBtnClr = '$txtBtnClr' WHERE spCategory_idspCategory = $txtCategoryId ";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Updated Successfully.";
			redirect('index.php?view=home');	
		}else{
			if ($txtImage != ''){
				$BannerMod  =   uploadPagePic('txtImage' , ABS_PATH ."upload/banner/", THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
			}else {
				$BannerMod = '';
			}
			// Insert
			$sql   = "INSERT INTO tbl_setting (spCategory_idspCategory, spSettingBanner, spSettingMainClr, spSettingBtnClr) VALUES ('$txtCategoryId','$BannerMod','$txtMainClr','$txtBtnClr')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view='.$redirct);	
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