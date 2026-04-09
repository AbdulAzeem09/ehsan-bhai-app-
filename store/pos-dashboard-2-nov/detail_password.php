<?php 
//die('-----');
error_reporting(E_ALL);  
ini_set('display_errors', 1);
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
$password_check = $_POST['password_check']; 
 




$res = $p->check_password_uid($password_check,$u_id); 

if($res){ 

$_SESSION['pass_check'] = 1;

?>
	<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type'; ?>";

</script>

<?php }else{ ?>
	
	<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/index.php?pass=wrong'; ?>";

</script>

 <?php }	



?>

