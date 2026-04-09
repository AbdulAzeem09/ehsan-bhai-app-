<?php 
	
	/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
	session_start();


  function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
	
		$p = new _postings;
		
		if(!empty($_FILES['spmediAttach'])){
		
	$name = $_FILES['spmediAttach']['name'];
 	$temp_name=$_FILES["spmediAttach"]["tmp_name"];
	 $extension = pathinfo($name, PATHINFO_EXTENSION);
$document_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
		 $result = substr($document_name, 0, 20);
	 	$name_document = $result.'.'.$extension;
		
		$_FILES['spmediAttach']['name']=$name_document;
		$file_name=$_FILES['spmediAttach']['name'];
	

move_uploaded_file($temp_name, "../uploads/" . $name_document);
	

$files=array("spuser_idspuser"=>$_SESSION['uid'],
"spprofiles_idspprofiles"=>$_SESSION['pid'],
"postid"=>$_POST['spPostings_idspPostings'],
"filename"=>$file_name);
$po=$p->delete_attachment_postid($_POST['spPostings_idspPostings']);
$fi=$p->create_training_attachment($files);

		}
		
		
		
		
		