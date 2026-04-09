<?php 
	
	session_start();


  function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
	
		$p = new _postings;
	
		if(!empty($_FILES['spmediaTrainPrev'])){
		//$count =count($_FILES['spmediaTrainPrev']['name']);
		
		
	$name = $_FILES['spmediaTrainPrev']['name'];
	
	
	
 	$temp_name=$_FILES["spmediaTrainPrev"]["tmp_name"];
	 $extension = pathinfo($name, PATHINFO_EXTENSION);
$video_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
		 $result = substr($video_name, 0, 20);
	 	$name_video = $result.'.'.$extension;
		
		$_FILES['spmediaTrainPrev']['name']=$name_video;
		$file_name=$_FILES['spmediaTrainPrev']['name'];
	
	
	

move_uploaded_file($temp_name,  "../uploads/".$name_video);



$files=array("spuser_idspuser"=>$_SESSION['uid'],
"spprofiles_idspprofiles"=>$_SESSION['pid'],
"postid"=>$_POST['spPostings_idspPostings'],
"filename"=>$file_name);
$po=$p->delete_preview_video_postid($_POST['spPostings_idspPostings']);
$fi=$p->create_training_preview_video($files);

		
		
		}