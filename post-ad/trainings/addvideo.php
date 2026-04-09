<?php
	session_start();
	include('../../univ/baseurl.php');

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	ignore_user_abort(true);
	spl_autoload_register("sp_autoloader");

	$pm = new _postingmusicmedia;
	$catid = 8;

	$UploadDirectory	= '../../upload/training/';

	if($_FILES['spPostingMedia']['size'] != 0){
		$File_Name   = strtolower($_FILES['spPostingMedia']['name']);
	}

	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = md5(rand() * time()); //Random number to be added to name.

	$FileExt = str_replace('.', '', $File_Ext);
	$spFileName = "video";

	$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; 

	if(move_uploaded_file($_FILES['spPostingMedia']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}
	$pid = $_SESSION['pid'];
	$result = $pm->createTrain($NewFileName, $FileExt, $pid, $File_Name, $catid);
	//echo $result;
	//echo $pm->ta->sql;
?>
	<div class='col-md-4 imagepost'>
		<span class='fa fa-remove dynamicimg closed'></span>
		<video controls style="width: 100%;height:150px;">
            <source src="<?php echo $BaseUrl.'/upload/training/'.$NewFileName;?>" type="video/mp4">                                                                  
            Your browser does not support the video tag.
        </video>
        <label><input type="radio" class="featuredVdo" data-musicid="<?php echo $result; ?>" > Featured video</label>
	</div>