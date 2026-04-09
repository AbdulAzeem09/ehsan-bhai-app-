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
//$old_password_in = $_POST['old_password_in']; 
$new_password_in = $_POST['new_password_in']; 
$confirm_password_in = $_POST['confirm_password_in']; 

if($new_password_in == $confirm_password_in ){


$data = array("pid"=>$pid,  
               "uid"=>$u_id,
               "password"=>$new_password_in);
			   
			   
			   

$res = $p->create_pass($data); 

//unset($_SESSION['pass_check']);   

}

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/index.php'; ?>";

</script>