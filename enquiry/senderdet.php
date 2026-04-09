<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//idspMessage, buyerProfileid, sellerProfileid, message, spPostings_idspPostings
	$pl = new _postenquiry;
	$res = $pl->readbuyer($_POST["mid"] , $_SESSION["uid"]);//As a buyer
	if($res != false)
	{
		$row = mysqli_fetch_assoc($res);
		echo "<input type='hidden' id='receiverid' value='".$row["sellerProfileid"]."'>";
	}
	
	$pl = new _postenquiry;
	$res = $pl->readseller($_POST["mid"] ,$_SESSION["uid"]);//As a seller
	if($res != false)
	{
		$row = mysqli_fetch_assoc($res);
		echo "<input type='hidden' id='receiverid' value='".$row["buyerProfileid"]."'>";
	}
		
?>