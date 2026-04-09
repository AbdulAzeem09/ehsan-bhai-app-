<?php


//die('==');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$p=new _pos;
if(isset($_POST['btn1'])){
//$uid=$_POST['uid'];

//print_r($_POST);
//die('==');

$membership_name=$_POST['membership_name'];
$customer_name=$_POST['cust_name'];
//$date=date();
//echo $customer_name;
//echo $membership_name;
//die('==');
$arr=array(
'customer_id'=>$customer_name,
'membership_id'=>$membership_name,
);

		$p->insert($arr);

}

}
?>