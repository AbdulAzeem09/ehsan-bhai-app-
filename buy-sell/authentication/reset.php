
<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$u = new _spuser;
	$re = new _redirect;

	$res = $u->read($_POST["userid_"]);
	if($res != false){
		$row = mysqli_fetch_assoc($res);
		$u->changepassword($_POST['userid_'],hash("sha256", $_POST['newpassword_']));

		$re->redirect('../login.php');
		//header("Location:../my-profile/");
	}

?>
