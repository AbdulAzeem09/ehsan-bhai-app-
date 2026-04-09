<?php 
	include('../univ/baseurl.php');
     include( "../univ/main.php");
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-profile/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

			
			$n= new _spuser;
			$n1=$n->readaddress($_SESSION['uid'],$_SESSION['pid']);
			//var_dump($n1);die;
			if($n1!=false){
			$n2=mysqli_fetch_assoc($n1);
			}
			if($n2['status']==0){
			$arr= array("status"=>1);
			$n->updateaddress($arr,$_SESSION['uid'],$_SESSION['pid']);
			}
			header("Location: add-shipping.php");
}