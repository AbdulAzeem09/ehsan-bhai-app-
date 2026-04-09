<?php



include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	
		//session_start();

	 $obj=new _spprofiles;
	 
	 $cid=$_POST['comment_id'];
	 
	  
	 $obj->deletecommentdata($cid) ;
	 
	$object=new _spprofilefeature;
	
	 $id=$_POST['id'];
	 
	 $object->deletetachmentfiles($id);
	 
	?>
	


   