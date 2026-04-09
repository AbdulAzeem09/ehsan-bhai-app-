<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';  
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";
$p=new _spuser;
$pos=new _pos;

//die('====1');
if(isset($_POST['quantity_btn'])){
	//echo $_POST['customer_id'];
	//echo $_POST['barcode'];
	//die('==');
	$type="Membership_quantity";
	$data=array(
	'uid'=>$_SESSION['uid'],
	'pid'=>$_SESSION['pid'],
	'customerr_user_id'=>$_POST['customer_id'],
	'currency'=>$_POST['currency'],
	'barcode'=>$_POST['barcode'],
	'quantity'=>$_POST['quantity'],
	'type'=>$type,
	'date'=>date("Y/m/d"),
	'current_qty'=>$_POST['current_qty'],
	'member_ship_id'=>$_POST['member_ship_id'],
	'notes'=>$_POST['notes'],
	);
	//print_r($data);
	//die('==');
	//$p->add_quantity($data);
	
	$p->add_quantity_manually($data);
	
	
		$data_1=array(
		'quantity'=>$_POST['quantity']+$_POST['current_qty'],
		);
		$pos->update_membership_real($data_1,$_POST['member_ship_id']);

	
	
	
	//die('==');
	?>
	<script>
  window.location.replace('<?php echo $BaseUrl?>/store/pos-dashboard/customer-assign-membership.php?postid=<?php echo $_POST["customer_id"]?>');
  </script>
	<?php
}



if(isset($_POST['quantity_btn_d'])){
	$type="Membership_quantity";
	$data=array(
	'uid'=>$_SESSION['uid'],
	'pid'=>$_SESSION['pid'],
	'customer_id'=>$_POST['customer_id_d'],
	'currency'=>$_POST['currency_d'],
	'barcode'=>$_POST['barcode_d'],
	'quantity'=>$_POST['quantity_d'],
	'type'=>$type,
	'date'=>date("Y/m/d")
	);
	
	$p->add_duration($data);
	?>
<script>
  window.location.replace('<?php echo $BaseUrl?>/store/pos-dashboard/customer-assign-membership.php?postid=<?php echo $_POST["customer_id_d"]?>');
  </script>
<?php
}

?>



<?php
}
?>