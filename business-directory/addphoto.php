<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	ignore_user_abort(true);
	spl_autoload_register("sp_autoloader");
	$pm = new _direcctory_gallery;
	//echo $_FILES["spPostingMedia"]["tmp_name"];
	//echo "yes";
	
	$UploadDirectory	= '../upload/directory-gallery/';

	if($_FILES['spPostingMedia']['size'] != 0){
		$File_Name   = strtolower($_FILES['spPostingMedia']['name']);
	}

	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = md5(rand() * time()); //Random number to be added to name.

	//$FileExt = str_replace('.', '', $File_Ext);
	$spFileName = "dirctory";

	$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; 

	if(move_uploaded_file($_FILES['spPostingMedia']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}
	$pid = $_SESSION['pid'];
	$result = $pm->create($NewFileName, $pid);
	echo $result;
	//echo $pm->ta->sql;
	$re = new _redirect;
    $redirctUrl = "../business-directory/gallery.php";
    $re->redirect($redirctUrl);
?>