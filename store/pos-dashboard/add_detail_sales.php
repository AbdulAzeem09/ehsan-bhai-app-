<?php 

/*Array ( [p_id] => 2971 [u_id] => 385 [fullname] => MOHIT SINGH [address] => VILL-NAGLA SHARKI NEAR HOLI CHOWK DIST- BUDAUN [spUserEmail] => price@gmail.com [zipcode] => 243601 [phone] => 7052303666 [uploadidentity] => s-2.jpg [uploadidentity1] => s-3.jpg ) ----------*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	//print_r($_POST); die("----------");
	
	$p = new _pos_sales;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_POST['p_id'];
$u_id = $_POST['u_id'];
$iteam = $_POST['iteam'];
$size = $_POST['size'];
$color = $_POST['color'];
$width = $_POST['width'];
$quantity = $_POST['quantity'];
$s_unit = $_POST['s_unit'];    
$u_price = $_POST['u_price'];
$discount = $_POST['discount'];
$amount = $_POST['amount'];
$g_sales = $_POST['g_sales'];
$p_sales = $_POST['p_sales'];
$Description = $_POST['Description'];

$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "iteam"=>$iteam,
			   "size"=>$size,
			   "color"=>$color,
			   "width"=>$width,
			   "quantity"=>$quantity,
			   "s_unit"=>$s_unit,
			   "u_price"=>$u_price,
			   "discount"=>$discount,
			   "amount"=>$amount,
			   "g_sales"=>$g_sales,
			   "p_sales"=>$p_sales,
			   "Description"=>$Description
			
); 

$res = $p->create($data); 






 /*$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['uploadidentity']['name']);   
$file_name= $_FILES['uploadidentity']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['uploadidentity']['tmp_name'], $target_path)) {   

   $arr1= array("file1"=>$file_name); 

    $p->update($arr1,$res); 
}


$target_path = "upload_pos/"; 
$target_path = $target_path.basename( $_FILES['uploadidentity1']['name']);
  $file_name= $_FILES['uploadidentity1']['name']; 
  
if(move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $target_path)) {  
      $arr1= array("file2"=>$file_name); 

    $p->update($arr1,$res); 
} 
*/


?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/sales.php'; ?>";

</script>