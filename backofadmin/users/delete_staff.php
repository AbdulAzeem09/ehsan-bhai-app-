<?php
require_once '../library/config.php';
require_once '../library/functions.php';

if(isset($_GET['id'])){
	$id= $_GET['id'];
$sql1= "DELETE FROM `staff` WHERE id= $id ";
$result2 = dbQuery($dbConn,$sql1);

$sql3= "DELETE FROM `role_permission` WHERE role_id= $id ";
$result3 = dbQuery($dbConn,$sql3);

redirect('index.php?view=staff');
}
?>