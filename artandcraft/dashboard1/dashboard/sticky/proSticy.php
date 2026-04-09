<?php
	session_start();
	include('../../univ/baseurl.php');
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spAllStoreForm;
	$re = new _redirect;
	
	if (isset($_POST['btnPin'])) {
		$pid = $_POST['pid'];
		$pin = $_POST['txtPin'];
		$result = $p->readpinvalid($pid, $pin);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['pin'] = 1;
		}else{
			$redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
			$re->redirect($redirctUrl);
		}


	}else if (isset($_GET['action']) && $_GET['action'] == 'modify') {
		$hidId = $_POST['hidId'];
		$title = $_POST['spStickyTitle'];
		$desc = $_POST['spStickyDes'];
		$pid = $_POST['spProfile_idspProfile'];
		$p->updateSticky($pid, $title, $desc, $hidId);
		
	}else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = $_GET['id'];
		$p->deletSticky($id);

	}else if (isset($_POST['btnAdd'])) {
		$title = $_POST['spStickyTitle'];
		$desc = $_POST['spStickyDes'];
		$pid = $_POST['spProfile_idspProfile'];
		$type = 0;
		// add in tbl_sticy_notes;
		$p->createSticky($pid, $title, $desc, $type);
		
	}
	
	$redirctUrl = $BaseUrl . "/dashboard/sticky/index.php/";
	$re->redirect($redirctUrl);
	
?>