<?php
	require_once 'config.php';

	function dbQuery($dbConn, $sql){
		$result = mysqli_query($dbConn, $sql);
		return $result;
	}

	function dbSelect($dbConn, $dbName){
		return mysqli_select_db($dbName);
	}
	
	function dbNumRows($result){
	if($result!=false){
		return mysqli_num_rows($result);
	}
	}
	function dbFetchAssoc($result){
	if($result!=false){
		return mysqli_fetch_assoc($result);
	}
	}
?>