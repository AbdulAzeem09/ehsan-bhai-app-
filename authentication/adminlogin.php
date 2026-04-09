<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	session_start(); 
	$u = new _spuser;
	$r = $u->adminlogin($_POST['spUserName'],hash("sha256", $_POST['spUserPassword']));
	if ($r != false)
	{	
		while($rows = mysqli_fetch_array($r))
		{  
			$_SESSION['login_user']= $rows['spUserName'];
			$_SESSION['uid'] =  $rows['idspUser']; 
			echo "/admin/buy/";
		}
	}
?>