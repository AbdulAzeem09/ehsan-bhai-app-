<?php 

/*Array ( [Barcode_in] => 123456 [products_in] => 2 [Color_in] => 2 [size_in] => 3 [qty_in] => 5 [cost_in] => 300 [t_cast] => 800 [markup_in] => 6 [gp_in] => 9 [price_in] => 500 [gst_in] => 1 ) ----------*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	//print_r($_POST); die("----------");  
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid']; 
$Barcode_in = $_POST['Barcode_in'];
$products_in = $_POST['products_in'];
$Color_in = $_POST['Color_in'];
$size_in = $_POST['size_in'];
$qty_in = $_POST['qty_in'];
$cost_in = $_POST['cost_in'];    
$t_cast = $_POST['t_cast'];
$markup_in = $_POST['markup_in'];
$gp_in = $_POST['gp_in'];
$price_in = $_POST['price_in'];
//$myfile = $_POST['myfile'];
$gst_in = $_POST['gst_in'];
$supplier_in = $_POST['supplier_in'];
$vender_id_in = $_POST['vender_id_in'];
$email_in = $_POST['email_in'];
$phone_in = $_POST['phone_in'];
$poNo_in = $_POST['poNo_in'];
$invNo_in = $_POST['invNo_in'];
$invDate_in = $_POST['invDate_in'];
$ref_in = $_POST['ref_in'];

/*$file_name = $_FILES['myfile']['name'];
      $file_size =$_FILES['myfile']['size'];
      $file_tmp =$_FILES['myfile']['tmp_name'];
      $file_type=$_FILES['myfile']['type'];
    
	  move_uploaded_file($file_tmp,"img/".$file_name);*/
//echo $file_name;
//die("==");

$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "Barcode_in"=>$Barcode_in,
			   "products_in"=>$products_in,
			   "Color_in"=>$Color_in,
			   "size_in"=>$size_in,
			   "qty_in"=>$qty_in,
			   "cost_in"=>$cost_in,
			   "t_cast"=>$t_cast,
			   "markup_in"=>$markup_in,
			   "gp_in"=>$gp_in,
			   "price_in"=>$price_in,
			   "gst_in"=>$gst_in,
			   "supplier_in"=>$supplier_in,
			   "vender_id_in"=>$vender_id_in,
			   "email_in"=>$email_in,
			   "phone_in"=>$phone_in,
			   "poNo_in"=>$poNo_in,
			   "invNo_in"=>$invNo_in,
			   "invDate_in"=>$invDate_in,   
			   "ref_in"=>$ref_in
			   
			
); 

$res = $p->create_ret_inventory($data);  






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
$_SESSION['msg'] = 1;  

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/receive-inventory.php'; ?>";

</script>