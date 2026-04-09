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


$action = $_GET['action']; 
$row_id = $_GET['id'];

if($action == "delete"){
	 $p->remove_brand($row_id);     
	  
  }



  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/brands.php'; ?>";

</script>