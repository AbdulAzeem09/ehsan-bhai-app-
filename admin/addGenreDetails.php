<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	$m = new _genre;
	$re = new _redirect;
	if($_POST["genre_id"] != null)
	{
		$data['genre_name'] =$_POST["genre_name"];
		$where = " WHERE genre_id=".$_POST["genre_id"];
		$m->update($data,$where);
		$_SESSION['err']="Genre Updated successfully.";
	}
	else
	{
		$data['genre_name'] =$_POST["genre_name"];
		$m->create($data);
		$_SESSION['err']="Genre Created successfully.";
		
	}
	$redirctUrl = "/admin/genre";
	
	$re->redirect($redirctUrl);	
	
?>