<?php
	spl_autoload_register(function ($class) {
			include '../mlayer/' . $class . '.class.php';
	});
	session_start(); 
	$error=''; 
	if (isset($_POST['submit'])) 
	{
		if (empty($_POST['username']) || empty($_POST['password'])) 
		{
			$error = "Username or Password is Empty";
			
		}
		
		else
		{
			$u = new _spuser;
			$r = $u->login($_POST['username'], $_POST['password']);
			if ($r != false)
			{	
				while($rows = mysqli_fetch_array($r))
				{
					if ($rows == 1)							
					
					{	
						$_SESSION['login_user']= $rows['spUserName'];
						$_SESSION['userid'] =  $rows['idspUser']; 
						$_SESSION['spUserEmail'] = $row['spUserEmail']; 
					}
				}
				if(isset($_SESSION['login_user']))
				{
					header("location: ../my-profile/index.php");
				}
			}
			
			else 
			{
				$error = "Username or Password is invalid";
			}
			
		}
	}
	 //echo $_SESSION['userid'];
	
	
?>