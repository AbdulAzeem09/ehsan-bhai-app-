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
	
	
	
	$p = new _pos_vendor;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_POST['p_id'];
$u_id = $_POST['u_id'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$spUserEmail = $_POST['spUserEmail'];
$zipcode = $_POST['zipcode'];
$phone = $_POST['phone'];
$phone_1 = $_POST['phone_1'];    
$spPostCountry = $_POST['spPostCountry'];
$spUserState = $_POST['spUserState'];
$spUserCity = $_POST['spUserCity'];
$street_name = $_POST['street_name'];
$street_no = $_POST['street_no'];

$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "name"=>$fullname,
			   "notes"=>$address,
			   "email"=>$spUserEmail,
			   "zipcode"=>$zipcode,
			   "phone"=>$phone,
			   "alt_phone"=>$phone_1,
			   "country"=>$spPostCountry,
			   "state"=>$spUserState,
			   "city"=>$spUserCity,
			   "street_name"=>$street_name,
			   "street_no"=>$street_no
			
); 

$res = $p->create($data); 




$target_path = "upload_pos/"; 
 
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



?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/vendor.php'; ?>";

</script>