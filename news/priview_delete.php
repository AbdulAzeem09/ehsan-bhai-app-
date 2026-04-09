<?php



include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	
		//session_start();

	 $obj=new _news;
	 
   $rid=$_POST['id'];
	//die("llllllllllllllll");
	 
	  
	 $obj->deletepreviewfiles($rid) ;
	 
	
	 
	?>
	


   