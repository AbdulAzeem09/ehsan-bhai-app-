<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
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
	
	
	
					if(isset($_POST['submit_retail'])){
						
						if(isset($_FILES['file'])){
				
		
			
	$filename = $_FILES["file"]["name"];
	$tempname = $_FILES["file"]["tmp_name"]; 
		$folder = "pos_csv/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			echo "<script>alert('File uploaded successfully');</script>";
			
		
			
		}
		
		$row = 1;
			$path = $BaseUrl."/store/pos-dashboard/pos_csv/".$filename;
			//echo $path; die('-------');
if (($handle = fopen($path , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  //3
      
		$pid= $_SESSION['pid'];
		$uid= $_SESSION['uid'];
		
		$Date =  date('Y-m-d');
 //print_r($data); die('-----');   

$e = new _email;  

$password = random_int(100000, 999999);

$customer_name = $data[1];
$spUserEmail = $data[3];
$pos_phone=$data[2];


$re = $e->pos_password_email($customer_name, $spUserEmail, $password); 

$en_password = md5($password);  
		
		
		$p = new _pos;
		$pos_phone = $p->read__pos_phone($pos_phone); 
		$res_pos = $p->read__pos_email($spUserEmail); 
         if($res_pos== false){
			 if($pos_phone==false){
		
		$alldata = array(  "pid"=>$pid,
						   "uid"=>$uid,
						   "name"=>$data[0],
						   "customer_name"=>$data[1],
						   "phone"=>$data[2],
						   "email"=>$data[3],
						   "customer_type"=>$data[4],
						   "profiletype"=>$data[5],
						   "membership"=>$data[6],
						   "submembership"=>$data[7],
						   "email_news"=>$data[8],
						   "empcheck"=>$data[9],
						   "address"=>$data[10],
						   "zipcode"=>$data[11],
						   "country"=>$data[12],
						   "state"=>$data[13],
						   "city"=>$data[14],
						   "payment_1"=>$data[15],
						   "payment_2"=>$data[16],
						   "discount"=>$data[17],
						   "notes"=>$data[18],
						    "password"=>$en_password,
						   
										  );
										  
	 						    
                                $res1 = $p->create($alldata); 
								
		 }
	}

												
$barcode = $data[0];
$quantity = $data[1];
$type = $data[2];
$customerr_user_id = $data[3];
$current_qty = $data[4];
$member_ship_id = $data[5];
$notes = $data[6];
$event = $data[7];

$data3=array(
           "pid"=>$pid,
           "uid"=>$uid,    
		'barcode'=>$data[0],
		'quantity'=>$data[1],
		'type'=>$data[2],
		'customerr_user_id'=>$data[3],
		'current_qty'=>$data[4],
		'member_ship_id'=>$data[5],
		'notes'=>$data[6],
		'event'=>$data[7],

);
//print_r($data3);
//die('======');

 $res3 = $p->create_data($data3); 					
	
										   
										   
										   
										   
										   
										   
										   
										   
										   
										   
										   
 $res = $p->read_email_check($spUserEmail); 
if($spUserEmail!=''){
         if($res == false){
			 			 $result1=$p->read_Email_1($phone);
if(!$result1){
 
 $username = $data[1];
 $spUserPhone = $data[2];
 $spUserEmail=$data[3];
 $spUserCountry=$data[12];
 $spUserState=$data[13];
 $spUserCity=$data[14];
 $spUserzipcode=$data[11];
 $profiletype=$data[5];
$data = array("spUserName"=>$username,	 
			   "spUserFirstName"=>$data[1],
			    "spUserPhone"=>$spUserPhone,
				  "spUserEmail"=>$spUserEmail,
			   "spUserAddress"=>$data[10],
			 "spUserCountry"=> $spUserCountry,
			    "spUserState"=>$spUserState,
			   "spUserCity "=>$spUserCity,
			   "spUserzipcode"=> $spUserzipcode,
			   "customer_type"=>$data[4],
			   "sales_price"=>$sales_price,
			   "tax"=>$tax,
			   "discount"=>$data[17],
			   "payment_1"=>$data[15],
			   "payment_2"=>$data[16],
			   "notes"=>$data[18],
			   "email_news"=>$data[8],	  
			   "spUserPassword"=>$en_password,
			   "empcheck"=>$data[9],
			   "email_verify_code" =>$emailRandCode,
			   "paymentterm_type"=>$paymentterm_type,
			   "submembership"=>$data[7],
			   "membership"=>$data[6],
			   "profiletype"=>$profiletype,
			
); 
echo "<pre>";

 //print_r($data);
 //die('++++++'); 
//spuser
 $res = $p->create_user($data);
 //print_r($res);die('+++++');
 
 
 
// $em = new _email;
        $e->sendemail();
        // // ===not complete
       $send_reg=$e->send_reg_email($data[3],$data[1],$res, $emailRandCode);
	   
	    $send=$e->send_reg_email_pos($data[3],$data[1],$res);
	     
		 $re = $e->pos_password_email($data[0], $data[3], $en_password); 
		 
		 $aa=1;
 
$data1 = array("spProfileName"=>$username,	 
			    "spProfilePhone"=>$spUserPhone,
				  "spProfileEmail"=>$spUserEmail,
				 "spProfilesDefault"=>$aa,
			    "spProfilesCountry"=> $spUserCountry,
			    "spProfilesState"=>$spUserState,
			   "spProfilesCity "=>$spUserCity,
			   "spUserzipcode"=> $spUserzipcode,
			   "spUser_idspUser"=>$res,
			  "spProfileType_idspProfileType"=>$profiletype,
); 
 
 $res = $p->create_profile($data1);
 
 
 
		 }
   } 
}
 

$result=$p->readCurrency($_SESSION["uid"]);
if($result){
$row1=mysqli_fetch_assoc($result);
$currency=$row1['currency'];

}
//phone number

$phone=$data[2];
//echo $phone;die('+++++');
$result1=$p->read_Email_1($phone);
//print_r($result1);die('++===');
if($result1){
	$row2=mysqli_fetch_assoc($result1);
//print_r($row2);
	//die('=====');
$id=$row2['idspUser'];
	$email=$row2['spUserEmail'];
	//echo $email;
	//die('======');
	$phone=$row2['spUserPhone'];
	//echo $phone;
	//die('=====');
}

$result2=$p->read_Customer_1($data[7]);
if($result2){
	$row3=mysqli_fetch_assoc($result2);
 $Quantity=$row3['Qty_qty'];
  //$bar=$row3['barcode'];
 //echo $bar;
 //die('====');
		
}


$member_type=$_POST['membership'];
//echo $member_type;die('++++++');
if($member_type==1){
	$mem='Membership_Quantity';
}else{
	$mem='Membership_Duration';
}
$form_qty=$_POST['form_quantity'];

$date=date("Y/m/d");

$barcode=$data[7];
$quantity=$data[19];
//$customer_id=$res;
//echo $res;
//die('======');
$data4=array(
   "pid"=>$pid,
   "uid"=>$uid,
   "type"=>$mem,
   "date"=>$date,
   "customer_id"=>$res1,
   "currency"=>$currency,
   "customerr_user_id"=>$id,
   "barcode"=>$barcode,  
   "quantity"=>$quantity,
);
//barcode vala table
$res2 = $p->create_profile_1($data4);
										   
										 								   

      //  }
    } //die("---------------------");
    fclose($handle); 
}
		
			}
			 
			
			
						
					}
					

	
	
	

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/customer-assign-membership.php'; ?>";  

</script>