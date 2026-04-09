<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";  
    //print_r($_FILES);
	//print_r($_POST); die();
	require_once('../../helpers/image.php');
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
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

$e = new _email;  

$password = random_int(100000, 999999);


$re = $e->pos_password_email($customer_name, $spUserEmail, $password); 

$en_password = md5($password); 

$data = array("pid"=>$pid,
               "uid"=>$u_id,
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
			   'pos_empid' => $_SESSION['pos_emplyee_id']
			
); 
//print_r($data); die('===========');
$res = $p->create_supplier($data);
//echo $res;
//die('==');
/*if(isset($_POST['btn'])){
	//die('===');
	$countfiles = count($_FILES['uploadimg']['name']);
	for($i=0;$i<$countfiles;$i++){
     $file_name = $_FILES['uploadimg']['name'][$i];
      $file_size =$_FILES['uploadimg']['size'][$i];
      $file_tmp =$_FILES['uploadimg']['tmp_name'][$i];
      $file_type=$_FILES['uploadimg']['type'][$i];
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	      move_uploaded_file($file_tmp,"img/".$file_name);
	 //move_uploaded_file($_FILES['file']['tmp_name'][$i],'eventgallery/'.$file_name);
      
	$arr=array(
	'uid'=>$u_id,
	'pid'=>$pid,
    'image'=>$file_name
	);
	$p->uploadimg($arr);
	
}
}
*/



 $image = new Image();
 $image->validateFileImageExtensions($_FILES['profile_img']);
  


$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['profile_img']['name']);   
$file_name= $_FILES['profile_img']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_path)) {   

   $arr1= array("file"=>$file_name); 

    $p->update_supplier($arr1,$res); 
}


$target_path = "upload_pos/"; 
$target_path = $target_path.basename( $_FILES['uploadidentity1']['name']);
  $file_name= $_FILES['uploadidentity1']['name']; 
  
if(move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $target_path)) {  
      $arr1= array("file2"=>$file_name); 

    $p->update_supplier($arr1,$res); 
} 
$_SESSION['msg']= 1;


?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/supplier-list.php'; ?>";  

</script>
