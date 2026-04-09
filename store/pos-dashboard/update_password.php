<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

$p = new _pos;  

$data = array(
               "password"=>$_POST['password'],
);

if(isset($_GET['action']) AND $_GET['action'] == "delete"){
	
	$p->delete_user_pass($_GET['id']);
}else{
			   
$res = $p->update_user_pass($data,$_POST['id']);
}    
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=pass_type'; ?>";
</script>