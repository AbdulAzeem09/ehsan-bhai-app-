<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$q = new _spquotation;
	$q->rejected($_POST["quotationid"]);
	
	$headers = "From: THE SHAREPAGE <manohar@officesoft.in> \r\n";
	$msg = "Dear " . $_POST["sellername"]. ",\r\n\r\n" . "Your quotation has Rejected\r\n\r\n";
	$msg .= "Contact Person:".$_POST["buyername"]."\r\nContact No: ".$_POST["buyerphone"]."\r\n\r\n"; 
	$msg .="Regards,\r\n".$_POST["buyername"]."\r\n\r\n"; 
	mail($_POST["selleremail"], "The SharePage, Quotation  has Rejected.", $msg, $headers);
?>