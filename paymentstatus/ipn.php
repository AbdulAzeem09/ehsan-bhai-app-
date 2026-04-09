<?php
	session_start();
	
	$txn_id = $_GET['tx'];
	$_SESSION['data'] = $txn_id
	
	if(!empty($_SESSION['data'])){
		
	}
    
?>