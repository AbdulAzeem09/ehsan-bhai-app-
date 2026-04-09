<?php 
include('../../univ/baseurl.php');
    session_start();

	$_SESSION['msg']= 2;

function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_GET); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);
$action = $_GET['action']; 
$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$id = $_POST['id'];
$payment_type = $_POST['payment_type'];





$data = array(
			   "payment_type"=>$payment_type);

$res = $p->update_payment_method($data,$id);   

  
if($action == "updatePay"){
	header("Location: payment.php");

}else{

?>
<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=payment_type'; ?>";

</script>
<?php } ?>