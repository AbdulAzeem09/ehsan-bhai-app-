<?php
	session_start();
	$_SESSION["timeline"]= $_GET['timeline'];
	echo $_SESSION["timeline"];
?>