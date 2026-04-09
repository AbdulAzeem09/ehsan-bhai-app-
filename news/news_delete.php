<?php



//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$obj=new _news;
	
	
	  $a=$_POST['news_id'];
	 $obj->removebookmarknews($a) ;
         

	

			
	
	 
	 
	?>
	


   