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
$name_qty_dur = $_POST['name_qty_dur'];
$qty_check = $_POST['qty_check'];
$qty_duration = $_POST['qty_duration'];
$price_qty_dur = $_POST['price_qty_dur'];


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "name_qty_dur"=>$name_qty_dur,  
			   "qty_check"=>$qty_check,
			   "qty_duration"=>$qty_duration,
			   "price_qty_dur"=>$price_qty_dur,
			   
			   
			   );

$res = $p->create_mem_qty_dur_method($data);       
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=membership_type'; ?>";

</script>