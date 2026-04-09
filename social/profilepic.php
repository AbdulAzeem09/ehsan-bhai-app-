<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _spprofiles;
	$result = $p->read($_POST['profileid']);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		if(isset($row["spProfilePic"]))
			echo "<img alt='profilepic' class='img-circle' src=' ". ($row["spProfilePic"])."' style='width: 40px; height: 40px;' >" ;
		else
			echo "<img alt='profilepic' class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;' >" ;
	}
?>