<?php
	include('../univ/baseurl.php');

	$_GET["mystore"]="4";
    $folderName = "friend-store";
    
	if(isset($_POST['txtStoreSearch']) && isset($_POST['btnSearchStore'])){
		$txtStoreSearch = $_POST['txtStoreSearch'];
		$txtSearchCategory 	= $_POST['txtSearchCategory'];
		include "../store/search.php";
		
	}else{
		//header('location:../details');
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$re = new _redirect;
  		$re->redirect("../friend-store");
	}
?>
