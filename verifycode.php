<?php
    include("univ/baseurl.php");
    session_start();

    function sp_autoloader($class) {
        include 'mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

        $u = new _spuser;

		if(isset($_POST["vcode"]) && $_POST["vcode"] != "" && isset($_POST["uid"]) && $_POST["uid"] != "")
		{
			//print_r($_POST);exit;
			$uid = $_POST["uid"];
			$res = $u->loginverifycode($uid);
			$row = mysqli_fetch_assoc($res);
			
			$code = $_POST["vcode"];
			$datacode = $row["phone_verify_code"];
			
			if($code == $datacode)
			{
				$u->activePhone($row["idspUser"]);
				header("Location: $BaseUrl1/registration-steps.php?pageid=5");
			}
			else
			{
			   header("Location: $BaseUrl1/registration-steps.php?pageid=4");
			   
			}
		}
?>