<?php


    include('../../univ/baseurl.php');
    session_start();
	
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
	
	$id=$_GET['id'];
	$postid=$_GET['postid'];
	 $p = new _spprofiles;
	 $data=array("status"=>1);
	$p->change_bid_status($data,$id);
	header("Location: bid_detail.php?postid=$postid");
	
	
	
}
?>