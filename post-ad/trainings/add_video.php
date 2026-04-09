<?php 
	error_reporting(E_ALL);
ini_set('display_errors', 'On'); 
	session_start(); 
//die('======xxxxxxxxxxxxxxxx======');       

  function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
	
		$p = new _postings;
		//print_r($_POST); 
		//echo '<pre>';
		//print_r($_FILES);    
		//print_r($_FILES['spPostingMedia']);  
		//die('======xxxxxxxxxxxxxxxx======');          
		
		$countfiles =count($_FILES['spPostingMedia']['name']); 

		//echo $countfiles.'hello';  

		for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['spPostingMedia']['name'][$i];
   
        // Upload file
        move_uploaded_file($_FILES['spPostingMedia']['tmp_name'][$i] , $_SERVER['DOCUMENT_ROOT'].'/upload/training/'.$filename);       

        $files=array("postid"=>$_POST['spPostings_idspPostings'],
                    "filename"=>$filename); 


          $fi=$p->create_training_video_des($files);   
    
   }
		
		