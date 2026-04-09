<?php
	include('../univ/baseurl.php');
	
    /*function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$re = new _redirect;
	$location = $BaseUrl."/login.php";
	if(!isset($_SESSION['uid'])){
        $re->redirect($location);
	}*/
?>
<script>
window.location.href = "<?php echo $BaseUrl.'/login.php'; ?>"; 

</script>