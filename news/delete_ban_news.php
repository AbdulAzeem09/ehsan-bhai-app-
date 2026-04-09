<?php



error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$obj=new _spprofiles;
	
	
	  $a=$_POST['id'];
	  $b=$_SESSION['uid'];
   $c=$_SESSION['pid'];
	
	$res=$obj->readBANdata($b,$c,$a) ;
	//print_r($res);
	//die("@@@@@@@@@@@@@@@@@@@@@@@");
	
	if($res!=false){
	//$obj=new _news;
	
	
	
		$obj->deleteBANdata($b,$c,$a) ;
          
}
?>
	


   