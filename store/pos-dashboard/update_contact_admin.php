<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();  
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$id = $_POST['id'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$hidden_file = $_POST['hidden_image'];  




$data = array("subject_type"=>$subject,
	            "message"=>$message); 

$res = $p->update_admin_method($data,$id);   


if($_FILES['profile_img']){  
$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['profile_img']['name']);   
$file_name= $_FILES['profile_img']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_path)) {    

   $arr1= array("file"=>$file_name); 

    $p->update_admin_method($arr1,$id); 
}
} else{
	$arr1= array("file"=>$hidden_file); 

    $p->update_admin_method($arr1,$id); 
}  

  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=contact_type'; ?>";

</script>