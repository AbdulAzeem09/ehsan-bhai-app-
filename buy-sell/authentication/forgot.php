<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$u = new _spuser;
	$em = new _email; 

	$res = $u->regen($_POST['spfregemail']);
	//echo $u->ta->sql;
	if($res != false){
		$row = mysqli_fetch_assoc($res);
		$recode = "";
		$recode = str_shuffle($row["spUserPassword"]);
		$username = $row["spUserName"];
		$u->resetcode($_POST['spfregemail'],$recode);
		
		if($recode != ""){
			//echo "helo";
			$link = $BaseUrl."/authentication/resetpassword.php?me=".$row["idspUser"]."&recode=".$recode;

			$em->forgotpass($row['spUserFirstName'], $_POST['spfregemail'], $link);

		}
		echo 0;
	}else{
		echo 1;
	}
?> 