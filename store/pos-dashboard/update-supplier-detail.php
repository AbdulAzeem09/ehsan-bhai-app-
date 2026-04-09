<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	require_once('../../helpers/image.php');
	$postid = isset($_POST['id']) ? (int) $_POST['id'] : 0;
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

//$id = $_POST['id'];
$hidden_file = $_POST['hidden_file'];  
$fullname = $_POST['customerno'];
$address = $_POST['address'];
$spUserEmail = $_POST['customeremail'];
$zipcode = $_POST['zip'];
$phone = $_POST['customerphone'];
$customer_name = $_POST['customername'];    
$spPostCountry = $_POST['spPostCountry'];
$spUserState = $_POST['spUserState'];
$spUserCity = $_POST['spUserCity'];  
$customer_type = $_POST['customertype'];
$sales_price = $_POST['sales_price'];
$tax = $_POST['tax'];
$discount = $_POST['discount'];
$payment_1 = $_POST['paymentterm'];
$payment_2 = $_POST['creditterm'];
$notes = $_POST['notes'];
$email_news = $_POST['emailcheck']; 
$empcheck = $_POST['empcheck']; 
$paymentterm_type = $_POST['paymentterm_type']; 
$submembership = $_POST['submembership'];
$membership = $_POST['membership'];
$profiletype = $_POST['profiletype'];

$data = array(
			   "name"=>$fullname,
			   "address"=>$address,
			   "email"=>$spUserEmail,
			   "zipcode"=>$zipcode,
			   "phone"=>$phone,
			   "customer_name"=>$customer_name,
			   "country"=>$spPostCountry,
			   "state"=>$spUserState,
			   "city"=>$spUserCity,
			   "customer_type"=>$customer_type,
			   "sales_price"=>$sales_price,
			   "tax"=>$tax,
			   "discount"=>$discount,
			   "payment_1"=>$payment_1,
			   "payment_2"=>$payment_2,
			   "notes"=>$notes,
			   "email_news"=>$email_news,
			   "password"=>$en_password,
			   "empcheck"=>$empcheck,
			   "paymentterm_type"=>$paymentterm_type,
			   "submembership"=>$submembership,
			   "membership"=>$membership,
			   "profiletype"=>$profiletype,  
			
); 

$res = $p->update_supplier($data,$postid);     



if($_FILES['profile_img']){ 
  $image = new Image();
  $image->validateFileImageExtensions($_FILES['profile_img']);
   
$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['profile_img']['name']);   
$file_name= $_FILES['profile_img']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_path)) {    

   $arr1= array("file"=>$file_name); 

    $p->update_supplier($arr1,$postid); 
}
} else{
	$arr1= array("file"=>$hidden_file); 

    $p->update_supplier($arr1,$postid); 
}
/*
if($_FILES['uploadidentity1']){  
$target_path = "upload_pos/"; 
$target_path = $target_path.basename( $_FILES['uploadidentity1']['name']);
  $file_name= $_FILES['uploadidentity1']['name']; 
  
if(move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $target_path)) {  
      $arr1= array("file2"=>$file_name); 

    $p->update($arr1,$id); 
} 
} else{  
	
	$arr1= array("file2"=>$file_2); 

    $p->update($arr1,$id); 
}
*/
$_SESSION['msg']= 2;
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/supplier-list.php'; ?>";  

</script>
