
<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1); */
  //die("=====reset======");

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$u = new _spuser;
	$re = new _redirect;
	$e = new _spprofiles;
	$id = 3;
	$result = $e->read_description($id);
	$rows1 = mysqli_fetch_assoc($result);
	$heading = $rows1['notification_description'];
	$subject = $rows1['subject'];
echo $heading;
echo "<br>";
$res = $u->read($_POST["userid_"]);
	$rows = mysqli_fetch_assoc($res);
	$name=$rows['spUserFirstName'];
	$email=$rows['spUserEmail'];
	echo $name;
	$em = new _email;
	$em->reset_send_mail($name,$email,$heading,$subject);

	$res = $u->read($_POST["userid_"]);
	if($res != false){
		$row = mysqli_fetch_assoc($res);
		$u->changepassword($_POST['userid_'],hash("sha256", $_POST['newpassword_']));

		$re->redirect('../login.php');
		//header("Location:../my-profile/");
	}

?>
