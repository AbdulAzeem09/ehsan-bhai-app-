<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$select_category = $_POST['select_category']; 
$select_sub_category = $_POST['type_category']; 


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "select_category"=>$select_category,
			   "select_sub_category"=>$select_sub_category
			   
			   
			   );

$res = $p->create_category($data);   



?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=cat_type'; ?>";

</script>