<?php 
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
 include('../../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
		
		$_SESSION['afterlogin']="freelancer/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	//print_r($_POST);
	$visible=$_POST['visible'];
	
	$data= array("spPostingVisibility"=> -2);
	
	$an = new _freelancerposting;
	
	$an->deactivate($data,$visible);
		}