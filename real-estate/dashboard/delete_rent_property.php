<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include('../../univ/baseurl.php');
function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if(isset($_GET['postid'])){
	 //   require_once '../../backofadmin/library/config.php';
		//require_once '../../backofadmin/library/functions.php';


		
		$p = new _realstateposting;
		$postid= $_GET['postid'];
		
		if($_GET['work']=='deactivate'){

		$pll = $p->updateread1($postid);

		
		}
		if($_GET['work']=='delete'){

		$pll = $p->deleteread1($postid);
		$pllpic = $p->deletereadpic1($postid);
			
			
		}
	   // die('============');
				
				
		//$result  = dbQuery($dbConn, $sql);
		
}
?>
<script>
	
	
	 window.location.href = '/real-estate/dashboard/rent-property.php';
	
	
	
	</script>