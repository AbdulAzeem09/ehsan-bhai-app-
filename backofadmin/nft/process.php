<?php
require_once '../library/config.php';
require_once '../library/functions.php';

	$return = $_SERVER['REQUEST_URI'];
echo "<pre>";

$nft_url = "/backofadmin/nft/index.php";
if (isset($_POST['action'])) {
	if ($_POST['action']=="nft_category_add") {
		$sql = "INSERT INTO nft_category (name) VALUES ('".$_POST['name']."')";
		$result  = dbQuery($dbConn, $sql);
	}
	if ($_POST['action']=="nft_category_update") {
		$sql = "UPDATE nft_category SET name='".$_POST['name']."' WHERE id=".$_POST['id'];
		$result  = dbQuery($dbConn, $sql);
	}

	if ($_POST['action']=="nft_setting_update") {


		$sql = "UPDATE nft_setting SET ins='".$_POST['ins']."' WHERE id=1";
		$result  = dbQuery($dbConn, $sql);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}




}


if (isset($_GET['action'])) {
	if ($_GET['action']=="delete") {
		$sql = "DELETE FROM nft_category WHERE id=".$_GET['id'];
		$result  = dbQuery($dbConn, $sql);
	}
}

header("Location:".$nft_url);
die();






?>