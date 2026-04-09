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
	require_once("../helpers/image.php");
	
	$gid = isset($_POST['comment_id']) ? (int) $_POST['comment_id'] : 0;
	
	$image = new Image();
	
	
	if(isset($_POST['submit'])){
		
	$object= new _spprofilefeature;
		
		  $comment=$_POST['comment'];
		   //$gid=$_POST['comment_id'];
		
		//die("OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO");
		$data=array(
		'comment'=>$comment,
	
		);
		
		$object->updatepostcomment( $data,$gid); 
		
    $image->validateFileImageExtensions($_FILES['newsPic']);
  
		//die("$$$$$$$$$$$$$$$");
	
	 $imgcount = count($_FILES['newsPic']['name']);    
	 
	 for( $i=0 ; $i < $imgcount ; $i++ ) {  
	 
	 if($_FILES['newsPic']['size']){
$File_Name3 = strtolower($_FILES['newsPic']['name'][$i] );
	$name3 = $_FILES["newsPic"]["name"][$i];
	$tmp_name3 = $_FILES["newsPic"]["tmp_name"][$i];

	 $uploads_dir3 = 'news_upload';
  move_uploaded_file($tmp_name3, "$uploads_dir3/$name3");
      
	 }

$data3=array(

'postid'=>$gid,
'attachmentfiles'=>$name3, 
'type'=>3

);
  $object->Update_news_attachment3($data3);  

	 
	}
	
 $image->validateFileDocExtensions($_FILES['newsDocument']);

 $doccount = count($_FILES['newsDocument']['name']);    
	
	 for( $i=0 ; $i < $doccount ; $i++ ) {  
	 

if($_FILES['newsDocument']['size'] ){
		$File_Name = strtolower($_FILES['newsDocument']['name'][$i]);
	$name = $_FILES["newsDocument"]["name"][$i];
	$tmp_name = $_FILES["newsDocument"]["tmp_name"][$i];
		
	 $uploads_dir = 'news_upload';
  move_uploaded_file($tmp_name, "$uploads_dir/$name"); 
}

$data=array(

'postid'=>$gid,
'attachmentfiles'=>$name,
'type'=>1

);

$object->Update_news_attachment($data);  

}







 

     
$image->validateFileVideoExtensions($_FILES['newsvideo']);

$Vidcount = count($_FILES['newsvideo']['name']);    
	 
	 for( $i=0 ; $i < $Vidcount ; $i++ ) {  



if($_FILES['newsvideo']['size']){
		 $File_Name2   = strtolower($_FILES['newsvideo']['name'][$i]);
	 $name2 = $_FILES["newsvideo"]["name"][$i];
	 $tmp_name2 = $_FILES["newsvideo"]["tmp_name"][$i];
	
	
    $uploads_dir2 = 'news_upload';
  move_uploaded_file($tmp_name2, "$uploads_dir2/$name2");  
}


$data2=array(

'postid'=>$gid,
'attachmentfiles'=>$name2, 
'type'=>2

);


 
$object->Update_news_attachment2($data2);

} 
  
	 
	 
	 
	

	


header("Location: " . $BaseUrl . "/news/index.php?page=1");

	  
	}
	   
	?>
	


   
