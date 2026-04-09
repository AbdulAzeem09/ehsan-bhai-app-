<?php 
include('../../univ/baseurl.php');
    session_start();
	$_SESSION['msg']= 3;
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
$p = new _pos;  
$row_id = $_GET['id'];

	$p->remove_category_($row_id);    
	header("Location: ExpenseCategory.php");
  
  
?>

