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
$set_password_in = $_POST['set_password_in']; 
$id = $_POST['user'];  

$us1=$p->read_users_id($id);
              if($us1!=false){
		$row = mysqli_fetch_assoc($us1);
         $email = $row['email'];		
												  
	  }
//$confirm_password_in = $_POST['confirm_password_in']; 

$data = array("pid"=>$pid,
               "uid"=>$u_id,
               "password"=>$set_password_in,
               "users"=>$email,
               "user_id"=>$id 
);
			   
$res = $p->create_user_pass($data);   

//unset($_SESSION['pass_check']);   
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=pass_type'; ?>";

</script>