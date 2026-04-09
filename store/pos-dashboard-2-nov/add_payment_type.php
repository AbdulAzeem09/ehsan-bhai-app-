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
$payment_type = $_POST['payment_type'];


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "payment_type"=>$payment_type);

$res = $p->create_payment_method($data);  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type'; ?>";

</script>