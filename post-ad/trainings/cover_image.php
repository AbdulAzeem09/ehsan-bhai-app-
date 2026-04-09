<?php 
	error_reporting(E_ALL);
ini_set('display_errors', 'On');
	session_start();


  function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
	
		$p = new _postings;
		if(!empty($_FILES['spPostingPic'])){
		$count =count($_FILES['spPostingPic']['name']);
		
		for($i=0;$i<$count;$i++)
		{
		
	$name = $_FILES['spPostingPic']['name'][$i];
	
	
	
	
 	
	  $extension = pathinfo($name, PATHINFO_EXTENSION);
	 // echo $extension.'=====';
$video_name = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
		 $result = substr($video_name, 0, 20);
	 	$name_video = $result.'.'.$extension;
		
		//$_FILES['spPostingPic']['name']=$name_video;
		//$file_name=$_FILES['spPostingPic']['name'][$i];
		
		
$temp_name = $_FILES['spPostingPic']["tmp_name"][$i];	
move_uploaded_file($temp_name,  "../uploads/".$name_video);




$files=array("spuser_idspuser"=>$_SESSION['uid'],
"spprofiles_idspprofiles"=>$_SESSION['pid'],
"postid"=>$_POST['spPostings_idspPostings'],
"filename"=>$name_video);


$fi=$p->create_training_cover_images($files);

		}
		}
		
		