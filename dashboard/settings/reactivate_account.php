<?php 

// error_reporting(E_ALL);
//  ini_set('display_errors', '1');
 require_once("../../univ/baseurl.php" );
//include('../univ/baseurl.php');
session_start();
	function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
	 //echo $BaseUrl;
	//die('====');
	
		$sp= new _spuser;
		//echo $_SESSION['uid'];
		//die('==');
	    $sp1 = $sp->reactivate_account($_SESSION['uid']);
		//echo $sp1;
		//die('==');
		//	$url=;	
		session_destroy();
?>
<script>
	
	window.location= "<?php echo $BaseUrl;?>";
	</script>