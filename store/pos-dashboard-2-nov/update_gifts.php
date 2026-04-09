<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_GET); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$id = $_POST['id'];

$giftcard_type = $_POST['giftcard_type'];
$giftcard_value = $_POST['giftcard_value'];  





$data = array(
			  "giftcard_type"=>$giftcard_type, 
			   "giftcard_value"=>$giftcard_value 
			   
			   
			   );

$res = $p->update_gift_method($data,$id);       

  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=gift_type'; ?>";

</script>