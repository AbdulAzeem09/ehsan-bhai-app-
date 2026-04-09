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

	
	$p = new _pos_po;  
	
$price = $_POST['price'];
//echo $price;
//die('=====');
$duration = $_POST['duration'];
//echo $duration;
//die('=====');
$data1 = array(
			  
			   "price"=>$price, 
			   "duration"=>$duration.' days'

); 
//print_r($data);
//die('=====');

$res1 = $p->dataInsert($data1); 

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/backofadmin/content/b_sale.php'; ?>";

</script>