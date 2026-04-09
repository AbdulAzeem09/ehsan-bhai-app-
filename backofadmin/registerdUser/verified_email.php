<?php
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");

require_once '../library/config.php';
require_once '../library/functions.php';

if(isset($_POST['u_id']) && isset($_POST['email']) && isset($_POST['username']) && $_POST['u_id'] != "" && $_POST['email'] != "" && $_POST['username']){

		$uid = $_POST['u_id'];
		$email = $_POST['email'];
		$username = $_POST['username'];
	
		$size_email = 8;
		$alpha_key_email = '';
		$keys_email = range('A', 'Z');
		for ($j = 0; $j < 2; $j++) {
			$alpha_key_email .= $keys_email[array_rand($keys_email)];
		}
		
		$length_email = $size_email - 2;
		$key_email = '';
		$keys_email = range(0, 9);
		for ($j = 0; $j < $length_email; $j++) {
			$key_email .= $keys_email[array_rand($keys_email)];
		}
		
		$emailRandCode = "ESP".$alpha_key_email . $key_email;
		
		//update email_verify_code
		$sql		=	"UPDATE spuser SET email_verify_code = '$emailRandCode' WHERE idspUser = $uid";
		$result 	= 	dbQuery($dbConn, $sql);
		
		$em = new _email;
		$em->send_reg_email($email, $username, $uid, $emailRandCode,'info-email@thesharepage.com');
		
		echo 1;
}
?>