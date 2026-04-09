<?php

	include('../univ/baseurl.php');
	session_start();
	
    function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//echo "<pre>"; print_r($_POST); exit;
	if (isset($_POST['cod']) && $_POST['uid']) {
		$cod = strtoupper($_POST['cod']);
		$uid = $_POST['uid'];

		$u = new _spuser;
		$result = $u->isPhoneVerify($uid);
		
		
		//echo $u->ta->sql;
		if ($result && $result->num_rows > 0) {
			echo 0;
		}else{
			$result2 = $u->isvodevalid($uid, $cod);
			
			//echo $u->ta->sql;
			if ($result2) {
				$result3 = $u->activePhone($uid);
				echo 0;
				session_unset();
				session_destroy();

			}else{
				echo 0;
			}
		}


	}

?>