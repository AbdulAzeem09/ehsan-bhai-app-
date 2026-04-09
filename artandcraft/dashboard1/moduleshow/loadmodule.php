<?php
	include('../../univ/baseurl.php');
	session_start();

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	

	$p = new _spAllStoreForm;
	$pid = $_POST['pid'];
	$uid = $_POST['uid'];
	$show = $_POST['show'];
	$mod = $_POST['mod'];

	$result = $p->chekModExit($pid, $uid);
	if ($result) {
		// donot perform any task.
	}else{
		$p->createModShow($pid, $uid);
	}
	
	if ($mod == 5) {
		// update
		$data = array("freelance" => $show);
	}else if($mod == 2){
		$data = array("jobboard" => $show);
	}else if($mod == 3){
		$data = array("realestate" => $show);
	}else if($mod == 9){
		$data = array("event" => $show);
	}else if($mod == 13){
		$data = array("art" => $show);
	}else if($mod == 14){
		$data = array("music" => $show);
	}else if($mod == 10){
		$data = array("videos" => $show);
	}else if($mod == 8){
		$data = array("trainings" => $show);
	}else if($mod == 17){
		$data = array("groups" => $show);
	}else if($mod == 19){
		$data = array("directory" => $show);
	}else{
		$data = "";
	}

	$p->updateModShow($data ,$pid, $uid);
	//echo $p->ms->sql;
?>