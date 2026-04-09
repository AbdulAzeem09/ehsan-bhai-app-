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
	
	
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);
//print_r($_POST); die("----------");  
$id = $_POST['invt_id'];
//$pid = $_POST['p_id'];
//$u_id = $_POST['u_id'];
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

$data = array(
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
			   "gst_in"=>$gst_in ,
                "supplier_in"=>$supplier_in,
			   "vender_id_in"=>$vender_id_in,
			   "email_in"=>$email_in,
			   "phone_in"=>$phone_in,
			   "poNo_in"=>$poNo_in,
			   "invNo_in"=>$invNo_in,
			   "invDate_in"=>$invDate_in,   
			   "ref_in"=>$ref_in			   
			
); 

$res = $p->update_ret_inventory($data,$id);       

$_SESSION['msg'] = 2;



?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/receive-inventory.php'; ?>";

</script>