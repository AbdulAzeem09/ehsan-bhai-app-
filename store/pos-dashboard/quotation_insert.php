<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

	
	$p = new _pos;  
if(isset($_POST['submit'])){

  $count=count($_POST['productto']);

$data=array(
    'uid'=>$_SESSION['uid'],
    'pid'=>$_SESSION['pid'],
    'quotation_date'=>$_POST['date'],
    'quotation_customer'=>$_POST['customer'],
    'quotation_warehouse'=>$_POST['warehouse'],
    'quotation_discount'=>$_POST['discount'],
    'quotation_grandtotal'=>$_POST['grandTotle'],
    'quotation_createdate'=>date('Y-m-d H:i:s')

);

 $id=$p->create_quotation($data);

 for($i=0;$i<$count;$i++){
    $productId=$_POST['productto'][$i];
  $productQty=$_POST['qty_'.$productId.''];

    $data1=array(
        'uid'=>$_SESSION['uid'],
        'pid'=>$_SESSION['pid'],
        'quotation_id'=>$id,
        'product_id'=>$productId,
        'product_qty'=>$productQty
       
    
    );
  $p->create_quotation_detail($data1);

 }
}


?>
<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/Quotation-list.php'; ?>";

</script>