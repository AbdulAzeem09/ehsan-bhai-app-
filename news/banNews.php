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
	  
	   $data=array(
	   
	   'newsid'=>$a,
	   'uid'=>$b,
	   'pid'=>$c,
	 
	   );
	   
	 $obj->createBANdata( $data);
	  // echo "<span class='fa fa-archive' title='Unarchive' style='color:blue'></span>";
//}
			
	
	 
	 
	?>
	


   