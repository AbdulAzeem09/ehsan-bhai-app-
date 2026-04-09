<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$u = new _spuser;
	$pro = new _spprofiles;
	$profileid = isset($_POST["profileId"]) ? (int) $_POST["profileId"] : 0;
	$store_name = isset($_POST["store_name"]) ? $_POST["store_name"] :'';
	if($profileid) {
		$updateData = array(
			"store_name" => $store_name
		);
		$pro->updateAllOtherProfiles($updateData, $profileid);
		echo "Store name is successfully updated.";
	}
	else {
		echo "Something went wrong, Please try again.";
	}
?>
