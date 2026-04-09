<?php
	include('../univ/baseurl.php');
	$_GET["mystore"]="5";
    $folderName = "group-store";
    
	if(isset($_POST['txtStoreSearch']) && isset($_POST['btnSearchStore'])){
		$txtStoreSearch = $_POST['txtStoreSearch'];
		$txtSearchCategory 	= $_POST['txtSearchCategory'];
		include "../store/search.php";
		
	}else{
		//header('location:../details');
	}
?>
