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
$size_email      = 8;
        $alpha_key_email = '';
        $keys_email      = range('A', 'Z');
        for ($j = 0; $j < 2; $j++) {
            $alpha_key_email .= $keys_email[array_rand($keys_email)];
        }
        $length_email = $size_email - 2;
        $key_email    = '';
        $keys_email   = range(0, 9);
        for ($j = 0; $j < $length_email; $j++) {
            $key_email .= $keys_email[array_rand($keys_email)];
        }
 $emailRandCode = "ESP" . $alpha_key_email . $key_email;
		
		$_SESSION['email_otp']=$emailRandCode;  
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$fullname = $_POST['customername'];
$address = $_POST['address'];
$spUserEmail = $_POST['customeremail'];
$zipcode = $_POST['zip'];
$phone = $_POST['customerphone'];
$customer_name = $_POST['customername'];    
$spPostCountry = $_POST['Country'];
$spUserState = $_POST['state'];
 //$state = $_POST['state'];
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
			   "password"=>hash("sha256", $en_password),
			
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






$target_path = "upload_pos/";  
 
$target_path = $target_path.basename( $_FILES['fill']['name']);   
$file_name= $_FILES['fill']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['fill']['tmp_name'], $target_path)) {   

   $arr1= array("file"=>$file_name); 

    $p->update($arr1,$res);   
}

$_SESSION['msg']= 1;

$res = $p->read_email_check($spUserEmail); 
if($spUserEmail!=''){

     if($res == false){
 
 
$data = array("spUserName"=>$fullname,	 
			   "spUserFirstName"=>$fullname,
			    "spUserPhone"=>$phone,
				  "spUserEmail"=>$spUserEmail,
			   "spUserAddress"=>$address,
			 "spUserCountry"=>$spPostCountry,
			    "spUserState"=>$spUserState,
			   "spUserCity "=>$spUserCity,
			   "spUserzipcode"=>$zipcode,
			  
			   "customer_type"=>$customer_type,
			   "sales_price"=>$sales_price,
			   "tax"=>$tax,
			   "discount"=>$discount,
			   "payment_1"=>$payment_1,
			   "payment_2"=>$payment_2,
			   "notes"=>$notes,
			   "email_news"=>$email_news,
			  
			   "spUserPassword"=>hash("sha256", $en_password),
			   "empcheck"=>$empcheck,
			   "email_verify_code" =>$emailRandCode,
			   "paymentterm_type"=>$paymentterm_type,
			   "submembership"=>$submembership,
			   "membership"=>$membership,
			   "profiletype"=>$profiletype,
			
); 

 $res = $p->create_user($data);
 //print_r($res);die('+++++');
 
 
 
 $em = new _email;
        $em->sendemail();
        // // ===not complete
       $em->send_reg_email($spUserEmail,$fullname,$res, $emailRandCode);
	   
	    $em->send_reg_email_pos($spUserEmail,$fullname,$res);
	     
		 $re = $e->pos_password_email($customer_name, $spUserEmail, $en_password,'info-email@thesharepage.com'); 

//die('++++++++++++++++++');
        // ==============END=================
      //return $res;
		
 
 
 $aa=1;
 
$data = array("spProfileName"=>$fullname,	 
			   
			    "spProfilePhone"=>$phone,
				  "spProfileEmail"=>$spUserEmail,
				 "spProfilesDefault"=>$aa,
			    "spProfilesCountry"=>$spPostCountry,
			    "spProfilesState"=>$spUserState,
			   "spProfilesCity "=>$spUserCity,
			   "spUserzipcode"=>$zipcode,
			   "spUser_idspUser"=>$res,
			  "spProfileType_idspProfileType"=>$profiletype,
			  
			  
			
); 
//print_r($data);
//die('===');
 $res = $p->create_profile($data);
   } 
 }
 
else {
	 // $em->send_reg_email_pos($spUserEmail,$fullname,$res);

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
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/pos.php'; ?>";

</script>-->