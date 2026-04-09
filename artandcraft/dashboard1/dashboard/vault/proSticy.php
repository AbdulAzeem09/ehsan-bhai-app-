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
		//echo $p->sn->sql;
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['pin'] = 1;
			$redirctUrl = $BaseUrl . "/dashboard/vault/index.php/";
			$re->redirect($redirctUrl);

		}else{
			$redirctUrl = $BaseUrl . "/dashboard/vault/pin.php/";
			$re->redirect($redirctUrl);
		}


	}else if (isset($_GET['action']) && $_GET['action'] == 'modify') {
		$hidId = $_POST['hidId'];
		$title = $_POST['spStickyTitle'];
		$desc = $_POST['spStickyDes'];
		$pid = $_POST['spProfile_idspProfile'];
		$p->updateSticky($pid, $title, $desc, $hidId);
		$redirctUrl = $BaseUrl . "/dashboard/vault/index.php/";
		
		$re->redirect($redirctUrl);
	}else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = $_GET['id'];
		$p->deletSticky($id);
		$redirctUrl = $BaseUrl . "/dashboard/vault/index.php/";
		$re->redirect($redirctUrl);
	}else if (isset($_POST['btnAdd'])) {

		$title = $_POST['spStickyTitle'];
		$desc = $_POST['spStickyDes'];
		$pid = $_POST['spProfile_idspProfile'];
		$type = $_POST['spStickyVault'];
		// add in tbl_sticy_notes;
		$p->createSticky($pid, $title, $desc, $type);
		$redirctUrl = $BaseUrl . "/dashboard/vault/index.php/";
		$re->redirect($redirctUrl);
	}
	
	
	
?>