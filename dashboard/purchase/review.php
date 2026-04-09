<?php 

function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$id=$_GET['id'];
$arr=array(
"is_reviewed"=>1,
"rating"=>$_GET['status']


);


$m = new _spmembership;
$result = $m->update_review($arr,$id);

header('location:'.$BaseUrl.'/dashboard/purchase/index.php');


?>