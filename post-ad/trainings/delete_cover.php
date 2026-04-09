<?php 
	
	
    session_start();
	
  function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
  }
  
   spl_autoload_register("sp_autoloader");
  $p = new _postings;
  
  $id=$_GET['data-cover'];
  
  $p->delete_cover_image($id);