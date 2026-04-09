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
	
	$p = new _pos_po;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_POST['p_id'];
$u_id = $_POST['u_id'];
$iteam = $_POST['iteam'];
$ship = $_POST['ship'];
$on_hand = $_POST['on_hand'];
$quantity = $_POST['quantity'];
$quantity_sold = $_POST['quantity_sold'];
$quantity_record = $_POST['quantity_record'];    
$unit_cost = $_POST['unit_cost'];
$total_cost = $_POST['total_cost'];
$mi = $_POST['mi'];
$notes = $_POST['notes'];
$GST = $_POST['GST'];
$Description = $_POST['Description'];

$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "iteam"=>$iteam,
			   "ship"=>$ship,
			   "on_hand"=>$on_hand,
			   "quantity"=>$quantity,
			   "quantity_sold"=>$quantity_sold,
			   "quantity_record"=>$quantity_record,
			   "unit_cost"=>$unit_cost,
			   "total_cost"=>$total_cost,
			   "mi"=>$mi,
			   "notes"=>$notes,
			   "GST"=>$GST,
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
window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/po.php'; ?>";

</script>