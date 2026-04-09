<?php 

/*Array ( [barcode_in] => 123456 [productname_in] => watch [purchaseprice_in] => 200 [cost_in] => 300 [saleprice_in] => 300 [color_in] => red [tax_in] => 33 [product_cat_in] => Fruits [product_sub_cat_in] => Fresh Fruit [description_in] => wetreytruyt ) =======*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";    
	//print_r($_POST); die('=======');    
//print_r($_FILES);	die('----');  
	
	$p = new _spprofiles;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$barcode_in = $_POST['barcode_in'];
$productname_in = $_POST['productname_in'];
$cost_in = $_POST['cost_in'];
$saleprice_in = $_POST['saleprice_in'];
$product_cat_in = $_POST['product_cat_in'];
$description_in = $_POST['description_in'];    


/*$e = new _email;  

$password = random_int(100000, 999999);


$re = $e->pos_password_email($customer_name, $spUserEmail, $password); 

$en_password = md5($password);*/

$data = array("spProfiles_idspProfiles"=>$pid,  
               "spuser_idspuser"=>$u_id,
			   "barcode"=>$barcode_in,
			   "spPostingTitle"=>$productname_in,
			   "spPostingPrice"=>$cost_in,
			   "discounted_price"=>$saleprice_in,
			   "subcategory"=>$product_cat_in,
			   "spPostingNotes"=>$description_in
			  
); 

$res = $p->create_spproduct($data); 
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





$pf = new _productpic;
$target_path = "upload_pos/";  
 
$target_path = $target_path.basename( $_FILES['feat_img']['name']);    
$file_name= $_FILES['feat_img']['name'];   
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['feat_img']['tmp_name'], $target_path)) {   

   //$arr1= array("file1"=>$file_name); 
$FeatureImg= 1;
   $pf->createPic($res, $file_name, $FeatureImg);  
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

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/customer.php'; ?>";

</script>