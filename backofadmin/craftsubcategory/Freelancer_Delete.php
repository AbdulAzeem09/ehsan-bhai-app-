<?php
require_once '../library/config.php';
require_once '../library/functions.php';

if(isset($_GET['id'])){
	$id= $_GET['id'];
$sql1= "DELETE FROM `in_sub_category` WHERE idinsubcategory = $id ";
$result2 = dbQuery($dbConn,$sql1);

redirect('index.php?view=Freelancer_SubCategory');
}
?>