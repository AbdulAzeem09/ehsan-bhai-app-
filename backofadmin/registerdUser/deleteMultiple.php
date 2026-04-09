<?php
require_once '../library/config.php';
require_once '../library/functions.php';

if(isset($_POST['deleteuser']) && !empty($_POST['deleteuser'])){
	foreach ($_POST['deleteuser'] as $key => $value) {

		
		$sql		=	"DELETE FROM spuser WHERE idspUser=$value";
		echo $sql;
		$result 	= 	dbQuery($dbConn, $sql);
	}
	$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Users deleted.";
	
}
?>