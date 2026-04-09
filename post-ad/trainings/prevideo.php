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

	if($_FILES['spmediaTrainPrev']['size'] != 0){
		$File_Name   = strtolower($_FILES['spmediaTrainPrev']['name']);
	}

	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = md5(rand() * time()); //Random number to be added to name.

	$FileExt = str_replace('.', '', $File_Ext);
	$spFileName = "video";

	$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	//$NewFileName 		= $File_Name; 

	if(move_uploaded_file($_FILES['spmediaTrainPrev']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}
	$pid = $_SESSION['pid'];
	$preview = 1;
	// chek kry ga phly k preview video set ha ya ni. agr ha to update kry ga ni to create

	$result2 = $pm->chekPreview($pid, $catid);
	//echo $pm->ta->sql;
	if ($result2) {
		$totalrow = $result2->num_rows;
	}else{
		$totalrow = 0;
	}
	
	if(isset($result2) && $totalrow == 0){

		$result = $pm->createPreview($NewFileName, $FileExt, $pid, $File_Name, $catid, $preview);
		//echo $pm->ta->sql;
	}else{
		$result3 = $pm->updatePreview($NewFileName, $FileExt, $pid, $File_Name, $catid, $preview);
		//echo "yes";
	}


	//$result = $pm->createTrain($NewFileName, $FileExt, $pid, $File_Name, $catid);
	//echo $result;
	//echo $pm->ta->sql;
		
?>
	<div class='col-md-4 imagepost' id="div1">
	<span class='fa fa-remove dynamicimg closed' style='margin-right:17px !important;'></span>
		<video controls style="width: 100%; height: 150px;">
		
            <source src="<?php echo $BaseUrl.'/upload/training/'.$NewFileName;?>" type="video/mp4">
		                                                                  
            Your browser does not support the video tag.
        </video>
	</div>
	
	<script>
	$(document).ready(function (){ 
     $('#div1').click(function(){
		 $('#div1').html('');
		 });
});
	

	

	</script>
	
	
	
	
	