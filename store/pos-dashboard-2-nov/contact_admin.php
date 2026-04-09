<?php
   session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
	
	
	$us= new _pos;
	/*if($_GET['action']=="delete"){
	$id=$_GET['id'];
	
	$us->delete_message($id);
	//header("Location:$BaseUrl/store/pos-dashboard/settings.php");
	}else{*/
	
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	"subject_type"=>$_POST['subject'],
	"message"=>$_POST['message']
	);
	
	$res = $us->add_message($data);
	
	
	$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['profile_img']['name']);   
$file_name= $_FILES['profile_img']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_path)) {   

   $arr1= array("file"=>$file_name); 

    $us->update_admin_method($arr1,$res);  
}
	
	//}
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=contact_type");