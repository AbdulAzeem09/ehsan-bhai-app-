<?php 

/*Array ( [customerno] => newcustomer [customername] => MOHIT SINGH [customerphone] => 1234567893 [customeremail] => pp@gmail.com [customertype] => 2 [address] => VILL-NAGLA SHARKI NEAR HOLI CHOWK [city] => Budaun [zip] => 243601 [customer_check] => 1 [saleprice] => 45.56 [tax] => 123 [discount_] => 123 [select_payment] => 2 [select_credit] => week [notes] => waretyrytuyt )*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";    
	//print_r($_POST);   
//print_r($_FILES);	die('----');   
	
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
$spPostCountry = $_POST['Country'];
$spUserState = $_POST['spUserState'];
$spUserCity = $_POST['city'];
$customer_type = $_POST['customertype'];
$sales_price = $_POST['saleprice'];
$tax = $_POST['tax'];
$discount = $_POST['discount_'];
$payment_1 = $_POST['select_payment'];
$payment_2 = $_POST['select_credit'];
$notes = $_POST['notes'];
$email_news = $_POST['customer_check']; 

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
			   "password"=>$en_password
			
); 

$res = $p->create($data); 
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






$target_path = "upload_files/";  
 
$target_path = $target_path.basename( $_FILES['fill']['name']);   
$file_name= $_FILES['fill']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['fill']['tmp_name'], $target_path)) {   

   $arr1= array("file"=>$file_name); 

    $p->update($arr1,$res);   
}
/*

$target_path = "upload_pos/"; 
$target_path = $target_path.basename( $_FILES['uploadidentity1']['name']);
  $file_name= $_FILES['uploadidentity1']['name']; 
  
if(move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $target_path)) {  
      $arr1= array("file2"=>$file_name); 

    $p->update($arr1,$res); 
} 
*/


?>

<!--<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/customer.php'; ?>";

</script>-->