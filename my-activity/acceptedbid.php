<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _postings;
	$p->accepbid($_POST["postid"], $_POST["profileid"]);
	//echo "Completed";
	
	/*$headers = "From: THE SHAREPAGE <manohar@officesoft.in> \r\n";
	$msg = "Dear " . $_POST["sellername"]. ",\r\n\r\n" . "Your quotation has successfully accepted\r\n\r\n";
	$msg .= "Contact Person:".$_POST["buyername"]."\r\nContact No: ".$_POST["buyerphone"]."\r\n\r\n"; 
	$msg .="Regards,\r\n".$_POST["buyername"]."\r\n\r\n"; 
	mail($_POST["selleremail"], "The SharePage, Quotation successful accepted.", $msg, $headers);*/
?>