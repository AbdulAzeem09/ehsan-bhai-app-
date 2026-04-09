<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
    include("../univ/baseurl.php");
    session_start();

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

        $u = new _spuser;

		if(isset($_POST["vcode"]) && $_POST["vcode"] != "")
		{
			//print_r($_POST);exit;
			// $uid = $_POST["uid"];
			 $res = $u->loginverifycode($_SESSION['last_user']);
			 $row = mysqli_fetch_assoc($res);
			
			$code = $_POST["vcode"];
			//$datacode = $row["phone_verify_code"];
			//echo $_SESSION["phone_otp"].'++++++';
			if($code == $_SESSION["phone_otp"] )
			{
				$u->activePhone($row["idspUser"]);
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
?>