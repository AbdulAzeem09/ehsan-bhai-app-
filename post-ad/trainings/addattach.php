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

	if($_FILES['spmediAttach']['size'] != 0){
		$File_Name   = strtolower($_FILES['spmediAttach']['name']);
	}

	//$File_Name          = strtolower($_FILES['spmediAttach']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = md5(rand() * time()); //Random number to be added to name.

	$FileExt = str_replace('.', '', $File_Ext);
	$spFileName = "attach";

	$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; 

	if(move_uploaded_file($_FILES['spmediAttach']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}
	$pid = $_SESSION['pid'];
	$result = $pm->createTrain($NewFileName, $FileExt, $pid, $File_Name, $catid);
	//echo $result;
	//echo $pm->ta->sql;
?>
	<div class='col-md-2 imagepost'>
		<!-- <span class='fa fa-remove dynamicimg closed'></span> -->
		<a href="<?php echo $BaseUrl.'/upload/training/'.$NewFileName; ?>" target="_blank">
			<img src="<?php echo $BaseUrl.'/assets/images/icon/documents_icon.png'; ?>" class="img-responsive" >
		</a>
        
	</div>