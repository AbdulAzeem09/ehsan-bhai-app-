<?php

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	//$p = new _postingpic;
	$sp = new _sponsorpic;
	
	$img = $_POST["spPostingPic"];
	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);

	//echo $_POST['postedit']. '--'.$_POST['del'];

	if(isset($_POST['SponorId']) && $_POST['SponorId'] != ''){
		$sp->updatepic($_POST["SponorId"], $data);
		//echo $_POST['SponorId'];
	}
?>
	
