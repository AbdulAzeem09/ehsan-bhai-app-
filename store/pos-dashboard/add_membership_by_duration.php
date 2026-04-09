<?php 

/*Array ( [Name] => Jatin Sanwal [dur_Qty] => 2 [paymentterm] => 2 [dur_price] => 1234 )*/
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();  
$p = new _pos; 
$sp = new _spprofiles;   
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$Name = $_POST['Name'];
$dur_Qty = $_POST['dur_Qty'];
$paymentterm = $_POST['paymentterm'];
$dur_price = $_POST['dur_price'];
$description_in = $_POST['description_in'];
$barcode_in = $_POST['barcode_in']; 
$Membership = "Membership_duration"; 

$data1 = array(
			   "spPostingTitle"=>$Name,
			   "retailQuantity"=>$dur_Qty,
			   "spPostingPrice"=>$dur_price,
			   "spPostingNotes"=>$description_in,
			   "subcategory"=>$Membership,
			    "barcode"=>$barcode_in, 
			   "spCategories_idspCategory"=>1,
			   
			   
			   );

 $res2 = $sp->create_spproduct($data1);   




$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "Name"=>$Name,
			   "dur_Qty"=>$dur_Qty,
			   "paymentterm"=>$paymentterm,
			   "dur_price"=>$dur_price,
			    "description_in"=>$description_in,
                "barcode"=>$barcode_in,	 			
			   "product_table_id"=>$res2,
			   
			   );

$res = $p->create_member_duration($data);  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=membership_type'; ?>";

</script>