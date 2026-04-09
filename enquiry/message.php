<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	$pl = new _postenquiry;
	$res = $pl->readmessage($_POST["mid"]);
	if($res != false)
	{
		while($row = mysqli_fetch_assoc($res))
		{
			echo $row["message"];
		}
	}
		
?>