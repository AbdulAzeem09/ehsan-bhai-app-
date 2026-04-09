 <?php 
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>"; 
	//print_r($_POST); die("----------");
	
$p = new _pos_po; 
 
$ids = $_POST['postid'];
$firstbox = $_POST['first'];


$res = $p->read($ids); 
//print_r($res);
//die('=='); 
$row = mysqli_fetch_assoc($res);
$id1=$row['id'];
$qty=$row['quantity'];
//echo $qty;
//die('====');

$left=$quantity-$firstbox;
$res = $p->updateCus($id1,$left);



$p = new _pos;  
 $id = $_POST['id'];
 $tbl = $_POST['tbl'];
 
 
  if($tbl == "pos_membership_barcode"){

  $res = $p->read_data_phone2($id); 

//print_r($res);  die('======');
if($res){
	 $data['quantity']=0;

	//$row = mysqli_fetch_assoc($res); 
	while ($row = mysqli_fetch_assoc($res)){

//$data['id'] = $row['id'];

 $data['quantity'] =  $data['quantity']+$row['quantity'];



}

  }
  else{
	 $data = ['quantity' =>''];
	   
  }

  }



?>
<!--
<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard\customer_membership1.php'; ?>";

</script>-->