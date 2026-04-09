<?php
	
	session_start();
	include '../univ/baseurl.php';

	if (!isset($_SESSION['pid'])) {
		//$_SESSION['afterlogin'] = "../timeline/";
        //include_once ("check.php");
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
    	$u = new _spprofiles;
		//$updateid = $u->update(array('is_active' => 0), "WHERE t.idspProfiles = " . $_SESSION['pid']);
		$_SESSION['uid'] = 0;
		session_unset();
		session_destroy();
		session_write_close();
		//setcookie(session_name(), '', 0, '/');
		//session_regenerate_id(true);
		
		$re = new _redirect;
		$re->redirect($BaseUrl);
		//header("location:" . $BaseUrl); //to redirect back to "index.php" after logging out
		exit();
    }else{
    	function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
    	$u = new _spprofiles;
		$updateid = $u->update(array('is_active' => 0), "WHERE t.idspProfiles = " . $_SESSION['pid']);
		$_SESSION['uid'] = 0;
		session_unset();
		session_destroy();
		session_write_close();
		//setcookie(session_name(), '', 0, '/');
		//session_regenerate_id(true);
		
		$re = new _redirect;
		$re->redirect($BaseUrl);
		//header("location:" . $BaseUrl); //to redirect back to "index.php" after logging out
		exit();
    }
	
?>  
