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

$select_category = $_POST['select_category'];
$select_sub_category = $_POST['type_category'];





$data = array(
			  "select_category"=>$select_category,
			   "select_sub_category"=>$select_sub_category
			   
			   
			   );

$res = $p->update_category_method($data,$id);       

  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=cat_type'; ?>";

</script>