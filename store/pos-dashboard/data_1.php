 <?php 
 //die('====');
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>"; 
	//print_r($_POST); die("----------");
	
$p = new _pos_po; 
$sp = new _pos;
$ids = $_POST['postid'];
$number = $_POST['second'];

$res = $p->read($ids);
if($res){ 
$row = mysqli_fetch_assoc($res);

$id1=$row['id'];
}
$rett = $sp->read_cust($ids,$_POST['current_barcode']);
if($rett){ 
	$rot = mysqli_fetch_assoc($rett);
	$quantity = $rot['quantity'];
	if($_POST['event']=="Deduct"){
	$totalSp = $rot['quantity'] - $_POST['second'];
	}else if($_POST['event']=="Add"){
	$totalSp = $rot['quantity'] + $_POST['second'];
	}
	$dataS=array(
		"quantity"=>$totalSp,
		);
	$ress = $sp->updateCust($dataS,$rot['id']); 
	}
	
$data2=array(
			   "pid"=>$_SESSION['pid'],
			   "uid"=>$_SESSION['uid'],
			    "barcode"=>$_POST['current_barcode'], 
				"quantity"=>$_POST['second'],
				"currency"=>$_POST['currency'],
				 "type"=>'Membership quantity',
				 "customerr_user_id"=>$_POST['postid'],
				 //"current_qty"=>$_POST['current_qty'],
				 "current_qty"=>$rot['quantity'],
				 //"member_ship_id"=>$current_member_ship_id,
				 "member_ship_id"=>$id1,
			   "event"=>$_POST['event'],
			   //"notes"=>$_POST['notes']
			   "notes"=>"note"
			);
			
$res1 = $p->insert_data_4($data2);

?>
<script>
  window.location.replace("<?php echo $BaseUrl;?>/store/pos-dashboard/customer-assign-membership.php?postid=<?php echo $ids; ?>");
  </script>