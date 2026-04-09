<?php
	spl_autoload_register(function ($class) 
	{
			include '../mlayer/' . $class . '.class.php';
	});
session_start();
// Storing Session
$user_check=$_SESSION['login_user'];

	$u = new _spuser;
	$res = $u->readLoginUser($_post['user_check']);
		if ($rpvt != false)
		{
			$row = mysqli_fetch_assoc($res);
			$login_session =$row['spUserName'];
			if(!isset($login_session))
			{ 
				header('Location: index.php'); 
			}
		}

?>