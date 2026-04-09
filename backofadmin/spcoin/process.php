<?php
require_once '../library/config.php';
require_once '../library/functions.php';

	$return = $_SERVER['REQUEST_URI'];
echo "<pre>";



$nft_url = "/backofadmin/spcoin/index.php";
if (isset($_POST['action'])) {

	if ($_POST['action']=="sp_coin_update") {
		//die('==');
		$sql = "UPDATE spcoin_core SET supply='".$_POST['supply']."',price='".$_POST['price']."',fector_up='".$_POST['fector_up']."',fector_down='".$_POST['fector_down']."' WHERE id=".$_POST['id'];
		$result  = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Update Successfully.";
		header('Location: ' . $return);
		die();
	}

	if ($_POST['action']=="sp_coin_updateXXX") {
		$sql = "INSERT INTO nft_category (name) VALUES ('".$_POST['name']."')";
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
		$sql = "DELETE FROM nft_category WHERE id=".base64_decode($_GET['id']);
		$result  = dbQuery($dbConn, $sql);
	}

	if ($_GET['action']=="fill") {
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO spcoin_historical (price,created_at) VALUES (100,'".$date."')";
		$result  = dbQuery($dbConn, $sql);
	}
}

header("Location:".$nft_url);
die();






?>