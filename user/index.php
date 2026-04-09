<?php
	include('Ulogin.php'); // Includes Login Script
	if(isset($_SESSION['login_user']))
	{
		//header("location: ../my-profile/index.php");
	}
?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="main">
		<div id="login">
			<h2> User Login</h2>
			
			<form action="" method="POST">
				<label>UserName :</label>
				<input id="name" name="username" placeholder="username" type="text"><br><br>
				<label>Password :</label>
				
				<input id="password" name="password" placeholder="**********" type="password">
				<br>
				</br>
				<input name="submit" type="submit" value=" Login ">
				<span><?php echo $error; ?></span>
			</form>
		</div>
	</div>
</body>
</html>