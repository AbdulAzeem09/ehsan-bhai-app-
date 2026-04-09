<?php
	
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spuser;

	if(isset($_POST['txtUser']) && $_POST['txtUser'] > 0){

		$uid = $_POST['txtUser'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$address = $_POST['address'];

		$result = $p->readship($uid);
		if ($result) {
			// UPDATE
			$p->updateship($name, $mobile, $email, $country, $state, $city, $address, $uid);
		}else{
			// INSERT
			$p->insertship($name, $mobile, $email, $country, $state, $city, $address, $uid);
		}	
	}
?>